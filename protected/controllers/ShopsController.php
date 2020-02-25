<?php

class ShopsController extends Controller
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
				'actions'=>array('index','view','archiveView','create','update','admin','delete','loadCity'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','loadCity'),
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

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
    */


    public function actionView($id=null)
    {
        if($id!== null)
        {

            $orders = Orders::model()->findAllByAttributes(array('shop_id'=>$id));

            foreach ($orders as $order){
                $orderId[] = $order->order_id;

            }

            if (!empty($orderId)){
                $orderItems = new OrderItems('filter');
                $orderItems->unsetAttributes();  // clear any default values
                $orderItems->archive = '0';

                $orderItems->order_id = $orderId;
            }
        }
        $this->render('view',array(
            'model'=>$this->loadModel($id),
            'orderItems'=>$orderItems,
        ));
    }

    public function actionArchiveView($id=null)
    {
        if($id!== null)
        {

            $orders = Orders::model()->findAllByAttributes(array('shop_id'=>$id));

            foreach ($orders as $order){
                $orderId[] = $order->order_id;

            }

            if (!empty($orderId)){
                $orderItems = new OrderItems('filter');
                $orderItems->unsetAttributes();  // clear any default values
                $orderItems->archive = '1';

                $orderItems->order_id = $orderId;
            }
        }
        $this->render('archiveView',array(
            'model'=>$this->loadModel($id),
            'orderItems'=>$orderItems,
        ));
    }


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Shops;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Shops']))
		{
			$model->attributes=$_POST['Shops'];
			if($model->save())
				$this->redirect(array('create','id'=>$model->shop_id));
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

		if(isset($_POST['Shops']))
		{
			$model->attributes=$_POST['Shops'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->shop_id));
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
		$dataProvider=new CActiveDataProvider('Shops');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Shops('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Shops']))
			$model->attributes=$_GET['Shops'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


    public function actionLoadCity(){
        $shopId = Yii::app()->getRequest()->getParam('shop_id');
        if(Yii::app()->request->isAjaxRequest && $shopId) {
            $criteria = new CDbCriteria();
            $criteria->addCondition("shop_id = $shopId");
            $shops = Shops::model()->findAll($criteria);
            $result = array();
            foreach($shops as $shop) {
                $id = $shop['city_id'];
                $pg = $shop['price_group_id'];
                $address = $shop['address'];
                $result = array(
                    'id'=>$id,
                    'pg'=>$pg,
                    'ad'=>$address,
                );
            }
            //echo $id;
            echo CJSON::encode($result);

            Yii::app()->end();
        }
    }


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Shops the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Shops::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Shops $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='shops-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
