<?php

/**
 * This is the model class for table "products_properties".
 *
 * The followings are the available columns in table 'products_properties':
 * @property integer $product_property_id
 * @property integer $price_group_id
 * @property integer $property_id
 * @property integer $add_payment
 */
class ProductsProperties extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'products_properties';
	}

    public $property_search;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('price_group_id, property_id, add_payment', 'required'),
			array('price_group_id, property_id, add_payment', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('product_property_id, price_group_id, property_id, add_payment, property_search', 'safe', 'on'=>'search'),
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
            'property'=>array(self::BELONGS_TO, 'Properties', 'property_id'),
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'product_property_id' => 'Product Property',
			'price_group_id' => 'Цінова категорія',
			'property_id' => 'Значення',
			'add_payment' => 'Додадкова вартість, %',
			'property_search' => 'Значення',
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
            'property' => array('select' => array('name')),
        );

        $criteria->together = true;

        if (!empty($this->property_search))     {$criteria->addSearchCondition('property.name', $this->property_search);}


        $criteria->compare('product_property_id',$this->product_property_id);
		$criteria->compare('price_group_id',$this->price_group_id);
		$criteria->compare('property_id',$this->property_id);
		$criteria->compare('add_payment',$this->add_payment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'product_property_id ASC',
                'attributes'=>array(
                    'property_search'=>array(
                        'asc'=>'property.name',
                        'desc'=>'property.name DESC',
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
	 * @return ProductsProperties the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
