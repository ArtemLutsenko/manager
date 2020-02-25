<?php
/* @var $this PriceGroupsController */
/* @var $model PriceGroups */

$this->breadcrumbs=array(
	'Цінові категорії'=>array('index'),
	$model->price_group_name,
);

$this->menu=array(
	array('label'=>'List PriceGroups', 'url'=>array('index')),
	array('label'=>'Create PriceGroups', 'url'=>array('create')),
	array('label'=>'Update PriceGroups', 'url'=>array('update', 'id'=>$model->price_group_id)),
	array('label'=>'Delete PriceGroups', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->price_group_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PriceGroups', 'url'=>array('admin')),
);
?>

<h1>Перегляд <?php echo $model->price_group_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'price_group_id',
		'price_group_name',
	),
)); ?>
