<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<?php
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/product_attributes.js');
//$cs->registerCssFile($baseUrl.'/css/yourcss.css');
?>
<?php

echo '<input type="hidden" name="js_lbl_title" value="title" />
		      <input type="hidden" name="js_lbl_property" value="property" />
		      <input type="hidden" name="js_lbl_property_new" value="property new" />
		      <input type="hidden" name="js_lbl_attribute_new" value="attr new" />
		      <input type="hidden" name="js_lbl_attribute_delete" value="attr del" />
		      <input type="hidden" name="js_lbl_price" value="price" />' ;
?>
    <table id="attributeX_table_0" cellpadding="0" cellspacing="0"
           border="0" class="adminform" width="30%">
        <tbody width="30%">
        <tr>
            <td width="5%">title</td>
            <td align="left" colspan="2"><input type="text" name="attributeX[0][name]" value="" size="60" /></td>
            <td colspan="3" align="left"><a href="javascript: newAttribute(1)">new attr</a>
                | <a href="javascript: newProperty(0)">new prop</a>
            </td>
        </tr>
        <tr id="attributeX_tr_0_0">
            <td width="5%">&nbsp;</td>
            <td width="10%" align="left">property</td>
            <td align="left" width="20%"><input type="text" name="attributeX[0][value][]" value="" size="40" /></td>
            <td align="left" width="5%">title</td>
            <td align="left" width="60%"><input type="text"
                                                name="attributeX[0][price][]" size="10" value="" /></td>
        </tr>
        </tbody>
    </table>

<div id="addinput">

    <p>

        <input type="text" id="p_new" size="20" name="p_new" value="" placeholder="Input Value" /><a href="#" id="addNew">Add</a>

    </p>

</div>

<div id="attr_0">

    <input type="text" id="p_new" size="20" name="p_new" value="" placeholder="Input Value"/>


</div>

