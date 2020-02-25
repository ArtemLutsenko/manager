<?php
/* @var $this ProductsPropertiesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Products Properties',
);

$this->menu=array(
	array('label'=>'Create ProductsProperties', 'url'=>array('create')),
	array('label'=>'Manage ProductsProperties', 'url'=>array('admin')),
);
?>

<h1>Products Properties</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
