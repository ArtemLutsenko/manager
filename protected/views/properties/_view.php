<?php
/* @var $this PropertiesController */
/* @var $data Properties */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->property_id), array('view', 'id'=>$data->property_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('attribute_id')); ?>:</b>
	<?php echo CHtml::encode($data->attribute_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_info_id')); ?>:</b>
	<?php echo CHtml::encode($data->property_info_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('img_url')); ?>:</b>
	<?php echo CHtml::encode($data->img_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('img_url_thumb')); ?>:</b>
	<?php echo CHtml::encode($data->img_url_thumb); ?>
	<br />


</div>