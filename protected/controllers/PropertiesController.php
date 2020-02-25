<?php

class PropertiesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(

			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','index','view','autocomplete', 'propertySuggest','orderItemPropertyUpdate','admin','delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Properties;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Properties']))
		{
			$model->attributes=$_POST['Properties'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->property_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Properties']))
		{
			$model->attributes=$_POST['Properties'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->property_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Properties');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Properties('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Properties']))
			$model->attributes=$_GET['Properties'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Properties the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Properties::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Properties $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='properties-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    public function actionAutocomplete()
    {
        $term = Yii::app()->getRequest()->getParam('term');
        $att = Yii::app()->getRequest()->getParam('att');
        $pg = Yii::app()->getRequest()->getParam('pg');

        if(Yii::app()->request->isAjaxRequest && $term && $att) {
            $criteria = new CDbCriteria();
            $criteria->addCondition("name LIKE '%$term%'");
            $criteria->addCondition("attribute_id = $att");
            $properties = Properties::model()->findAll($criteria);
            $result = array();
            foreach($properties as $property) {
                $label = $property['name'];
                $property_id = $property['property_id'];

                $productAdd = ProductsProperties::model()->find('
                    price_group_id=:price_group_id AND
                    property_id=:property_id
                    ',
                    array(
                        ':price_group_id'=>$pg,
                        ':property_id'=>$property_id,
                    ));

                $result[] = array(
                    'label'=>$label,
                    'id'=>$property_id,
                    'add'=>$productAdd->add_payment,
                );
            }
            echo CJSON::encode($result);
            Yii::app()->end();
        }
    }

    public function actionPropertySuggest()
    {
        $term = Yii::app()->getRequest()->getParam('term');
        $att = Yii::app()->getRequest()->getParam('att');

        if(Yii::app()->request->isAjaxRequest && $term) {
            $criteria = new CDbCriteria();
            $criteria->addCondition("name LIKE '%$term%'");
            //$criteria->addCondition("attribute_id = $att");
            $properties = Properties::model()->findAll($criteria);
            $result = array();
            foreach($properties as $property) {
                $label = $property['name'];
                $property_id = $property['property_id'];
                $result[] = array(
                    'label'=>$label,
                    'id'=>$property_id,
                );
            }
            echo CJSON::encode($result);
            Yii::app()->end();
        }
    }

    public function actionOrderItemPropertyUpdate()
    {
        $term = Yii::app()->getRequest()->getParam('term');
        $att = Yii::app()->getRequest()->getParam('att');

        if(Yii::app()->request->isAjaxRequest && $term) {
            $criteria = new CDbCriteria();
            $criteria->addCondition("name LIKE '%$term%'");
            $criteria->addCondition("attribute_id = $att");
            $properties = Properties::model()->findAll($criteria);
            $result = array();
            foreach($properties as $property) {
                $label = $property['name'];
                $property_id = $property['property_id'];
                $result[] = array(
                    'label'=>$label,
                    'id'=>$property_id,
                );
            }
            echo CJSON::encode($result);
            Yii::app()->end();
        }
    }
}
