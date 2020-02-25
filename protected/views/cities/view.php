<?php
/* @var $this CitiesController */
/* @var $model Cities */

$this->breadcrumbs=array(
	'Міста доставки'=>array('admin'),
	$model->city_name,
);

$this->menu=array(

    array('label'=>'Додати місто', 'url'=>array('create')),
	array('label'=>'Редагувати місто', 'url'=>array('update', 'id'=>$model->city_id)),
	array('label'=>'Видалити місто', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->city_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управління містами доставки', 'url'=>array('admin')),
);
?>

<h1>Місто <?php echo $model->city_name; ?></h1>

<?php

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'city_name',
		'region_name',
	),
)); ?>
