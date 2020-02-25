<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="uk" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.animate-shadow-min.js',CClientScript::POS_END);?>
	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(

    'brand'=>'',
    'collapse'=>true,
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'Головна', 'url'=>array('/site/index')),
                array('label'=>'Замовлення', 'url'=>array('/orders/admin')),
                array('label'=>'Магазини', 'url'=>array('/shops/admin')),
                array('label'=>'Товари', 'url'=>array('/products/index'), 'items'=>array(
                    array('label'=>'Товари', 'url'=>array('/products/index')),
                    array('label'=>'Ціни', 'url'=>array('/productsPrices/index')),
                    array('label'=>'Цінові категорії', 'url'=>array('/priceGroups/index')),
                    array('label'=>'Атрибути', 'url'=>array('/attributes/index')),
                    array('label'=>'Властивості', 'url'=>'#', 'items'=> array(
                        array('label'=>'Управління властивостями', 'url'=>array('/properties/index')),
                        array('label'=>'Інформація про властивостямі', 'url'=>array('/propertiesInfo/index')),
                        array('label'=>'Управління властивостями', 'url'=>array('/productsProperties/admin')),
                    )),
                )),
                array('label'=>'Додаткові налаштування', 'url'=>'#', 'items'=>array(
                    array('label'=>'Способи оплати', 'url'=>array('/paymentMethods/index')),
                    array('label'=>'Способи доставки', 'url'=>array('/shipmentMethods/index')),
                    array('label'=>'Міста доставки', 'url'=>array('/cities/index')),
                    array('label'=>'Статуси замовлень', 'url'=>array('/status/index')),
                )),
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
