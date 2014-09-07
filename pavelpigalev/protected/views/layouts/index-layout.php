<?
/* @var $this MyController */

FrontHelper::o()->addLess('layout/index-layout.less');
FrontHelper::o()->addJs('myWindow.js');
FrontHelper::o()->addJs('loading.js');
FrontHelper::o()->addJs('main.js');
$this->_app->clientScript->registerCoreScript('jquery');

$baseUrl = $this->_app->request->baseUrl;
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="language" content="ru"/>

        <title><?= CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>
    <div id="main-scroll">
        <?= $content; ?>
        <div class="clear"></div>
    </div>
    </body>
    </html>
<?
$cs = $this->_app->getClientScript();
if ($cssFile = FrontHelper::o()->getCssFile()) {
    $cs->registerCssFile($cssFile);
}
if ($jsFile = FrontHelper::o()->getJsFile()) {
    $cs->registerScriptFile($jsFile);
}
?>