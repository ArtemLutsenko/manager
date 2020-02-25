<?php
/* @var $this AttributesController */
/* @var $model Attributes */

$this->breadcrumbs=array(
	'Атрибути'=>array('admin'),
	$model->name,
);

$this->menu=array(

	array('label'=>'Додати атрибут', 'url'=>array('create')),
	array('label'=>'Редагувати атрибут', 'url'=>array('update', 'id'=>$model->attribute_id)),
	array('label'=>'Видалити атрибут', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->attribute_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управління атрибутами', 'url'=>array('admin')),
);
?>

<h1>Атрибут <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'desc',
	),
)); ?>
