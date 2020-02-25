<?php

/**
 * This is the model class for table "status".
 *
 * The followings are the available columns in table 'status':
 * @property string $status_id
 * @property string $status_name
 * @property string $status_desc
 */
class Status extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'status';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status_name, status_desc', 'required'),
			array('status_name, status_desc', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('status_id, status_name, status_desc', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'status_id' => '№',
			'status_name' => 'Статус',
			'status_desc' => 'Опис',
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

		$criteria->compare('status_id',$this->status_id,true);
		$criteria->compare('status_name',$this->status_name,true);
		$criteria->compare('status_desc',$this->status_desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getOrderStatus($id, $status_id, $getModel){
        $models = Status::model()->findAll(array('order' => 'status_id'));
        $list = CHtml::listData($models, 'status_id', 'status_name');
        echo CHtml::dropDownList('status_id', 'ajaxStatusUpdate', $list,
            array(
                'empty' => 'Виберіть статус',
                'class'=>'ajaxStatusUpdate','options' => array(
                    $status_id=>array(
                        'selected'=>true
                        ),
            ),
                'ajax' => array(
                    'type'=>'POST',
                    'url'=>Yii::app()->createAbsoluteUrl('status/statusUpdateAjax'),
                    'data'=>array(
                        'id'=>'js:jQuery(this).parent().siblings(":first").text()',
                        'status_id'=>'js:jQuery(this).find(":selected").val()',
                        'getModel'=>$getModel,
                    ),
                ),
            )
        );
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Status the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}