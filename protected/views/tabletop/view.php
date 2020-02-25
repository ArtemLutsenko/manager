<?php
/* @var $this TabletopController */
/* @var $model Tabletop */

$this->breadcrumbs=array(
	'Надбавки за розмір'=>array('admin'),
    $model->attribute->name,
);

$this->menu=array(
	array('label'=>'Додати надбавку', 'url'=>array('create')),
	array('label'=>'Редагувати надбавку', 'url'=>array('update', 'id'=>$model->tabletop_id)),
	array('label'=>'Видалити набдавку', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->tabletop_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управління надбавками', 'url'=>array('admin')),
);
?>

<h1>Надбавка за розмір "<?php echo $model->attribute->name ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'attribute.name',
		'add',
	),
)); ?>
