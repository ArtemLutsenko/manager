<?php
/* @var $this BillController */
/* @var $model Bill */
?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/invoice.js',CClientScript::POS_END);?>

<form class="form-inline">

    <div class="form-group">
        <label for="listname">Керівник: </label>
        <?php
        echo CHtml::dropDownList('listname', $select, array('gv' => 'ПП Олексенко Г. В.', 'bv' => 'ПП Олексенко Б. В.'),
            array('class'=>'input-lg'));
        ?>
    </div>
    <div class="form-group">
        <label for="customText">Повідомлення: </label>
        <input type="text" class="message input-lg" id="customText" autocomplete="none" name="message"/>
    </div>
</form>
<span id="invoiceType" class="hidden">Відправляємо накладну №<?php echo $model->account_id; ?> від <?php echo Yii::app()->dateFormatter->format("dd.MM.y", $model->created_on); ?></span>

<div class="text-center ">
    
    <div class="control-wrapper">
    <?php
    
    if ($model->shop_id > 0){
        $toEmail= $model->shop->email; 
    }else{
        $toEmail= $model->customers->email; 
    }
    
    echo CHtml::link(
        '<i class="fa fa-envelope feature-icon"></i> Відправити',
        array('orderItems/doPdf'),
        array(
            'submit' =>  array('orderItems/doPdf'),
            'id'=>'pdfButton',
            'class'=>'bt btn-2',
            'confirm' => 'Відправити накладну на '.$toEmail.'?',
            'params' => array(
                'html'=>'js:getHtml()',
                'email'=>'js:$("#pdfButton").data("sendingEmail")',
                'title'=>'js:$("h1").text()',
                'invoiceType'=>'js:$("#invoiceType").text()',
                'customText'=>'js:$("#customText").val()',
            ),
        )
    );
    ?>


    <?php

    /*echo CHtml::link(
        '<i class="fa fa-print feature-icon"></i> Друкувати (додати в архів)',
        array('invoice/addToArchive'),
        array(
            'submit' =>  array('invoice/addToArchive'),
            'id'=>'toArchive',
            'class'=>'bt btn-2',
            'confirm' => 'Друкувати ти додати до архіву?',
            'params' => array(
                'html'=>'js:getHtml()',
                'email'=>'js:$("#pdfButton").data("sendingEmail")',
                'title'=>'js:$("h1").text()',
                'invoiceType'=>'js:$("#invoiceType").text()',
                'customText'=>'js:$("#customText").val()',
            ),
        )
    );*/
    echo CHtml::ajaxLink(
        '<i class="fa fa-print feature-icon"></i> Друкувати та додати в архів',          // the link body (it will NOT be HTML-encoded.)
        array('invoice/addToArchive'), // t empty, it is assumed to be the current URL.
        array(
            'type' => 'POST',
            'data' =>array(
                'items'=>$orderItems->order_item_id,
            ),
            'beforeSend' => 'function() {
           $("#print").addClass("loading");
        }',
            'complete' => 'function() {
                printPage();
        }',
        ),
        array(
            'id'=>'printButton',
            'confirm' => 'Друкувати ти додати до архіву?',
            'class'=>'bt btn-2',
        )
    );
    ?>

    <a href="#" id="addShipment" class="bt btn-2"><i class="fa fa-truck feature-icon"></i> Додати доставку</a>
   
    <?php
    if ($model->customer_id > 0){
    echo '
	 <form class="form-inline inline">   
    <div class="input-group inline">
      <input type="text" value="190" name="Email" id="defaultShipmentPrice" size="30" class="form-control input-lg"/>
     <span class="input-group-addon input-lg"> грн.</span>
    </div>   
	 </form>    
    ';
    }else{
        echo '
        <form class="form-inline inline">    
            <div class="form-group inline">
                <input type="radio" checked="checked" name="radio" id="standartShipment" />
                <label for="standartShipment" class="checkbox">Стандартна   
                </label>
            </div>         
            <div class="form-group inline">
                <input type="radio" name="radio" id="customShipment" />   
                <label for="customShipment" class="checkbox">   
                    <div class="input-group inline">    
                        <input type="text" placeholder="" class="form-control input-lg" id="customShipmentValue" size="30" autocomplete="none" name="customShipment"/>
                        <span class="input-group-addon input-lg"> грн.</span>
                    </div>
                </label>
            </div>
        </form>       
        ';
    }
    ?>

</div>
</div>
<hr class="invoice" />
<div id="wrap">

    <div id="print">

        <h1>Накладна № <?php echo $model->account_id; ?> </h1>
        <h5>від         <?php echo Yii::app()->dateFormatter->format("dd.MM.y", $model->created_on); ?> </h5>
        <div class="invoice-left">
            <div id='manager'>
            </div>

            <?php
            if ($model->shop_id > 0)
            {
                $this->widget('zii.widgets.CDetailView', array(
                    'data'=>$model,
                    'attributes'=>array(
                        array(
                            'name'=>'Одержано',
                            'value'=>$model->shop->full_name,
                            'template'=>"<tr class=\"print-tr\"><th width=\"130px\">{label}</th><td><span itemprop=\"name\" data-item=\"shop\"><b contentEditable='true'>{value}</b></span></td></tr>\n",
                        ),
                        array(
                            'name'=>'АДРЕСА:',
                            'value'=> Shops::getCityAndAddress($model->shop_id),
                            'template'=>"<tr class=\"print-tr\"><td><b>{label}</b></td><td><span itemprop=\"name\">{value}</span></td></tr>\n",
                        ),
                        array(
                            'name'=>'ТЕЛ',
                            'value'=> $model->shop->phone,
                            'template'=>"<tr class=\"print-tr\"><td><b>{label}.:</b></td><td><span itemprop=\"name\">{value}</span></td></tr>\n",
                        ),
                        array(
                            'name'=>'email',
                            'value'=> $model->shop->email,
                            'template'=>"<tr class=\"print-tr visible hidden\"><td class=\"visible hidden\"><b>{label}.:</b></td><td class=\"print-tr visible hidden\"><span itemprop=\"name\" data-email=\"email\">{value}</span></td></tr>\n",

                        ),
                    ),
                ));
            }

            if ($model->customer_id > 0)
            {
                $this->widget('zii.widgets.CDetailView', array(
                    'data'=>$model,
                    'attributes'=>array(
                        array(
                            'name'=>'Одержано',
                            'value'=>Customers::model()->getCustomerName($model->customer_id),
                            'template'=>"<tr class=\"print-tr\"><th width=\"130px\">{label}</th><td><span itemprop=\"name\" data-item=\"customer\"><b>{value}</b></span></td></tr>\n",
                        ),
                        array(
                            'name'=>'ЄДРПОУ:',
                            'value'=> '',
                            'template'=>"<tr class=\"print-tr\"><td><b>{label}</b></td><td><span itemprop=\"name\">{value}</span></td></tr>\n",
                        ),
                        array(
                            'name'=>'АДРЕСА:',
                            'value'=> Customers::model()->getCustomerCityAndAddress($model->customer_id),
                            'template'=>"<tr class=\"print-tr\"><td><b>{label}</b></td><td><span itemprop=\"name\">{value}</span></td></tr>\n",
                        ),
                        array(
                            'name'=>'ТЕЛ',
                            'value'=> $model->customers->phone,
                            'template'=>"<tr class=\"print-tr\"><td><b>{label}.:</b></td><td><span itemprop=\"name\">{value}</span></td></tr>\n",
                        ),
                        array(
                            'name'=>'email',
                            'value'=> $model->customers->email,
                            'template'=>"<tr class=\"print-tr visible hidden\"><td class=\"visible hidden\"><b>{label}.:</b></td><td class=\"print-tr visible hidden\"><span itemprop=\"name\" data-email=\"email\">{value}</span></td></tr>\n",

                        ),
                    ),
                ));
            }

            ?>
        </div>
        <div class="invoice-right"><img src="/images/admin/logo.jpg" alt=""></div>

            <div class="pdv">

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
                                'value'=>'$data->getProductNameAndSize($data->order_item_id)',
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
                            array(
                                'class'=>'CButtonColumn',
                                'template'=>'{update}{delete}',
                                'headerHtmlOptions'=>array(
                                    'class'=>'visible hidden',
                                ),
                                'htmlOptions' => array('class' => 'visible hidden'),
                               // 'afterDelete' => "function(link,success,data){countTotal(); getAjaxNum2Str()}",
                                'afterDelete'=>'function(link,success,data){ if(success) alert("Delete completed successfully");countTotal(); getAjaxNum2Str() }',
                                'buttons'=>array
                                (
                                    'update' => array
                                    (
                                        'url'=>'$this->grid->controller->createUrl("/orderItems/update", array("id"=>$data->primaryKey))',
                                    ),
                                    'delete' => array
                                    (
                                        'url'=>'$this->grid->controller->createUrl("/invoiceItems/deleteAndReturnToItems", array("id"=>$data->invoiceItem->primaryKey))',
                                    ),
                                ),
                            ),
                        ),
                    ));
                }

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

        <table style="width:100%; " class="sender">
            <tr>
                <td style="width:11%">
                    <b>Відпустив</b>
                </td>
                <td style="width:39%">
                    <p class="underline-pdf">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <td style="width:15%">
                    <b>Одержав</b>
                </td>
                <td style="width:35%">
                    <p class="underline-pdf">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
            </tr>
            <tr>
                <td>
                    <span>Керівник: </span>
                </td>
                <td>
                    <p class="underline-pdf"><span class="name"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td>
                    <span>Гол. бухгалтер: </span>
                </td>
                <td>
                    <p class="underline-pdf">Олексенко Наталія Марківна&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
            </tr>
        </table>

    </div>
</div>