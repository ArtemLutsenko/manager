<?php
/* @var $this OrdersItemsPropertiesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Orders Items Properties',
);

$this->menu=array(
	array('label'=>'Create OrdersItemsProperties', 'url'=>array('create')),
	array('label'=>'Manage OrdersItemsProperties', 'url'=>array('admin')),
);
?>

<h1>Orders Items Properties</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
