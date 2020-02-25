<?php
/* @var $this ShopsController */
/* @var $model Shops */

$this->breadcrumbs=array(
	'Магазини'=>array('admin'),
	'Додати',
);

$this->menu=array(
	array('label'=>'Управління магазинами', 'url'=>array('admin')),
);
?>

<h1>Додати магазин</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>