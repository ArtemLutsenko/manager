<?php
/* @var $this PropertiesInfoController */
/* @var $model PropertiesInfo */

$this->breadcrumbs=array(
	'Properties Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PropertiesInfo', 'url'=>array('index')),
	array('label'=>'Manage PropertiesInfo', 'url'=>array('admin')),
);
?>

<h1>Create PropertiesInfo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>