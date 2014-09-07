<?
/**
 * @var $this MainController
 * @var $ratio float
 * @var $layers array
 */

$this->pageTitle = $this->_app->name . ' | ' . (($this->_app->params['debug']) ? 'development' : 'production');
FrontHelper::o()->addLess('main');
?>
<script>
    $(function () {
        var mainPage = new MainPage();
        mainPage.init(<?=$ratio;?>);
    });
</script>
<div id="mountain-layers">
    <div id="layers">
        <? foreach ($layers as $layer) : ?>
            <div class="layer">
                <?
                switch ($layer['type']) {
                    case 'img':
                        echo '<img src="' . $layer['src'] . '">';
                        break;
                    case 'html':
                    default:
                        echo $layer['src'];
                        break;
                }
                ?>
            </div>
        <? endforeach; ?>
    </div>
</div>