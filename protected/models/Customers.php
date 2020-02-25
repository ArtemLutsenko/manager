<?php

/**
 * This is the model class for table "customers".
 *
 * The followings are the available columns in table 'customers':
 * @property string $customer_id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $email
 * @property integer $city_id
 * @property integer $price_group_id
 * @property string $created_on
 * @property string $created_by
 * @property string $modified_on
 * @property string $modified_by
 */
class Customers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name, last_name, phone', 'required'),
			array('city_id, price_group_id', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name, phone, created_by, modified_by', 'length', 'max'=>40),
			array('email', 'length', 'max'=>50),

            array('modified_on', 'default',
                'value'=>new CDbExpression('NOW()'),
                'setOnEmpty'=>false,'on'=>'update'),

            array('modified_by', 'default',
                'value'=>Yii::app()->user->id ,
                'setOnEmpty'=>false,'on'=>'update'),

            array('created_on, modified_on','default',
                'value'=>new CDbExpression('NOW()'),
                'setOnEmpty'=>false,'on'=>'insert'),

            array('created_by, modified_by', 'default',
                'value'=>Yii::app()->user->id ,
                'setOnEmpty'=>false,'on'=>'insert'),

            array('price_group_id', 'default',
                'value'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('customer_id, first_name, last_name, phone, email, city_id, price_group_id, created_on, created_by, modified_on, modified_by', 'safe', 'on'=>'search'),
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
            'order'=>array(self::BELONGS_TO, 'Orders', 'customer_id'),
            'priceGroup'=>array(self::HAS_ONE, 'PriceGroups', 'price_group_id'),
            'city'=>array(self::BELONGS_TO, 'Cities', 'city_id'),
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
			'customer_id' => 'Customer',
			'first_name' => 'Ім\'я',
			'last_name' => 'Прізвище',
			'phone' => 'Телефон',
			'email' => 'Email',
			'city_id' => 'Місто',
			'price_group_id' => 'Цінова категорія',
			'created_on' => 'Додано',
			'created_by' => 'Додав',
			'modified_on' => 'Змінено',
			'modified_by' => 'Змінив',
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

		$criteria->compare('customer_id',$this->customer_id,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('price_group_id',$this->price_group_id);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('modified_on',$this->modified_on,true);
		$criteria->compare('modified_by',$this->modified_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'customer_id DESC',

            ),
            'pagination' => array(
                'pageSize' => 40,
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Customers the static model class
	 */

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

    public function getCustomerCityAndAddress($customer_id){

        $order=Orders::model()->find( array("condition"=>"customer_id = $customer_id"));
        $result = $order->city->city_name.", ".$order->address;
        //$fullName = CHtml::link($fullName, Yii::app()->createUrl("customers/view/",array("id"=>$customer_id)));
        return $result;

    }

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
