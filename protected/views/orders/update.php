<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs=array(
	'Замовлення'=>array('index'),
	$model->order_id=>array('view','id'=>$model->order_id),
	'Оновити',
);

$this->menu=array(
	array('label'=>'Перелік замовлень', 'url'=>array('index')),
	array('label'=>'Додати замовлення', 'url'=>array('create')),
	array('label'=>'Переглянути замовлення', 'url'=>array('view', 'id'=>$model->order_id)),
	array('label'=>'Управління замовленнми', 'url'=>array('admin')),
);
?>

<h1>Редагувати замовлення № <?php echo $model->order_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>