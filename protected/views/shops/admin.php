<?php
/* @var $this ShopsController */
/* @var $model Shops */

$this->breadcrumbs=array(
	'Магазини',
);

$this->menu=array(
	array('label'=>'Додати магазин', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#shops-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управління магазинами</h1>

<?php //echo CHtml::link('Розширений пошук','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'shops-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'header'=>'№ п/п',
            'value'=>'$row+1',
            'headerHtmlOptions'=>array('style'=>'width: 40px'),
        ),

		//'shop_id',
        array(
            'name'=>'full_name',
            'type'=>'raw',
            'filter' => CHtml::listData(Shops::model()->findAll(array('order' => 'full_name  ASC')), 'full_name', 'full_name'),
            //'value'=>'$data->shop->full_name',
            'value'=>'CHtml::link($data->full_name, Yii::app()->createUrl("shops/view/",array("id"=>$data->shop_id)))',
        ),
        'name',
        array(
            'name'=>'city_id',
            'type'=>'raw',
            'value'=>'$data->city->city_name',
        ),
        'address',
        array(
            'name'=>'price_group_id',
            'type'=>'raw',
            'value'=>'$data->priceGroup->price_group_name',
        ),
        'phone',
        'email',
        /*
                'debt',
                'comment',
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
                */
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
