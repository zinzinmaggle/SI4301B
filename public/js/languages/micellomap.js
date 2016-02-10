var micello = {};
micello.maps = {};
micello.maps.PROTOCOL = "http";
if (location.protocol == "https:") {
    micello.maps.PROTOCOL = "https"
}
micello.maps.VERSION_SERVER = "maps.micello.com";
micello.maps.init = function (a, b) {
    micello.maps.key = a;
    micello.maps.initCallback = b;
    if (micello.maps.MapControl) {
        b()
    }
};
micello.maps.loadInit = function () {
    var f = (new Date()).getTime();
    var d = document.createElement("canvas");
    var g = (d.getContext) ? 1 : 0;
    var a = 0;
    var b = micello.maps.PROTOCOL + "://" + micello.maps.VERSION_SERVER + "/webmapversion/scriptrequest?v=" + a + "&t=" + f + "&c=" + g;
    micello.maps.networkRequest(b, micello.maps.loadInit2, micello.maps.errorHandler, "POST")
};
micello.maps.loadInit2 = function (f) {
    var d = document.getElementsByTagName("head")[0];
    if (!d) {
        micello.maps.onMapError("Error: head element not found!");
        return
    }
    var c;
    var a = f.scripts;
    if (a) {
        for (c = 0; c < a.length; c++) {
            micello.maps.addScript(d, a[c])
        }
    }
    var b = f.css;
    if (b) {
        for (c = 0; c < b.length; c++) {
            micello.maps.addCss(d, b[c])
        }
    }
};
micello.maps.addScript = function (c, b) {
    if (b.substr(0, 4) == "http") {
        srcTmp = b.split(":");
        b = micello.maps.PROTOCOL + ":" + srcTmp[1]
    } else {
        b = micello.maps.PROTOCOL + "://" + b
    }
    var a = document.createElement("script");
    a.type = "text/javascript";
    a.src = b;
    c.appendChild(a)
};
micello.maps.addCss = function (b, a) {
    if (a.substr(0, 4) == "http") {
        srcTmp = a.split(":");
        a = micello.maps.PROTOCOL + ":" + srcTmp[1]
    } else {
        a = micello.maps.PROTOCOL + "://" + a
    }
    var c = document.createElement("link");
    c.rel = "stylesheet";
    c.type = "text/css";
    c.href = a;
    b.appendChild(c)
};
micello.maps.networkRequest = function (url, onDownload, onFailure, httpMethod, body) {
    var xmlhttp;
    var doIe = false;
    if (window.XDomainRequest) {
        xmlhttp = new XDomainRequest();
        xmlhttp.timeout = 10000;
        doIe = true
    } else {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest()
        } else {
            onFailure("This browser is not supported.");
            return
        }
    }
    if (!doIe) {
        xmlhttp.dataManager = this;
        xmlhttp.onreadystatechange = function () {
            var msg;
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var data = eval("(" + xmlhttp.responseText + ")");
                if (data.error) {
                    msg = "Error in request: " + data.error;
                    onFailure(msg)
                } else {
                    onDownload(data)
                }
            } else {
                if (xmlhttp.readyState == 4 && xmlhttp.status >= 400) {
                    msg = "Error in http request. Status: " + xmlhttp.status;
                    onFailure(msg)
                }
            }
        }
    } else {
        xmlhttp.onload = function () {
            var data = eval("(" + xmlhttp.responseText + ")");
            if (data.error) {
                msg = "Error in request: " + data.error;
                onFailure(msg)
            } else {
                onDownload(data)
            }
        };
        xmlhttp.onerror = function () {
            msg = "Error in http request. Status: " + xmlhttp.status;
            onFailure(msg)
        }
    }
    xmlhttp.open(httpMethod, url, true);
    if (!doIe) {
        if (httpMethod == "POST") {
            xmlhttp.setRequestHeader("Content-Type", "text/plain")
        }
    }
    xmlhttp.send(body)
};
micello.maps.errorHandler = function (a) {
    e = document.createElement("div");
    e.innerHTML = "Micello Map: " + a;
    e.setAttribute("id", "micello-map-msg");
    e.style.top = 0;
    e.style.left = 0;
    e.style.padding = "7px";
    e.style.border = "1px solid #666";
    e.style.backgroundColor = "#fff";
    e.style.position = "absolute";
    document.body.appendChild(e);
    setTimeout(function (b) {
        eM = document.getElementById("micello-map-msg");
        eM.style.display = "none"
    }, 7000)
};
micello.maps.onMapError = micello.maps.errorHandler;
micello.maps.loadInit();