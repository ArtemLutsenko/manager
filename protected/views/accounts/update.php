<?php
/* @var $this AccountsController */
/* @var $model Accounts */

$this->breadcrumbs=array(
	'Accounts'=>array('index'),
	$model->account_id=>array('view','id'=>$model->account_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Accounts', 'url'=>array('index')),
	array('label'=>'Create Accounts', 'url'=>array('create')),
	array('label'=>'View Accounts', 'url'=>array('view', 'id'=>$model->account_id)),
	array('label'=>'Manage Accounts', 'url'=>array('admin')),
);
?>

<h1>Update Accounts <?php echo $model->account_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>