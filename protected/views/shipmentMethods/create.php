<?php
/* @var $this ShipmentMethodController */
/* @var $model ShipmentMethods */

$this->breadcrumbs=array(
	'Способи доставки'=>array('admin'),
	'Додати',
);

$this->menu=array(

	array('label'=>'Управління способами доставки', 'url'=>array('admin')),
);
?>

<h1>Додати спосіб доставки</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>