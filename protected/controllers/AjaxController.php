<?php
class AjaxController extends Controller
{
    public function actionAutocomplete()
    {
        $term = Yii::app()->getRequest()->getParam('term');

        if(Yii::app()->request->isAjaxRequest && $term) {
            $cities = Cities::model()->findAll(array('condition'=>"city_name LIKE '$term%'"));
            $result = array();
            foreach($cities as $city) {
                $label = $city['city_name']." - ".$city['region_name'];
                $cityId = $city['city_id'];
                $result[] = array('label'=>$label, 'value'=>$label,'id'=>$cityId);
            }
            echo CJSON::encode($result);
            Yii::app()->end();
        }
    }
}