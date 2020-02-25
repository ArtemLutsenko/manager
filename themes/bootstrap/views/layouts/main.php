<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="uk" />



	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<?php
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.animate-shadow-min.js',CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.fancybox-1.3.4.pack.js', CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.printElement.min.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerScript('fancyboxClick', '$("a[rel=fancybox]").fancybox({"showNavArrows": false});', CClientScript::POS_READY);
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/jquery.fancybox-1.3.4.css');
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/font-awesome.min.css');
    ?>
	<?php Yii::app()->bootstrap->register(); ?>
    <script>
        var urlProdAutocomplete  =  '<?php  echo Yii::app()->createUrl("products/autocomplete") ?>' ;
        var urlProdPropAutocomplete  =  '<?php  echo Yii::app()->createUrl('productsAttributes/autocomplete') ?>' ;
        var urlPropAutocomplete  =  '<?php  echo Yii::app()->createUrl('properties/autocomplete') ?>' ;
        var c = 0;
    </script>
</head>

<body>
<?php

//echo "helo!!";
 
//echo array_keys(Yii::app()->authManager->getRolesByUser($userID))[0] == User::ROLE_NAME;
 //$usrAssigned = Yii::app()->authManager->getAssignments($userID);
 
  if(Yii::app()->user->isGuest){
	  $itemVisible = false;
  }else{
	  $itemVisible = User::model()->findByPk(Yii::app()->user->id)->profile == "admin" ? true : false;
  }
?>
<?php $this->widget('bootstrap.widgets.TbNavbar',array(

    'brand'=>'',
    'collapse'=>true,
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'Замовлення', 'url'=>array('/orders/admin')),
                array('label'=>'Цех', 'url'=>array('/orderItems/admin')),
                array('label'=>'+ Замовлення сайт', 'url'=>array('/orders/create'), 'visible'=>$itemVisible),
                array('label'=>'+ Замовлення магазин', 'url'=>array('/orders/createShop'), 'visible'=>$itemVisible),
                array('label'=>'Магазини', 'url'=>array('/shops/admin'), 'visible'=>$itemVisible),
                array('label'=>'Покупці', 'url'=>array('/customers/admin'), 'visible'=>$itemVisible),
                array('label'=>'Товари', 'url'=>array('/products/admin'), 'visible'=>$itemVisible,  'items'=>array(
                    array('label'=>'Товари', 'url'=>array('/products/admin')),
                    array('label'=>'Ціни', 'url'=>array('/productsPrices/admin')),
                    array('label'=>'Цінові категорії', 'url'=>array('/priceGroups/admin')),
                    array('label'=>'Надбавки', 'url'=>'#','items'=> array(
                        array('label'=>'За розмір', 'url'=>array('/tabletop/admin')),
                        array('label'=>'За колір', 'url'=>array('/productsProperties/admin')),
                    )),
                    array('label'=>'Атрибути', 'url'=>array('/attributes/admin')),
                    array('label'=>'Атрибути товарів', 'url'=>array('/productsAttributes/admin')),
                    array('label'=>'Кольори', 'url'=>array('/properties/admin')),
                )),
                array('label'=>'Налаштування',  'url'=>'#', 'visible'=>$itemVisible, 'items'=>array(
                    array('label'=>'Способи оплати', 'url'=>array('/paymentMethods/admin')),
                    array('label'=>'Способи доставки', 'url'=>array('/shipmentMethods/admin')),
                    array('label'=>'Міста доставки', 'url'=>array('/cities/admin')),
                    array('label'=>'Статуси замовлень', 'url'=>array('/status/admin')),
                )),
                array('label'=>'Архів', 'url'=>'#', 'visible'=>$itemVisible, 'items'=>array(
                    array('label'=>'Архів замовлень', 'url'=>array('/orders/archive')),
                    array('label'=>'Архів товарів', 'url'=>array('/orderItems/archive')),
                )),
                array('label'=>'Аналітика', 'url'=>array('/orderItems/analytics'), 'visible'=>$itemVisible),
                array('label'=>'Рахунки', 'url'=>array('#'), 'visible'=>$itemVisible,'items'=>array(
                    array('label'=>'Рахунки', 'url'=>array('/bill/admin')),
                    array('label'=>'Накладні', 'url'=>array('/invoice/admin')),
                )),

                array('label'=>'Вхід',
                    'url'=>array('site/login'),
                    'visible'=>Yii::app()->user->isGuest
                ),
                array('label'=>'Вихід ('.Yii::app()->user->name.')',
                    'url'=>array('site/logout'),
                    'visible'=>!Yii::app()->user->isGuest
                ),

            ),
        ),
    ),
)); ?>

<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">

		<?php //echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
