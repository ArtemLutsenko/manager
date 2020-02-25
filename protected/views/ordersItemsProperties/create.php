<?php
/* @var $this OrdersItemsPropertiesController */
/* @var $model OrdersItemsProperties */

$this->breadcrumbs=array(
	'Orders Items Properties'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OrdersItemsProperties', 'url'=>array('index')),
	array('label'=>'Manage OrdersItemsProperties', 'url'=>array('admin')),
);
?>

<h1>Create OrdersItemsProperties</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>