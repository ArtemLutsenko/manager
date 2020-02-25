<?php
/* @var $this CustomerController */
/* @var $model Customer */

$this->breadcrumbs=array(
	'Покупці'=>array('admin'),
    $model->getCustomerName($model->customer_id)=>array('view','id'=>$model->customer_id),
	'Редагувати',
);

$this->menu=array(
	array('label'=>'Переглянути покупця', 'url'=>array('view', 'id'=>$model->customer_id)),
	array('label'=>'Управління покупцями', 'url'=>array('admin')),
);
?>

<h1>Редагувати покупця "<?php echo $model->getCustomerName($model->customer_id); ?>"</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>