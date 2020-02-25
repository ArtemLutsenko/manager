<?php
/* @var $this ProductsAttributesController */
/* @var $model ProductsAttributes */

$this->breadcrumbs=array(
	'Атрибути товарів'=>array('admin'),
	$model->product->product_name=>array('view','id'=>$model->product_attribute_id),
	'Редагувати',
);

$this->menu=array(

	array('label'=>'Редагувати атрибут товару', 'url'=>array('create')),
	array('label'=>'Переглянути атрибут товару', 'url'=>array('view', 'id'=>$model->product_attribute_id)),
	array('label'=>'Атрибути товарів', 'url'=>array('admin')),
);
?>

<h1>Редагувати атрибут товара <?php echo $model->product->product_name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>