<?php
/* @var $this StatusController */
/* @var $model Status */

$this->breadcrumbs=array(
    'Магазини'=>array('admin'),
    $model->full_name,
);

$this->menu=array(
    array('label'=>'Додати магазин', 'url'=>array('create')),
    array('label'=>'Редагувати магазин', 'url'=>array('update', 'id'=>$model->shop_id)),
    array('label'=>'Видалити магазин', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->shop_id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Управління магазинами', 'url'=>array('admin')),
);
?>

<?php

Yii::app()->clientScript->registerScript('print', "
$('a.bt').addClass('disable-button');

$(':input:checkbox').on('click', function(){
var len = $(':checkbox:checked').length
    if(len > 0){
        $('a.bt').removeClass('disable-button');
    }else{
       $('a.bt').addClass('disable-button');
    }
})

");

?>

    <h1>Замовлення магазину <?php echo $model->full_name; ?></h1>

<?php $form=$this->beginWidget('CActiveForm', array(
    'enableAjaxValidation'=>true,
)); ?>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,

    'attributes'=>array(

        array(
            'name'=>'shop_id',
        ),
        array(
            'name'=>'city_id',
            'type'=>'raw',
            'value'=> $model->city->city_name,
        ),
        array(
            'name'=>'price_group_id',
            'value'=>$model->priceGroup->price_group_name,
        ),
//
        'full_name',
        'name',
        'address',
        'phone',
        'email',

        array(
            'name'=>'debt',
            'visible'=>$model->debt == null ? false : true,
        ),
        'comment',
        //'created_on',
        //'created_by',
        'modified_on',
        'modified_by',
    ),
)); ?>

<?php echo CHtml::ajaxSubmitButton('Filter',array('menu/ajaxupdate'), array(),array("style"=>"display:none;")); ?>

    <p><?php
        /*$url = array('orderItems/invoice');
        echo CHtml::link(
            'do pdf',
            array('orderItems/invoice'),
            array(
                'submit' => array('orderItems/invoice'),
                'id'=>'printButton',
                'class'=>'disable-button',
                'params' => array(
                    'shopId'=>$model->shop_id,
                ),
            )
        );
        */
        ?>
    </p>
    <p><?php
        echo CHtml::link(
            '<i class="fa fa-file-powerpoint-o feature-icon"></i> Створити рахунок',
            array('bill/createBill'),
            array(
                'submit' =>  array('bill/createBill'),
                'id'=>'printButton',
                'class'=>'bt btn-2',
                'params' => array(
                    'shopId'=>$model->shop_id,
                ),
            )
        );
        echo CHtml::link(
            '<i class="fa fa-file-text feature-icon"></i> Створити накладну',
            array('invoice/createInvoice'),
            array(
                'submit' =>  array('invoice/createInvoice'),
                'id'=>'ert',
                'class'=>'bt btn-2',
                'params' => array(
                    'shopId'=>$model->shop_id,
                ),
            )
        );
        /*echo CHtml::link(
            'Прибутковий касовий ордер',
            array('orderItems/cashOrder'),
            array(
                'submit' =>  array('orderItems/cashOrder'),
                'id'=>'cashOrder',
                'class'=>'bt btn-2',
                'params' => array(
                    'shopId'=>$model->shop_id,
                ),
            )
        );*/

        ?></p>

<?php
if ( $orderItems !== null )
{
    $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'orders-items-grid',
        'dataProvider'=>$orderItems->filter(),
        //'template' => '{items}{summary} {pager}',//

        'columns'=>array(
            array(
                'id'=>'autoId',
                'class'=>'CCheckBoxColumn',
                'selectableRows' => 50,
                'checkBoxHtmlOptions' => array('class' => 'classname'),
            ),
            array(
                'name'=>'order_id',
                'type'=>'raw',
                'value'=>'CHtml::link($data->order_id, Yii::app()->createUrl("orders/view/",array("id"=>$data->order_id)))',
                'headerHtmlOptions'=>array(
                    'width'=>'50px',
                ),
            ),
            array(
                'name'=>'product_id',
                'type'=>'raw',
                'value'=>'$data->product->product_name',
                'headerHtmlOptions'=>array(
                    'width'=>'120px',
                ),
            ),
            array(
                'name'=>'length',
                'type'=>'raw',
                'headerHtmlOptions'=>array(
                    'width'=>'70px',
                ),
            ),
            array(
                'name'=>'insert',
                'type'=>'raw',
                'headerHtmlOptions'=>array(
                    'width'=>'70px',
                ),
            ),
            array(
                'name'=>'width',
                'type'=>'raw',
                'headerHtmlOptions'=>array(
                    'width'=>'70px',
                ),
            ),
            array(
                'name'=>'height',
                'type'=>'raw',
                'headerHtmlOptions'=>array(
                    'width'=>'70px',
                ),
            ),
            'quantity',


            array(
                'header'=>'Колір',
                'value'=>'$data->getColor($data->order_item_id)',
            ),
            'comment',
            'price',
            'subtotal',

             array(
                 'name'=>'archive',

                 'headerHtmlOptions'=>array(
                     'class'=>'hidden ',
                 ),
                 'htmlOptions'=>array(
                     'class'=>'hidden',
                 ),
             ),

        ),
    ));
}
?>
    <script>
        function reloadGrid(data) {
            $.fn.yiiGridView.update('menu-grid');
        }
        $("table.detail-view tr:first").hide();
    </script>


<?php $this->endWidget(); ?>