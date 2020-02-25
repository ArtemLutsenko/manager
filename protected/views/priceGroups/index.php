<?php
/* @var $this PriceGroupsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Цінові категорії',
);

$this->menu=array(
	array('label'=>'Додати цінову категорію', 'url'=>array('create')),
	array('label'=>'Управління ціновими категоріями', 'url'=>array('admin')),
);
?>

<h1>Цінові катгорії</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
