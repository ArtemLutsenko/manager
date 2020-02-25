<?php
/* @var $this OrderItemsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Order Items',
);

$this->menu=array(
	array('label'=>'Create OrderItems', 'url'=>array('create')),
	array('label'=>'Manage OrderItems', 'url'=>array('admin')),
);
?>

<h1>Order Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
