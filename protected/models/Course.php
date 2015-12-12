<?php

/**
 * This is the model class for table "{{course}}".
 *
 * The followings are the available columns in table '{{course}}':
 * @property integer $id
 * @property integer $store_id
 * @property string $introduction
 * @property integer $start_time
 * @property integer $end_time
 * @property integer $sale_time
 * @property integer $esale_time
 * @property string $time_area
 * @property double $sale_price
 * @property string $is_check
 * @property string $gmt_created
 * @property string $gmt_modified
 */
class Course extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{course}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('store_id, sale_price,name', 'required'),
			//array('store_id, start_time, end_time, sale_time, esale_time', 'numerical', 'integerOnly'=>true),
			array('sale_price', 'numerical'),
			array('is_check', 'length', 'max'=>1),
			array('introduction, gmt_created, gmt_modified,time_area,,start_time, end_time, sale_time, esale_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, store_id, introduction, start_time, end_time, sale_time, esale_time, time_area, sale_price, is_check, gmt_created, gmt_modified', 'safe', 'on'=>'search'),
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
			'store' =>array(self::BELONGS_TO,'Store','store_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '课程id',
			'store_id' => '店铺',
			'name' =>'课程名称',
			'introduction' => '课程介绍',
			'start_time' => '开始时间',
			'end_time' => '结束时间',
			'sale_time' => '开售时间',
			'esale_time' => '停售时间',
			'time_area' => '时间区间',
			'sale_price' => '售价',
			'is_check' => '状态',//0-未审核,1-已审核
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
		$criteria->compare('store_id',$this->store_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('introduction',$this->introduction,true);
		$criteria->compare('start_time',$this->start_time);
		$criteria->compare('end_time',$this->end_time);
		$criteria->compare('sale_time',$this->sale_time);
		$criteria->compare('esale_time',$this->esale_time);
		$criteria->compare('time_area',$this->time_area,true);
		$criteria->compare('sale_price',$this->sale_price);
		$criteria->compare('is_check',$this->is_check,true);
		$criteria->compare('gmt_created',$this->gmt_created,true);
		$criteria->compare('gmt_modified',$this->gmt_modified,true);
		$info = Yii::app()->user->getState('info');
		if($info->authority == 0)
		{
			$criteria->compare('manager',$info->id);
		}
		$criteria->with = array('store');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getCheck()
	{
		$is_open = $this->is_check;
		switch($is_open)
		{
			case 0:
				$res = '未审核';
				break;
			case 1:
				$res = '通过';
				break;
			case 2:
				$res = '失败';
				break;
			case 3:
				$res = '删除';
				break;
			default:
				$res = '-';
				break;
		}
		return $res;
	}

	//获取课程名称
	public function getLessons()
	{
		$info = Yii::app()->user->getState('info');
		if($info->authority == 0)
		{
			//$criteria->compare('manager',$info->id);
			$data = $this->findAll(array('select'=>array('id','name'),'condition'=>'manager=:id','params'=>array(':id'=>$info->id)));
		}else{
			$data = $this->findAll(array('select'=>array('id','name')));
		}
		$names = array();
		if($data)
		{
			foreach($data as $key=>$val)
			{
				$names[$val->id]=$val->name;
			}
		}

		return $names;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Course the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
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

}
