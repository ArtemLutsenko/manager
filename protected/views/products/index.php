<?php
/* @var $this ProductsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Products',
);

$this->menu=array(
	array('label'=>'Create Products', 'url'=>array('create')),
	array('label'=>'Manage Products', 'url'=>array('admin')),
);
?>

<h1>Товари</h1>

<?php

$this->widget('zii.widgets.jui.CJuiAutoComplete',array(
    'name'=>'products',//+
    'source'=>Yii::app()->createUrl('products/autocomplete'),
    // additional javascript options for the autocomplete plugin
    'options'=>array(

    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;',
    ),
));


$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
