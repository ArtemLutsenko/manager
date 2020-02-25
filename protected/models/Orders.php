<?php

/**
 * This is the model class for table "orders".
 *
 * The followings are the available columns in table 'orders':
 * @property string $order_id
 * @property string $shop_id
 * @property string $customer_id
 * @property string $payment_name_id
 * @property string $shipment_name_id
 * @property integer $city_id
 * @property string $address
 * @property string $order_total
 * @property string $status_id
 * @property integer $order_number
 * @property string $comment
 * @property string $created_on
 * @property string $created_by
 * @property string $modified_on
 * @property string $modified_by
 * @property string $delivery_date
 * @property integer $paid
 * @property integer $archive
 */
class Orders extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'orders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */

    public $city_search;
    public $customer_search;
    public $status_id = '1';
    public $paid = '0';

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('payment_name_id, shipment_name_id', 'required'),
			array('city_id, order_number, paid', 'numerical', 'integerOnly'=>true),
			array('shop_id, customer_id, payment_name_id, shipment_name_id, order_total', 'length', 'max'=>10),
			array('status_id, created_by, modified_by', 'length', 'max'=>32),

            array('modified_on', 'default',
                'value'=>new CDbExpression('NOW()'),
                'setOnEmpty'=>false,'on'=>'update'),

            array('modified_by', 'default',
                'value'=>Yii::app()->user->id ,
                'setOnEmpty'=>false,'on'=>'update'),

           /* array('created_on, modified_on','default',
                'value'=>new CDbExpression('NOW()'),
                'setOnEmpty'=>false,'on'=>'insert'),
				*/

            array('created_by, modified_by', 'default',
                'value'=>Yii::app()->user->id ,
                'setOnEmpty'=>false,'on'=>'insert'),

            array('status_id', 'default', 'value' => '1'),
            array('paid', 'default', 'value' => '0'),
            array('archive', 'default', 'value' => '0'),


			array('comment, address', 'safe'),
            array('delivery_date', 'length', 'max'=>21),
            array('created_on', 'length', 'max'=>21),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('order_id, shop_id, customer_id, payment_name_id, shipment_name_id, city_id, order_total, status_id,  created_on, created_by, modified_on, modified_by, delivery_date, paid, city_search, customer_search, archive', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'paymentMethod'=>array(self::BELONGS_TO, 'PaymentMethods','payment_name_id'),
            'shipmentMethod'=>array(self::BELONGS_TO, 'ShipmentMethods','shipment_name_id'),
            'status'=>array(self::BELONGS_TO, 'Status','status_id'),
            'customers'=>array(self::BELONGS_TO, 'Customers', 'customer_id'),
            'city'=>array(self::BELONGS_TO, 'Cities', 'city_id'),
            'shop'=>array(self::BELONGS_TO, 'Shops', 'shop_id'),
            'creator' => array(self::BELONGS_TO, 'User', 'created_by'),
            'updater' => array(self::BELONGS_TO, 'User', 'modified_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'order_id' => '№',
			'shop_id' => 'Магазин',
			'customer_id' => 'Покупець',
			'payment_name_id' => 'Спосіб оплати',
			'shipment_name_id' => 'Спосіб доставки',
			'city_id' => 'Місто',
			'order_total' => 'Загальна сума',
			'status_id' => 'Статус',
			'address' => 'Адреса',
			'order_number' => 'Номер замовлення',
			'comment' => 'Коментар',
			'created_on' => 'Створено',
			'created_by' => 'Створив',
			'modified_on' => 'Змінено',
			'modified_by' => 'Змінив',
			'delivery_date' => 'Дата доставки',
			'paid' => 'Оплачено',
			'archive' => 'Архів',
            'payment_search' => 'Спосіб оплати',
            'shipment_search'=>'Спосіб доставки',
            'city_search'=>'Місто доставки',
            'city_or_region'=>'Місто або область',
            'customer_search'=>'Покупець'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $criteria->join='LEFT JOIN cities ON t.city_id = cities.city_id';
        $criteria->with = array( 'customers' => array('select' => array('last_name', 'first_name')));
        $criteria->together = true;

        if (!empty($this->customer_search)) {
            $criteria->addSearchCondition(
                new CDbExpression( 'CONCAT(customers.last_name, " ", customers.first_name)' ),
                $this->customer_search
            );
        }

        if (!empty($this->city_search)) {
            $criteria->addSearchCondition(
                new CDbExpression( 'CONCAT(cities.city_name, " ", cities.region_name)' ), // ne znayu chi ti hochesh shukat zrazu po dvom polyam - remove if not needed.
                $this->city_search
            );
        }

        $criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('shop_id',$this->shop_id,true);
		//$criteria->compare('payment_name_id',$this->payment_name_id,true);
		$criteria->compare('shipment_name_id',$this->shipment_name_id,true);
		$criteria->compare('order_total',$this->order_total,true);
		$criteria->compare('status_id',$this->status_id,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('modified_on',$this->modified_on,true);
		$criteria->compare('modified_by',$this->modified_by,true);
        $criteria->mergeWith($this->dateRangeSearchCriteria('delivery_date', $this->delivery_date));
        $criteria->compare('paid',$this->paid);
        $criteria->compare('archive',$this->archive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'order_id DESC',

            ),
            'pagination' => array(
                'pageSize' => 50,
            ),
		));
	}

    public function filter()
    {

        $criteria=new CDbCriteria;
        $criteria->compare('shop_id',$this->shop_id, false);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => 50,
            ),
        ));
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Orders the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

   /* public function getDataPicker(){
		$active_controller = Yii::app()->controller;
		$form = $active_controller->beginWidget('CActiveForm');
        $html .= $active_controller->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'delivery_date',
                'model' => $model,
                'attribute' => 'delivery_date',
                'language' => 'ru',
                'value' => $model->delivery_date,
                'options' => array(
                    'showAnim' => 'clip',
                    'showButtonPanel'=>true,
                    'minDate'=> 0,
                    'dateFormat'=>'dd-mm-yy',
                ),
                'htmlOptions' => array(
                    'style' => 'height:20px;'
                ),
            )
        );
		$active_controller->endWidget();
		return $html;
    }
*/
    public function getCityAndAddress($order_id){

        $order=Orders::model()->findByPK($order_id);
        $result = $order->city->city_name.", ".$order->address;
        //$fullName = CHtml::link($fullName, Yii::app()->createUrl("customers/view/",array("id"=>$customer_id)));
        return $result;

    }

    public function getCustomerName($customer_id){

        $customer=Customers::model()->findByPK($customer_id);
        $fullName = $customer->last_name." ".$customer->first_name;
        //$fullName = CHtml::link($fullName, Yii::app()->createUrl("customers/view/",array("id"=>$customer_id)));
        return $fullName;

    }

    public function getCustomerLink($customer_id){

        $customer=Customers::model()->findByPK($customer_id);
        $fullName = $customer->last_name." ".$customer->first_name;
        $fullName = CHtml::link($fullName, Yii::app()->createUrl("customers/view/",array("id"=>$customer_id)));
        return $fullName;

    }

    public function getCustomerArchiveLink($customer_id){

        $customer=Customers::model()->findByPK($customer_id);
        $fullName = $customer->last_name." ".$customer->first_name;
        $fullName = CHtml::link($fullName, Yii::app()->createUrl("customers/archiveView/",array("id"=>$customer_id)));
        return $fullName;

    }

    public function getCustomerPhone($customer_id){

        $customer=Orders::model()->findByPK($customer_id);

        if($customer->shop_id !== NULL){
            $result = $customer->shop->phone;
        }elseif($customer->customer_id !== NULL){
            $result = $customer->customers->phone;
        }else{
            $result = "invalid customer phone";
        }
        return $result;
    }


    protected function beforeSave()
    {
        if(parent::beforeSave()) {
            $this->delivery_date =   date('Y-m-d', strtotime($this->delivery_date));
            $this->created_on =   date('Y-m-d', strtotime($this->created_on));
            return parent::beforeSave();
        } else {
            return false;
        }
    }

    public function behaviors()
    {
        return array(
            'dateRangeSearch'=>array(
                'class'=>'application.components.behaviors.EDateRangeSearchBehavior',
            ),
        );
    }
}
