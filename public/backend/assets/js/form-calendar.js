var Calendar = function() {
//function to initiate Full CAlendar
    var runCalendar = function() {
        var $modal = $('#event-management');
        $('#event-categories div.event-category').each(function() {
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };
            $(this).data('eventObject', eventObject);
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 50 //  original position after the drag
            });
        });
        var _this = this;
        _this.id_widget = new_guid();
        /* initialize the calendar
         -----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var form = '';
        var calendar = $('#calendar').fullCalendar({
            buttonText: {
//                prev: '<i class="fa fa-chevron-left"></i>',
//                next: '<i class="fa fa-chevron-right"></i>'
            },
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: {
                url: '/Ajax/GetEvents',
                type: 'POST',
                error: function() {
                    $('#script-warning').show();
                }
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            eventDrop: function(event, delta, revertFunc) {

                var start_formated = event.start.format('YYYY-MM-D H:mm');
                var end_formated = event.end.format('YYYY-MM-D H:mm');
                jQuery.ajax({
                    type: "POST",
                    url: "/Ajax/UpdateEventStartEndOnly",
                    data: ({
                        event_id: event._id,
                        start_formated: start_formated,
                        end_formated: end_formated
                    }),
                    beforeSend: function() {
                    },
                    success: function(data) {
                        if (data.success) {

                        } else {
                            revertFunc();
                        }
                    },
                    error: function() {
                        revertFunc();
                    }
                });
            }, eventResize: function(event, delta, revertFunc) {

                var start_formated = event.start.format('YYYY-MM-D H:mm');
                var end_formated = event.end.format('YYYY-MM-D H:mm');
                jQuery.ajax({
                    type: "POST",
                    url: "/Ajax/UpdateEventStartEndOnly",
                    data: ({
                        event_id: event._id,
                        start_formated: start_formated,
                        end_formated: end_formated
                    }),
                    beforeSend: function() {
                    },
                    success: function(data) {
                        if (data.success) {

                        } else {
                            revertFunc();
                        }
                    },
                    error: function() {
                        revertFunc();
                    }
                });
            },
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDay) {
                $.fn.modal.Constructor.prototype.enforceFocus = function() {
                };
                $modal.modal({
                    backdrop: 'static'
                });
                var start_formated = start.format('YYYY/MM/D h:mm A');
                var end_formated = end.format('YYYY/MM/D h:mm A');
                var id_widget = new_guid();
                form = $("<form id='form_" + id_widget + "' class='form-horizontal'></form>");
                jQuery.ajax({
                    type: "POST",
                    url: "/Ajax/CreateNewEventForm",
                    data: ({
                        start_formated: start_formated,
                        end_formated: end_formated
                    }),
                    beforeSend: function() {
                    },
                    success: function(data) {
                        form.append(data.form);
                        form.find('.date-time-range').daterangepicker({
                            timePicker: true,
                            timePickerIncrement: 30,
                            format: 'YYYY/MM/DD h:mm A'
                        });
                        var errorHandler1 = $('.errorHandler', form);
                        var successHandler1 = $('.successHandler', form);
                        form.validate({
                            errorElement: "span", // contain the error msg in a span tag
                            errorClass: 'help-block',
                            errorPlacement: function(error, element) { // render error placement for each input type
                                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
                                } else if (element.attr("name") == "dd" || element.attr("name") == "mm" || element.attr("name") == "yyyy") {
                                    error.insertAfter($(element).closest('.form-group').children('div'));
                                } else {
                                    error.insertAfter(element);
                                }
                            },
                            ignore: "",
                            rules: {
                                title: {
                                    minlength: 3,
                                    required: true
                                },
                                url: {
                                    url: true
                                },
                                category: {
                                    required: true
                                }
                            },
                            messages: {
//                                title: "Please specify the title"
                            },
                            invalidHandler: function(event, validator) { //display error alert on form submit
                                successHandler1.hide();
                                errorHandler1.show();
                            },
                            highlight: function(element) {
                                $(element).closest('.help-block').removeClass('valid');
                                $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                            },
                            unhighlight: function(element) { // revert the change done by hightlight
                                $(element).closest('.form-group').removeClass('has-error');
                            },
                            success: function(label, element) {
                                label.addClass('help-block valid');
                                $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
                            },
                            submitHandler: function(form) {
                                successHandler1.show();
                                errorHandler1.hide();
                                var Data = new Object();
                                jQuery('.a_element').each(function(index) {
                                    Data[jQuery(this).attr('id')] = jQuery(this).val();
                                });
                                jQuery.ajax({
                                    type: "POST",
                                    url: "/Ajax/CreateNewEvent",
                                    data: ({
                                        Data: Data
                                    }),
                                    beforeSend: function() {
                                    },
                                    success: function(data) {
                                        $modal.modal('hide');
                                        form.remove();
                                        calendar.fullCalendar('refetchEvents');
                                    },
                                    error: function() {
                                    }
                                });
                            }

                        });
                    },
                    error: function() {
                    }

                });

                $modal.find('.remove-event').hide().end().find('.update-event').hide().end().find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function() {
                    form.submit();
                });
                calendar.fullCalendar('unselect');
            },
            eventClick: function(calEvent, jsEvent, view) {
                $.fn.modal.Constructor.prototype.enforceFocus = function() {
                };
                $modal.modal({
                    backdrop: 'static'
                });
                var start_formated = calEvent.start.format('YYYY/MM/D h:mm A');
                var end_formated = calEvent.end.format('YYYY/MM/D h:mm A');
                var id_widget = new_guid();
                form = $("<form id='form_" + id_widget + "' class='form-horizontal'></form>");
                jQuery.ajax({
                    type: "POST",
                    url: "/Ajax/UpdateEventForm",
                    data: ({
                        start_formated: start_formated,
                        end_formated: end_formated,
                        event_id: calEvent._id
                    }),
                    beforeSend: function() {
                    },
                    success: function(data) {
                        form.append(data.form);
                        form.find('.date-time-range').daterangepicker({
                            timePicker: true,
                            timePickerIncrement: 30,
                            format: 'YYYY/MM/DD h:mm A'
                        });
                        var errorHandler1 = $('.errorHandler', form);
                        var successHandler1 = $('.successHandler', form);
                        form.validate({
                            errorElement: "span", // contain the error msg in a span tag
                            errorClass: 'help-block',
                            errorPlacement: function(error, element) { // render error placement for each input type
                                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
                                } else if (element.attr("name") == "dd" || element.attr("name") == "mm" || element.attr("name") == "yyyy") {
                                    error.insertAfter($(element).closest('.form-group').children('div'));
                                } else {
                                    error.insertAfter(element);
                                }
                            },
                            ignore: "",
                            rules: {
                                title: {
                                    minlength: 3,
                                    required: true
                                },
                                url: {
                                    url: true
                                },
                                category: {
                                    required: true
                                }
                            },
                            messages: {
//                                title: "Please specify the title"
                            },
                            invalidHandler: function(event, validator) { //display error alert on form submit
                                successHandler1.hide();
                                errorHandler1.show();
                            },
                            highlight: function(element) {
                                $(element).closest('.help-block').removeClass('valid');
                                $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                            },
                            unhighlight: function(element) { // revert the change done by hightlight
                                $(element).closest('.form-group').removeClass('has-error');
                            },
                            success: function(label, element) {
                                label.addClass('help-block valid');
                                $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
                            },
                            submitHandler: function(form) {
                                successHandler1.show();
                                errorHandler1.hide();
                                var Data = new Object();
                                Data['event_id'] = calEvent._id;
                                jQuery('.a_element').each(function(index) {
                                    Data[jQuery(this).attr('id')] = jQuery(this).val();
                                });
                                jQuery.ajax({
                                    type: "POST",
                                    url: "/Ajax/UpdateEvent",
                                    data: ({
                                        Data: Data
                                    }),
                                    beforeSend: function() {
                                    },
                                    success: function(data) {
                                        $modal.modal('hide');
                                        form.remove();
                                        calendar.fullCalendar('refetchEvents');
                                    },
                                    error: function() {
                                    }
                                });
                            }

                        });
                    },
                    error: function() {
                    }

                });
                $modal.find('.remove-event').show().end().find('.update-event').show().unbind('click').click(function() {
                    form.submit();
                }).end().find('.save-event').hide().end().find('.modal-body').empty().prepend(form).end().find('.remove-event').unbind('click').click(function() {
                    jQuery.ajax({
                        type: "POST",
                        url: "/Ajax/RemoveEvent",
                        data: ({
                            event_id: calEvent._id
                        }),
                        beforeSend: function() {
                        },
                        success: function(data) {
                            $modal.modal('hide');
                            form.remove();
//                            calendar.fullCalendar('refetchEvents');
                            if (data.success) {
                                calendar.fullCalendar('removeEvents', function(ev) {
                                    return (ev._id == calEvent._id);
                                });
                            }
                        },
                        error: function() {
                            $modal.modal('hide');
                            form.remove();
                        }
                    });
                });
            }
        });
    };
    return {
        init: function() {
            runCalendar();
        }
    };
}();