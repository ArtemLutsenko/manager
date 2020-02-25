<?php
/* @var $this PriceGroupsController */
/* @var $data PriceGroups */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('price_group_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->price_group_id), array('view', 'id'=>$data->price_group_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price_group_name')); ?>:</b>
	<?php echo CHtml::encode($data->price_group_name); ?>
	<br />


</div>