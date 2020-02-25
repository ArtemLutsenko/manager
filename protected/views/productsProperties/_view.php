<?php
/* @var $this ProductsPropertiesController */
/* @var $data ProductsProperties */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_property_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->product_property_id), array('view', 'id'=>$data->product_property_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price_group_id')); ?>:</b>
	<?php echo CHtml::encode($data->price_group_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_id')); ?>:</b>
	<?php echo CHtml::encode($data->property_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('add_payment')); ?>:</b>
	<?php echo CHtml::encode($data->add_payment); ?>
	<br />


</div>