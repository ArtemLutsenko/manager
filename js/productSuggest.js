

var autocompleteSettings={
        source: function(request, response) {
            $.ajax({
                url: urlProdAutocomplete, //products/autocomplete
                dataType: "json",
                data: {
                    term: request.term,
                    pg: $("#pg").val()
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 1,
        select: function( event, ui ) {
            var id = getLastNumber(this.id)
            var prices = ui.item.p
            var add = ui.item.tt
            $("#product_id_" + id).val(ui.item.id);
            $("#OrderItems_length_" + id).val(ui.item.l)
                                         .data('addPaySize', add)
                                         .data('size', ui.item.l)
                                         .data('id', id)
                                         .attr("data-add-pay-size", add)
                                         .attr("data-size", ui.item.l)
                                         .attr("data-id", id);
            $("#OrderItems_width_" + id).val(ui.item.w)
                                         .data('addPaySize', add)
                                         .data('size', ui.item.w)
                                         .data('id', id)
                                         .attr("data-add-pay-size", add)
                                         .attr("data-size", ui.item.w)
                                         .attr("data-id", id);
            $("#OrderItems_height_" + id).val(ui.item.h);
            $("#OrderItems_insert_" + id).val(ui.item.i);
            $("#OrderItems_price_" + id).val(ui.item.p)
                                         .data('price', prices)
                                         .data('id', id)
                                         .attr("data-price", prices)
                                         .attr("data-id", id);
            $("#OrderItems_subtotal_"+ id).val(ui.item.p)
                                        .data('subtotal', prices)
                                        .data('id', id)
                                        .attr("data-subtotal", prices)
                                        .attr("data-id", id);
            $("#Item_patina_" + id).val(ui.item.pt);

            $("#OrderItems_quantity_" + id).val("1")
                                        .data('id', id)
                                        .data('quantity', '1')
                                        .attr("data-id", id)
                                        .attr("data-quantity", '1');
            updateTotalPrice();
            $.ajax({
                dataType: "json",
                url: urlProdPropAutocomplete,  //productsProperties/autocomplete
                data:{
                    id_prod: $("#product_id_" + id).val(),
                    pg: $("#pg").val()
                },
                success: function(data){
                    $(".prop_"+id).empty();

                    var i = "0";

                    $.each(data, function(index, value){
                        var row = $("<div class=\"new_property\">"+
                            "<label for=\"name\" >" + value.attr_name + "</label>"+
                            "<input name=\"OrdersItemsProperties[property_name]["+id+"]["+i+"]\" id=\"name\" data-attr="+ value.attr_id +" type=\"text\" placeholder=\"автозаповнення\">"+
                            "<input name=\"OrdersItemsProperties[property_id]["+id+"]["+i+"]\" id=\"id\" data-attr="+ value.attr_id +" class=\"id\" type=\"hidden\" >"+
                            "<input name=\"OrdersItemsProperties[add_payment]["+id+"]["+i+"]\" id=\"add_payment\" data-add-pay-color=\"0\" data-id="+id+" class=\"add_payment\"  type=\"text\" value=\"0\" >"+
                            "</div>");
                        $(".prop_" + id).append(row).hide().fadeIn().slideDown();
                        i++;
                    });
                    if ($("#Item_patina_"+id).val() == 1){
                        var ton = $("<label for=\"OrderItems[tinting]["+id+"]\">Тонування</label>"+
                            "<input name=\"OrderItems[tinting]["+id+"]\" id=\"OrderItems_tinting_"+id+"\" data-add-pay-tinting=\"0\" data-id="+id+" type=\"checkbox\" value=\"1\" >"+
                            "<span></span> <br />")
                        $(".prop_" + id).append(ton).hide().fadeIn().slideDown();

                        var patina = {'1': 'Золото','2': 'Мідь','3':'Бронза'}
                        var list = $("<label for=\"Patina\" style='padding: 5px 0 0 0'>Патіна</label>"+
                            "<select name=\"OrderItems[patina]["+id+"]\" id=\"OrderItems_patina_"+id+"\" data-add-pay-patina=\"0\" data-id="+id+"/>")
                        $(".prop_" + id).append(list);
                        for(var val in patina){
                            $('<option />', {value: val, text: patina[val]}).appendTo(list);
                        }
                        $("#OrderItems_patina_"+id).prepend("<option value='' selected='selected'>Виберіть значення</option>");
                        $("#OrderItems_patina_"+id+" option[value='']").attr('selected',true);
                    }
                    var comment = $("<label for=\"OrderItems[comment]["+id+"]\" >Коментар (обивка)</label>"+
                        "<textarea name=\"OrderItems[comment]["+id+"]\" id=\"OrderItems_comment"+id+"\" rows=\"1\" >")
                    $(".prop_" + id).append(comment).hide().fadeIn().slideDown();
                    $(".prop_" + id).addClass('content-color copy'+id)
                    $(".new_property > input").click(function(eventObject){
                        var elem = $(this);
                        elem.autocomplete({
                            source: function(request, response){
                                $.ajax({
                                    url: urlPropAutocomplete, // properties/autocomplete
                                    dataType: "json",
                                    data: {
                                        term: request.term,
                                        att: elem.data("attr"),
                                        pg: $("#pg").val()
                                    },
                                    success: function(data) {
                                        response(data);
                                    }
                                });
                            },
                            select: function(event, ui) {
                                elem.siblings(".add_payment").val(ui.item.add).data('addPayColor', add).attr("data-add-pay-color", ui.item.add);
                                elem.siblings(".id").val(ui.item.id);
                                var className = elem.parents(':eq(1)').attr("class")
                                updatePrice(id)
                            }
                        });
                    });
                },
                error: function(xhr){
                    alert("failure"+xhr.readyState+this.url)
                }
            });
            return true;

        }
    }

    $("fieldset").on("click", function(){return event.target.id},  function(event){
        var id = getLastNumber(event.target.id);
        $("#OrderItems_product_id_" + id).autocomplete(autocompleteSettings);
    });