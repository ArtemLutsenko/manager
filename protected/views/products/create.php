<?php
/* @var $this ProductsController */
/* @var $model Products */

$this->breadcrumbs=array(
	'Управління товарами'=>array('admin'),
	'Додати',
);

$this->menu=array(

	array('label'=>'Управління товарами', 'url'=>array('admin')),
);
?>

<h1>Додаити товар</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>