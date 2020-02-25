<?php
/* @var $this PaymentMethodsController */
/* @var $model PaymentMethods */

$this->breadcrumbs=array(
	'Способи оплати'=>array('index'),
	$model->payment_method_name,
);

$this->menu=array(
	array('label'=>'Перегляд способів оплати', 'url'=>array('index')),
	array('label'=>'Додати спосіб оплати', 'url'=>array('create')),
	array('label'=>'Редагувати даний спосіб оплати', 'url'=>array('update', 'id'=>$model->payment_method_id)),
	array('label'=>'Видалити даний спосіб оплати', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->payment_method_id),'confirm'=>'Ви дійсно бажаєте видалити даний елемент?')),
	array('label'=>'Управління способами оплати', 'url'=>array('admin')),
);
?>

<h1>Перегляд способу оплати "<?php echo $model->payment_method_name; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'payment_method_id',
		'payment_method_name',
	),
)); ?>
