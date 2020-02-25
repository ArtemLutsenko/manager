<?php
/* @var $this ProductsController */
/* @var $model Products */

$this->breadcrumbs=array(

	'Товари',
);

$this->menu=array(

	array('label'=>'Додати товар', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#products-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управління товарами</h1>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'products-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'header'=>'№ п/п',
            'value'=>'$row+1',
            'headerHtmlOptions'=>array('style'=>'width: 40px'),
        ),
		'product_name',
		'product_length',
		'product_insert',
		'product_width',
		'product_height',
		array(
            'name'=>'type_search',
            'value'=>'$data->productType->name',
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
