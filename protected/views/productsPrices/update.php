<?php
/* @var $this ProductsPricesController */
/* @var $model ProductsPrices */

$this->breadcrumbs=array(
	'Управління цінами'=>array('admin'),
	$model->product_price_id=>array('view','id'=>$model->product_price_id),
	'Редагувати',
);

$this->menu=array(

	array('label'=>'Додати ціну', 'url'=>array('create')),
	array('label'=>'Переглянути ціну', 'url'=>array('view', 'id'=>$model->product_price_id)),
	array('label'=>'Управління цінами', 'url'=>array('admin')),
);
?>

<h1>Редагувати ціну на торвар <?php echo $model->product->product_name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>