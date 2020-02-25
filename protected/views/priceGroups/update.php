<?php
/* @var $this PriceGroupsController */
/* @var $model PriceGroups */

$this->breadcrumbs=array(
	'Price Groups'=>array('index'),
	$model->price_group_id=>array('view','id'=>$model->price_group_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PriceGroups', 'url'=>array('index')),
	array('label'=>'Create PriceGroups', 'url'=>array('create')),
	array('label'=>'View PriceGroups', 'url'=>array('view', 'id'=>$model->price_group_id)),
	array('label'=>'Manage PriceGroups', 'url'=>array('admin')),
);
?>

<h1>Update PriceGroups <?php echo $model->price_group_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>