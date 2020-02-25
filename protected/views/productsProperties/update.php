<?php
/* @var $this ProductsPropertiesController */
/* @var $model ProductsProperties */

$this->breadcrumbs=array(
	'Надбавки за колір'=>array('admin'),
	$model->property->name=>array('view','id'=>$model->product_property_id),
	'Редагувати',
);

$this->menu=array(

	array('label'=>'Додати надбавку', 'url'=>array('create')),
	array('label'=>'переглянути надбавку', 'url'=>array('view', 'id'=>$model->product_property_id)),
	array('label'=>'Надбавки за колір', 'url'=>array('admin')),
);
?>

<h1>Редагувати надбавку за колір "<?php echo $model->property->name; ?>"</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>