<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $real_name
 * @property string $username
 * @property string $password
 * @property integer $unit
 * @property integer $manger
 * @property string $review_type
 * @property double $self_weight
 * @property double $review_weight
 * @property string $staff_code
 * @property string $staff_level
 * @property string $gmt_entry
 * @property string $gmt_out
 * @property integer $is_mange
 * @property string $status
 * @property string $gmt_created
 * @property string $gmt_modifued
 * @property string $other
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('real_name, username, password, unit, manger, staff_code, gmt_created, other', 'required'),
			array('unit, manger, is_mange', 'numerical', 'integerOnly'=>true),
			array('self_weight, review_weight', 'numerical'),
			array('real_name, username, password, staff_code', 'length', 'max'=>32),
            array('username','unique','className'=>'User','attributeName'=>'username','on'=>array('create'),'message'=>'用户名已经存在'),
			array('review_type', 'length', 'max'=>6),
			array('staff_level', 'length', 'max'=>8),
			array('status', 'length', 'max'=>3),
			array('gmt_entry, gmt_out, gmt_modifued', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, real_name, username, password, unit, manger, review_type, self_weight, review_weight, staff_code, staff_level, gmt_entry, gmt_out, is_mange, status, gmt_created, gmt_modifued, other', 'safe', 'on'=>'search'),
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
			'id' => '员工id',
			'real_name' => '姓名',
			'username' => '登录名',
			'password' => '登录密码',
			'unit' => '所属单位',
			'manger' => '上级领导',
			'review_type' => '考核方式',
			'self_weight' => '自评权重',
			'review_weight' => '考核权重',
			'staff_code' => '员工编号',
			'staff_level' => '员工等级',
			'gmt_entry' => '入职时间',
			'gmt_out' => '离职时间',
			'is_mange' => '是否是领导0-否,1-是',
			'status' => '员工状态in-在职,out-离职',
			'gmt_created' => '创建时间',
			'gmt_modifued' => '更新时间',
			'other' => '备注',
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
		$criteria->compare('real_name',$this->real_name,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('unit',$this->unit);
		$criteria->compare('manger',$this->manger);
		$criteria->compare('review_type',$this->review_type,true);
		$criteria->compare('self_weight',$this->self_weight);
		$criteria->compare('review_weight',$this->review_weight);
		$criteria->compare('staff_code',$this->staff_code,true);
		$criteria->compare('staff_level',$this->staff_level,true);
		$criteria->compare('gmt_entry',$this->gmt_entry,true);
		$criteria->compare('gmt_out',$this->gmt_out,true);
		$criteria->compare('is_mange',$this->is_mange);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('gmt_created',$this->gmt_created,true);
		$criteria->compare('gmt_modifued',$this->gmt_modifued,true);
		$criteria->compare('other',$this->other,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
