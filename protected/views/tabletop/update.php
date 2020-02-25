<?php
/* @var $this TabletopController */
/* @var $model Tabletop */

$this->breadcrumbs=array(
	'Надбавки за розмір'=>array('admin'),
    $model->attribute->name=>array('view','id'=>$model->tabletop_id),
	'Редагувати',
);

$this->menu=array(
	array('label'=>'Додати надбавку', 'url'=>array('create')),
	array('label'=>'Переглянути надбавку', 'url'=>array('view', 'id'=>$model->tabletop_id)),

);
?>

<h1>Редагувати надбавку "<?php echo $model->attribute->name; ?>"</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>