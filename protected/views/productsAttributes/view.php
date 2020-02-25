<?php
/* @var $this ProductsAttributesController */
/* @var $model ProductsAttributes */

$this->breadcrumbs=array(
	'Атрибути товарів'=>array('admin'),
	$model->product->product_name,
);

$this->menu=array(
	array('label'=>'Додати атрибут товару', 'url'=>array('create')),
	array('label'=>'Редагувати атрибут товару', 'url'=>array('update', 'id'=>$model->product_attribute_id)),
	array('label'=>'Видалити атрибут товару', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->product_attribute_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Атрибути товарів', 'url'=>array('admin')),
);
?>

<h1>Атрибут товару <?php echo $model->product->product_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'product.product_name',
		'attribute.name',
	),
)); ?>
