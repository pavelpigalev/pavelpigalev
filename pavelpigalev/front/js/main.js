function MainPage() {

    var self = this;

    var _browser = (typeof( window.innerWidth ) == 'number') ? 0 : ((document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight)) ? 1 : 2),
        _layersWrapper = $('#mountain-layers'),
        _imgRatio = 1;

    var _getWindowSizes = function () {
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

    var _resizeToFitWindow = function () {
        var ws = _getWindowSizes(),
            layers = _layersWrapper.find('#layers'),
            leftText = layers.find('.text.text-left'),
            rightText = layers.find('.text.text-right'),
            w, h, lCss = {}, ltCss = {}, rtCss = {};
        _layersWrapper.css('width', ws.w + 'px');
        _layersWrapper.css('height', ws.h + 'px');

        w = (_imgRatio > ws.r) ? ws.w : ws.h / _imgRatio;
        h = (_imgRatio > ws.r) ? ws.w * _imgRatio : ws.h;

        lCss.width = w;
        lCss.height = h;
        lCss.left = -((w - ws.w) / 2);
        lCss.top = -((h - ws.h) / 2);

        if (ws.r < 0.7 && ws.h > 450) {
            ltCss['margin-left'] = -lCss.left + (ws.w / 7);
            ltCss['margin-top'] = (142 - leftText.height()) * 0.8 + (h / 4.5) + ((h - ws.h) / 5);
            rtCss['margin-right'] = (w - ws.w + lCss.left) + ((ws.w - rightText.width()) / 3.5);
            rtCss['margin-top'] = ltCss['margin-top']  + leftText.height()*0.93;
        } else {
            ltCss['margin-left'] = -lCss.left + ((ws.w - leftText.width()) / 2) - (rightText.width() / 28);
            ltCss['margin-top'] = (h - ws.h) / 2 + h/4;
            rtCss['margin-right'] = (w - ws.w + lCss.left) + ((ws.w - rightText.width()) / 2);
            rtCss['margin-top'] = ltCss['margin-top']  + leftText.height()*0.93;
        }


        layers.css(lCss);
        leftText.css(ltCss);
        rightText.css(rtCss);
    };

    this.init = function (imgRatio) {
        _imgRatio = imgRatio;
        setTimeout(function () {
            _resizeToFitWindow();
            $(window).resize(_resizeToFitWindow);
        }, 50);

    };
}
