<?php
/* @var $this ShipmentMethodController */
/* @var $model ShipmentMethods */

$this->breadcrumbs=array(
	'Спосбои доставки'=>array('admin'),
	$model->shipment_name=>array('view','id'=>$model->shipment_name_id),
	'Редагувати',
);

$this->menu=array(
	array('label'=>'Додати спосіб доставки', 'url'=>array('create')),
	array('label'=>'Перегляд даного способу доставки', 'url'=>array('view', 'id'=>$model->shipment_name_id)),
	array('label'=>'Управління способами доставки', 'url'=>array('admin')),
);
?>

<h1>Редагувати спосіб доставки "<?php echo $model->shipment_name; ?>"</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>