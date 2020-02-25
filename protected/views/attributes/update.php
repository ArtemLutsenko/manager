<?php
/* @var $this AttributesController */
/* @var $model Attributes */

$this->breadcrumbs=array(
	'Атрибути'=>array('admin'),
	$model->name=>array('view','id'=>$model->attribute_id),
	'Редагувати',
);

$this->menu=array(

	array('label'=>'Додати атрибут', 'url'=>array('create')),
	array('label'=>'Перегляд атрибуту', 'url'=>array('view', 'id'=>$model->attribute_id)),
	array('label'=>'Управління атрибутами', 'url'=>array('admin')),
);
?>

<h1>Редагувати атрибут "<?php echo $model->name; ?>"</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>