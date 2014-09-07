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
    $(function() {
       var loading = new Loading(), mainPage = new MainPage();
        loading.init();
        mainPage.init(<?=$ratio;?>);

        $(window).load(function(){
            loading.hide();
        });
    });
</script>
<div id="loading-page"></div>
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