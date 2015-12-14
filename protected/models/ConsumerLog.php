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
	public $total;
	public $used;
	public $price;
	public $card_id;
	public $time_start;
	public $time_end;
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
			array('flag,user_id, store_id', 'numerical', 'integerOnly'=>true),
			array('fee', 'numerical'),
			array('flag_content', 'length', 'max'=>32),
			array('flag_content','checkCard'),
			array('is_used', 'length', 'max'=>1),
			array('gmt_created, gmt_modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('log_id, flag, flag_content,time_start,time_end, user_id, store_id, fee, is_used, gmt_created, gmt_modified', 'safe', 'on'=>'search'),
		);
	}

	//验证卡号信息
	public function checkCard($attribute,$params)
	{
		if($this->flag <2)
		{
			if($this->flag_content){
				$obj= Card::model()->find(array('condition'=>'card_num=:num and is_sale =:sale','params'=>array(':num'=>$this->flag_content,':sale'=>'1')));
				if($obj){
					if(strtotime($obj->start_time) > time()) {
						$this->addError($attribute, '使用时间未开始');
						return false;
					}
					if(strtotime($obj->end_time) < time()){
						$this->addError($attribute, '有效时间已过');
						return false;
					}
					if ($obj->total_num > $obj->used_num) {
						//ok
						$this->total = $obj->total_num;
						$this->used = $obj->used_num;
						$this->price = $obj->price;
						$this->card_id = $obj->card_id;
						return true;
					} else {
						$this->addError($attribute, '次数已用完');
					}

				}else{
					$this->addError($attribute,'卡号不存在');
				}
			}else{
				$this->addError($attribute,'卡号不能为空');
			}
		}else if($this->flag == 2)
		{
			return true;
		}else{
			$this->addError($attribute,'卡号不存在');
		}
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
			'log_id' => '消费记录',
			'flag' => '消费类型',
			'flag_content' => '卡号',
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
		/*var_dump($this->time_start);
		exit;*/
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
		if($this->time_start)
			$criteria->compare('t.gmt_created',">".date('Y-m-d',strtotime($this->time_start))." 00:00:00");
		if($this->time_end)
			$criteria->compare('t.gmt_created',"<".date('Y-m-d',strtotime($this->time_end))." 23:59:59");
		$criteria->with = 'store';
		$criteria->order = 't.gmt_created desc';

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

	public function beforeSave()
	{
		if($this->isNewRecord)
			$this->gmt_created = date('Y-m-d H:i:s');
		$this->gmt_modified = date('Y-m-d H:i:s');
		return true;
	}

	public function getFlag()
	{
		$flag = $this->flag;
		switch($flag)
		{
			case 0:
				$res = '体验卡';
				break;
			case 1:
				$res = '通卡';
				break;
			case 2:
				$res = '课程';
				break;
			default:
				break;
		}
		return $res;
	}

	public function getAmount(){
		$select="select sum(fee) as total from `t_consumer_log`";

		$condition = 'where 1=1';
		if($this->store_id)
			$condition .= ' and store_id='.$this->store_id;
		if($this->flag)
			$condition .= ' and flag='.$this->flag;

		if($this->is_used)
			$condition .= ' and paid='.$this->is_used;
		if($this->time_start)
			$condition .='gmt_created >'.$this->time_start." 00:00:00";
		if($this->time_end)
			$condition .='gmt_created<'.$this->time_end." 23:59:59";
		$sql = $select.$condition;
		$result = Yii::app()->db->createCommand($sql);
		$res = $result->queryAll();
		return $res[0];
	}
}
