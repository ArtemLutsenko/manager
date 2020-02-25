<?php

/**
 * This is the model class for table "shops".
 *
 * The followings are the available columns in table 'shops':
 * @property integer $shop_id
 * @property integer $city_id
 * @property integer $price_group_id
 * @property string $full_name
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $debt
 * @property string $comment
 * @property string $created_on
 * @property string $created_by
 * @property string $modified_on
 * @property string $modified_by
 */
class Shops extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shops';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('city_id, price_group_id, full_name', 'required'),
			array('city_id, price_group_id', 'numerical', 'integerOnly'=>true),
			array('full_name, name, address, phone, email, debt', 'length', 'max'=>255),
			array('created_by, modified_by', 'length', 'max'=>40),
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
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('shop_id, city_id, price_group_id, full_name, name, address, phone, email, debt, comment, created_on, created_by, modified_on, modified_by', 'safe', 'on'=>'search'),
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
            'priceGroup'=>array(self::BELONGS_TO, 'PriceGroups', 'price_group_id'),
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
			'shop_id' => 'Shop',
			'city_id' => 'Місто',
			'price_group_id' => 'Цінова категорія',
			'full_name' => 'ПП П.І.Б.',
			'name' => 'Магазин',
			'address' => 'Адреса',
			'phone' => 'Телефон',
			'email' => 'Почта',
			'debt' => 'Борг',
			'comment' => 'Коментар',
            'created_on' => 'Створено',
            'created_by' => 'Створив',
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

		$criteria->compare('shop_id',$this->shop_id,true);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('price_group_id',$this->price_group_id);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('debt',$this->debt,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('modified_on',$this->modified_on,true);
		$criteria->compare('modified_by',$this->modified_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => 50,
            ),
		));
	}

    public function getCityAndAddress($shop_id){

        $shop=Shops::model()->findByPK($shop_id);
        $result = $shop->city->city_name.", ".$shop->address;
        //$fullName = CHtml::link($fullName, Yii::app()->createUrl("customers/view/",array("id"=>$customer_id)));
        return $result;

    }



    public function getShopList()
    {
        return CHtml::listData($this->findAll(new CDbCriteria(array('order'=>'full_name ASC'))),'shop_id','full_name', 'name');
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Shops the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
