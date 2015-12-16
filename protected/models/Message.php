<?php

/**
 * This is the model class for table "{{message}}".
 *
 * The followings are the available columns in table '{{message}}':
 * @property integer $id
 * @property integer $flag
 * @property integer $to_user
 * @property string $content
 * @property string $is_read
 * @property string $gmt_created
 * @property string $gmt_modified
 */
class Message extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{message}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('flag, content', 'required'),
			array('flag, to_user', 'numerical', 'integerOnly'=>true),
			array('content', 'length', 'max'=>250),
			array('is_read', 'length', 'max'=>1),
			array('gmt_created, gmt_modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, flag, to_user, content, is_read, gmt_created, gmt_modified', 'safe', 'on'=>'search'),
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
			'id' => '消息id',
			'flag' => '消息标识',
			'to_user' => '发送对象',
			'content' => '发送内容',
			'is_read' => '是否已读',//0-未读,1-已读
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
		$criteria->compare('flag',$this->flag);
		$criteria->compare('to_user',$this->to_user);
		$criteria->compare('content',$this->content,true);
		//$criteria->compare('is_read',$this->is_read,true);
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
	 * @return Message the static model class
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

	public function flag()
	{
		$flag = $this->flag;
		switch($flag)
		{
			case 0:
				$res = '所有';
				break;
			case 1:
				$res = '店铺';
				break;
			case 2:
				$res = '用户';
				break;
			default:
				$res = '用户';
				break;
		}
		return $res;
	}



}
