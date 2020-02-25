<?php
/* @var $this PropertiesInfoController */
/* @var $data PropertiesInfo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_info_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->property_info_id), array('view', 'id'=>$data->property_info_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('collection')); ?>:</b>
	<?php echo CHtml::encode($data->collection); ?>
	<br />


</div>