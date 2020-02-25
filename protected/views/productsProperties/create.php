<?php
/* @var $this ProductsPropertiesController */
/* @var $model ProductsProperties */

$this->breadcrumbs=array(
	'Надбавки за колір'=>array('admin'),
	'Додати',
);

$this->menu=array(

	array('label'=>'Надбавки за колір', 'url'=>array('admin')),
);
?>

<h1>Додати надбавку за колір</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>