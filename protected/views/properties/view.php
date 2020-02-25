<?php
/* @var $this PropertiesController */
/* @var $model Properties */

$this->breadcrumbs=array(
	'Кольори'=>array('admin'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Додати колір', 'url'=>array('create')),
	array('label'=>'Редагувати колір', 'url'=>array('update', 'id'=>$model->property_id)),
	array('label'=>'Видалити колір', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->property_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управління кольорами', 'url'=>array('admin')),
);
?>

<h1>Колір <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'attribute.name',
		'name',
		//'img_url',
		//'img_url_thumb',
	),
)); ?>
