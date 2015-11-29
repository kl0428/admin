<?php

/**
 * This is the model class for table "{{managers}}".
 *
 * The followings are the available columns in table '{{managers}}':
 * @property integer $id
 * @property string $name
 * @property string $password
 * @property string $mobile
 * @property string $email
 * @property string $authority
 * @property string $is_quit
 * @property string $gmt_created
 * @property string $gmt_modified
 */
class Managers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{managers}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, mobile, email', 'required','message'=>'必填'),
			array('name','unique','className'=>'Managers','attributeName'=>'name','message'=>'用户名已存在'),
			array('mobile','unique','className'=>'Managers','attributeName'=>'mobile','message'=>'手机号码已经存在'),
			array('name, password, email', 'length', 'max'=>32),
			array('mobile', 'length', 'max'=>11),
			array('email','email','message'=>'请填写正确的邮箱'),
			array('authority, is_quit', 'length', 'max'=>1),
			array('gmt_created, gmt_modified , store', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, password, mobile, email, authority, is_quit, gmt_created, gmt_modified', 'safe', 'on'=>'search'),
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
			'id' => '编号',
			'name' => '用户名',
			'password' => '密码',
			'mobile' => '手机',
			'email' => '邮箱',
			'store' =>'店铺',
			'authority' => '权限',
			'is_quit' => '是否退出',
			'gmt_created' => '创建时间',
			'gmt_modified' => '更新时间',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('authority',$this->authority,true);
		$criteria->compare('is_quit',$this->is_quit,true);
		$criteria->compare('gmt_created',$this->gmt_created,true);
		$criteria->compare('gmt_modified',$this->gmt_modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Managers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	/*获取用户信息*/
	public function loadStaffModel($id)
	{
		$res = '';
		if(intval($id)) {
			$model = $this->find(array('select' => array('name'), 'condition' => 'id=:id', 'params' => array(':id' => $id)));
			if($model){
				$res = $model->name;
			}
		}
		return $res;
	}
	public function loadStaffAllModel()
	{
		$res = array();
		$model = (array)$this->findAll(array('select'=>array('id','name'),'order'=>'name asc'));
		if($model){
			foreach($model as $key=>$value)
			{
				$res[$value->id] = $value->name;
			}
		}
		return $res;
	}

	public function beforeSave()
	{
		if($this->isNewRecord)
		{
			$this->gmt_created = date('Y-m-d H:i:s');
		}
		$this->gmt_modified = date('Y-m-d H:i:s');
		return true;
	}

	public function getAuthority()
	{
		$authority = $this->authority;
			switch($authority){
				case 0:
					$res = '普通';
					break;
				case 1:
					$res = '管理员';
					break;
				case 2:
					$res = '超级管理员';
					break;
				default:
					$res = '普通';
					break;
			}
		return $res;
	}

}
