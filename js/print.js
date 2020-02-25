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
        url: '<?= hj ?>',
        data:{ num: data },
    success: function(data){ $('#total').text(data).fadeIn('slow') }
})
}
///Yii::app()->createUrl("orders/numToStr")

addShip()
countTotal()
getAjaxNum2Str()


$('a#printButton').click(function() {
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
