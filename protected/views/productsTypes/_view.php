<?php
/* @var $this ProductsTypesController */
/* @var $data ProductsTypes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_type_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->product_type_id), array('view', 'id'=>$data->product_type_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />


</div>