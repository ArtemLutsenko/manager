<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/updatePrice.js',CClientScript::POS_END);?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/productSuggest.js',CClientScript::POS_END);?>
<?php

Yii::app()->clientScript->registerScript('loading', '

    $("#copylink").on("click", function(){
        c++;
        var copyDiv = "<div class=\"prop_"+c+"\"></div>"
        $(copyDiv).appendTo($(".wrap_prop"));
    })



', CClientScript::POS_READY);

Yii::app()->clientScript->registerScript('remove', "
$('[data-remove]').on('click', '',function(){
    console.log($(this).parent())
})
");

return array(
    'elements' => array(
        'Customers' => array(
            'type' => 'form',
            'title' => 'Замовник',
            'elements' => array(
                'first_name' => array(
                    'type' => 'text',
                    'attributes'=>array(
                        'required' =>'required',
                    ),
                ),
                'last_name' => array(
                    'type' => 'text',
                    'attributes'=>array(
                        'required' =>'required',
                    ),
                ),
                'phone' => array(
                    'type' => 'text',
                    'attributes'=>array(
                        'required' =>'required',
                    ),
                ),
                'email' => array(
                    'type' => 'email',
                ),
                'price_group_id'=> array(
                    'type' => 'hidden',
                    'attributes'=>array(
                        'value' => '1',
                        'id'=>'pg',
                    ),
                ),

            ),
        ),

        'OrderItems'=>array(
            'type' => 'form',
            'title' => 'Товар',
            'elements' => array(
                '<div class="wrap">',
                'product_id' => array(
                    'type'=>'zii.widgets.jui.CJuiAutoComplete',
                    'htmlOptions'=>array(
                        'name' => 'OrderItems[product_id][0]',
                        'placeholder' => 'автозаповнення',
                    ),
                ),
                '<input id="product_id_0" name="OrderItems[product_id][0]" type="hidden" />',
                'length' => array(
                    'type' => 'text',
                    'attributes'=>array(
                        'name' => 'OrderItems[length][0]',
                        'required' =>'required',
                        'data-color' => '0',

                    ),
                ),
                'insert' => array(
                    'type' => 'text',
                    'attributes'=>array(
                        'name' => 'OrderItems[insert][0]',
                        'required' =>'required',
                        'data-color' => '0',
                    ),
                ),
                'width' => array(
                    'type' => 'text',
                    'attributes'=>array(
                        'name' => 'OrderItems[width][0]',
                        'required' =>'required',
                        'data-color' => '0',
                    ),
                ),
                'height' => array(
                    'type' => 'text',
                    'attributes'=>array(
                        'name' => 'OrderItems[height][0]',
                        'required' =>'required',
                        'data-color' => '0',
                    ),
                ),
                'patina' => array(
                    'type' => 'hidden',
                    'attributes'=>array(
                        'name' => 'Item[patina][0]',
                        'id' => 'Item_patina_0'
                    ),
                ),
                'quantity' => array(
                    'type' => 'number',
                    'attributes'=>array(
                        'name' => 'OrderItems[quantity][0]',
                        'id'=>'OrderItems_quantity_0',
                        'required' =>'required',
                        'min'=>'1'
                    ),
                ),
                'price' => array(
                    'type' => 'text',
                    'attributes'=>array(
                        'name' => 'OrderItems[price][0]',
                        'class' => 'copy',
                        'required' =>'required',
                    ),
                ),
                'subtotal'=>array(
                    'type'=>'text',
                    'attributes'=>array(
                        'name' => 'OrderItems[subtotal][0]',
                        'id'=>'OrderItems_subtotal_0',
                        'required' =>'required',
                        'data-subtotal'=>'0',
                    ),
                ),
                '</div>',
                '<a id="copylink" href="#" rel=".wrap">[+] Додати товар</a>',
            ),
        ),

        'OrdersItemsProperties'=>array(
            'type' => 'form',
            'title' => 'Колір',
            'elements' => array(
                '<div class="wrap_prop">',
                '<div class="prop_0"></div>',
                '</div>',
            ),
        ),

        'Orders' => array(
            'type' => 'form',
            'title' => 'Доставка/Оплата',
            'elements' => array(
                'city_id' => array(
                    'type'=>'zii.widgets.jui.CJuiAutoComplete',
                    'source'=>Yii::app()->createUrl('ajax/autocomplete'),
                    'options'=>array(
                        'select'=>'js:function(event, ui) {
                            $("#hidden_city_id").val(ui.item.id);
                            return true;
                        }',
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'автозаповнення',
                    ),
                ),
                '<input id="hidden_city_id" name="Orders[city_id]" type="hidden" />',
                'shipment_name_id' => array(
                    'type'=>'dropdownlist',
                    'items'=>ShipmentMethods::model()->getShipmentMethodsList(),
                    'prompt'=>'Виберіть значення',
                ),
                'address' => array(
                    'type' => 'textarea',
                    'rows' => 1,
                ),
                'payment_name_id' => array(
                    'type'=>'dropdownlist',
                    'items'=>PaymentMethods::model()->getPaymentMethodsList(),
                    'prompt'=>'Виберіть значення',
                ),
				'created_on' => array(
                    'type'=>'zii.widgets.jui.CJuiDatePicker',
                    'model' => $model,
                    'language' => 'uk',
                    'attribute' => 'created_on',
                    'options'=>array(
                        'showAnim' => 'clip',
                        'showButtonPanel'=>true,
                       // 'minDate'=> 0,
                        'dateFormat'=>'dd-mm-yy',
                    ),
					'htmlOptions' => array(
						 'value' => date('d-m-Y H:i:s'), // set the default date as today's date
					),
                ),
                'delivery_date' => array(
                    'type'=>'zii.widgets.jui.CJuiDatePicker',
                    'model' => $model,
                    'language' => 'uk',
                    'attribute' => 'delivery_date',
                    'options'=>array(
                        'showAnim' => 'clip',
                        'showButtonPanel'=>true,
                        'minDate'=> 0,
                        'dateFormat'=>'dd-mm-yy',
                    ),
                ),
                'order_total' => array(
                    'type' => 'text',
                ),
            ),
        ),
    ),

    'buttons' => array(
        'create' => array(
            'type' => 'submit',
            'label' => 'Додати замовлення',
        ),
    ),
);