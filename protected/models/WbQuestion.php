<?php

/**
 * This is the model class for table "wb_question".
 *
 * The followings are the available columns in table 'wb_question':
 * @property integer $ques_id
 * @property string $ques_message
 * @property integer $ques_like
 * @property integer $obj_id
 * @property integer $mem_id
 * @property string $ques_updatedate
 */
class WbQuestion extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'wb_question';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ques_message, ques_like, obj_id, mem_id, ques_updatedate', 'required'),
            array('ques_like, obj_id, mem_id', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ques_id, ques_message, ques_like, obj_id, mem_id, ques_updatedate', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            //'member' => array(self::BELONGS_TO, 'Member', 'mem_id'),
            //'action'=>array(self::HAS_MANY, 'WbQuestionAction', 'mem_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ques_id' => 'Ques',
            'ques_message' => 'Ques Message',
            'ques_like' => 'Ques Like',
            'obj_id' => 'Obj',
            'mem_id' => 'Mem',
            'ques_updatedate' => 'Ques Updatedate',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('ques_id', $this->ques_id);
        $criteria->compare('ques_message', $this->ques_message, true);
        $criteria->compare('ques_like', $this->ques_like);
        $criteria->compare('obj_id', $this->obj_id);
        $criteria->compare('mem_id', $this->mem_id);
        $criteria->compare('ques_updatedate', $this->ques_updatedate, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return WbQuestion the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
