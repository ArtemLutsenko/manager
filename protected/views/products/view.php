<?php
/* @var $this ProductsController */
/* @var $model Products */

$this->breadcrumbs=array(
	'Управління товарами'=>array('admin'),
	$model->product_name,
);

$this->menu=array(

	array('label'=>'Додати товар', 'url'=>array('create')),
	array('label'=>'Редагувати товар', 'url'=>array('update', 'id'=>$model->product_id)),
	array('label'=>'Видалити товар', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->product_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управління товарами', 'url'=>array('admin')),
);
?>

<h1>Товар <?php echo $model->product_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(

		'product_name',
		'product_length',
		'product_insert',
		'product_width',
		'product_height',

        array(
            'name'=>'patina',
            'value' => ($model->patina != 0) ? "Так" : "Ні",

        )
	),
)); ?>
