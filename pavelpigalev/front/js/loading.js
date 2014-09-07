function Loading() {
    var self = this,
        _window = null,
        _interval = 0,
        _loader = $('#loading-page'),
        _lp, _i = 0;

    var _resize = function () {
        var ws = _window.getWindowSizes();
        _window.fitToWindowSizes(_loader);
        _lp.css({
            'line-height' : 65 + 'px',
            top: (ws.h - 65) / 2 + 'px',
            left: (ws.w - 220) / 2 + 'px'
        });
    };

    this.show = function () {
        _loader.html('<p></p>');
        _lp =_loader.find('p');
        _interval = setInterval(function () {
            !((_i++)%4) ? _lp.html('Loading') : _lp.append('.');
            console.log(_interval);
        }, 500);
        _resize();
        $(window).resize(_resize);
        _loader.fadeIn(1000);
    };

    this.hide = function () {
        _loader.fadeOut(1000);
        _i = 0;
        $(window).off("resize", _resize);
        clearInterval(_interval);
    };

    this.init = function () {
        _window = new MyWindow();
        self.show();
    }
}
