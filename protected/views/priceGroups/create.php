<?php
/* @var $this PriceGroupsController */
/* @var $model PriceGroups */

$this->breadcrumbs=array(
	'Цінові категорії'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Список цінових категорій', 'url'=>array('index')),
	array('label'=>'Управління ціновими категоріями', 'url'=>array('admin')),
);
?>

<h1>Додати цінову категорію</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>