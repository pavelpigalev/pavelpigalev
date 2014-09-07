<?php
/**
 * @var $this SiteController
 * @var $code int
 * @var $message string
 * */
FrontHelper::o()->addLess('error.less');
$this->pageTitle=$this->_app->name . ' - Ошибка';
?>

<div id="error">
    <h2>ERROR <span>#<?= $code; ?></span></h2>

    <div class="message">
        <?
        switch($code) {
            case 404:
                echo '<p>Sorry, you must be lost.</p>';
                break;
        }
        ?>
        <p class="error-message"><?= CHtml::encode($message); ?></p>
    </div>
</div>
