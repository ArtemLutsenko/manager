<?php
/* @var $this ProductsPropertiesController */
/* @var $model ProductsProperties */

$this->breadcrumbs=array(
	'Надбавки за колір'=>array('admin'),
	$model->property->name,
);

$this->menu=array(

	array('label'=>'Додати надбавку', 'url'=>array('create')),
	array('label'=>'Редагувати надбавку', 'url'=>array('update', 'id'=>$model->product_property_id)),
	array('label'=>'Видалити надбавку', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->product_property_id),'confirm'=>'Are you sure you want to delete this item?')),

);
?>

<h1>Надбавка за колір <?php echo $model->property->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'priceGroup.price_group_name',
		'property.name',
		'add_payment',
	),
)); ?>
