<?php
/* @var $this OrdersItemsPropertiesController */
/* @var $data OrdersItemsProperties */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_item_property_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->order_item_property_id), array('view', 'id'=>$data->order_item_property_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_item_id')); ?>:</b>
	<?php echo CHtml::encode($data->order_item_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_id')); ?>:</b>
	<?php echo CHtml::encode($data->property_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('add_payment')); ?>:</b>
	<?php echo CHtml::encode($data->add_payment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_on')); ?>:</b>
	<?php echo CHtml::encode($data->created_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_on')); ?>:</b>
	<?php echo CHtml::encode($data->modified_on); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_by')); ?>:</b>
	<?php echo CHtml::encode($data->modified_by); ?>
	<br />

	*/ ?>

</div>