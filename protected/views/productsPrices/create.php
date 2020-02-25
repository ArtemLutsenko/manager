<?php
/* @var $this ProductsPricesController */
/* @var $model ProductsPrices */

$this->breadcrumbs=array(
	'Управління цінами'=>array('admin'),
	'Додати',
);

$this->menu=array(

	array('label'=>'Управління цінами', 'url'=>array('admin')),
);
?>

<h1>Додати ціну на товар</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>