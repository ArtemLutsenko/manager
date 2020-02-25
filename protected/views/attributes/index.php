<?php
/* @var $this AttributesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Атрибути',
);


?>

<h1>Атрибути</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
