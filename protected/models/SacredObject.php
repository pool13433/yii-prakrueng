<?php

/**
 * This is the model class for table "sacred_object".
 *
 * The followings are the available columns in table 'sacred_object':
 * @property integer $obj_id
 * @property string $obj_name
 * @property integer $obj_price
 * @property string $obj_year
 * @property string $obj_img
 * @property integer $obj_like
 * @property string $obj_comment
 * @property integer $type_id
 * @property integer $pro_id
 * @property string $obj_updatedate
 *
 * The followings are the available model relations:
 * @property SacredType $type
 */
class SacredObject extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sacred_object';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('obj_name, obj_price, obj_year, obj_comment, type_id, pro_id, obj_updatedate', 'required'),
            array('obj_price, obj_like,obj_view,obj_onwer, type_id, pro_id', 'numerical', 'integerOnly' => true),
            array('obj_name, obj_img', 'length', 'max' => 255),
            array('obj_year', 'length', 'max' => 4),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('obj_id, obj_name, obj_price, obj_year, obj_img, obj_like, obj_comment,obj_onwer, type_id, pro_id, obj_updatedate', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'type' => array(self::BELONGS_TO, 'SacredType', 'type_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'obj_id' => 'Obj',
            'obj_name' => 'Obj Name',
            'obj_price' => 'Obj Price',
            'obj_year' => 'Obj Year',
            'obj_img' => 'Obj Img',
            'obj_like' => 'Obj Like',
            'obj_view' => 'Obj View',
            'obj_onwer' => 'Obj Onwer',
            'obj_comment' => 'Obj Comment',
            'type_id' => 'Type',
            'pro_id' => 'Pro',
            'obj_updatedate' => 'Obj Updatedate',
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

        $criteria->compare('obj_id', $this->obj_id);
        $criteria->compare('obj_name', $this->obj_name, true);
        $criteria->compare('obj_price', $this->obj_price);
        $criteria->compare('obj_year', $this->obj_year, true);
        $criteria->compare('obj_img', $this->obj_img, true);
        $criteria->compare('obj_like', $this->obj_like);
        $criteria->compare('obj_comment', $this->obj_comment, true);
        $criteria->compare('type_id', $this->type_id);
        $criteria->compare('pro_id', $this->pro_id);
        $criteria->compare('obj_updatedate', $this->obj_updatedate, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SacredObject the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    protected function afterFind() {
        // convert to display format
        $this->obj_updatedate = strtotime($this->obj_updatedate);
        $this->obj_updatedate = date('m/d/Y', $this->obj_updatedate);

        parent::afterFind();
    }

}
