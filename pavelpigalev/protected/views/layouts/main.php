<?
/* @var $this MyController */

FrontHelper::o()->addLess('layout/layout.less');

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
    <div id="header">
        <div id="header-wrapper">
            <div id="logo"><?= CHtml::encode($this->_app->name); ?></div>

            <? $this->widget('zii.widgets.CMenu', array(
                'items'       => array(
                    array(
                        'label'       => 'MAIN',
                        'url'         => array('/main/index'),
                        'itemOptions' => array(
                            'class' => 'menu-item'
                        )
                    ),
                    array(
                        'label'       => 'ABOUT',
                        'url'         => array('/main/about'),
                        'itemOptions' => array(
                            'class' => 'menu-item'
                        )
                    ),
                    array(
                        'label'       => 'EXPERIENCE',
                        'url'         => array('/main/experience'),
                        'itemOptions' => array(
                            'class' => 'menu-item'
                        )
                    ),
                    array(
                        'label'       => 'PORTFOLIO',
                        'url'         => array('/main/portfolio'),
                        'itemOptions' => array(
                            'class' => 'menu-item'
                        )
                    ),
                    array(
                        'label'       => 'CODE',
                        'url'         => array('/code/index'),
                        'itemOptions' => array(
                            'class' => 'menu-item'
                        )
                    )
                ),
                'htmlOptions' => array(
                    'id' => 'mainmenu'
                )
            ));
            ?>
        </div>
    </div>

    <div id="container">
        <? if (isset($this->breadcrumbs)): ?>
            <? $this->widget('zii.widgets.CBreadcrumbs', array('links' => $this->breadcrumbs,)); ?>
        <? endif ?>

        <?= $content; ?>

        <div class="clear"></div>

    </div>
    <div id="footer">
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