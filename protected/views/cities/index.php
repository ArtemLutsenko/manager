<?php
/* @var $this CitiesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Міста доставки',
);

$this->menu=array(
	array('label'=>'Додати місто доставки', 'url'=>array('create')),
	array('label'=>'Управління містами доставки', 'url'=>array('admin')),
);
?>

<h1>Міста доставки</h1>

<?php


    $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
