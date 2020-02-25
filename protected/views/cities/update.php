<?php
/* @var $this CitiesController */
/* @var $model Cities */

$this->breadcrumbs=array(
	'Міста доставки'=>array('admin'),
	$model->city_name=>array('view','id'=>$model->city_name),
	'Редагувати',
);

$this->menu=array(

	array('label'=>'Додати місто', 'url'=>array('create')),
	array('label'=>'Переглянути місто', 'url'=>array('view', 'id'=>$model->city_id)),
	array('label'=>'Управління містами', 'url'=>array('admin')),
);
?>

<h1>Редагувати місто "<?php echo $model->city_name; ?>"</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>