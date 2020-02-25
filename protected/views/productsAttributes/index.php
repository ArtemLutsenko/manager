<?php
/* @var $this ProductsAttributesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Products Attributes',
);

$this->menu=array(
	array('label'=>'Create ProductsAttributes', 'url'=>array('create')),
	array('label'=>'Manage ProductsAttributes', 'url'=>array('admin')),
);
?>

<h1>Products Attributes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
