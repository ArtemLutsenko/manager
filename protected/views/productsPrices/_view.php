<?php
/* @var $this ProductsPricesController */
/* @var $data ProductsPrices */

?>

<div class="view">

	<?php //echo CHtml::encode($data->getAttributeLabel('product_price_id')); ?>
	<?php //echo CHtml::link(CHtml::encode($data->product_price_id), array('view', 'id'=>$data->product_price_id)); ?>


	<?php //echo CHtml::encode($data->getAttributeLabel('price_group_id')); ?>
	<?php echo CHtml::encode($data->priceGroup->price_group_name); ?>
	<br />

	<?php echo CHtml::encode($data->getAttributeLabel('product_id')); ?>:
	<?php //echo CHtml::encode($data->product_id); ?>
    <b><?php echo CHtml::encode($data->product->product_name); ?></b>
    <?php //print_r($post2->product) ?>
	<br />

	<?php echo CHtml::encode($data->getAttributeLabel('product_price')); ?>:
    <b><?php echo CHtml::encode($data->product_price); ?></b>
	<br />


</div>