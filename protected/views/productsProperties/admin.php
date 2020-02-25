<?php
/* @var $this ProductsPropertiesController */
/* @var $model ProductsProperties */

$this->breadcrumbs=array(

	'Управління надбавками',
);

$this->menu=array(

	array('label'=>'Додати надбавку ', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#products-properties-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управління надбавками за колір</h1>


<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'products-properties-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'product_property_id',
        array(
            'header'=>'№ п/п',
            'value'=>'$row+1',
        ),
        array(
            'name'=>'price_group_id',
            'type'=>'raw',
            'value'=>'$data->priceGroup->price_group_name',
            'filter' => CHtml::listData(PriceGroups::model()->findAll(), 'price_group_id', 'price_group_name'),
        ),

        array(
            'name'=>'property_search',
            'type'=>'raw',
            'value'=>'$data->property->name',
        ),

		'add_payment',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
