<?php

/**
 * This is the model class for table "sacred_object_img".
 *
 * The followings are the available columns in table 'sacred_object_img':
 * @property integer $img_id
 * @property string $img_name
 * @property integer $obj_id
 * @property string $img_updatedate
 */
class SacredObjectImg extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sacred_object_img';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('img_name, obj_id, img_updatedate', 'required'),
            array('obj_id', 'numerical', 'integerOnly' => true),
            array('img_name', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('img_id, img_size,img_ext,img_name, obj_id, img_updatedate', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'object' => array(self::BELONGS_TO, 'SacredObject', 'obj_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'img_id' => 'Img',
            'img_name' => 'Img Name',
            'img_size' => 'Image Size',
            'img_ext' => 'Image Extension',
            'obj_id' => 'Obj',
            'img_updatedate' => 'Img Updatedate',
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

        $criteria->compare('img_id', $this->img_id);
        $criteria->compare('img_name', $this->img_name, true);
        $criteria->compare('obj_id', $this->obj_id);
        $criteria->compare('img_updatedate', $this->img_updatedate, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SacredObjectImg the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
