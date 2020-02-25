<?php

class BillController extends Controller
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
				'actions'=>array('index','view','create','update','invoice','admin','delete'),
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
        $billItems = new BillItems('search');

        $findItems = BillItems::model()->findAll( array("condition"=>"bill_id = $id"));

        $itemsId = array();

        foreach($findItems as $item)
        {
            $itemsId[] = $item->order_item_id;
        }

        $billItems->order_item_id = $itemsId;
        $orderItems = new OrderItems('filter');
        $orderItems->order_item_id = $itemsId;

        $this->render('view',array(
			'model'=>$this->loadModel($id),
            'orderItems'=>$orderItems,
		));
	}

    public function actionInvoice()
    {
        $id = $_POST['id'];
        $billItems = new BillItems('search');
        $findItems = BillItems::model()->findAll( array("condition"=>"bill_id = $id"));
        $invoice = new InvoiceItems();

        $itemsId = array();

        $invoiceItems = InvoiceItems::model()->findByAttributes(array("bill_id" => $id));
        $save = 0;
        if (empty($invoiceItems->bill_id))
        {
            $save = 1;
        };
        foreach($findItems as $item)
        {
            $invoice->invoice_item_id = null;
            $invoice->bill_id = $item->bill_id;
            $invoice->order_item_id = $item->order_item_id;
            $itemsId[] = $item->order_item_id;
            $invoice->isNewRecord = true;
            if ($save == 1)
            {
                $invoice->save();
            }

        }

        $billItems->order_item_id = $itemsId;
        $orderItems = new OrderItems('filter');
        $orderItems->order_item_id = $itemsId;

        $this->render('invoice',array(
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
		$model=new Bill;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Bill']))
		{
			$model->attributes=$_POST['Bill'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->bill_id));
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

		if(isset($_POST['Bill']))
		{
			$model->attributes=$_POST['Bill'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->bill_id));
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
		$dataProvider=new CActiveDataProvider('Bill');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Bill('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Bill']))
			$model->attributes=$_GET['Bill'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Bill the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Bill::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Bill $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='bill-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
