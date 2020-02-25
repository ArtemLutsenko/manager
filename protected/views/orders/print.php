<?php
/* @var $this OrdersController */
/* @var $model Orders */
?>

<?php
Yii::app()->clientScript->registerScript('managers', "

$('table.detail-view').removeClass().addClass('invoice-info')

var gv = '<table class=\"invoice-info\"><tr><th width=\"150px\">Відпущено:</th><th>ПП Олексенко Г. В.</th></tr><tr><td><b>ЄДРПОУ:</b></td><td><b>2345817293</b></td></tr><tr><td><b>АДРЕСА</b></td><td>Кам`нка, 2-й пров. Ватутіна, 6, кв.24</td></tr><tr><td><b>Тел.:</b></td><td>60319</td></tr><tr><td><b>РОЗР/РАХ.:</b></td><td>26003000049377 в ПАТ \"УКРСОЦБАНК\"</td></tr><tr><td><b>МФО</b></td><td>300023</td></tr><tr><td colspan=\"2\">єдиний податок</td> </tr></table>';
var ogv = 'Олексенко Григорій Васильович'
var bv = '<table class=\"invoice-info\"><tr><th width=\"150px\">Відпущено:</th><th>ПП Олексенко Б. В.</th></tr><tr><td><b>ЄДРПОУ:</b></td><td><b>2306407577</b></td></tr><tr><td><b>АДРЕСА</b></td><td>Кам`нка, вул. Леніна 17д</td></tr><tr><td><b>Тел.:</b></td><td>60319</td></tr><tr><td><b>РОЗР/РАХ.:</b></td><td>26000000040272 в ПАТ \"УКРСОЦБАНК\"</td></tr><tr><td><b>МФО</b></td><td>300023</td></tr><tr><td colspan=\"2\">Підприємство - платник єдиного податку</td> </tr></table>';
var obv = 'Олексенко Борис Васильович'
$('#manager').append(gv).hide().fadeIn('slow');
$('.name').append(ogv).hide().fadeIn('slow');
$('#listname').on('change', function(){
      var name = $('#listname').val();
    if (name == 'bv'){
        $('#manager').empty();
        $('#manager').append(bv).hide().fadeIn('slow');
        $('.name').empty();
        $('.name').append(obv).hide().fadeIn('slow');
    }else if(name == 'gv'){
        $('#manager').empty();
        $('#manager').append(gv).hide().fadeIn('slow');
        $('.name').empty();
        $('.name').append(ogv).hide().fadeIn('slow');
    }else{
        alert ('Поимилка накладної!')
    }
})

var shop = $('[data-item = shop]').length;
var customer = $('[data-item = customer]').length;
var lenght = $('table.order tr').length;
    if (shop){
        var newRow = addShip();
    }else if(customer){
        var newRow = '<tr class=\"shipment\"><td width=\"50\">'+lenght+'</td><td>Доставка до під`їзду</td><td width=\"100\">штук</td><td width=\"100\" class=\"right\">1</td><td width=\"150\" class=\"right\">190.00</td><td width=\"150\" class=\"right\" data-subtotal=\"subtotal\">190.00</td></tr>'
    }else{
        console.log('invalid customer')
    }

function addRowShipCustomer(){
    $('table.order tr:last').after(newRow);
    $('table.order tr:last').hide().fadeIn('slow');
    countTotal()
    getAjaxNum2Str()
}

function removeRowShipCustomer(){
$('table.order tr.shipment').fadeOut('slow')
    $('table.order tr.shipment').remove();
    countTotal()
    getAjaxNum2Str()
}

$('#addShipment').toggle(function(){
    $(this).text('Видалити доставку з накладної');
    addRowShipCustomer();
}, function(){
    $(this).text('Додати доставку в накладну');
    removeRowShipCustomer();
});

function addShip(){
    var countTable = 0;
    var countChair = 0;
    var countStool = 0;
    $('.type').each(function(){
        var type = $(this).text()
        var next = parseInt($(this).next().text())
        switch (type){
            case '1':
                countTable += next;
                break;
            case '2':
                countChair += next;
                break;
            case '3':
                countStool += next;
                break;
        }
    })
    console.log('table: '+countTable+' chair: '+countChair+' stool: '+countStool)
    var addTable ='';
    var addChair ='';
    var addStool ='';
    if (countTable > 0 ){
        addTable = '<tr class=\"shipment\"><td width=\"50\">'+lenght+'</td><td>Доставка стола</td><td width=\"100\">штук</td><td width=\"100\" class=\"right\">'+countTable+'</td><td width=\"150\" class=\"right\">60.00</td><td width=\"150\" class=\"right\" data-subtotal=\"subtotal\">'+ countTable*60 +'</td></tr>';
        lenght +=1
    }
    if (countChair > 0 ){
        addChair = '<tr class=\"shipment\"><td width=\"50\">'+lenght+'</td><td>Доставка стільця</td><td width=\"100\">штук</td><td width=\"100\" class=\"right\">'+countChair+'</td><td width=\"150\" class=\"right\">20.00</td><td width=\"150\" class=\"right\" data-subtotal=\"subtotal\">'+ countChair*20 +'</td></tr>';
        lenght +=1
    }
    if (countStool > 0 ){
        addStool = '<tr class=\"shipment\"><td width=\"50\">'+lenght+'</td><td>Доставка табурета</td><td width=\"100\">штук</td><td width=\"100\" class=\"right\">'+countStool+'</td><td width=\"150\" class=\"right\">10.00</td><td width=\"150\" class=\"right\" data-subtotal=\"subtotal\">'+ countStool*10 +'</td></tr>';
        lenght +=1
    }
    var newRow = addTable + addChair + addStool
    return newRow

}
function countTotal(){
var res = 0;
    $('[data-subtotal]').each(function(){
        res += parseInt($(this).text());
    });
    $('b.subtotal').text(res.toFixed(2));
}

function getAjaxNum2Str(){
    var data = $('b.subtotal:first').text();
    $.ajax({
        //dataType: 'json',
        type: 'POST',
        url: '".Yii::app()->createUrl('orders/numToStr')."',
        data:{ num: data },
        success: function(data){ $('#total').text(data).fadeIn('slow') },
    })
}


addShip()
countTotal()
getAjaxNum2Str()


$('.print').click(function() {
        pathArray = window.location.href.split( '/' );
        protocol = pathArray[0];
        host = pathArray[2];
        url = protocol + '//' + host + '/css/print.css';
		$('#print').printElement({
             overrideElementCSS:[
		    '../../css/print.css',
		    { href:'../../css/print.css',media:'print'}],
             pageTitle:'Накладна'
        });
});



");


    echo CHtml::dropDownList('listname', $select, array('gv' => 'ПП Олексенко Г. В.', 'bv' => 'ПП Олексенко Б. В.'));
//echo $model->num2str('6690');
?>
<button id="addShipment">Додати доставку в накладну</button>
<button class="print" rel="print">Друкувати</button>

<div id="print">

<h1>Накладна №<?php echo $model->order_id; ?></h1>
<h5>від
    <?php
    $now  = date("d.m.Y");
        echo $now;
    ?>
</h5>





<div id='manager'>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,

	'attributes'=>array(
        array(
            'name'=>'Одержувач',
            'value'=>$model->shop->full_name,
            'visible'=>$model->shop_id == null ? false : true,
            'template'=>"<tr class=\"print\"><th width=\"150px\">{label}</th><td><span itemprop=\"name\" data-item=\"shop\">{value}</span></td></tr>\n",
        ),
        array(
            'visible'=>$model->customer_id == null ? false : true,
            'name'=>'Одержувач',
            'value'=>$model->getCustomerName($model->customer_id),
            'template'=>"<tr class=\"print\"><th width=\"150px\">{label}</th><th><span itemprop=\"name\" data-item=\"customer\">{value}</span></th></tr>\n",
        ),
        array(
            'name'=>'АДРЕСА:',
            'value'=> $model->getCityAndAddress($model->order_id),
            'template'=>"<tr class=\"print\"><td><b>{label}</b></td><td><span itemprop=\"name\">{value}</span></td></tr>\n",
        ),
        array(
            'name'=>'ТЕЛ',
            'value'=> $model->getCustomerPhone($model->order_id),
            'template'=>"<tr class=\"print\"><td><b>{label}.:</b></td><td><span itemprop=\"name\">{value}</span></td></tr>\n",
        ),
	),
)); ?>


<?php
if ( $orderItems !== null )
{
    $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'order-items-grid',
        'itemsCssClass' => 'items order',
    'dataProvider'=>$orderItems->search(),
    'template' => '{items} {pager}',//{summary}
        'enableSorting' => false,
    'columns'=>array(
        array(
            'header'=>'№ п/п',
            'value'=>'$row+1',
            'htmlOptions'=>array(
                'width'=>'70px',
            ),
            'headerHtmlOptions'=>array(
                'width'=>'70px',
                'class'=>'field_id',
            ),
        ),

        'order_id',
        array(
            'name'=>'product_id',
            'header'=>'Найменування',
            'value'=>'$data->getProductNameAndSize($data->order_id, $data->product_id)',
            'htmlOptions'=>array(
                'width'=>'550px',
            ),
            'headerHtmlOptions'=>array(
                'class'=>'field_name',
                'width'=>'550px'
            ),
        ),
        array(
            'header'=>'Од. вим.',
            'value'=>'штук',
            'htmlOptions'=>array(
                'width'=>'100px',
            ),
            'headerHtmlOptions'=>array(
                'class'=>'field_type',
                'width'=>'100px',
            ),
        ),
        array(
            'name'=>'product_type_id',
            'header'=>'тип',
            'value'=>'$data->product->productType->product_type_id',
            'headerHtmlOptions'=>array(
                'class'=>'hidden ',
            ),
            'htmlOptions'=>array(
                'class'=>'hidden type',
            ),
        ),
        array(
            'name'=>'quantity',
            'htmlOptions'=>array(
                'width'=>'70px',
                'class'=>'right quantity',
            ),
            'headerHtmlOptions'=>array(
                'class'=>'field_q',
                'width'=>'70px',
            ),
        ),
        array(
            'name'=>'price',
            'header'=>'Ціна без ПДВ',
            'htmlOptions'=>array(
                'width'=>'150',
                'class'=>'right',
            ),
            'headerHtmlOptions'=>array(
                'class'=>'field_price',
            ),
        ),
        array(
            'name'=>'subtotal',
            'header'=>'Сума без ПДВ',
            'htmlOptions'=>array(
                'width'=>'150',
                'data-subtotal'=>subtotal,
                'class'=>'right',
            ),
            'headerHtmlOptions'=>array(
                'class'=>'field_total',
            ),
        ),

    ),
));
}
    ?>
    <div class="pdv">
    <?php

    echo CHtml::openTag('table', array('class'=>'pdv'));

    echo CHtml::openTag('tr');
    echo CHtml::tag('td', array('width'=>'610px'), '');
    echo CHtml::tag('td', array('width'=>'210px'), '<b>Всього без ПДВ</b>');
    echo CHtml::tag('td', array('width'=>'100px', 'class'=>'right'), '<b class="subtotal" ></b>');
    echo CHtml::closeTag('tr');
    echo CHtml::openTag('tr');
        echo CHtml::tag('td', array('class'=>'bar'), '');
    echo CHtml::tag('td', array(), '<b>ПДВ 0%</b>');
    echo CHtml::tag('td', array('class'=>'right'), '<b class="right">0.00</b>');
    echo CHtml::closeTag('tr');
    echo CHtml::openTag('tr');
        echo CHtml::tag('td', array('class'=>'bar'), '');
    echo CHtml::tag('td', array('class'=>'bar'), '<b>Загальна сума з ПДВ</b>');
    echo CHtml::tag('td', array('class'=>'right'), '<b class="subtotal"></b>');
    echo CHtml::closeTag('tr');
    echo CHtml::closeTag('table');
    ?>

    </div>
    <div style='text-decoration: underline'>Всього відпущено на суму</div>
    <div id="total"></div>
    <div style="font-weight: bold; padding-bottom: 20px">В т. ч. ПДВ 0% <span style="padding-left: 120px">0. 00 грн</span></div>

    <div class="sender">
         <div>
             <span>Відпустив </span><div class="line">&nbsp; </div>
         </div>
         <div>
             <span>Керівник </span><div class="line name"> </div>
         </div>
    </div>
    <div class="sender">
        <div>
            <span>Одержав </span><div class="line ">&nbsp; </div>
        </div>
        <div>
            <span>Гол. бухгалтер </span><div class="line">&nbsp; </div>
        </div>
    </div>
</div>