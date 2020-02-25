<?php
/* @var $this ProductsPricesController */
/* @var $model ProductsPrices */

$this->breadcrumbs=array(

	'Управління цінами',
);

$this->menu=array(

	array('label'=>'Додати ціну', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#products-prices-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управління цінами</h1>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'products-prices-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'product_price_id',
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
            'name'=>'product_search',
            'type'=>'raw',
            'value'=>'$data->product->product_name',
        ),
		'product_price',
        array(
            'name' => 'modified_on',
            'value' => 'Yii::app()->dateFormatter->format("dd-MM-y", $data->modified_on)',
            'filter' => false,
        ),
        array(
            'header'=>'Змінив',
            'value'=>'$data->updater->username',
        ),

		array(
			'class'=>'CButtonColumn',
		),
	),
));

?>