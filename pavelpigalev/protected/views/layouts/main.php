<?
/* @var $this MyController */
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="ru" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?= $this->_app->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?= $this->_app->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?= $this->_app->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?= $this->_app->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?= $this->_app->request->baseUrl; ?>/css/form.css" />

	<title><?= CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?= CHtml::encode($this->_app->name); ?></div>
	</div>

	<div id="mainmenu">
		<? $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Главная', 'url'=>array('/site/index')),
				array('label'=>'Обо мне', 'url'=>array('/site/about')),
				array('label'=>'Опыт', 'url'=>array('/site/experience')),
				array('label'=>'Портфолио', 'url'=>array('/site/portfolio')),
				array('label'=>'Код', 'url'=>array('/code/index')),
			),
		)); ?>
	</div>
    
	<? if(isset($this->breadcrumbs)):?>
		<? $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?>
	<? endif?>

	<?= $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?= date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?= Yii::powered(); ?>
	</div>

</div>

</body>
</html>
