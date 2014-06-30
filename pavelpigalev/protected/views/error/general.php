<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=$this->_app->name . ' - Ошибка';
?>

<h2>Ошибка #<?= $code; ?></h2>

<div class="error">
<?= CHtml::encode($message); ?>
</div>