<?php
/* @var $this OrderItemsController */
/* @var $model OrderItems */

$this->breadcrumbs=array(
	'Замовлені товари'=>array('admin'),
	$model->product->product_name=>array('view','id'=>$model->order_item_id),
	'Редагувати',
);

$this->menu=array(


	array('label'=>'Переглянути товар', 'url'=>array('view', 'id'=>$model->order_item_id)),
	array('label'=>'Замовлені товари', 'url'=>array('admin')),
);
?>

<h1>Редагувати замовлений товар <?php echo $model->product->productType->name." ". $model->product->product_name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>