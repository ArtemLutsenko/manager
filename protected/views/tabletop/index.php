<?php
/* @var $this TabletopController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tabletops',
);

$this->menu=array(
	array('label'=>'Create Tabletop', 'url'=>array('create')),
	array('label'=>'Manage Tabletop', 'url'=>array('admin')),
);
?>

<h1>Tabletops</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
