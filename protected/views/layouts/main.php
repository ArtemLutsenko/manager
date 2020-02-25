<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <?php

    Yii::app()->clientScript->registerScript('autocompletek', "
 jQuery(document).ready(function($){

                        var autocompleteSettings={
                                        'source':" .Yii::app()->createUrl('products/autocomplete'). ",// the action that provides data
                        'minLength':1,
                        'select': function( event, ui ) {
                        $('#product-field').val(ui.item.id);
                        $('#OrderItems_length_0').val(ui.item.l);
                        $('#OrderItems_width_0').val(ui.item.w);
                        $('#OrderItems_height_0').val(ui.item.h);
                        $('#OrderItems_price_0').val(ui.item.p);

                        }
                        };
                        $('.product_id > input').autocomplete(autocompleteSettings);
                        //instantiate the existing field with the autocomplete.
                        $('#cloneTag').autocomplete(autocompleteSettings).data( 'autocomplete' )._renderItem = function( ul, item ) {
                                    return $( '<li></li>' )
                                        .data( 'item.autocomplete', item )
                                        .append( '<a>' + item.user_code + '<br>' + item.user_name + '</a>' )
                                        .appendTo( ul );
                                };
                        // create the action when the input field is cloned.
                        var i = 1;
                        var tagsdiv = $('#myTags');

                });

", CClientScript::POS_END);

    ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container-fluid" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Головна', 'url'=>array('/site/index')),
                array('label'=>'Замовлення', 'url'=>array('/orders/admin')),
				array('label'=>'Товари', 'url'=>array('/products/index')),
				array('label'=>'Ціни', 'url'=>array('/productsPrices/index')),
				array('label'=>'Цінові категорії', 'url'=>array('/priceGroups/index')),
				array('label'=>'Способи оплати', 'url'=>array('/paymentMethods/index')),
				array('label'=>'Способи доставки', 'url'=>array('/shipmentMethods/index')),
				array('label'=>'Міста доставки', 'url'=>array('/cities/index')),
				array('label'=>'Статуси', 'url'=>array('/status/index')),
                array('label'=>'Атрибути товарів', 'url'=>array('/productsAttributes/index')),
                array('label'=>'Атрибути товарів', 'url'=>array('/productsAttributes/index')),
                array('label'=>'Управління атрибутами', 'url'=>array('/attributes/index')),
				array('label'=>'Інформація про властивостямі', 'url'=>array('/propertiesInfo/index')),
                array('label'=>'Управління властивостями', 'url'=>array('/properties/index')),

		))); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
