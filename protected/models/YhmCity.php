<?php

/**
 * This is the model class for table "{{yhm_city}}".
 *
 * The followings are the available columns in table '{{yhm_city}}':
 * @property integer $class_id
 * @property integer $class_parent_id
 * @property string $class_name
 * @property integer $class_type
 */
class YhmCity extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{yhm_city}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('class_parent_id, class_type', 'numerical', 'integerOnly'=>true),
			array('class_name', 'length', 'max'=>120),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('class_id, class_parent_id, class_name, class_type', 'safe', 'on'=>'search'),
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
			'class_id' => '城市id',
			'class_parent_id' => '父类城市',
			'class_name' => '城市名称',
			'class_type' => '城市等级',
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

		$criteria->compare('class_id',$this->class_id);
		$criteria->compare('class_parent_id',$this->class_parent_id);
		$criteria->compare('class_name',$this->class_name,true);
		$criteria->compare('class_type',$this->class_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return YhmCity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	//获取城市列表
	public function city($province = 0){
			$city =array();

				$city_obj = YhmCity::model()->findAll('class_parent_id=:id',array(':id'=>$province));

				if($city_obj){
					foreach($city_obj as $key=>$val)
					{
						$city[$val->class_id] = $val->class_name;
					}

				}
			return $city;
	}
	//获取城市列表
	public function cityHtml($province = 0){
		$city =array();

		$city_obj = YhmCity::model()->findAll('class_parent_id=:id',array(':id'=>$province));

		if($city_obj){
			foreach($city_obj as $key=>$val)
			{
				//$city[$val->class_id] = $val->class_name;
				/*echo CHtml::tag('option', array('value' => ''), '请选择考核时期', true);*/

				echo CHtml::tag('option', array('value' => $val->class_id), CHtml::encode($val->class_name), true);
			}

		}
		//return $city;
	}

	//获取省列表
	public function province()
	{
		$province =array();

		$pro_obj = YhmCity::model()->findAll('class_type=:type',array(':type'=>1));

		if($pro_obj){
			foreach($pro_obj as $key=>$val)
			{
				$province[$val->class_id] = $val->class_name;
			}

		}
		return $province;
	}
}
