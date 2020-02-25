<?php
/* @var $this CustomerControllers */
/* @var $model Customers */

$this->breadcrumbs=array(
	'Customers'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Customer', 'url'=>array('index')),
	array('label'=>'Manage Customer', 'url'=>array('admin')),
);
?>

<h1>Додати покупця</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>