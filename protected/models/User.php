<?php

class User extends CActiveRecord
{
	public $new_password;
	public $new_confirm;
	
	/**
	 * The followings are the available columns in table 'tbl_user':
	 * @var integer $id
	 * @var string $username
	 * @var string $password
	 * @var string $salt
	 * @var string $email
	 * @var string $profile
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, email', 'required'),
			array('username', 'match', 'pattern'=>'#^[a-zA-Z0-9_\.-]+$#', 'message'=>'Логин содержит запрещённые символы'),
			array('email', 'email', 'message'=>'Неверный формат E-mail адреса'),
			array('username, email', 'unique', 'caseSensitive'=>false),
			array('username, new_password, new_confirm, salt, email', 'length', 'max'=>128),
			array('email, username', 'unique'), 
			array('new_password', 'length', 'min'=>6, 'allowEmpty'=>true),
			array('new_confirm', 'compare', 'compareAttribute'=>'new_password', 'message'=>'Пароли не совпадают'),
			array('profile', 'safe'),
			
			// Register
			array('new_password', 'required', 'on'=>'register'),
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
			'posts' => array(self::HAS_MANY, 'Post', 'author_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'username' => 'Додав',
			'new_password' => 'Новый пароль',
			'new_confirm' => 'Подтвердите новый пароль',
			'salt' => 'Salt',
			'email' => 'Email',
			'profile' => 'Profile',
			'creator' => 'Додав',
			'updater' => 'Змінив',
		);
	}
    
	protected function beforeSave() 
	{ 
		if ($this->new_password) 
			$this->salt = self::generateSalt();
			$this->password = $this->hashPassword($this->new_password, $this->salt);
		return parent::beforeSave();
	}

	// После валидации присваиваем пароль и соль.
	  /*public function afterValidate()
	  {
			$this->password = self::hashPassword($this->password, $this->salt);
	        if($this->isNewRecord) {
	            $salt = self::generateSalt();
	            $this->password = self::hashPassword($this->password, $salt);
	            $this->salt = $salt;
	            //$this->role = 'user';
	        }
	        return true;
	  } */
	
	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return $this->hashPassword($password,$this->salt)===$this->password;
	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @param string salt
	 * @return string hash
	 */
	public function hashPassword($password,$salt)
	{
		return md5($salt.$password);
	}

	/**
	 * Generates a salt that can be used to generate a password hash.
	 * @return string the salt
	 */
	protected function generateSalt()
	{
		return uniqid('',true);
	}  
	
	public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('username',$this->username,true);
        $criteria->compare('email',$this->email);

        return new CActiveDataProvider('User', array(
            'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'username, email DESC',
            ),
        ));
    }
}