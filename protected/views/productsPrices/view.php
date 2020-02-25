<?php
/* @var $this ProductsPricesController */
/* @var $model ProductsPrices */

$this->breadcrumbs=array(
	'Управління цінами'=>array('admin'),
    $model->product->product_name,
);

$this->menu=array(

	array('label'=>'Додати ціну', 'url'=>array('create')),
	array('label'=>'Редагувати ціну', 'url'=>array('update', 'id'=>$model->product_price_id)),
	array('label'=>'Видалити ціну', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->product_price_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управління цінами', 'url'=>array('admin')),
);
?>

<h1>Ціна на товар <?php echo $model->product->product_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'product_price_id',
        array(
            'label'=>'Цінова категорія',
            'value'=>$model->priceGroup->price_group_name
        ),
		array(
            'label'=>'Товар',
            'value'=>$model->product->product_name
        ),
		'product_price',
	),
)); ?>
