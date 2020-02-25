<?php

/**
 * This is the model class for table "properties".
 *
 * The followings are the available columns in table 'properties':
 * @property integer $property_id
 * @property integer $attribute_id
 * @property integer $property_info_id
 * @property string $name
 * @property string $img_url
 * @property string $img_url_thumb
 */
class Properties extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'properties';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('attribute_id, name', 'required'),
			array('attribute_id, property_info_id', 'numerical', 'integerOnly'=>true),
			array('name, img_url, img_url_thumb', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('property_id, attribute_id, property_info_id, name', 'safe', 'on'=>'search'),
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
            'attribute'=>array(self::BELONGS_TO, 'Attributes', 'attribute_id'),
            'propertyInfo'=>array(self::BELONGS_TO, 'PropertiesInfo', 'property_info_id'),
            'orderItemProperty'=>array(self::HAS_MANY, 'OrdersItemsProperties', 'property_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'property_id' => 'Property',
			'attribute_id' => 'Атрибут',
			'property_info_id' => 'Інфо',
			'name' => 'Назва',
			'img_url' => 'Зображення',
			'img_url_thumb' => 'Зображення (зм)',
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

		$criteria->compare('property_id',$this->property_id);
		$criteria->compare('attribute_id',$this->attribute_id);
		$criteria->compare('property_info_id',$this->property_info_id);
		$criteria->compare('name',$this->name,true);
		//$criteria->compare('img_url',$this->img_url,true);
		//$criteria->compare('img_url_thumb',$this->img_url_thumb,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => 40,
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Properties the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
