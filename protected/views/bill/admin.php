<?php
/* @var $this BillController */
/* @var $model Bill */

$this->breadcrumbs=array(

	'Рахунки',
);

Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $('#datepicker_for_due_date').datepicker(jQuery.extend({showMonthAfterYear:true},
    jQuery.datepicker.regional['uk'],{
        'dateFormat':'yy-mm-dd',
        'changeMonth':'true',
        'changeYear':'true',
        'showButtonPanel':'true',
        'showOtherMonths':'true',
        'selectOtherMonths':'true',
    }));
}
");
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#bill-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Рахунки</h1>



<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'bill-grid',
	'dataProvider'=>$model->search(),
    'afterAjaxUpdate' => 'reinstallDatePicker',
	'filter'=>$model,
	'columns'=>array(
		//'bill_id',
		//'account_id',
        array(
            'name'=>'account_id',
            'value'=>'CHtml::link($data->account_id, Yii::app()->createUrl("bill/view/",array("id"=>$data->primaryKey)))',
            'type'  => 'raw',
        ),
        array(
            'name'=>'shop_id',
            'type'=>'raw',
            'filter' => CHtml::listData(Shops::model()->findAll(array('order' => 'full_name  ASC')), 'shop_id', 'full_name'),
            'value'=>'CHtml::link($data->shop->full_name, Yii::app()->createUrl("shops/view/",array("id"=>$data->shop_id)))',
        ),
        array(
            'name'=>'customer_search',
            'type'=>'raw',
            'value'=>'Customers::model()->getCustomerLink($data->customer_id)',
        ),
		//'created_on',
        array('name' => 'created_on',
            'value' => '$data->created_on',
            'filter' => false,
            'htmlOptions' => array('class' => 'date'),
        ),
		'creator.username',
		/*
		'modified_on',
		'modified_by',
		*/
		array(
			'class'=>'CButtonColumn',
            'template'=>'{view}{delete}',
		),
	),
)); ?>
