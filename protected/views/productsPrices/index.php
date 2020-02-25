<?php
/* @var $this ProductsPricesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ціни',
);

$this->menu=array(
	array('label'=>'Додати ціну', 'url'=>array('create')),
	array('label'=>'Управління цінами', 'url'=>array('admin')),
);

?>

<h1>Ціни</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
