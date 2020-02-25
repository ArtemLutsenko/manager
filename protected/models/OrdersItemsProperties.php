<?php

/**
 * This is the model class for table "orders_items_properties".
 *
 * The followings are the available columns in table 'orders_items_properties':
 * @property integer $order_item_property_id
 * @property integer $order_item_id
 * @property integer $property_id
 * @property integer $add_payment
 * @property string $created_on
 * @property string $created_by
 * @property string $modified_on
 * @property string $modified_by
 */
class OrdersItemsProperties extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'orders_items_properties';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('property_id', 'required'),
			array('order_item_id, property_id, add_payment', 'numerical', 'integerOnly'=>true),
			array('created_by, modified_by', 'length', 'max'=>32),
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
			array('order_item_property_id, order_item_id, property_id, add_payment, created_on, created_by, modified_on, modified_by', 'safe', 'on'=>'search'),
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
            'property'=>array(self::BELONGS_TO, 'Properties','property_id'),
            'orderItem'=>array(self::BELONGS_TO, 'OrderItems','order_item_id'),
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
			'order_item_property_id' => 'Order Item Property',
			'order_item_id' => 'Товар',
			'property_id' => 'Колір',
			'add_payment' => 'Надбавка за колір',
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

		$criteria->compare('order_item_property_id',$this->order_item_property_id);
		$criteria->compare('order_item_id',$this->order_item_id);
		$criteria->compare('property_id',$this->property_id);
		$criteria->compare('add_payment',$this->add_payment);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('modified_on',$this->modified_on,true);
		$criteria->compare('modified_by',$this->modified_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrdersItemsProperties the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeValidate()
    {
        if(parent::beforeValidate())
        {
            /* Do some common work */
            return true;
        }
    }
}
