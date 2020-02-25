<?php
/* @var $this ShipmentMethodController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Способи доставки',
);

$this->menu=array(
	array('label'=>'Додати спосіб доставки', 'url'=>array('create')),
	array('label'=>'Управління способами доставки', 'url'=>array('admin')),
);
?>

<h1>Способи доставки</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
