<?php
/* @var $this PropertiesController */
/* @var $model Properties */

$this->breadcrumbs=array(
	'Кольори'=>array('admin'),
	$model->name=>array('view','id'=>$model->property_id),
	'Редагувати',
);

$this->menu=array(
	array('label'=>'Додати колір', 'url'=>array('create')),
	array('label'=>'Переглянути колір', 'url'=>array('view', 'id'=>$model->property_id)),
	array('label'=>'Управління кольорами', 'url'=>array('admin')),
);
?>

<h1>Редагувати колір <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>