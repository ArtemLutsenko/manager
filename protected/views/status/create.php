<?php
/* @var $this StatusController */
/* @var $model Status */

$this->breadcrumbs=array(
	'Статуси'=>array('admin'),
	'Додати',
);

$this->menu=array(

	array('label'=>'Управління статсусами', 'url'=>array('admin')),
);
?>

<h1>Додати статус</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>