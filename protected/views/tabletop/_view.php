<?php
/* @var $this TabletopController */
/* @var $data Tabletop */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('tabletop_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->tabletop_id), array('view', 'id'=>$data->tabletop_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('attribute_id')); ?>:</b>
	<?php echo CHtml::encode($data->attribute_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('add')); ?>:</b>
	<?php echo CHtml::encode($data->add); ?>
	<br />


</div>