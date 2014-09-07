function MyWindow() {
    var self = this;
    var _browser = (typeof( window.innerWidth ) == 'number') ? 0 : ((document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight)) ? 1 : 2);

    this.getWindowSizes = function () {
        var d = document, w = window, windowH, windowW;
        if (_browser == 0) {
            windowW = $(w).innerWidth();
            windowH = $(w).innerHeight();
        } else if (_browser == 1) {
            windowW = d.documentElement.clientWidth;
            windowH = d.documentElement.clientHeight;
        } else {
            windowW = d.body.clientWidth;
            windowH = d.body.clientHeight;
        }
        return {w: windowW, h: windowH, r: windowH / windowW}
    };

    this.fitToWindowSizes = function(obj) {
        var ws = self.getWindowSizes();
        obj.css('width', ws.w + 'px');
        obj.css('height', ws.h + 'px');
    }
}
