<?php

/**
 * This is the model class for table "{{consumer_log}}".
 *
 * The followings are the available columns in table '{{consumer_log}}':
 * @property integer $log_id
 * @property integer $flag
 * @property string $flag_content
 * @property integer $user_id
 * @property integer $store_id
 * @property double $fee
 * @property string $is_used
 * @property string $gmt_created
 * @property string $gmt_modified
 */
class ConsumerLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{consumer_log}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('flag, user_id, store_id', 'numerical', 'integerOnly'=>true),
			array('fee', 'numerical'),
			array('flag_content', 'length', 'max'=>32),
			array('is_used', 'length', 'max'=>1),
			array('gmt_created, gmt_modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('log_id, flag, flag_content, user_id, store_id, fee, is_used, gmt_created, gmt_modified', 'safe', 'on'=>'search'),
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
			'log_id' => '消费记录',
			'flag' => '消费标识',
			'flag_content' => '标识内容',
			'user_id' => '消费用户',
			'store_id' => '消费店铺',
			'fee' => '费用',
			'is_used' => '确认使用',
			'gmt_created' => '创建时间',
			'gmt_modified' => '修改时间',
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

		$criteria->compare('log_id',$this->log_id);
		$criteria->compare('flag',$this->flag);
		$criteria->compare('flag_content',$this->flag_content,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('store_id',$this->store_id);
		$criteria->compare('fee',$this->fee);
		$criteria->compare('is_used',$this->is_used,true);
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
	 * @return ConsumerLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
