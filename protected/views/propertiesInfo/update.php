<?php
/* @var $this PropertiesInfoController */
/* @var $model PropertiesInfo */

$this->breadcrumbs=array(
	'Properties Infos'=>array('index'),
	$model->property_info_id=>array('view','id'=>$model->property_info_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PropertiesInfo', 'url'=>array('index')),
	array('label'=>'Create PropertiesInfo', 'url'=>array('create')),
	array('label'=>'View PropertiesInfo', 'url'=>array('view', 'id'=>$model->property_info_id)),
	array('label'=>'Manage PropertiesInfo', 'url'=>array('admin')),
);
?>

<h1>Update PropertiesInfo <?php echo $model->property_info_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>