<?php
/* @var $this OrdersItemsPropertiesController */
/* @var $model OrdersItemsProperties */

$this->breadcrumbs=array(
	$model->order_item_property_id=>array('view','id'=>$model->order_item_property_id),
    $model->orderItem->product->product_name=>$model->orderItem->product->product_name,
	'Редагувати',
);
?>

<h1>Редагувати колір <?php echo $model->property->attribute->name.' '.$model->property->name; ?></h1>
    <input name="Properties[attribute_id]" id="ProductsProperties_attribute_id" type="hidden" maxlength="255" value="<?php echo  $model->property->attribute_id;?>" />
<?php $this->renderPartial('_formUpdate', array('model'=>$model)); ?>