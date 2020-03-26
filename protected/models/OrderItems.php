<?php

/**
 * This is the model class for table "order_items".
 *
 * The followings are the available columns in table 'order_items':
 * @property integer $order_item_id
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $width
 * @property integer $insert
 * @property integer $length
 * @property integer $height
 * @property integer $quantity
 * @property integer $price
 * @property integer $subtotal
 * @property integer $status_id
 * @property string $comment
 * @property string $delivered
 * @property string $tinting
 * @property string $patina
 * @property string $created_on
 * @property string $created_by
 * @property string $modified_on
 * @property string $modified_by
 * @property string $archive
 * @property string $joiner
 * @property string $packing
 * @property string $painter
 * @property string $coating
 * @property string $finish
 * @property string $primer
 * @property string $upholstery
 */
class OrderItems extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_items';
	}
    public $city_search;
    public $customer_search;
    public $shop_search;
    public $product_search;
    public $type_search;
    public $color_search;
    public $eaf_search;
    public $stone_search;
    public $glass_search;
    public $patina_search;
    public $tinting_search;
    public $create_search;
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('width, length, height, price, quantity', 'required'),
			array('order_id, product_id, width, insert, length, height, quantity, status_id, tinting, patina, archive, joiner, finish, coating , packing, painter, primer, upholstery', 'numerical', 'integerOnly'=>true),
			array('price, subtotal', 'numerical', 'integerOnly'=>false),
			array('created_by, modified_by', 'length', 'max'=>32),
            array('comment', 'length', 'max'=>255),
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

            array('status_id', 'default', 'value' => '1'),
            array('archive', 'default', 'value' => '0'),
            array('joiner', 'default', 'value' => '0'),
            array('packing', 'default', 'value' => '0'),
            array('painter', 'default', 'value' => '0'),
            array('coating', 'default', 'value' => '0'),
            array('finish', 'default', 'value' => '0'),
            array('primer', 'default', 'value' => '0'),
            array('upholstery', 'default', 'value' => '0'),
            

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('order_item_id, order_id, product_id, width, insert, length, height, quantity, price, subtotal, status_id, comment, tinting, patina, created_on, created_by, modified_on, modified_by, archive, city_search, customer_search, shop_search, order_total, product_search, type_search, color_search, eaf_search, stone_search, glass_search, patina_search, tinting_search, create_search, joiner, packing, painter, upholstery', 'safe', 'on'=>'search'),
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
            'orderItemProperty'=>array(self::HAS_MANY, 'OrdersItemsProperties', 'order_item_id'),
            'colorItemProperty'=>array(self::HAS_MANY, 'OrdersItemsProperties', 'order_item_id'),
            'eafItemProperty'=>array(self::HAS_MANY, 'OrdersItemsProperties', 'order_item_id'),
            'stoneItemProperty'=>array(self::HAS_MANY, 'OrdersItemsProperties', 'order_item_id'),
            'glassItemProperty'=>array(self::HAS_MANY, 'OrdersItemsProperties', 'order_item_id'),
            'billItem'=>array(self::HAS_ONE, 'BillItems', 'order_item_id'),
            'invoiceItem'=>array(self::HAS_ONE, 'InvoiceItems', 'order_item_id'),
		    'status'=>array(self::BELONGS_TO, 'Status', 'status_id'),
            'user'=>array(self::BELONGS_TO, 'User', 'modified_by'),
            'order'=>array(self::BELONGS_TO, 'Orders', 'order_id'),
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
			'order_item_id' => 'Арт.',
			'order_id' => '№ Зам.',
			'product_id' => 'Товар',
			'product_search' => 'Товар',
			'type_search' => 'Тип',
			'width' => 'Ш., мм',
			'insert' => 'Вст., мм',
			'length' => 'Д., мм',
			'height' => 'Вис., мм',
			'quantity' => 'Шт.',
			'price' => 'Ціна',
			'subtotal' => 'Загальна вартість',
			'status_id' => 'Статус',
			'comment' => 'Коментар (обивка)',
			'tinting' => 'Тонування',
			'patina' => 'Патіна',
            'created_on' => 'Створено',
            'created_by' => 'Створений',
            'modified_on' => 'Змінено',
            'modified_by' => 'Змінив',
            'archive' => 'Архів',
            'joiner' => 'Стол.',
            'coating' => 'Покр',
            'finish' => 'Фініш',
            'primer' => 'Грунт',
            'packing' => 'Упак.',
            'painter' => 'Маляр',
            'upholstery' => 'Обивк.',
            'customer_search'=>'Покупець',
            'city_search'=>'Місто доставки',
            'city_or_region'=>'Місто або область',
            'color_search'=>'Покраска',
            'eaf_search'=>'ДСП',
            'glass_search'=>'Скло',
            'stone_search'=>'Камінь',
            'patina_search'=>'Патіна',
            'tinting_search'=>'Тонування',
            'shop_search'=>'Магазин',


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
            'order.customers' => array('select' => array('last_name', 'first_name')),
            'order.shop' => array('select' => array('full_name')),
            'order.city' => array('select' => array('city_name')),
            'product' => array('select' => array('product_name')),
            'product.productType' => array('select' => array('name')),
           // 'orderItemProperty.property' => array('select' => array('name')),
            'colorItemProperty.property' => array('select' => array('name')),
        );

        $criteria->together = true;

        if (!empty($this->city_search))     {$criteria->addSearchCondition(new CDbExpression( 'CONCAT(city.city_name, " ", city.region_name)' ), $this->city_search);}
        if (!empty($this->customer_search)) {$criteria->addSearchCondition(new CDbExpression( 'CONCAT(customers.last_name, " ", customers.first_name)' ), $this->customer_search);}
        if (!empty($this->shop_search))     {$criteria->addSearchCondition('shop.full_name' , $this->shop_search);}
        if (!empty($this->product_search))  {$criteria->addSearchCondition('product.product_name', $this->product_search);}
        if (!empty($this->type_search))     {$criteria->addSearchCondition('productType.name',$this->type_search, false);}
       // if (!empty($this->color_search))    {$criteria->addCondition('property.name',$this->color_search, true,'OR');}
       // if (!empty($this->eaf_search))      {$criteria->addCondition('property.name',$this->eaf_search, true,'OR');}
       // if (!empty($this->stone_search))    {$criteria->addCondition('property.name',$this->stone_search, true,'OR');}
      //  if (!empty($this->glass_search))    {$criteria->addCondition('property.name',$this->glass_search, true,'OR');}


		$criteria->compare('t.order_item_id',$this->order_item_id);
		$criteria->compare('t.order_id',$this->order_id);
		$criteria->compare('t.product_id',$this->product_id);
		$criteria->compare('t.width',$this->width);
		$criteria->compare('t.insert',$this->insert);
		$criteria->compare('t.length',$this->length);
		$criteria->compare('t.height',$this->height);
		$criteria->compare('t.quantity',$this->quantity);
		$criteria->compare('t.price',$this->price);
		$criteria->compare('t.subtotal',$this->subtotal);
		$criteria->compare('t.status_id',$this->status_id);
		$criteria->compare('t.comment',$this->comment,true);
		$criteria->compare('t.tinting',$this->tinting,true);
		$criteria->compare('t.patina',$this->patina,true);
		$criteria->compare('property.name',$this->color_search,true);
		//$criteria->compare('t.created_on',$this->created_on);
		//$criteria->compare('t.create_search',$this->created_on);
        $criteria->mergeWith($this->dateRangeSearchCriteria('t.created_on', $this->created_on));
        //$criteria->mergeWith($this->dateRangeSearchCriteria('t.modified_on', $this->modified_on));
		$criteria->compare('t.created_by',$this->created_by,true);
		$criteria->compare('t.modified_on',$this->modified_on,true);
		$criteria->compare('t.modified_by',$this->modified_by,true);
		$criteria->compare('t.archive',$this->archive,true);
        $criteria->compare('t.joiner',$this->joiner,true);
        $criteria->compare('t.packing',$this->packing,true);
        $criteria->compare('t.painter',$this->painter,true);
        $criteria->compare('t.finish',$this->finish,true);
        $criteria->compare('t.coating',$this->coating,true);
        $criteria->compare('t.primer',$this->primer,true);
        $criteria->compare('t.upholstery',$this->upholstery,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'city.city_name, shop.full_name',
                'attributes'=>array(
                    'city_search'=>array(
                        'asc'=>'city.city_name',
                        'desc'=>'city.city_name DESC',
                    ),
                    '*',
                    'customer_search'=>array(
                        'asc'=>'customers.last_name',
                        'desc'=>'customers.last_name DESC',
                    ),
                    '*',
                    'shop_search'=>array(
                        'asc'=>'shop.full_name',
                        'desc'=>'shop.full_name DESC',
                    ),
                    '*',
                    'product_search'=>array(
                        'asc'=>'product.product_name',
                        'desc'=>'product.product_name DESC',
                    ),
                    '*',
                    'type_search'=>array(
                        'asc'=>'productType.name',
                        'desc'=>'productType.name DESC',
                    ),
                    '*',
                    'color_search'=>array(
                        'asc'=>'property.name',
                        'desc'=>'property.name DESC',
                    ),
                    '*',
                    'eaf_search'=>array(
                        'asc'=>'property.name',
                        'desc'=>'property.name DESC',
                    ),
                    '*',
                    'stone_search'=>array(
                        'asc'=>'property.name',
                        'desc'=>'property.name DESC',
                    ),
                    '*',
                    'glass_search'=>array(
                        'asc'=>'property.name',
                        'desc'=>'property.name DESC',
                    ),
                    '*',
                ),

            ),
            'pagination' => array(
                'pageSize' => 500,
            ),
		));
	}

    public function filter()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('order_id',$this->order_id, false);
        $criteria->compare('archive',$this->archive,true);
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

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderItems the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
    public function getProductName($id){

        $product = Products::model()->findByPk($id);
        echo "<span data-product-name='".$product->product_name."'>".$product->product_name."</span>";
    }

    public function getColor($id){
        $properties  = OrdersItemsProperties::model()->findAll(
            array("condition"=>"order_item_id = $id")
        );
        foreach ($properties as $property){
           echo "<p><b>".$property->property->attribute->name.": </b>";
           echo $property->property->name.' <a class="update-color" title="Редагувати" href="/ordersItemsProperties/update?id='.$property->order_item_property_id.'"><img src="/images/admin/update.png" alt="Редагувати"></a>';
        }
        if ($this->tinting == 1){
            echo "<p><b>Тонування:</b> Так";        }
        if ($this->patina == 1){
            echo "<p><b>Патіна:</b> Золото";
        }elseif($this->patina == 2){
            echo "<p><b>Патіна:</b> Мідь";
        }elseif($this->patina == 3){
            echo "<p><b>Патіна:</b> Бронза";
        }
    }

    public function getColorName($id){

        $properties = OrdersItemsProperties::model()->with('property')->findByAttributes(
            array(
                'order_item_id'=>$id
            ),
            array(
                'condition' =>'property.attribute_id = :id',
                'params'=>array(':id'=> '2')
            )
        );
        if ($properties->property->name != "" ){
            echo "<span data-color='".$properties->property->name."'>".$properties->property->name."</span>";
        }
        //echo $properties->property->name;
    }

    public function getEafName($id){

        $properties  = OrdersItemsProperties::model()->with('property')->findByAttributes(
            array(
                'order_item_id'=>$id
            ),
            array(
                'condition' =>'property.attribute_id = 1 OR property.attribute_id = 9'
            )
        );
        echo $properties->property->name;
    }

    public function getStoneName($id){

        $properties  = OrdersItemsProperties::model()->with('property')->findByAttributes(
            array(
                'order_item_id'=>$id
            ),
            array(
                'condition' =>'property.attribute_id = :id',
                'params'=>array(':id'=> '3')
            )
        );
        echo $properties->property->name;
    }

    public function getGlassName($id){

        $properties  = OrdersItemsProperties::model()->with('property')->findByAttributes(
            array(
                'order_item_id'=>$id
            ),
            array(
                'condition' =>'property.attribute_id = :id',
                'params'=>array(':id'=> '5')
            )
        );
        echo $properties->property->name;
    }

    public function getShopName($id){

        $properties  = OrderItems::model()->findByPk($id);
        echo "<span data-shop='".$properties->order->shop->full_name."'>".$properties->order->shop->full_name."</span>";
    }

	public function isTable($id){
		$product = OrderItems::model()->findByPk($id);
		$productType    = $product->product->product_type_id;
		
		if ($productType == 1){
            return true;
        }else{
			return false;
		}
	}

    public function getProductNameAndSize($id){

        $product = OrderItems::model()->findByPk($id);

        $itemId     = $product->order_item_id;
        $width      = $product->width;
        $insert     = $product->insert;
        $length     = $product->length;
        $comment    = $product->comment;

        $properties = OrdersItemsProperties::model()->findAll('order_item_id=:order_item_id',
            array(
                ':order_item_id'=>$itemId,
            )
        );

        foreach ($properties as $property){
            $color .= $property->property->name." ";
        }

        $size           = $length."(+".$insert.")x".$width;
        $productName    = $product->product->product_name;
        $productType    = $product->product->product_type_id;
        $typeName       = $product->product->productType->name;

        if ($productType == 1){
			if($comment != "") {
				echo $typeName." ".$productName."  ".$size." ".$color." <br />".$comment;	
			}else{
				echo $typeName." ".$productName."  ".$size." ".$color;	
			}    
        }
        if($productType > 1){
            echo $typeName." ".$productName." ".$color." ".$comment;
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

    public function getMetaData(){
        $data = parent::getMetaData();
        $data->columns['glass_search'] = array('name' => 'glass_search','defaultValue'=>'$data->getGlassName($data->order_item_id)' );
        $data->columns['eaf_search'] = array('name' => 'eaf_search');
        return $data;
    }

}
