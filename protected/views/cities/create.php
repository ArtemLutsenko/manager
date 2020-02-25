<?php
/* @var $this CitiesController */
/* @var $model Cities */

$this->breadcrumbs=array(
	'Міста доставки'=>array('admin'),
	'Додати місто',
);

$this->menu=array(
	//array('label'=>'Перелік міст доставки', 'url'=>array('index')),
	array('label'=>'Управління містами доставки', 'url'=>array('admin')),
);
?>

<h1>Додати місто</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>