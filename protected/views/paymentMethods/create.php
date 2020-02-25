<?php
/* @var $this PaymentMethodsController */
/* @var $model PaymentMethods */

$this->breadcrumbs=array(
	'Способи оплати'=>array('index'),
	'Додати',
);

$this->menu=array(
	array('label'=>'Перелік способів оплати', 'url'=>array('index')),
	array('label'=>'Управління способами оплати', 'url'=>array('admin')),
);
?>

<h1>Додати спосіб оплати</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>