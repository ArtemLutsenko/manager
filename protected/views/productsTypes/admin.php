<?php
/* @var $this ProductsTypesController */
/* @var $model ProductsTypes */

$this->breadcrumbs=array(
	'Типи товарів',
);

$this->menu=array(

	array('label'=>'Додати тип', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#products-types-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Типи товарів</h1>



<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'products-types-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'header'=>'№ п/п',
            'value'=>'$row+1',
        ),
		'name',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
