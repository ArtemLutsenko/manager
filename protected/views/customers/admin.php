<?php
/* @var $this CustomersController */
/* @var $model Customers */

$this->breadcrumbs=array(
	'Управління',
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#customer-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управління покупцями</h1>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'header'=>'№ п/п',
            'value'=>'$row+1',
        ),
		'first_name',
		'last_name',
		'phone',
		'email',
		//'city_id',

		'created_on',
        array(
            'name' => 'Додав',
            'filter' => false,
            'value'=>'$data->creator->username'
        ),
		'modified_on',
        array(
            'name' => 'Змінив',
            'filter' => false,
            'value'=>'$data->updater->username'
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
