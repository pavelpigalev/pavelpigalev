function MainPage() {

    var self = this;

    var _layersWrapper = $('#mountain-layers'),
        _imgRatio = 1,
        _window = null;

    var _resizeToFitWindow = function () {
        var ws = _window.getWindowSizes(),
            layers = _layersWrapper.find('#layers'),
            leftText = layers.find('.text.text-left'),
            rightText = layers.find('.text.text-right'),
            w, h, lCss = {}, ltCss = {}, rtCss = {};
        _window.fitToWindowSizes(_layersWrapper);

        w = (_imgRatio > ws.r) ? ws.w : ws.h / _imgRatio;
        h = (_imgRatio > ws.r) ? ws.w * _imgRatio : ws.h;

        lCss.width = w;
        lCss.height = h;
        lCss.left = -((w - ws.w) / 2);
        lCss.top = -((h - ws.h) / 2);

        /*if (ws.r < 0.7 && ws.h > 450) {
            ltCss['margin-left'] = -lCss.left + (ws.w / 7);
            ltCss['margin-top'] = (142 - leftText.height()) * 0.8 + (h / 4.5) + ((h - ws.h) / 5);
            rtCss['margin-right'] = (w - ws.w + lCss.left) + ((ws.w - rightText.width()) / 3.5);
            rtCss['margin-top'] = ltCss['margin-top']  + leftText.height()*0.93;
        } else {*/
            ltCss['margin-left'] = -lCss.left + ((ws.w - leftText.width()) / 2) - (rightText.width() / 28);
            ltCss['margin-top'] = (h - ws.h) / 2 + (ws.h > 450 ? ws.h/4 : ws.h/20);
            rtCss['margin-right'] = (w - ws.w + lCss.left) + ((ws.w - rightText.width()) / 2);
            rtCss['margin-top'] = ltCss['margin-top']  + leftText.height() * 0.93;
        /*}*/


        layers.css(lCss);
        leftText.css(ltCss);
        rightText.css(rtCss);
    };

    this.init = function (imgRatio) {
        _imgRatio = imgRatio;
        _window = new MyWindow();
        _resizeToFitWindow();
        $(window).resize(_resizeToFitWindow);
    };
}
