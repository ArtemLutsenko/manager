<?php
/* @var $this TabletopController */
/* @var $model Tabletop */

$this->breadcrumbs=array(
	'Надбавки за розмір'=>array('admin'),
	'Додати',
);

$this->menu=array(

	array('label'=>'Надбавки за розмір', 'url'=>array('admin')),
);
?>

<h1>Додати надбавку за розмір</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>