<?php

class InvoiceController extends Controller
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
				'actions'=>array('index','view','create','update','admin','delete','createInvoice','createInvoiceFromBill', 'addToArchive'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Invoice;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Invoice']))
		{
			$model->attributes=$_POST['Invoice'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->invoice_id));
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

		if(isset($_POST['Invoice']))
		{
			$model->attributes=$_POST['Invoice'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->invoice_id));
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
        InvoiceItems::model()->deleteAllByAttributes(array('invoice_id' => $id));
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
		$dataProvider=new CActiveDataProvider('Invoice');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Invoice('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Invoice']))
			$model->attributes=$_GET['Invoice'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

    public function actionCreateInvoice(){

        $shopId = $_POST['shopId'];
        $customerId = $_POST['customerId'];
        $autoIdAll = $_POST['autoId'];

        $account = new Accounts;
        $account->account_id = null;
        $account->isNewRecord = true;
        $account->save();

        $invoice = new Invoice;
        $invoice->account_id = $account->account_id;
        $invoice->shop_id = $shopId;
        $invoice->customer_id = $customerId;
        $invoice->save();

        $invoiceItems = new InvoiceItems;
        foreach ($autoIdAll as $autoId){
            $invoiceItems->invoice_item_id = null;
            $invoiceItems->invoice_id = $invoice->invoice_id;
            $invoiceItems->order_item_id = $autoId;
            $invoiceItems->isNewRecord = true;
            $invoiceItems->save();
        }

        if ($shopId)
        {
            $shop = Shops::model()->findByPk($shopId);
        }

        if($customerId)
        {
            $customer = Customers::model()->findByPk($customerId);
        }


        $this->redirect(array('view','id'=>$invoice->invoice_id));
        $this->render('view',array(
            'model'=>$this->loadModel($invoice->invoice_id),
        ));

    }

    public function actionAddToArchive(){

        $items = $_POST['items'];

        $ordersId = array();

        foreach($items as $item)
        {
            $orderItem = OrderItems::model()->findByPk($item);
            $ordersId[] = $orderItem->order_id;
            $orderItem->archive = '1';
            if(!$orderItem->save(false))
                throw new Exception("Sorry",500);
        }

        $ordersId  = array_unique($ordersId);

        foreach ($ordersId as $orderId){

            $order = Orders::model()->findByPk($orderId);
            $items = OrderItems::model()->findAll( array("condition"=>"order_id = $orderId"));
            $archive = array();

            foreach ($items as $item)
            {
                $archive[] = $item->archive;
            }

            if (!(in_array("0", $archive)))
            {
                $order->archive = 1;
                if(!$order->save(false))
                    throw new Exception("Sorry",500);
            }
        }
    }

    public function actionCreateInvoiceFromBill()
    {
        $id = $_POST['id'];
        $invoice        = new Invoice;
        $invoiceItem    = new InvoiceItems;
        $billItems      = new BillItems('search');
        $bill           = new Bill;

        $bill = Bill::model()->findByPk($id);

        $currAccId = $bill->account_id;
        $checkInvoice = Invoice::model()->findByAttributes(array("account_id" => $currAccId));

        if ($checkInvoice->account_id > 0)
        {
            $findBillItems = BillItems::model()->findAll( array("condition"=>"bill_id = $id"));
            $modelId = $checkInvoice->primaryKey;
            $itemsId = array();
            foreach($findBillItems as $item)
            {
                $itemsId[] = $item->order_item_id;
            }
            //$this->redirect(array('view','id'=>$invoice->invoice_id));
        }else
        {
            $invoice->invoice_id = null;
            $invoice->account_id = $bill->account_id;
            $invoice->shop_id = $bill->shop_id;
            $invoice->customer_id = $bill->customer_id;
            $invoice->isNewRecord = true;
            $invoice->save();
            $modelId = $invoice->invoice_id;
            $findBillItems = BillItems::model()->findAll( array("condition"=>"bill_id = $id"));

            $itemsId = array();

            foreach($findBillItems as $item)
            {
                $invoiceItem->invoice_item_id = null;
                $invoiceItem->invoice_id = $modelId;
                $invoiceItem->order_item_id = $item->order_item_id;
                $itemsId[] = $item->order_item_id;
                $invoiceItem->isNewRecord = true;
                $invoiceItem->save();
            }
        }

        $orderItems = new OrderItems('filter');
        $orderItems->order_item_id = $itemsId;
        /*
                $ordersId = array();
                if(count($itemsId)>0)
                {
                    foreach($itemsId as $autoId)
                    {
                        $orderItem=OrderItems::model()->findByPk($autoId);
                        $orderItem->status_id = '6';               //статус "відправлено"
                        $ordersId[] = $orderItem->order_id;
                        $orderItem->archive = '1';
                        if(!$orderItem->save(false))
                            throw new Exception("Sorry",500);
                    }
                }

                $ordersId  = array_unique($ordersId);

                foreach ($ordersId as $orderId){

                    $order = Orders::model()->findByPk($orderId);
                    $items = OrderItems::model()->findAll( array("condition"=>"order_id = $orderId"));
                    $archive = array();

                    foreach ($items as $item)
                    {
                        $archive[] = $item->archive;
                    }

                    if (!(in_array("0", $archive)))
                    {
                        $order->archive = 1;
                        if(!$order->save(false))
                            throw new Exception("Sorry",500);
                    }
                }*/
        $this->redirect(array('view','id'=>$invoice->invoice_id));
        $this->render('view',array(
            'model'=>$this->loadModel($modelId),
            'orderItems'=>$orderItems,
        ));
    }

    public function actionView($id)
    {
        $invoiceItems = new InvoiceItems('search');

        $findItems = InvoiceItems::model()->findAll( array("condition"=>"invoice_id = $id"));

        $itemsId = array();

        foreach($findItems as $item)
        {
            $itemsId[] = $item->order_item_id;
        }

        $invoiceItems->order_item_id = $itemsId;
        $orderItems = new OrderItems('filter');
        $orderItems->order_item_id = $itemsId;

        $this->render('view',array(
            'model'=>$this->loadModel($id),
            'orderItems'=>$orderItems,
        ));
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Invoice the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Invoice::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Invoice $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='invoice-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
