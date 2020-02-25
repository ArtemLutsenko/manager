<?php
/* @var $this ProductsController */
/* @var $data Products */
$num = CHtml::encode($data->product_id);
//$post=Products::model()->findByPk($num);
//echo $post->productPrice->product_price;

//$post=Products::model()->findByPk($num);
//pp($post->priceGroup);
//foreach ($post->priceGroup as $object) {pp($object);}
//echo $post->priceGroup[0]->price_group_name;


//echo $post->productPrices->price_group_id;
//print_r($post->productPrices->product_price);
//echo Products::model()->with('priceGroups')->findAll();

// priceGroup

?>


<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->product_id), array('view', 'id'=>$data->product_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_name')); ?>:</b>
	<?php echo CHtml::encode($data->product_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_length')); ?>:</b>
	<?php echo CHtml::encode($data->product_length); ?>
	<br />

    <?php
        if (CHtml::encode($data->product_insert) !== '0'){
    ?>
    <b><?php echo CHtml::encode($data->getAttributeLabel('product_insert')); ?>:</b>
	<?php echo CHtml::encode($data->product_insert); ?>
	<br />
    <?php
        }
    ?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('product_width')); ?>:</b>
	<?php echo CHtml::encode($data->product_width); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_height')); ?>:</b>
	<?php echo CHtml::encode($data->product_height); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('patina')); ?>:</b>
    <?php echo (CHtml::encode($data->patina))  ? "Так" : "Ні"; ?>
    <br />

</div>