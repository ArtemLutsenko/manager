<?php
/* @var $this PropertiesInfoController */
/* @var $model PropertiesInfo */

$this->breadcrumbs=array(
	'Properties Infos'=>array('index'),
	$model->property_info_id,
);

$this->menu=array(
	array('label'=>'List PropertiesInfo', 'url'=>array('index')),
	array('label'=>'Create PropertiesInfo', 'url'=>array('create')),
	array('label'=>'Update PropertiesInfo', 'url'=>array('update', 'id'=>$model->property_info_id)),
	array('label'=>'Delete PropertiesInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->property_info_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PropertiesInfo', 'url'=>array('admin')),
);
?>

<h1>View PropertiesInfo #<?php echo $model->property_info_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'property_info_id',
		'type',
		'collection',
	),
)); ?>
