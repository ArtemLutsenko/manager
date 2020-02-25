<?php
/* @var $this AttributesController */
/* @var $model Attributes */

$this->breadcrumbs=array(
	'Атрибути'=>array('admin'),
	'Додати',
);

$this->menu=array(
	//array('label'=>'List Attributes', 'url'=>array('index')),
	array('label'=>'Управління атрибутами', 'url'=>array('admin')),
);
?>

<h1>Додати атрибут</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>