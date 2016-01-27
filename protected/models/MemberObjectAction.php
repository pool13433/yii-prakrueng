<?php

/**
 * This is the model class for table "member_object_action".
 *
 * The followings are the available columns in table 'member_object_action':
 * @property integer $act_id
 * @property integer $obj_id
 * @property integer $act_like
 * @property integer $act_view
 * @property integer $act_favorite
 * @property integer $mem_id
 * @property string $act_updatedate
 */
class MemberObjectAction extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'member_object_action';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('obj_id, act_like, act_view, act_favorite, mem_id, act_updatedate', 'required'),
            array('obj_id, act_like, act_view, act_favorite, mem_id', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('act_id, obj_id, act_like, act_view, act_favorite, mem_id, act_updatedate', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'member' => array(self::BELONGS_TO, 'Member', 'mem_id'),
            'object' => array(self::BELONGS_TO, 'SacredObject', 'obj_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'act_id' => 'Act',
            'obj_id' => 'Obj',
            'act_like' => 'Act Like',
            'act_view' => 'Act View',
            'act_favorite' => 'Act Favorite',
            'mem_id' => 'Mem',
            'act_updatedate' => 'Act Updatedate',
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

        $criteria->compare('act_id', $this->act_id);
        $criteria->compare('obj_id', $this->obj_id);
        $criteria->compare('act_like', $this->act_like);
        $criteria->compare('act_view', $this->act_view);
        $criteria->compare('act_favorite', $this->act_favorite);
        $criteria->compare('mem_id', $this->mem_id);
        $criteria->compare('act_updatedate', $this->act_updatedate, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return MemberObjectAction the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
