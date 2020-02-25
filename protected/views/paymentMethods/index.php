<?php
/* @var $this PaymentMethodsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Способи оплати',
);

$this->menu=array(
	array('label'=>'Додати спосіб оплати', 'url'=>array('create')),
	array('label'=>'Управління способами оплати', 'url'=>array('admin')),
);
?>

<h1>Перелік способів оплати</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
