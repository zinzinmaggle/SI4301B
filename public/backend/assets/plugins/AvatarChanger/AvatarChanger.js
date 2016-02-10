// Configuration
var AvatarChanger =
        {
            'bg': '#fff',
            'text': '#484848',
            'active': '#439ef2',
            'invalid': '#f24343',
            'disabled': '#b8b8b8',
            'lang':
                    {
                        'and': 'and',
                        'edit': 'edit',
                        'done': "I'm done.",
                        'close': 'Press esc to cancel.',
                        'enter_url': 'Enter image URL',
                        'method':
                                {
                                    'computer': 'Browse computer',
                                    'url': 'Upload from web',
                                    'random': 'Generate random image',
                                    'webcam': 'Webcam snapshot',
                                    'restore': 'Restore default'
                                },
                        'disabled':
                                {
                                    'webcam': 'Webcam not supported',
                                    'restore': 'Restore default'
                                },
                        'instruction':
                                {
                                    'selection': 'Select a method to upload an image.',
                                    'preview': 'Use the mousewheel to resize and the mouse to move the image.',
                                    'webcam': 'Click on the feed to capture an image.'
                                },
                        'error':
                                {
                                    'file_error': 'Please select an image file.',
                                    'image_type': 'Only {types} images are allowed.',
                                    'invalid_url': 'Please enter a valid URL.',
                                    'no_camera': "You don't have a camera or it wasn't detected."
                                }
                    }
        };

// Avatar Changer
(function($)
{
    var action = false,
            config,
            settings = {},
            scripts = document.getElementsByTagName("script"),
            src = scripts[scripts.length - 1].src,
            root = src.substr(0, src.length - 16),
            api = typeof (document.createElement('input').files) === 'object';

    // Style
    document.write('<link rel="stylesheet" href="' + root + 'css/layout.css"/>');
    document.write('<script type="text/javascript" src="' + root + 'js/mousewheel.js"></script>');

    // DOM
    var $body = $('body');

    var $bg = $('<div id="AvatarChanger_bg"/>').css('opacity', .8).mousedown(function(e) {
        e.preventDefault();
    });
    var $wrapper = $('<div id="AvatarChanger_wrapper"/>').mousedown(function(e) {
        e.preventDefault();
    });
    var $container = $('<div id="AvatarChanger_container"/>').appendTo($wrapper);

    var $msg_close = $('<p id="AvatarChanger_close">' + AvatarChanger.lang.close + '</p>').css('color', AvatarChanger.bg).prependTo($wrapper).click(function()
    {
        close();
    }).after('<div></div>');

    var $instruction = $('<p id="AvatarChanger_instruction"/>').css('color', AvatarChanger.bg).appendTo($wrapper);

    // Methods
    var methods = {};

    // Browse computer
    methods.computer = function()
    {
        var $iframe, $target;

        if (api)
        {
            $target = $('<input id="input" name="file" type="file" multiple="multiple"/>').appendTo($('body')).hide().change(function()
            {
                var file = this.files[0];

                if (config.types.indexOf(file.type.substr(6)) === -1)
                {
                    AvatarChanger.error('image_type');
                } else
                {
                    reader = new FileReader;

                    reader.onloadend = function()
                    {
                        AvatarChanger.dataURI(this.result);
                    };

                    reader.readAsDataURL(file);
                }


                $target.remove();
            }).click();
        } else
        {
            $iframe = $('<iframe style="display: none;"/>').bind('load', function()
            {
                var iframe = this.contentWindow.document, i;
                iframe.body.innerHTML = '<form id="form" method="POST" action="' + root + 'php/computer.php" enctype="multipart/form-data"><input type="hidden" name="id" value="' + settings.id + '"/><input id="input" name="file" type="file"/></form>';

                $(iframe.getElementById('input')).change(function()
                {
                    $iframe.unbind('load');

                    iframe.location = 'javascript: document.getElementById("form").submit();';
                });

                iframe.location = 'javascript: document.getElementById("input").click();';
            }).appendTo($('body'));
        }
    };

    // Webcam snapshot
    var getUserMedia, action_webcam = {};

    action_webcam.cancel = function()
    {
        console.log('stop stream');

        this.video.pause();
        this.stream.stop();
    };

    if ('getUserMedia' in navigator || 'webkitGetUserMedia' in navigator)
    {
        getUserMedia = ('getUserMedia' in navigator) ? navigator.getUserMedia : navigator.webkitGetUserMedia;

        methods.webcam = function()
        {
            getUserMedia.call(navigator, {'video': true, 'audio': false}, function(stream)
            {
                selection.cancel();

                action = action_webcam;

                $container.html('<video id="AvatarChanger_camera" autoplay></video>');

                var video = document.getElementById('AvatarChanger_camera');

                action_webcam.stream = stream;
                action_webcam.video = video;

                video.addEventListener('play', function()
                {
                    if (action)
                    {
                        center();
                    }
                });

                video.src = window.URL.createObjectURL(stream);

                video.load();

                // Instruction
                $instruction.show().html(AvatarChanger.lang.instruction.webcam);

                // Capture
                $('#AvatarChanger_camera').click(function()
                {
                    loading.init();

                    action_webcam.cancel();

                    var w = video.videoWidth;
                    var h = video.videoHeight;

                    var canvas = document.createElement('canvas');

                    canvas.width = w;
                    canvas.height = h;

                    var ctx = canvas.getContext('2d');

                    ctx.drawImage(video, 0, 0, w, h);

                    AvatarChanger.dataURI(canvas.toDataURL());

                    return false;
                });
            }, function()
            {
                AvatarChanger.error('no_camera');
            });
        };
    } else
    {
        methods.webcam = false;
    }

    // URL
    methods.url = function()
    {
        var url = prompt(AvatarChanger.lang.enter_url, 'http://');

        if (url)
        {
            selection.cancel();

            loading.init();

            ajax('url', {'url': url}, function(response)
            {
                if (response.type === 'error')
                {
                    AvatarChanger.error(response.data);
                } else
                {
                    AvatarChanger.dataURI(response.data);
                }
            });
        }
    };

    // Generate random image
    methods.random = function()
    {
        selection.cancel();

        loading.init();

        ajax('random', {}, function(data)
        {
            AvatarChanger.dataURI(data);
        });
    };

    // Restore default
    methods.restore = function()
    {
        action = 0;

        $msg_close.hide();

        loading.init();

        ajax('restore', {}, function(response)
        {
            settings.img.attr('src', settings.default);

            action = true;

            close();
        });
    };

    // Layout
    var center = function()
    {
        var top = ($bg.height() - $wrapper.outerHeight(true)) / 2;
        var left = ($bg.width() - $wrapper.outerWidth(true)) / 2;

        if (top < 0)
        {
            top = 0;
        }

        if (left < 0)
        {
            left = 0;
        }

        if (!top || !left)
        {
            $wrapper.css(
                    {
                        'position': 'absolute',
                        'top': top,
                        'left': left
                    });
        } else
        {
            $wrapper.css(
                    {
                        'position': 'fixed',
                        'top': top + 'px',
                        'left': left + 'px'
                    });
        }
    };

    $(window).resize(center);

    // Loading
    var loading = {};

    loading.init = function()
    {
        action = loading;

        $instruction.hide();

        $container.html('<img src="' + root + 'icon/loading.gif"/>');

        center();
    };

    loading.cancel = function()
    {
        $container.html('');
    };

    loading.progress = function(progress)
    {
        $container.html('<div style="width: ' + (progress * 100) + '%; background-color: ' + AvatarChanger.active + ';"></div>');
    };

    // AJAX

    var ajax = function(file, data, callback)
    {
        if (file === "done") {
            var url = '/Attachment/ChangeAvatar';
            if (jQuery('#customer_id').length > 0) {
                data.customer_id = jQuery('#customer_id').val();
            }
        } else {
            var url = root + 'php/' + file + '.php';
        }
        data.id = settings.id;

        if ('data' in settings)
        {
            data.data = settings.data;
        }
        $.ajax(
                {
                    'type': 'POST',
                    'url': url,
                    'data': data,
                    'dataType': 'json',
                    'success': function(response)
                    {
                        if (action !== false)
                        {
                            loading.cancel();

                            callback(response);
                        }
                    },
                    'error': function(xhr)
                    {
                        console.log('AJAX error');
                        console.log(xhr.responseText);
                    }
                });
    };

    // Selection
    var selection = {};

    selection.init = function()
    {
        var i, method, $method;

        action = selection;

        $instruction.show().html(AvatarChanger.lang.instruction.selection);

        $container.addClass('selection').html('');

        for (i = 0; i < config.methods.length; i++)
        {
            method = config.methods[i];

            $method = $('<div class="method"><div class="icon" style="background-image: url(' + root + 'icon/' + method + '.png);"></div></div>').appendTo($container);

            $method.css({'background-color': AvatarChanger.bg, 'color': AvatarChanger.text});

            if (!i)
            {
                $method.addClass('first');
            }

            if (methods[method])
            {
                $method.append('<p>' + AvatarChanger.lang.method[method] + '</p>');

                $method.hover(function()
                {
                    $(this).addClass('hover').css({'background-color': AvatarChanger.active, 'color': AvatarChanger.bg});
                }, function()
                {
                    $(this).removeClass('hover').css({'background-color': AvatarChanger.bg, 'color': AvatarChanger.text});
                });

                $method.bind('click', {'method': methods[method]}, function(e)
                {
                    e.data.method();
                });
            } else
            {
                $method.append('<p>' + AvatarChanger.lang.disabled[method] + '</p>');

                $method.addClass('disabled').css('color', AvatarChanger.disabled);
            }
        }

        $container.append('<div style="clear: both;"></div>');

        center();
    };

    selection.cancel = function()
    {
        $container.removeClass('selection').html('');
    };

    // Error
    AvatarChanger.error = function(key)
    {
        var message = AvatarChanger.lang.error[key], types, i;

        loading.cancel();

        selection.init();

        if (key === 'image_type')
        {
            types = '';

            for (i = 0; i < config.types.length; i++)
            {
                if (i > 0)
                {
                    types += (i === config.types.length - 1) ? (' ' + AvatarChanger.lang.and + ' ') : ', ';
                }

                types += config.types[i];
            }

            message = message.replace('{types}', types);
        }

        $('<div id="AvatarChanger_error">' + message + '</div>').css({'background-color': AvatarChanger.invalid, 'color': AvatarChanger.bg}).appendTo($container);

        center();
    };

    // Preview
    preview = {};

    preview.init = function(img)
    {
        action = preview;

        var $img = $(img);

        var w = img.width;
        var h = img.height;

        var min_width, min_height;

        var width, height, top, left;

        // Instruction
        $instruction.show().html(AvatarChanger.lang.instruction.preview);

        // Container
        var $preview = $('<div id="AvatarChanger_preview"/>').html($img).css(
                {
                    'width': config.width,
                    'height': config.height,
                    'border-color': AvatarChanger.bg
                });

        $container.addClass('preview').html($preview);

        center();

        // Default position
        if (h * config.width / w >= config.height)
        {
            width = config.width;
            height = Math.round(h * config.width / w);

            top = -Math.floor((height - config.height) / 2);
            left = 0;
        } else
        {
            width = Math.round(w * config.height / h);
            height = config.height;

            top = 0;
            left = -Math.floor((width - config.width) / 2);
        }

        min_width = width;
        min_height = height;

        $img.css(
                {
                    'top': top,
                    'left': left,
                    'width': width,
                    'height': height
                });

        // Move
        var move = false;

        $preview.mousedown(function(e)
        {
            e.preventDefault();

            move = [e.pageX, e.pageY];
        });

        $(window).mousemove(preview.mousemove = function(e)
        {
            e.preventDefault();

            if (move !== false)
            {
                top -= move[1] - e.pageY;
                left -= move[0] - e.pageX;

                move = [e.pageX, e.pageY];

                if (top > 0)
                {
                    top = 0;
                }

                if (top < config.height - height)
                {
                    top = config.height - height;
                }

                if (left > 0)
                {
                    left = 0;
                }

                if (left < config.width - width)
                {
                    left = config.width - width;
                }

                $img.css(
                        {
                            'top': top,
                            'left': left,
                        });
            }
        });

        $(window).mouseup(preview.mouseup = function(e)
        {
            e.preventDefault();

            move = false;
        });

        // Zoom
        $container.bind('mousewheel', function(e, direction)
        {
            e.preventDefault();

            var offset = $container.offset();

            var x = e.pageX - offset.left;
            var y = e.pageY - offset.top;

            width *= 1 + direction / 10;
            height *= 1 + direction / 10;

            if (width < min_width)
            {
                width = min_width;
            }

            if (height < min_height)
            {
                height = min_height;
            }

            left -= 0.1 * (x - left) * direction;
            top -= 0.1 * (y - top) * direction;

            if (top > 0)
            {
                top = 0;
            }

            if (top < config.height - height)
            {
                top = config.height - height;
            }

            if (left > 0)
            {
                left = 0;
            }

            if (left < config.width - width)
            {
                left = config.width - width;
            }

            $img.css(
                    {
                        'top': top,
                        'left': left,
                        'width': width,
                        'height': height
                    });
        });

        // Done
        $('<div id="AvatarChanger_done">' + AvatarChanger.lang.done + '</div>').css({'background-color': AvatarChanger.active, 'color': AvatarChanger.bg}).appendTo($container).click(function()
        {
            $msg_close.hide();

            preview.cancel();

            loading.init();

            action = 0;

            ajax('done', {'src': img.src, 'x': -left, 'y': -top, 'width': width, 'height': height}, function(response)
            {
                settings.img.attr('src', '/general/assets/images/avatars/thumb/' + response.img);

                action = true;

                close();

                if ('done' in settings)
                {
                    settings.done();
                }
            });
        });
    };

    preview.cancel = function()
    {
        $(window).unbind('mouseup', preview.mouseup).unbind('mousemove', preview.mousemove);

        $container.unbind('mousedown').unbind('mousewheel').removeClass('preview').css(
                {
                    'width': 'auto',
                    'height': 'auto'
                }).html('');
    };

    // Load image data URI
    AvatarChanger.dataURI = function(data)
    {
        var img = document.createElement('img');
        img.onload = function()
        {
            var pattern, canvas, ctx, x, y;

            if (action)
            {
                canvas = document.createElement('canvas');

                // Enlargement method (only works if canvas is supported)
                if (img.width < config.width / 2 && img.height < config.height / 2 && !!(canvas.getContext && canvas.getContext('2d')))
                {
                    // Repeat image with canvas
                    canvas.width = config.width;
                    canvas.height = config.height;

                    ctx = canvas.getContext('2d');

                    ctx.drawImage(img, 0, 0, img.width, img.height);

                    for (y = 0; y < Math.ceil(config.height / img.height); y++)
                    {
                        for (x = 0; x < Math.ceil(config.width / img.width); x++)
                        {
                            ctx.drawImage(img, x * img.width, y * img.height, img.width, img.height);
                        }
                    }

                    // Create image element
                    pattern = document.createElement('img');

                    pattern.onload = function()
                    {
                        loading.cancel();

                        preview.init(pattern);
                    };

                    pattern.src = canvas.toDataURL();
                } else
                {
                    loading.cancel();

                    preview.init(img);
                }
            }
        };

        img.src = data;
    };

    // Initialize
    var init = function(data)
    {
        action = true;

        // Elements
        $('body').prepend($wrapper).prepend($bg);

        $msg_close.show();

        // AJAX
        loading.init();

        settings = data;

        config = {};
        config.types = ["jpeg", "png", "gif"];
        config.methods = ["computer", "webcam"];
        if (jQuery('#customer_id').length > 0) {
            config.width = 190;
            config.height = 36;
        } else {
            config.width = 200;
            config.height = 300;
        }

        // Config validation
        if (config.methods.indexOf('restore') !== -1 && !('default' in settings))
        {
            console.log('You must set the default image source if the restore method is available.');
        }
        selection.init();

    };

    // Close
    var close = function()
    {
        if (action)
        {
            if (action !== true && action !== selection)
            {
                action.cancel();

                selection.init();
            } else
            {
                action = false;

                $bg.detach();
                $wrapper.detach();
            }
        }
    };

    $(window).keyup(function(e)
    {
        if (e.which === 27)
        {
            close();
        }
    });

    // Avatar Changer
    $.fn.AvatarChanger = function(id, data)
    {
        var $this = this, $wrap, $button;

        if (typeof (data) !== 'object')
        {
            data = {};
        }

        data.id = id;
        data.img = this;

        if (!('src' in data))
        {
            data.src = this.attr('src');
        }

        $this.css('cursor', 'pointer');

        $this.click(function()
        {
            init(data);
        });

        // Button
        if (!('button' in data))
        {
            data.button = true;
        }

//        var onload = function()
//        {


        $this.unbind('load', onload);

        $wrap = $('<div id="AvatarChanger_wrap"/>');

        $this.wrap($wrap);

        $button = $('<div id="AvatarChanger_button">' + AvatarChanger.lang.edit + '</div>').insertAfter($this).css('opacity', .8);


        $button.css(
                {
                    'top': ($this.outerHeight(true) - $button.height()) / 2 - 5,
                    'left': ($this.outerWidth(true) - $button.width()) / 2 - 10
                });
//        };

//        if (data.button)
//        {
//            this.bind('load', onload);
//        }


        if (data.button)
        {
            this.mouseenter(function()
            {
                $button.hide();
            });

            this.mouseleave(function()
            {
                $button.show();
            });
        }
    };
})(jQuery);