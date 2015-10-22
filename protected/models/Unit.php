<?php

/**
 * This is the model class for table "{{unit}}".
 *
 * The followings are the available columns in table '{{unit}}':
 * @property integer $unit_id
 * @property string $unit_name
 * @property integer $unit_superior
 * @property integer $unit_manger
 * @property string $unit_code
 * @property integer $unit_level
 * @property string $unit_created
 * @property string $gmt_modifued
 */
class Unit extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{unit}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('unit_name, unit_superior, unit_manger, unit_code, unit_level', 'required'),
			array('unit_superior, unit_manger, unit_level', 'numerical', 'integerOnly'=>true),
			array('unit_name', 'length', 'max'=>32),
			array('unit_code', 'length', 'max'=>10),
			array('unit_created, gmt_modifued', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('unit_id, unit_name, unit_superior, unit_manger, unit_code, unit_level, unit_created, gmt_modifued', 'safe', 'on'=>'search'),
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
			'unit_id' => '部门id',
			'unit_name' => '部门名称',
			'unit_superior' => '上级部门',
			'unit_manger' => '部门主管',
			'unit_code' => '部门编号',
			'unit_level' => '部门级别',
			'unit_created' => '部门创建时间',
			'gmt_modifued' => '更新时间',
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

		$criteria->compare('unit_id',$this->unit_id);
		$criteria->compare('unit_name',$this->unit_name,true);
		$criteria->compare('unit_superior',$this->unit_superior);
		$criteria->compare('unit_manger',$this->unit_manger);
		$criteria->compare('unit_code',$this->unit_code,true);
		$criteria->compare('unit_level',$this->unit_level);
		$criteria->compare('unit_created',$this->unit_created,true);
		$criteria->compare('gmt_modifued',$this->gmt_modifued,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Unit the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
