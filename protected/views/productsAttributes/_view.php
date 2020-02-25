<?php
/* @var $this ProductsAttributesController */
/* @var $data ProductsAttributes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_attribute_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->product_attribute_id), array('view', 'id'=>$data->product_attribute_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_id')); ?>:</b>
	<?php echo CHtml::encode($data->product_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('attribute_id')); ?>:</b>
	<?php echo CHtml::encode($data->attribute_id); ?>
	<br />


</div>