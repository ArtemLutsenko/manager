<?php
/* @var $this BillItemsController */
/* @var $data BillItems */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('bill_item_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->bill_item_id), array('view', 'id'=>$data->bill_item_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bill_id')); ?>:</b>
	<?php echo CHtml::encode($data->bill_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_item_id')); ?>:</b>
	<?php echo CHtml::encode($data->order_item_id); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_by')); ?>:</b>
	<?php echo CHtml::encode($data->modified_by); ?>
	<br />


</div>