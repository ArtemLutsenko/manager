<?php
/* @var $this ShipmentMethodController */
/* @var $model ShipmentMethods */

$this->breadcrumbs=array(
	'Способи доставки'=>array('index'),
	$model->shipment_name,
);

$this->menu=array(
	array('label'=>'Додати спосіб доставки', 'url'=>array('create')),
	array('label'=>'Редагувати даний спосіб доставки', 'url'=>array('update', 'id'=>$model->shipment_name_id)),
	array('label'=>'Видалити даний спосіб доставки', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->shipment_name_id),'confirm'=>'Ви дійсно бажаєте видалити даний елемент?')),
	array('label'=>'Управління способами доставки', 'url'=>array('admin')),
);
?>

<h1>Спосіб доставки <?php echo $model->shipment_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'shipment_name_id',
		'shipment_name',
	),
)); ?>
