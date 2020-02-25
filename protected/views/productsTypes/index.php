<?php
/* @var $this ProductsTypesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Products Types',
);

$this->menu=array(
	array('label'=>'Create ProductsTypes', 'url'=>array('create')),
	array('label'=>'Manage ProductsTypes', 'url'=>array('admin')),
);
?>

<h1>Products Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
