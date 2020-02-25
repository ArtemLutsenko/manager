<?php
/* @var $this StatusController */
/* @var $model Status */

$this->breadcrumbs=array(
	'Управління статусами'=>array('admin'),
	$model->status_name=>array('view','id'=>$model->status_id),
	'Редагувати',
);

$this->menu=array(
	array('label'=>'Додати статус', 'url'=>array('create')),
	array('label'=>'Переглянути статус', 'url'=>array('view', 'id'=>$model->status_id)),
	array('label'=>'Управління статусами', 'url'=>array('admin')),
);
?>

<h1>Редагувати статус "<?php echo $model->status_name; ?>"</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>