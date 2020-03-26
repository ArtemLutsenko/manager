$('table.detail-view').removeClass().addClass('invoice-info')
$('form').submit(false);
var gv      = '<table border=\"0\" class=\"invoice-info\"><tr><th width=\"130px\">Постачальник:</th><th>ПП Олексенко Г. В.</th></tr><tr><td><b>ЄДРПОУ:</b></td><td><b>2345817293</b></td></tr><tr><td><b>АДРЕСА</b></td><td>м. Кам`янка, 2-й пров. Ватутіна, 6, кв.24</td></tr><tr><td><b>Тел.:</b></td><td>60319</td></tr><tr><td><b>РОЗР/РАХ.:</b></td><td>UA963543470000026008051545067 в ЧЕРК. ГРУ ПАТ КБ\"ПРИВАТБАНК\", М. ЧЕРКАСИ</td></tr><tr><td><b>МФО</b></td><td>354347</td></tr><tr><td colspan=\"2\">Підприємство - платник єдиного податку</td> </tr></table>',
    ogv     = 'Олексенко Григорій Васильович',
    bv      = '<table border=\"0\" class=\"invoice-info\"><tr><th width=\"130px\">Постачальник:</th><th>ПП Олексенко Б. В.</th></tr><tr><td><b>ЄДРПОУ:</b></td><td><b>2306407577</b></td></tr><tr><td><b>АДРЕСА</b></td><td>м. Кам`янка, вул. Героїв Майдану</td></tr><tr><td><b>Тел.:</b></td><td>60319</td></tr><tr><td><b>РОЗР/РАХ.:</b></td><td>UA153543470000026009051521659 в ЧЕРК. ГРУ ПАТ КБ\"ПРИВАТБАНК\", М. ЧЕРКАСИ</td></tr><tr><td><b>МФО</b></td><td>354347</td></tr><tr><td colspan=\"2\">Підприємство - платник єдиного податку</td> </tr></table>',
    obv     = 'Олексенко Борис Васильович';
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

function addRowShipment(){
    var defaultShipmentPrice = $('#defaultShipmentPrice').val(),
        shop = $('[data-item = shop]').length,
        customer = $('[data-item = customer]').length,
        lenght = $('table.order tr').length;
    if (shop){
        var newRow = addShopShipment();
    }else if(customer){
        var newRow = '<tr class=\"shipment\"><td width=\"50\">'+lenght+'</td><td>&nbsp;  </td><td>Доставка до під`їзду</td><td width=\"100\">штук</td><td width=\"100\" class=\"right\">1</td><td width=\"150\" class=\"right\">'+defaultShipmentPrice+'</td><td width=\"150\" class=\"right\" data-subtotal=\"subtotal\">'+defaultShipmentPrice+'</td></tr>'
    }else{
        alert('invalid customer')
    }
    $('table.order tr:last').after(newRow);
    $('table.order tr:last').hide().fadeIn('slow');
    countTotal()
    getAjaxNum2Str()
}

function removeRowShipment(){
    $('table.order tr.shipment').fadeOut('slow')
    $('table.order tr.shipment').remove();
    countTotal()
    getAjaxNum2Str()
}

$('#addShipment').toggle(function(){
    $(this).html('<i class=\"fa fa-truck feature-icon\"></i> Видалити доставку');
    addRowShipment();
}, function(){
    $(this).html('<i class=\"fa fa-truck feature-icon\"></i> Додати доставку');
    removeRowShipment();
});

function addShopShipment(){
    var lenght = $('table.order tr').length,
		newRow = "",
        countTable = 0,
        countChair = 0,
        countStool = 0,
		standartShipment = document.getElementById("standartShipment"),
		customShipment = document.getElementById("customShipment");

	if(standartShipment.checked){	
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
		var addTable ='',
			addChair ='',
			addStool ='';
		if (countTable > 0 ){
			addTable = '<tr class=\"shipment\"><td width=\"50\">'+lenght+'</td><td>&nbsp;  </td><td>Доставка стола</td><td width=\"100\">штук</td><td width=\"100\" class=\"right\">'+countTable+'</td><td width=\"150\" class=\"right\">110.00</td><td width=\"150\" class=\"right\" data-subtotal=\"subtotal\">'+ countTable*110 +'</td></tr>';
			lenght +=1
		}
		if (countChair > 0 ){
			addChair = '<tr class=\"shipment\"><td width=\"50\">'+lenght+'</td><td>&nbsp;  </td><td>Доставка стільця</td><td width=\"100\">штук</td><td width=\"100\" class=\"right\">'+countChair+'</td><td width=\"150\" class=\"right\">40.00</td><td width=\"150\" class=\"right\" data-subtotal=\"subtotal\">'+ countChair*40 +'</td></tr>';
			lenght +=1
		}
		if (countStool > 0 ){
			addStool = '<tr class=\"shipment\"><td width=\"50\">'+lenght+'</td><td>&nbsp;  </td><td>Доставка табурета</td><td width=\"100\">штук</td><td width=\"100\" class=\"right\">'+countStool+'</td><td width=\"150\" class=\"right\">15.00</td><td width=\"150\" class=\"right\" data-subtotal=\"subtotal\">'+ countStool*15 +'</td></tr>';
			lenght +=1
		}
			newRow = addTable + addChair + addStool
	
	}else if(customShipment.checked){customShipmentValue
		var cs = document.getElementById("customShipmentValue");
		if(cs){	
			var csValue = cs.value;
			if(!isNaN(csValue)){
				newRow = '<tr class=\"shipment\"><td width=\"50\">'+lenght+'</td><td>&nbsp;  </td><td>Доставка </td><td width=\"100\">штук</td><td width=\"100\" class=\"right\">1</td><td width=\"150\" class=\"right\">'+csValue+'</td><td width=\"150\" class=\"right\" data-subtotal=\"subtotal\">'+csValue+'</td></tr>'
			}		
		}   	
	}
	
    return newRow
}
function countTotal(){
    var res = 0;
    $('[data-subtotal]').each(function(){
        res += parseInt($(this).text());
    });
    $('b.subtotal').text(res.toFixed(2));
}


var pathArray = window.location.href.split( '/'),
    protocol = pathArray[0],
    host = pathArray[2],
    domain = protocol + '//' + host,
    urlPrintInvoiceCss = domain + '/css/printInvoice.css';

function printPage(){
    $('#print').printElement({
        overrideElementCSS:[
            urlPrintInvoiceCss,
            { href:urlPrintInvoiceCss,media:'print'}],
        pageTitle:'Друкувати накладну'
});
}

function getAjaxNum2Str(){
    var data = $('b.subtotal:first').text();
    $.ajax({
        //dataType: 'json',
        type: 'POST',
        url: domain+'/orders/numToStr',
        data:{ num: data },
    success: function(data){
        var res = data.charAt(0).toUpperCase() + data.substring(1);
        $('#total').text(res).fadeIn('slow') }
    })
}

function getHtml(){
    $('#wrap').find('th.hidden, td.hidden').remove();
    var html = $('#wrap').html();
    return html;
}

function getEmail(){
    var email =$('[data-email]').text();
    if (email == ""){
        $('#pdfButton').addClass('disable-button')
        console.log('false')
    }else{
        if ( email.indexOf(',') !== -1 ){
            var arr = email.split(',');
            console.log('many emails '+arr[0]);
            $('#pdfButton').attr('data-sending-email', arr[0])
        }else{
            console.log('true'+email)
            $('#pdfButton').attr('data-sending-email', email)
        }
    }
}

$('a.delete').on('click',function(){
    countTotal();
    getAjaxNum2Str();
})

getEmail();
//addShopShipment();
countTotal();
getAjaxNum2Str();