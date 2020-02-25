/// get last number from class or id
function getLastNumber(attr){
    var pattern = /[0-9]/g;
    return attr.match(pattern);
}
jQuery.fn.flash = function( color, duration )
{
    var current = '#fff';
    this.animate( { backgroundColor: color }, duration / 2 );
    this.animate( {backgroundColor: current }, duration / 2 );
}
function updateSize(id){
    var sum = 0;
    $("[data-add-pay-size][data-id="+id+"]").each(function(){
        var thisVal     = parseInt($(this).val());
        var thisData    = parseInt($(this).data('size'));
        var multiplier  = parseFloat($(this).data('addPaySize'))/10;
        if ( thisVal > thisData ){
            sum += (thisVal - thisData) * multiplier;
        }
    });
    return sum;
}

function updateColor(id){
    var percent = 0;
    $("[data-add-pay-color][data-id="+id+"]").each(function()
    {
        percent += parseInt($(this).val());
    });
    return percent;
}

function updateTinting(id){
    var percent = 0;
    if ($("#pg").val() != "1"){                                      //// price group
        var that = $("[data-add-pay-tinting][data-id="+id+"]");
        if (that.prop('checked')){
            percent += 10;
        }
    }
    return percent;
}

function updatePatina(id){
    var percent = 0;
    if ($("select[data-add-pay-patina][data-id="+id+"]").val()){
        percent += 20;
    }
    return percent;
}

function updatePrice(id){
    var priceField = $("[data-price][data-id="+id+"]")
    var curPrice = parseInt(priceField.data('price'));
    var updPrice = parseInt((curPrice + updateSize(id)) *( 1 + (updateColor(id) + updateTinting(id) + updatePatina(id)) / 100));
    priceField.val(updPrice);
    priceField.flash( "#81FFAA", 2000 );
    updateQuantity(id)
}

function updateQuantity(id){
    var priceField = parseInt($("[data-price][data-id="+id+"]").val())
    var qField = parseInt($("[data-quantity][data-id="+id+"]").val())
    $("[data-subtotal][data-id="+id+"]").val(priceField * qField).flash( "#81FFAA", 2000 );
    updateTotalPrice()
}

function updateCustomPrice(id){
    var priceField = parseInt($("[data-price][data-id="+id+"]").val())
    var qField = parseInt($("[data-quantity][data-id="+id+"]").val())
    $("[data-subtotal][data-id="+id+"]").val(priceField * qField).flash( "#81FFAA", 2000 );
    updateTotalPrice()
}

function updateTotalPrice(){
    var itemsPrice = 0;
    $("[data-subtotal]").each(function(){
        itemsPrice += parseInt($(this).val());
    })
    $("#Orders_order_total").val(itemsPrice)

    $("#Orders_order_total").flash( "#81FFAA", 2000 );
/*
    if (updPrice.val()  != currPrice ){
        orderTotal.flash( "#81FFAA", 2000 );
    }else{
        orderTotal.flash( "#eee", 2000 );
    }
*/
}

jQuery(function($) {
    $("fieldset").on("change", "[data-add-pay-size], [data-add-pay-color], [data-add-pay-tinting], [data-add-pay-patina] ", function(){
        var id = $(this).data('id')
        updatePrice(id)
    })

    $("fieldset").on("change", "[data-price]", function(){
        var id = $(this).data('id')
        updateCustomPrice(id);
        console.log("id - "+id)
    })

    $("fieldset").on("change", "[data-quantity]", function(){
        var id = $(this).data('id')
        updatePrice(id)
    })
})