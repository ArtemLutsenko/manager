<?php
/* @var $this OrderItemsController */
/* @var $model OrderItems */
Yii::app()->clientScript->registerCss('cs1','

div.page-break{
page-break-after: always;
margin-bottom:0px;
padding:0;

}


');

Yii::app()->clientScript->registerScript('print', "
function paintOrder(){
var d = new Date();
$('[data-created]').each(function(){
    var get = $(this).data('created')
    var res = (new Date(d).getTime() - new Date(get).getTime())/1000/60/60/24
    if (res < 8 ){
        $(this).find('.date').addClass('green')
    }else if(res >=8 && res <=10){
        $(this).find('.date').addClass('yellow')
    }else if(res>10) {
       $(this).find('.date').addClass('red')
    }
})
}
paintOrder();
$('.print').click(function() {
        pathArray = window.location.href.split( '/' );
        protocol = pathArray[0];
        host = pathArray[2];
        url = protocol + '//' + host + '/css/printItems.css';
		$('#print').printElement({
             overrideElementCSS:[
		    '../../css/printItems.css',
		    { href:'../../css/printItems.css',media:'print'}],
             pageTitle:'замовленні товари'
        });
});
paintOrder();
var elements = [];

$('span[data-shop]').each(function(){
    var currShop = $(this).text();
    var nextShop = $(this).closest('tr').next().find('span[data-shop]').text();
    var prevShop = $(this).closest('tr').prev().find('span[data-shop]').text();
    var emptyRow = '<tr><td colspan=\'13\' style=\'height: 20px; padding:0; margin:0;\'></td></tr>'
    if ( currShop !='' &&  currShop != nextShop){
        $(emptyRow).insertAfter( $(this).closest('tr'));
    }
    if (currShop !='' && currShop != prevShop){
        $(this).css({'fontWeight':'bold', 'backgroundColor' : 'yellow'})
    }

elements.push(name);
});
function splitTable(table, maxHeight) {
        var header = table.children('thead');
        if (!header.length)
            return;

        var headerHeight = header.outerHeight();
        var header = header.detach();

        var splitIndices = [0];
        var rows = table.children('tbody').children();

        maxHeight -= headerHeight;
        var currHeight = 0;
        rows.each(function(i, row) {
            currHeight += $(rows[i]).outerHeight();
            console.log($(rows[i]).outerHeight())
            if (currHeight > maxHeight) {
                splitIndices.push(i);
                currHeight = $(rows[i]).outerHeight();
            }
        });
        splitIndices.push(undefined);

        table = table.replaceWith('<div id=\"_split_table_wrapper\"></div>');
        table.empty();

        for(var i=0; i<splitIndices.length-1; i++) {
            var newTable = table.clone();
            if (i>0){newTable.addClass('cloned')}
            header.clone().appendTo(newTable);
            $('<tbody />').appendTo(newTable);
            rows.slice(splitIndices[i], splitIndices[i+1]).appendTo(newTable.children('tbody'));
            newTable.appendTo(\"#_split_table_wrapper\");
            if (splitIndices[i+1] !== undefined) {
                $('<div class=\"page-break\"></div>').appendTo(\"#_split_table_wrapper\");
            }
        }
    }
$(document).ready(function(){
$(function() { splitTable($('.items'), 970); });
});
");
?>

<h1>Друкувати замовленні товари</h1>

<a href="#" class="print bt btn-2" rel="print"><i class="fa fa-print feature-icon"></i> Друкувати</a>

<div id="print">
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'order-items-grid',
    'itemsCssClass' => 'items order',
    'dataProvider'=>$orderItems->search(),
    'template' => '{items} {pager}',//{summary}
    'rowHtmlOptionsExpression' => 'array("data-created"=>$data->created_on, "data-shop"=>$data->order->city->city_name)',
    'columns'=>array(
        array(
            'name' => 'created_on',
            'htmlOptions' => array('class' => 'date'),
            'value'=>'Yii::app()->dateFormatter->format("dd-MM-y", $data->created_on)',
            'headerHtmlOptions'=>array(
                'width'=>'69px',
            ),
            //'htmlOptions' => array('class' => 'created_on'),
        ),
        array(
            'name'=>'order_id',
            'type'=>'raw',
            'headerHtmlOptions'=>array(
                'width'=>'37px',
            ),
            'htmlOptions' => array('class' => 'order_id'),
        ),
        array(
            'name'=>'city_search',
            'type'=>'raw',
            'value'=>'$data->order->city->city_name',
            'headerHtmlOptions'=>array(
                'width'=>'85px',
            ),
            'htmlOptions' => array('class' => 'city_search'),
        ),
        array(
            'name'=>'shop_search',
             'type'=>'raw',
            'value'=>' $data->order_id ? $data->getShopName($data->order_item_id) : ""' ,
            'headerHtmlOptions'=>array(
                'width'=>'135px',
            ),
            'htmlOptions' => array('class' => 'shop_search'),
        ),
        array(
            'name'=>'customer_search',
            'type'=>'raw',
            'value'=>'Orders::model()->getCustomerName($data->order->customer_id)',
            'headerHtmlOptions'=>array(
                'width'=>'85px',
            ),
            'htmlOptions' => array('class' => 'customer_search'),
        ),
        array(
            'name'=>'product_id',
            'type'=>'raw',
            'value'=>'$data->product->product_name',
            'headerHtmlOptions'=>array(
                'width'=>'100px',
            ),
            'htmlOptions' => array('class' => 'product_id'),
        ),

        array(
            'name'=>'length',
            'type'=>'raw',
            'headerHtmlOptions'=>array(
                'width'=>'37px',
            ),
            'htmlOptions' => array('class' => 'size'),
        ),
        array(
            'name'=>'insert',
            'type'=>'raw',
            'headerHtmlOptions'=>array(
                'width'=>'37px',
            ),
            'htmlOptions' => array('class' => 'size'),
        ),
        array(
            'name'=>'width',
            'type'=>'raw',
            'headerHtmlOptions'=>array(
                'width'=>'37px',
            ),
            'htmlOptions' => array('class' => 'size'),
        ),
        array(
            'name'=>'height',
            'type'=>'raw',
            'headerHtmlOptions'=>array(
                'width'=>'37px',
            ),
            'htmlOptions' => array('class' => 'size'),
        ),
        array(
            'name'=>'quantity',
            'type'=>'raw',
            'headerHtmlOptions'=>array(
                'width'=>'37px',
            ),
            'htmlOptions' => array('class' => 'size'),
        ),
        array(
            'header'=>'Колір',
            'value'=>'$data->getColor($data->order_item_id)',
            'headerHtmlOptions'=>array(
                'width'=>'137px',
            ),
            'htmlOptions' => array('class' => 'color'),
        ),/**/
        array(
            'name'=>'comment',
            'type'=>'raw',
            'headerHtmlOptions'=>array(
                'width'=>'80px',
            ),
            'htmlOptions' => array('class' => 'customer_search'),
        ),



    ),
)); ?>
</div>
