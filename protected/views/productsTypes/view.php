<?php
/* @var $this ProductsTypesController */
/* @var $model ProductsTypes */

$this->breadcrumbs=array(
	'Типи товарів'=>array('admin'),
	$model->name,
);

$this->menu=array(

	array('label'=>'Додати тип', 'url'=>array('create')),
	array('label'=>'Редагувати тип', 'url'=>array('update', 'id'=>$model->product_type_id)),
	array('label'=>'Видалати тип', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->product_type_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управління типами', 'url'=>array('admin')),
);
?>

<h1>Тип товару "<?php echo $model->name; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(

		'name',
	),
)); ?>
