<?php

/**
 * This is the model class for table "bill".
 *
 * The followings are the available columns in table 'bill':
 * @property string $bill_id
 * @property integer $account_id
 * @property integer $shop_id
 * @property integer $customer_id
 * @property string $created_on
 * @property string $created_by
 * @property string $modified_on
 * @property string $modified_by
 */
class Bill extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bill';
	}
    public $customer_search;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('account_id', 'required'),
			array('account_id, shop_id, customer_id', 'numerical', 'integerOnly'=>true),
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
			array('bill_id, account_id, shop_id, customer_id, created_on, created_by, modified_on, modified_by,customer_search', 'safe', 'on'=>'search'),
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
            'account'=>array(self::BELONGS_TO, 'Accounts', 'account_id'),
            'customers'=>array(self::BELONGS_TO, 'Customers', 'customer_id'),
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
			'bill_id' => 'Bill',
			'account_id' => '№ п/п',
			'shop_id' => 'Магазин',
			'customer_id' => 'Покупець',
			'created_on' => 'Додано',
			'created_by' => 'Додав',
			'modified_on' => 'Змінено',
			'modified_by' => 'Змінив',
            'customer_search'=>'Покупець',
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
        $criteria->with = array(
            'customers' => array('select' => array('last_name', 'first_name')),
        );

        $criteria->together = true;
        if (!empty($this->customer_search)) {$criteria->addSearchCondition(new CDbExpression( 'CONCAT(customers.last_name, " ", customers.first_name)' ), $this->customer_search);}

        $criteria->compare('bill_id',$this->bill_id,true);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('shop_id',$this->shop_id);
		//$criteria->compare('customer_id',$this->customer_id);
		//$criteria->compare('created_on',$this->created_on);
		//$criteria->compare('created_by',$this->created_by,true);
		///$criteria->compare('modified_on',$this->modified_on,true);
		//$criteria->compare('modified_by',$this->modified_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'bill_id DESC',
            ),
            'pagination' => array(
                'pageSize' => 50,
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Bill the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
