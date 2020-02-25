<?php
/* @var $this PropertiesInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Properties Infos',
);

$this->menu=array(
	array('label'=>'Create PropertiesInfo', 'url'=>array('create')),
	array('label'=>'Manage PropertiesInfo', 'url'=>array('admin')),
);
?>

<h1>Properties Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
