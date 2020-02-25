<?php
/* @var $this OrdersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Замовлення',
);

$this->menu=array(
	array('label'=>'Додати замовлення', 'url'=>array('create')),
	array('label'=>'Управління замовленнями', 'url'=>array('admin')),
);
?>

<h1>Замовлення</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
