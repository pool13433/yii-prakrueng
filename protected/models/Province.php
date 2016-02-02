<?php

/**
 * This is the model class for table "province".
 *
 * The followings are the available columns in table 'province':
 * @property integer $pro_id
 * @property string $pro_name_th
 * @property int $reg_id
 * @property string $pro_name_eng
 * @property string $pro_updatedate
 */
class Province extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'province';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pro_name_th, pro_name_eng,reg_id, pro_updatedate', 'required'),
            array('pro_name_th, pro_name_eng', 'length', 'max' => 150),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('pro_id, pro_name_th, pro_name_eng, pro_updatedate', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'region' => array(self::BELONGS_TO, 'Region', 'reg_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'pro_id' => 'Pro',
            'pro_name_th' => 'Pro Name Th',
            'pro_name_eng' => 'Pro Name Eng',
            'reg_id' => 'Region Id',
            'pro_updatedate' => 'Pro Updatedate',
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

        $criteria->compare('pro_id', $this->pro_id);
        $criteria->compare('pro_name_th', $this->pro_name_th, true);
        $criteria->compare('pro_name_eng', $this->pro_name_eng, true);
        $criteria->compare('pro_updatedate', $this->pro_updatedate, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Province the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
