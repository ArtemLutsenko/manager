<?php
/* @var $this BillController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bills',
);

$this->menu=array(
	array('label'=>'Create Bill', 'url'=>array('create')),
	array('label'=>'Manage Bill', 'url'=>array('admin')),
);
?>

<h1>Bills</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
