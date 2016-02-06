<?php

/**
 * This is the model class for table "rules".
 *
 * The followings are the available columns in table 'rules':
 * @property integer $rul_id
 * @property string $rul_desc
 * @property string $rul_updatedate
 */
class SacredRules extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sacred_rules';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('rul_desc, rul_updatedate', 'required'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('rul_id, rul_desc, rul_updatedate', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'rul_id' => 'Rul',
            'rul_desc' => 'Rul Desc',
            'rul_updatedate' => 'Rul Updatedate',
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

        $criteria->compare('rul_id', $this->rul_id);
        $criteria->compare('rul_desc', $this->rul_desc, true);
        $criteria->compare('rul_updatedate', $this->rul_updatedate, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Rules the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
