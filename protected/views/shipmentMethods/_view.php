<?php
/* @var $this ShipmentMethodController */
/* @var $data ShipmentMethods */
?>

<div class="view">

	<?php echo CHtml::encode($data->getAttributeLabel('shipment_name_id')); ?>:
    <b><?php echo CHtml::link(CHtml::encode($data->shipment_name_id), array('view', 'id'=>$data->shipment_name_id)); ?></b>
	<br />

	<?php echo CHtml::encode($data->getAttributeLabel('shipment_name')); ?>:
    <b><?php echo CHtml::encode($data->shipment_name); ?></b>
	<br />


</div>