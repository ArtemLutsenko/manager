<?php
/* @var $this PropertiesController */
/* @var $model Properties */

$this->breadcrumbs=array(
	'Кольори'=>array('admin'),
	'Додати',
);

$this->menu=array(

	array('label'=>'Управління кольорами', 'url'=>array('admin')),
);
?>

<h1>Додати колір</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>