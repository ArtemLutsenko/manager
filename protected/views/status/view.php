<?php
/* @var $this StatusController */
/* @var $model Status */

$this->breadcrumbs=array(
	'Статуси'=>array('admin'),
	$model->status_name,
);

$this->menu=array(
	array('label'=>'Додати статус', 'url'=>array('create')),
	array('label'=>'Редагувати статус', 'url'=>array('update', 'id'=>$model->status_id)),
	array('label'=>'Видалити статус', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->status_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управління статусами', 'url'=>array('admin')),
);
?>

<h1>Статус <?php echo $model->status_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'status_name',
		'status_desc',
	),
)); ?>
