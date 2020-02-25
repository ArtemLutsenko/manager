<?php
/* @var $this PaymentMethodsController */
/* @var $data PaymentMethods */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_method_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->payment_method_id), array('view', 'id'=>$data->payment_method_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_method_name')); ?>:</b>
	<?php echo CHtml::encode($data->payment_method_name); ?>
	<br />


</div>