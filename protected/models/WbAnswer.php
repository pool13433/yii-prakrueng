<?php

/**
 * This is the model class for table "wb_answer".
 *
 * The followings are the available columns in table 'wb_answer':
 * @property integer $ans_id
 * @property string $ans_message
 * @property integer $ans_like
 * @property integer $ques_id
 * @property integer $mem_id
 * @property string $ans_updatedate
 */
class WbAnswer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'wb_answer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ans_message, ans_like, ques_id, mem_id, ans_updatedate', 'required'),
			array('ans_like, ques_id, mem_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ans_id, ans_message, ans_like, ques_id, mem_id, ans_updatedate', 'safe', 'on'=>'search'),
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
			'ans_id' => 'Ans',
			'ans_message' => 'Ans Message',
			'ans_like' => 'Ans Like',
			'ques_id' => 'Ques',
			'mem_id' => 'Mem',
			'ans_updatedate' => 'Ans Updatedate',
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

		$criteria->compare('ans_id',$this->ans_id);
		$criteria->compare('ans_message',$this->ans_message,true);
		$criteria->compare('ans_like',$this->ans_like);
		$criteria->compare('ques_id',$this->ques_id);
		$criteria->compare('mem_id',$this->mem_id);
		$criteria->compare('ans_updatedate',$this->ans_updatedate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return WbAnswer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
