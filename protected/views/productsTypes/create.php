<?php
/* @var $this ProductsTypesController */
/* @var $model ProductsTypes */

$this->breadcrumbs=array(
	'Типи продуктів'=>array('admin'),
	'Додати',
);

$this->menu=array(

	array('label'=>'Типи продуктів', 'url'=>array('admin')),
);
?>

<h1>Додати тип продукту</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>