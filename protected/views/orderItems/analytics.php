<?php
/* @var $this OrderItemsController */
/* @var $model OrderItems */

$this->breadcrumbs=array(
	'Аналітика',
);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/d3.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/d3pie.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/analytics.pie.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $('#datepicker_for_due_date').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['uk'],{'dateFormat':'yy-mm-dd'}));

countProduct()


productPieChart.updateProp('data.content', getJsonData('span[data-product-name]', 'productName'));
colorPieChart.updateProp('data.content', getJsonData('span[data-color]', 'color'));
}
");

Yii::app()->clientScript->registerScript('search', "

function countProduct(){
    var summary = 0,
        summaryShop = 0,
        summarySite = 0;

    $('[data-quantity]').each(function(){
        summary += parseInt($(this).text());
    })
    $('[data-quantity=site]').each(function(){
        summarySite += parseInt($(this).text());
    })
    $('[data-quantity=shop]').each(function(){
        summaryShop += parseInt($(this).text());
    })

    $('td#site').text(summarySite);
    $('td#shop').text(summaryShop);
    $('td#total').text(summary);
}

$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#order-items-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
countProduct()


");
?>

<h1>Статистика замовлених товарів</h1>
<table class="table table-condensed" style="width:200px;">
    <tbody>
        <tr>
            <td>Сайт:</td>
            <td id="site"></td>
        <tr>
            <td>Магазини:</td>
            <td id="shop"></td>
        </tr>
        <tr>
            <td>Всього:</td>
            <td id="total"></td>
        </tr>
    </tbody>
</table>

<div style="display: block">
<?php echo CHtml::link('Розширений пошук','#',array('class'=>'search-button bt btn-2')); ?>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_searchAnalytics',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
</div>
    <div id="shopPieChart" class="inline-pie-chart"></div>
    <div id="productPieChart" class="inline-pie-chart"></div>
    <div id="colorPieChart" class="inline-pie-chart"></div>
<?php $form=$this->beginWidget('CActiveForm', array(
    'enableAjaxValidation'=>true,
    'method'=>'Post',
)); ?>

    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'order-items-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'afterAjaxUpdate' => 'reinstallDatePicker', // (#1)
        'columns'=>array(
            array(
                'header'=>'№',
                'value'=>'$row+1',
            ),
            array(
                'name'=>'city_search',
                'type'=>'raw',
                'value'=>'$data->order->city->city_name',
            ),
            array(
                'name'=>'shop_search',
                'filter' => CHtml::listData(Shops::model()->findAll(array('order' => 'full_name  ASC')), 'full_name', 'full_name'),
                'type'=>'raw',
                'value'=>'$data->order->shop_id ? $data->getShopName($data->order_item_id) : ""' ,
            ),
            array(
                'name'=>'customer_search',
                'type'=>'raw',
                'value'=>'Orders::model()->getCustomerName($data->order->customer_id)',
            ),
            array(
                'name'=>'type_search',
                'type'=>'raw',
                'filter' => CHtml::listData(ProductsTypes::model()->findAll(array('order' => 'name  ASC')), 'name', 'name'),
                'value'=>'$data->product->productType->name',
            ),
            array(
                'name'=>'product_search',
                'type'=>'raw',
                'value'=>'$data->getProductName($data->product_id)',

            ),
            array(
                'name'=>'length',
                'type'=>'raw',
                'headerHtmlOptions'=>array(
                    'width'=>'37px',
                ),
            ),
            array(
                'name'=>'insert',
                'type'=>'raw',
                'headerHtmlOptions'=>array(
                    'width'=>'37px',
                ),
            ),
            array(
                'name'=>'width',
                'type'=>'raw',
                'headerHtmlOptions'=>array(
                    'width'=>'37px',
                ),
            ),
            array(
                'name'=>'height',
                'type'=>'raw',
                'headerHtmlOptions'=>array(
                    'width'=>'37px',
                ),
            ),
            array(
                'name'=>'quantity',
                'type'=>'raw',
                'headerHtmlOptions'=>array(
                    'width'=>'37px',
                ),
                'value' => '$data->order->shop_id == null ? "<span data-quantity=\"site\">$data->quantity</span>" : "<span data-quantity=\"shop\">$data->quantity</span>"' ,
            ),
            array(
                'name'=>'color_search',
               // 'filter' => CHtml::activeTextField($model, 'color_search'),
                'value'=>'$data->getColorName($data->order_item_id)',
            ),
            array(
                'name'=>'eaf_search',
                'value'=>'$data->getEafName($data->order_item_id)',
            ),
            array(
                'name'=>'stone_search',
                'value'=>'$data->getStoneName($data->order_item_id)',
            ),
            array(
                'name'=>'glass_search',

                'value'=>'$data->getGlassName($data->order_item_id)',
            ),
            array(
                'name'=>'patina',
                'value' => '$data->patina==null ? " + " : " - "',
                'filter'=>array(1=>'Так', 0=>'Ні'),
            ),
            array(
                'name' => 'created_on',
                'value' => 'Yii::app()->dateFormatter->format("dd-MM-y", $data->created_on)',
                'filter' => false,
                'headerHtmlOptions'=>array(
                    'width'=>'65px',
                ),
            ),
            /*
            'created_by',
            'modified_on',
            'modified_by',
             */
        ),
    )); ?>
<?php $this->endWidget(); ?>