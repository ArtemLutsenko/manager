<?php

class OrdersController extends Controller
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
			'postOnly + delete, toggle', // we only allow deletion via POST request
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
				'actions'=>array('admin','statusUpdateAjax','toggle','switch','qtoggle', 'numToStr','print', 'morph','view', 'archive'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create', 'createShop','update','admin','delete','statusUpdateAjax','toggle','switch','qtoggle', 'numToStr','print', 'morph','view', 'archive'),
				 'expression'=>'User::model()->findByPk(Yii::app()->user->id)->profile==admin',
          
			),
			array('deny',  // deny all users
				// 'users'=>array('*'),
			),

		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */

    public function actionCreateShop() {

        $this->widget('ext.jqrelcopy.JQRelcopy',
        array(
            'id' => 'copylink',
            'removeText' => '[-] Видалити товар', //uncomment to add remove link
        ));

        $form = new MyCForm('application.views.orders.createShopForm');

        $form['Shops']->model = new Shops;
        $form['Orders']->model = new Orders;
        $form['OrderItems']->model = new OrderItems;
        $form['OrdersItemsProperties']->model = new OrdersItemsProperties;
        /* echo "<pre>";
            print_r($_POST[Shops]);
        echo "</pre>";*/
        $arrItems = $_POST[OrderItems];
        $arrProperties = $_POST[OrdersItemsProperties];

        if ($form->submitted('create') )
        {
            $shops = $form['Shops']->model;
            $orders = $form['Orders']->model;
            $orderItems = $form['OrderItems']->model;
            $orderItemsProperties = $form['OrdersItemsProperties']->model;

                $orders->shop_id = $shops->full_name;

                if($orders->save())
                {
                    $orderId = $orders->order_id;
                    $k = 0;
                    if ($arrItems)
                    {
                        foreach ($arrItems as $items)
                        {
                            $orderItems->order_item_id = null;
                            $orderItems->order_id = $orderId;
                            $orderItems->product_id = $arrItems["product_id"]["$k"];
                            $orderItems->width = $arrItems["width"]["$k"];
                            $orderItems->insert = $arrItems["insert"]["$k"];
                            $orderItems->length = $arrItems["length"]["$k"];
                            $orderItems->height = $arrItems["height"]["$k"];
                            $orderItems->quantity = $arrItems["quantity"]["$k"];
                            $orderItems->comment = $arrItems["comment"]["$k"];
                            $orderItems->tinting = $arrItems["tinting"]["$k"];
                            $orderItems->patina = $arrItems["patina"]["$k"];
                            $orderItems->price = $arrItems["price"]["$k"];
                            $orderItems->subtotal = $arrItems["subtotal"]["$k"];
                            $orderItems->isNewRecord = true;
                            $orderItems->save();
                                $i = 0;
                                foreach($arrProperties as $properties)
                                {
                                    $orderItemsProperties->order_item_property_id = null;
                                    $orderItemsProperties->order_item_id = $orderItems->order_item_id;
                                    $orderItemsProperties->property_id = $arrProperties["property_id"]["$k"]["$i"];
                                    $orderItemsProperties->add_payment = $arrProperties["add_payment"]["$k"]["$i"];
                                    $orderItemsProperties->isNewRecord = true;
                                    $orderItemsProperties->save();
                                    $i++;
                                }
                            $k++;
                        }

                    Yii::app()->user->setFlash('success', "Data saved!");
                    $this->redirect(array('orders/admin'));
                    }else{
                        echo "not array";
                    }
                }else{
                }

        }

    $this->render('create', array('form' => $form));
    }

    public function actionCreate() {

        $this->widget('ext.jqrelcopy.JQRelcopy',
            array(
                'id' => 'copylink',
                'removeText' => '[-] Видалити товар', //uncomment to add remove link
            ));

        $form = new MyCForm('application.views.orders.createForm');

        $form['Customers']->model = new Customers;
        $form['Orders']->model = new Orders;
        $form['OrderItems']->model = new OrderItems;
        $form['OrdersItemsProperties']->model = new OrdersItemsProperties;
         /*echo "<pre>";
            print_r($_POST[OrderItems]);
        echo "</pre>";*/
        $arrItems = $_POST[OrderItems];
        $arrProperties = $_POST[OrdersItemsProperties];

        if ($form->submitted('create') )
        {
            $customers = $form['Customers']->model;
            $orders = $form['Orders']->model;
            $orderItems = $form['OrderItems']->model;
            $orderItemsProperties = $form['OrdersItemsProperties']->model;

            if ($customers->save())
            {
                $orders->customer_id = $customers->customer_id;

                if($orders->save())
                {
                    $orderId = $orders->order_id;
                    $k = 0;
                    if ($arrItems)
                    {
                        foreach ($arrItems as $items)
                        {
                            $orderItems->order_item_id = null;
                            $orderItems->order_id = $orderId;
                            $orderItems->product_id = $arrItems["product_id"]["$k"];
                            $orderItems->width = $arrItems["width"]["$k"];
                            $orderItems->insert = $arrItems["insert"]["$k"];
                            $orderItems->length = $arrItems["length"]["$k"];
                            $orderItems->height = $arrItems["height"]["$k"];
                            $orderItems->quantity = $arrItems["quantity"]["$k"];
                            $orderItems->comment = $arrItems["comment"]["$k"];
                            $orderItems->tinting = $arrItems["tinting"]["$k"];
                            $orderItems->patina = $arrItems["patina"]["$k"];
                            $orderItems->price = $arrItems["price"]["$k"];
                            $orderItems->subtotal = $arrItems["subtotal"]["$k"];
                            $orderItems->isNewRecord = true;
                            $orderItems->save();
                            $i = 0;
                            foreach($arrProperties as $properties)
                            {
                                $orderItemsProperties->order_item_property_id = null;
                                $orderItemsProperties->order_item_id = $orderItems->order_item_id;
                                $orderItemsProperties->property_id = $arrProperties["property_id"]["$k"]["$i"];
                                $orderItemsProperties->add_payment = $arrProperties["add_payment"]["$k"]["$i"];
                                $orderItemsProperties->isNewRecord = true;
                                $orderItemsProperties->save();
                                $i++;
                            }
                            $k++;
                        }

                        Yii::app()->user->setFlash('success', "Data saved!");
                        $this->redirect(array('orders/admin'));
                    }else{
                        echo "not array";
                    }
                }else{
                }
            }
        }

        $this->render('create', array('form' => $form));
    }
    /**
     *
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Orders']))
		{
			$model->attributes=$_POST['Orders'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->order_id));
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

        $items = OrderItems::model()->findAll(array("condition"=>"order_id =  $id"));

            foreach($items as $item)
            {
                $itemId = $item->order_item_id;
                OrdersItemsProperties::model()->deleteAllByAttributes(array('order_item_id' => $itemId));
            }

        OrderItems::model()->deleteAllByAttributes(array('order_id' => $id));

        $this->loadModel($id)->delete();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */

    public function actionView($id=null)
    {
        if($id!== null)
        {

            $model2 = new OrderItems('search');
            $model2->unsetAttributes();
            $model2->order_id = $id;
            if (isset($_GET['OrderItems']))
            {
                $model2->order_item_id = $_GET['OrderItems'];
            }
        }

        $this->render('view',array(
            'model'=>$this->loadModel($id),
            'model2'=>$model2,
        ));
    }

    public function actionPrint($id=null)
    {
        if($id!== null)
        {
            $orderItems = new OrderItems('search');
            $orderItems->unsetAttributes();
            $orderItems->order_id = $id;
            $items = OrderItems::model()->findAll(array("condition"=>"order_id =  $id"));

                foreach($items as $item)
                {
                    $id = $item->order_item_id;
                    $model=OrderItems::model()->findByPk($id);
                    if(!$model->save(false))
                        throw new Exception("Sorry",500);
                }

        }
        $this->render('print',array(
            'model'=>$this->loadModel($id),
            'orderItems'=>$orderItems,
        ));
    }

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Orders');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

    public function actionMy()
    {
        $dataProvider=new CActiveDataProvider('Orders');
        $this->render('my',array(
            'dataProvider'=>$dataProvider,
        ));
    }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Orders('search');
		$model->unsetAttributes();  // clear any default values
        $model->archive = '0';
		if(isset($_GET['Orders']))
			$model->attributes=$_GET['Orders'];

        if (Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('admin', array(
                'model'=>$model,
            ));
        } else {
            $this->layout='column1';
		    $this->render('admin',array(
			'model'=>$model,
		));
	    }
    }


    public function actionArchive()
    {
        $model=new Orders('search');
        $model->unsetAttributes();  // clear any default values
        $model->archive = '1';
        if(isset($_GET['Orders']))
            $model->attributes=$_GET['Orders'];

        if (Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('archive', array(
                'model'=>$model,
            ));
        } else {
            $this->render('archive',array(
                'model'=>$model,
            ));
        }
    }

    public function actionToggle($id, $attribute)
    {
        if(!Yii::app()->request->isPostRequest)
            throw new CHttpException(400, 'Bad request');
        if (!in_array($attribute, array('paid', 'archive')))
            throw new CHttpException(400, 'Некорректный запрос');

        $model = $this->loadModel($id);
        $model->$attribute = $model->$attribute ? 0 : 1;
        $model->save();

        if (!Yii::app()->request->isAjaxRequest)
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('archive'));
    }


    public function actionNumToStr() {
        $num = Yii::app()->request->getPost('num');
        $nul='нуль';
        $ten=array(
            array('', 'один', 'дві', 'три', 'чотири', 'п\'ять', 'шість', 'сім', 'вісім', 'дев\'ять'),
            array('', 'одна', 'дві', 'три', 'чотири', 'п\'ять', 'шість', 'сім', 'вісім', 'дев\'ять'),
        );
        $a20=array('десять', 'одинадцять', 'дванадцять', 'тринадцять', 'чотирнадцять', 'п\'ятнадцять', 'шістнадцять', 'сімнадцять', 'вісімнадцять', 'дев\'ятнадцять');
        $tens=array(2=>'двадцять', 'тридцять', 'сорок', 'п\'ятдесят', 'шістдесят', 'сімдесят', 'вісімдесят', 'дев\'яносто');
        $hundred=array('', 'сто', 'двісті', 'триста', 'чотириста', 'п\'ятсот', 'шістсот', 'сімсот', 'вісімсот', 'дев\'ятсот');
        $unit=array( // Units
            array('коп.' ,'коп.' ,'коп.',	         1),
            array('грн.'   ,'грн.'   ,'грн.'        ,0),
            array('тисяча', 'тисячі', 'тисяч'       ,1),
            array('миллион' ,'миллиона','миллионов' ,0),
            array('миллиард','милиарда','миллиардов',0),
        );
        //
        list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
        $out = array();
        if (intval($rub)>0) {
            foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
                if (!intval($v)) continue;
                $uk = sizeof($unit)-$uk-1; // unit key
                $gender = $unit[$uk][3];
                list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
                // mega-logic
                $out[] = $hundred[$i1]; # 1xx-9xx
                if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
                else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
                // units without rub & kop
                if ($uk>1) $out[]= $this->actionMorph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
            } //foreach
        }
        else $out[] = $nul;
        $out[] = $this->actionMorph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
        $out[] = $kop.' '.$this->actionMorph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
        //return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
        echo trim(ucfirst(preg_replace('/ {2,}/', ' ', join(' ',$out))));
    }

    /**
     * Склоняем словоформу
     * @ author runcore
     */
    public function actionMorph($n, $f1, $f2, $f5) {
        $n = abs(intval($n)) % 100;
        if ($n>10 && $n<20) return $f5;
        $n = $n % 10;
        if ($n>1 && $n<5) return $f2;
        if ($n==1) return $f1;
        return $f5;
    }


    /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Orders the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Orders::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Orders $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='orders-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    protected function beforeSave() {


        if ($this->isNewRecord){

            echo "new record";
        }
        //do something
        else{
            echo "not new record";    //do something else
            /* some more code*/
            parent::beforeSave();
        return true;
        }
    }




}
