<?php
/* @var $this PropertiesController */
/* @var $model Properties */

$this->breadcrumbs=array(
	'Кольори'
);

$this->menu=array(

	array('label'=>'Додати колір', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#properties-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управління кольорами</h1>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'properties-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'header'=>'№ п/п',
            'value'=>'$row+1',
            'headerHtmlOptions'=>array('style'=>'width: 40px'),
        ),
        array(
            'name'=>'attribute_id',
            'type'=>'raw',
            'value'=>'$data->attribute->name',
        ),
        array(
            'name'=>'property_info_id',
            'type'=>'raw',
            'value'=>'$data->propertyInfo->collection',
        ),
		'name',
		//'img_url',
		'img_url_thumb',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
