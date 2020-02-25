<?php
/* @var $this ShopsController */
/* @var $model Shops */

$this->breadcrumbs=array(
	'Магазини'=>array('admin'),
	$model->full_name=>array('view','id'=>$model->shop_id),
	'Редагувати',
);

$this->menu=array(
	array('label'=>'Додати магазни', 'url'=>array('create')),
	array('label'=>'Переглянути магазин', 'url'=>array('view', 'id'=>$model->shop_id)),
	array('label'=>'Управління магазинами', 'url'=>array('admin')),
);
?>

<h1>Редагувати магазин "<?php echo $model->full_name; ?>"</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>