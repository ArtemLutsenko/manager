<?php
/* @var $this BillItemsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bill Items',
);

$this->menu=array(
	array('label'=>'Create BillItems', 'url'=>array('create')),
	array('label'=>'Manage BillItems', 'url'=>array('admin')),
);
?>

<h1>Bill Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
