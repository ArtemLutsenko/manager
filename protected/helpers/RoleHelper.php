<?php
class RoleHelper {

    public static function GetRole(){

        if (Yii::app()->user->type == "admin"){
            //set the actions which admin can access
            $actionlist = "'index','view','create','update','admin','delete'";
        }
        elseif (Yii::app()->user->type = "staff"){
            //set the actions which staff can access
            $actionlist = "'index','view','create','update'";
        }
        else {
            $actionlist = "";
        }

        return $actionlist;

    }

}