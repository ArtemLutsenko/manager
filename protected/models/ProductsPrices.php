<?php

/**
 * This is the model class for table "products_prices".
 *
 * The followings are the available columns in table 'products_prices':
 * @property integer $product_price_id
 * @property integer $price_group_id
 * @property integer $product_id
 * @property integer $product_price
 */
class ProductsPrices extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'products_prices';
	}
    public $product_search;
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('price_group_id, product_id, product_price', 'required'),
			array('price_group_id, product_id, product_price', 'numerical', 'integerOnly'=>true),
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
			array('product_price_id, price_group_id, product_id, product_price,  created_on, created_by, modified_on, modified_by,product_search', 'safe', 'on'=>'search'),
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

            'product'=>array(self::BELONGS_TO, 'Products', 'product_id'),
            'priceGroup'=>array(self::BELONGS_TO, 'PriceGroups', 'price_group_id'),
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
			'product_price_id' => 'ID',
			'price_group_id' => 'Цінова категорія',
			'product_id' => 'Товар',
			'product_search' => 'Товар',
			'product_price' => 'Ціна',
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

        $criteria->with = array(
            'product'=> array('select' => array('product_name'))
        );

        $criteria->together = true;

        if (!empty($this->product_search))  {$criteria->addSearchCondition('product.product_name', $this->product_search);}

        //$criteria->with=array('product');
		$criteria->compare('product_price_id',$this->product_price_id);
		$criteria->compare('price_group_id',$this->price_group_id);
		//$criteria->compare('product_id',$this->product_id);
		$criteria->compare('product_price',$this->product_price);
        $criteria->compare('created_on',$this->created_on,true);
        $criteria->compare('created_by',$this->created_by,true);
        $criteria->compare('modified_on',$this->modified_on,true);
        $criteria->compare('modified_by',$this->modified_by,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => 100,
            ),
		));
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductsPrices the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
