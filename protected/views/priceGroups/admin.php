<?php
/* @var $this PriceGroupsController */
/* @var $model PriceGroups */

$this->breadcrumbs=array(
	'Price Groups'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List PriceGroups', 'url'=>array('index')),
	array('label'=>'Create PriceGroups', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#price-groups-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управління ціновими категоріями</h1>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'price-groups-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'price_group_id',
		'price_group_name',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
