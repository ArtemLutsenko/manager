<?php
/* @var $this ProductsController */
/* @var $model Products */

$this->breadcrumbs=array(
	'Управління товарами'=>array('index'),
	$model->product_name=>array('view','id'=>$model->product_id),
	'Редагувати',
);

$this->menu=array(

	array('label'=>'Додати товар', 'url'=>array('create')),
	array('label'=>'Переглянути товар', 'url'=>array('view', 'id'=>$model->product_id)),
	array('label'=>'Управління товарами', 'url'=>array('admin')),
);
?>

<h1>Редагувати товар <?php echo $model->product_name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>