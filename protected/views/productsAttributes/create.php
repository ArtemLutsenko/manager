<?php
/* @var $this ProductsAttributesController */
/* @var $model ProductsAttributes */

$this->breadcrumbs=array(
	'Атрибути товарів'=>array('admin'),
	'Додати',
);

$this->menu=array(

	array('label'=>'Атрибути товарів', 'url'=>array('admin')),
);
?>

<h1>Додати атрибут товару</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>