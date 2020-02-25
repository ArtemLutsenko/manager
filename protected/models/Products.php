<?php

/**
 * This is the model class for table "products".
 *
 * The followings are the available columns in table 'products':
 * @property string $product_id
 * @property string $product_name
 * @property string $product_length
 * @property string $product_width
 * @property string $product_height
 * @property string $patina
 * @property string $tabletop_id
 * @property string $product_type_id
 */
class Products extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'products';
	}

    public $type_search;

    /**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_name, product_length, product_width, product_height, patina, product_type_id', 'required'),
			array('product_name', 'length', 'max'=>100),
			array('product_length, product_insert, product_width, product_height, tabletop_id, product_type_id', 'length', 'max'=>10),
			array('patina', 'length', 'max'=>1),
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
			array('product_id, product_name, product_length, product_insert, product_width, product_height, patina, tabletop_id, product_type_id, type_search,  created_on, created_by, modified_on, modified_by', 'safe', 'on'=>'search'),
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
          // 'productPrice'=>array(self::BELONGS_TO, 'ProductsPrices', 'product_id'),
        //   'priceGroup'=>array(self::MANY_MANY, 'PriceGroups',
        //        'products_prices(product_id, price_group_id)'),
            'properties'=>array(self::HAS_MANY, 'ProductsProperties', 'product_id'),
            'tabletop'=>array(self::BELONGS_TO, 'Tabletop', 'tabletop_id'),
            'productType'=>array(self::BELONGS_TO, 'ProductsTypes', 'product_type_id'),
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
			'product_id' => '№',
			'product_name' => 'Товар',
			'product_length' => 'Довжина, мм',
			'product_insert' => 'Вставка, мм',
			'product_width' => 'Ширина, мм',
			'product_height' => 'Висота, мм',
			'patina' => 'Патіна',
			'tabletop_id' => 'Стільниця',
			'product_type_id' => 'Тип',
			'type_search' => 'Тип',
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
            'productType'=> array('select' => array('name'))
        );

        $criteria->together = true;

        if (!empty($this->type_search))  {$criteria->addSearchCondition('productType.name', $this->type_search);}

		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('product_name',$this->product_name,true);
		$criteria->compare('product_length',$this->product_length,true);
		$criteria->compare('product_insert',$this->product_insert,true);
		$criteria->compare('product_width',$this->product_width,true);
		$criteria->compare('product_height',$this->product_height,true);
		$criteria->compare('patina',$this->patina,true);
		$criteria->compare('tabletop_id',$this->tabletop_id,true);
        $criteria->compare('created_on',$this->created_on,true);
        $criteria->compare('created_by',$this->created_by,true);
        $criteria->compare('modified_on',$this->modified_on,true);
        $criteria->compare('modified_by',$this->modified_by,true);
		//$criteria->compare('product_type_id',$this->product_type_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'product_name ASC',
                'attributes'=>array(
                    'type_search'=>array(
                        'asc'=>'productType.name',
                        'desc'=>'productType.name DESC',
                    ),
                    '*',

                ),

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
	 * @return Products the static model class
	 */

    public function getPatinaOptions() {
        return array(
            1=>'Так',
            0=>'Ні',
        );
    }

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
