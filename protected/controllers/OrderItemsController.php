<?php

class OrderItemsController extends Controller
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
               // 'actions'=>array('pdf','index','create','update','view','checkBox','print','admin','analytics','delete','shipPay','ajaxupdate','printOrderItems','archive', 'joiner', 'packing', 'painter', 'upholstery', 'toggle','cashOrder','customerInvoice', 'dynamic', 'doPdf'),
              'actions'=>array('pdf','index','create','view','checkBox','print','admin','shipPay','ajaxupdate','printOrderItems','archive','joiner', 'packing', 'finish', 'coating', 'primer', 'painter', 'upholstery', 'toggle','cashOrder','dynamic', 'doPdf'),
                  'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
              //  'actions'=>array('admin','delete','shipPay','checkBox','print','printOrderItems'),
                'actions'=>array('pdf','index','create','update','view','checkBox','print','admin','analytics','delete','shipPay','ajaxupdate','printOrderItems','archive', 'joiner', 'packing', 'primer', 'painter', 'upholstery', 'toggle','cashOrder','customerInvoice', 'dynamic', 'doPdf'),
                'expression'=>'User::model()->findByPk(Yii::app()->user->id)->profile==admin',
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
        $model=new OrderItems;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['OrderItems']))
        {
            $model->attributes=$_POST['OrderItems'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->order_item_id));
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

        if(isset($_POST['OrderItems']))
        {
            $model->attributes=$_POST['OrderItems'];
            if($model->save())
                //$this->redirect(array('view','id'=>$model->order_item_id));
                echo "  <script type='text/javascript'>
                                                self.history.go(-2);

                        </script>";
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
        OrdersItemsProperties::model()->deleteAllByAttributes(array('order_item_id' => $id));
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
        $dataProvider=new CActiveDataProvider('OrderItems');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new OrderItems('search');
        $model->unsetAttributes();
        $model->archive = '0';
        if(isset($_GET['OrderItems']))
            $model->attributes=$_GET['OrderItems'];
        $this->layout='column1';
        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    public function actionDynamic() {
        $model = new OrderItems('search');

        if (!empty($_POST['columns'])) {
            // name the cookies after the model or something unique so that other gridviews don't overwrite this one
            unset(Yii::app()->request->cookies['orderItems-columns']);  // first unset cookie for columns
            //Yii::app()->request->cookies['orderItems-columns'] = new CHttpCookie('orderItems-columns', serialize($_POST['columns']));  // define cookie for columns
            $columns = $_POST['columns'];
        } elseif (empty(Yii::app()->request->cookies['orderItems-columns'])) {
            // if no columns are selected, set the default columns
            $columns = array(
                array(
                    'header'=>'№',
                    'value'=>'$row+1',
                ),

                array(
                    'name'=>'city_search',
                    //'filter' => CHtml::listData(Shops::model()->findAll(array('order' => 'full_name  ASC')), 'full_name', 'full_name'),
                    'type'=>'raw',
                    'value'=>'$data->order->city->city_name',
                ),
                array(
                    'name'=>'shop_search',

                    'filter' => CHtml::listData(Shops::model()->findAll(array('order' => 'full_name  ASC')), 'full_name', 'full_name'),
                    'type'=>'raw',
                    'value'=>'$data->order->shop->full_name',
                ),
                array(
                    'name'=>'customer_search',
                    'type'=>'raw',
                    'value'=>'Orders::model()->getCustomerName($data->order->customer_id)',
                ),

                array(
                    'name'=>'product_search',
                    'type'=>'raw',

                    'value'=>'$data->product->product_name',
                ),
                array(
                    'name'=>'type_search',
                    'type'=>'raw',
                    'filter' => CHtml::listData(ProductsTypes::model()->findAll(array('order' => 'name  ASC')), 'name', 'name'),
                    'value'=>'$data->product->productType->name',
                ),

                'width',
                'insert',
                'length',
                'height',
                'quantity',

                array(
                    'name'=>'color_search',
                    'value'=>'$data->getColorName($data->order_item_id)',
                ),
                array(
                    'name'=>'eaf_search',
                    'value'=>'$data->getEafName($data->order_item_id)',
                ),
                array(
                    'name'=>'stone_search',
                    'value'=>'$data->getStoneName($data->order_item_id)',
                ),
                array(
                    'name'=>'glass_search',
                    'value'=>'$data->getGlassName($data->order_item_id)',
                ),
                array(
                    'name'=>'patina',
                    'value' => '$data->patina==null ? " + " : " - "',
                    'filter'=>array(1=>'Так', 0=>'Ні'),
                ),
                array(
                    'name' => 'created_on',
                    'filter' => false,
                ),
            );
        } else {
            $columns = unserialize(Yii::app()->request->cookies['orderItems-columns']);
        }

        // page size for the gridview
        $pageSize = Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']);
        if (isset($_GET['pageSize'])) {
            $pageSize = $_GET['pageSize'];
            Yii::app()->user->setState('pageSize', (int) $_GET['pageSize']);
            unset($_GET['pageSize']);
        }

        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['OrderItems']))
            $model->attributes = $_GET['OrderItems'];

        $this->render('dynamic', array(
            'model' => $model,
            'columns' => $columns,
            'pageSize' => $pageSize,
        ));
    }

    public function actionAnalytics()
    {
        $model=new OrderItems('search');
        $model->unsetAttributes();
        if(isset($_GET['OrderItems']))
            $model->attributes=$_GET['OrderItems'];
        $this->layout='column1';
        $this->render('analytics',array(
            'model'=>$model,
        ));
    }

    public function actionArchive()
    {
        $model=new OrderItems('search');
        $model->unsetAttributes();
        $model->archive = '1';
        if(isset($_GET['OrderItems']))
            $model->attributes=$_GET['OrderItems'];
        $this->layout='column1';
        $this->render('archive',array(
            'model'=>$model,
        ));
    }

    public function actionCheckBox($id=null)
    {
        $model=new OrderItems('search');
        $model->unsetAttributes();
        if(isset($_GET['OrderItems']))
            $model->attributes=$_GET['OrderItems'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    public function actionCustomerInvoice()
    {
        $customerId = $_POST['customerId'];
        $autoIdAll = $_POST['autoId'];

        $customer = Customers::model()->findByPk($customerId);

        $orderItems = new OrderItems('filter');
        $orderItems->order_item_id = $autoIdAll;
        $ordersId = array();
        if(count($autoIdAll)>0)
        {
            foreach($autoIdAll as $autoId)
            {
                $model=$this->loadModel($autoId);
                $ordersId[] = $model->order_id;
                $model->archive = '1';
                if(!$model->save(false))
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
        }

        $this->render('customerInvoice',array(
            'model'=>$this->loadModel($autoIdAll),
            'orderItems'=>$orderItems,
            'customer'=>$customer,
        ));

    }

    public function actionDoPdf(){
        $html = $_POST['html'];
        $email = $_POST['email'];
        $title = $_POST['title'];
        $customText = $_POST['customText'];
        $invoiceType = $_POST['invoiceType'];

        $mPDF1 = Yii::app()->ePdf->mpdf();

        $stylesheet = file_get_contents('http://oms1.ck.ua/css/pdf.css');

        $mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->WriteHTML($html, 2);

        $content = $mPDF1->Output('', 'S');

        $content = chunk_split(base64_encode($content));

        $mailto = $email; //Mailto here
        $from_name = 'Олексенко Борис'; //Name of sender mail
        $from_mail = 'oleksenkomail@gmail.com'; //Mailfrom here
        $subject = $title;
        $filename = $title." від ".date("d-m-Y",time()).".pdf"; //Your Filename whit local date and time
        $message = '<p>Вітвємо! </p>';
        $message .= '<p>'.$invoiceType;
        if($customText){
            $message .= '<p>'.$customText;
        }
        $message .= '<p> З повагою, ПП Олексенко</p> (097) 486-71-93<br /> (093) 499-68-30<br />(04732) 6-03-19';


//Headers of PDF and e-mail
        $boundary = "XYZ-" . date("dmYis") . "-ZYX";

        $header = "--$boundary\r\n";
        $header .= "Content-Transfer-Encoding: 8bits\r\n";
        $header .= "Content-Type: text/html; charset=UTF-8\r\n\r\n"; //plain
        $header .= "$message\r\n";
        $header .= "--$boundary\r\n";
        $header .= "Content-Type: application/pdf; name=\"".$filename."\"\r\n";
        $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n";
        $header .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $header .= "$content\r\n";
        $header .= "--$boundary--\r\n";

        $header2 = "MIME-Version: 1.0\r\n";
        $header2 .= "From: ".$from_name." <oleksenkomail@gmail.com> \r\n";
        $header2 .= "Return-Path: $from_mail\r\n";
        $header2 .= "Reply-To: ".$from_name." <oleksenkomail@gmail.com>\r\n";
        $header2 .= "Content-type: multipart/mixed; boundary=\"$boundary\"\r\n";
        $header2 .= "X-Mailer: PHP/".phpversion();
        $header2 .= "$boundary\r\n";

        mail($mailto,$subject,$header,$header2, "-r".$from_mail);

        $mPDF1->Output($filename ,'I');
        exit;
    }


    public function actionPdf()
    {
        $shopId = $_POST['shopId'];
        $customerId = $_POST['customerId'];
        $autoIdAll = $_POST['autoId'];

        $bill = new Bill;
        $bill->shop_id = $shopId;
        $bill->customer_id = $customerId;
        $bill->save();

        $billItems = new BillItems;
        foreach ($autoIdAll as $autoId){
            $billItems->bill_item_id = null;
            $billItems->bill_id = $bill->bill_id;
            $billItems->order_item_id = $autoId;
            $billItems->isNewRecord = true;
            $billItems->save();
        }


        if ($shopId)
        {
            $shop = Shops::model()->findByPk($shopId);
        }
        if($customerId)
        {
            $customer = Customers::model()->findByPk($customerId);
        }

        $orderItems = new OrderItems('filter');
        $orderItems->order_item_id = $autoIdAll;
        $this->render('pdf',array(
            'model'=>$this->loadModel($autoIdAll),
            'orderItems'=>$orderItems,
            'shop'=>$shop,
            'customer'=>$customer,
            'bill'=>$bill,
        ));
    }



    public function actionPrintOrderItems(){

        $autoIdAll = $_POST['autoId'];
        $orderItems = new OrderItems('search');
        $orderItems->order_item_id = $autoIdAll;

        if(count($autoIdAll)>0)
        {
            foreach($autoIdAll as $autoId)
            {
                $model=$this->loadModel($autoId);
                if(!$model->save(false))
                    throw new Exception("Sorry",500);
            }
        }
        $this->layout='column1';
        $this->render('printOrderItems',array(
            'orderItems'=>$orderItems,
        ));

    }

    public function actionCashOrder()
    {
        $shopId = $_POST['shopId'];
        $autoIdAll = $_POST['autoId'];

        $shop = Shops::model()->findByPk($shopId);

        $orderItems = new OrderItems('filter');
        $orderItems->order_item_id = $autoIdAll;

        $this->render('cashOrder',array(
            'model'=>$this->loadModel($autoIdAll),
            'orderItems'=>$orderItems,
            'shop'=>$shop,
        ));

    }

    public function actionToggle($id, $attribute)
    {
        if(!Yii::app()->request->isPostRequest)
            throw new CHttpException(400, 'Bad request');
        if (!in_array($attribute, array('paid', 'archive', 'joiner', 'packing', 'coating', 'finish', 'painter', 'primer', 'upholstery')))
            throw new CHttpException(400, 'Некорректный запрос');

        $model = $this->loadModel($id);
        $model->$attribute = $model->$attribute ? 0 : 1;
        $model->save(false);

        if (!Yii::app()->request->isAjaxRequest)
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return OrderItems the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=OrderItems::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param OrderItems $model the model to be validated
     */


    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='order-items-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
