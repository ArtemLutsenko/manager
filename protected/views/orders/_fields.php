<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $form CActiveForm */
?>

<div>

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'orders-columns',
        'enableAjaxValidation'=>false,
    ));

    $modelColumns=$model->getMetaData()->columns;
    $attributeLabels = $model->attributeLabels();


    $i=0;
    foreach ($modelColumns AS $column => $columnData) {

        // group fields into columns for big tables (optional)
        if ($i==0) {
            echo '<div style="float:left">';
        }

        // set selected columns to be checked
        $checked=0;
        if (in_array($column,$columns)) {
            $checked=1;
        }

        // restrict sensitive columns that should not be viewed or searched
        if ($column!='password' && $column!='secret') {
            echo CHtml::checkBox("columns[]",$checked,array('value'=>$column,'id'=>"column_$column"));
            echo CHtml::label($attributeLabels[$column],"column_$column");
            echo "<br/>\r\n";
        }

        // group columns
        $i++;
        if ($i==10) {
            echo '</div>';
            $i=0;
        }
    }
    // group columns
    if ($i!==0) {
        echo '</div>';
    }
    ?>
    <div class="row buttons clear">
        <?php echo CHtml::submitButton('Refresh'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->