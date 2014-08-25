<?php
/* @var $this SiteController */
/* @var $error array */
FrontHelper::o()->addLess('error.less');
$this->pageTitle=$this->_app->name . ' - Ошибка';
?>

<div id="error">
    <h2>ERROR <span>#<?= $code; ?></span></h2>

    <div class="message">
        <?= CHtml::encode($message); ?>
    </div>
</div>
