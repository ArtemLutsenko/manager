<?php
/* @var $this PaymentMethodsController */
/* @var $model PaymentMethods */

$this->breadcrumbs=array(
	'Способи оплати'=>array('index'),
	$model->payment_method_name=>array('view','id'=>$model->payment_method_id),
	'Редагувати',
);

$this->menu=array(
	array('label'=>'Перегляд способів оплати', 'url'=>array('index')),
	array('label'=>'Додати спосіб оплати', 'url'=>array('create')),
	array('label'=>'Переглянути даний спосіб оплати', 'url'=>array('view', 'id'=>$model->payment_method_id)),
	array('label'=>'Управління способами оплати', 'url'=>array('admin')),
);
?>

<h1>Редагувати способ оплати "<?php echo $model->payment_method_name; ?>"</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>