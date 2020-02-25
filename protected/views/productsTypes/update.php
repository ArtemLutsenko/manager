<?php
/* @var $this ProductsTypesController */
/* @var $model ProductsTypes */

$this->breadcrumbs=array(
	'Типи продуктів'=>array('admin'),
	$model->name=>array('view','id'=>$model->product_type_id),
	'Редагувати',
);

$this->menu=array(

	array('label'=>'Додати тип', 'url'=>array('create')),
	array('label'=>'Редагувати тип', 'url'=>array('view', 'id'=>$model->product_type_id)),
	array('label'=>'Управління типами', 'url'=>array('admin')),
);
?>

<h1>Рудагувати тип "<?php echo $model->name; ?>"</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>