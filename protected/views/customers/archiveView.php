<?php
/* @var $this CustomerController */
/* @var $model Customer */

$this->breadcrumbs=array(
	'Покупці'=>array('index'),
	$model->getCustomerName($model->customer_id),
);

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

$this->menu=array(


	array('label'=>'Редагувати покупця', 'url'=>array('update', 'id'=>$model->customer_id)),
	array('label'=>'Видалити покупця', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->customer_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управління покупцями', 'url'=>array('admin')),
);
?>

<h1>Покупець <?php echo $model->last_name; echo " ".$model->first_name;?> (архів товарів)</h1>
<?php $form=$this->beginWidget('CActiveForm', array(
    'enableAjaxValidation'=>true,
)); ?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'customer_id',
		'first_name',
		'last_name',
		'phone',
		'email',
        array(
            'name'=>'city_id',
            'value'=> Customers::model()->getCustomerCityAndAddress($model->customer_id),
            //'visible'=>$model->shop_id == null ? false : true,
            //'type'=>'raw',
        ),
	),
)); ?>
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
                'customerId'=>$model->customer_id,
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
                'customerId'=>$model->customer_id,
            ),
        )
    );

    ?></p>
<?php
if ( $orderItems !== null )
{
    $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'orders-items-grid',
        'dataProvider'=>$orderItems->filter(),
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
                    'width'=>'120px',
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
            'status.status_name',
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
