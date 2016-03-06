<?php

/**
 * This is the model class for table "member".
 *
 * The followings are the available columns in table 'member':
 * @property integer $mem_id
 * @property string $facebook_id
 * @property string $mem_fname
 * @property string $mem_lname
 * @property string $mem_sex
 * @property string $mem_phone
 * @property string $mem_email
 * @property string $mem_address
 * @property string $mem_img
 * @property integer $mem_level
 */
class Member extends CActiveRecord {

    public $mem_status_desc;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'member';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('mem_fname, mem_username,mem_password,mem_lname, mem_sex, mem_phone, mem_email, mem_address, mem_img, mem_level,mem_updatedate', 'required'),
            array('mem_level,mem_status', 'numerical', 'integerOnly' => true),
            array('mem_fname, mem_lname', 'length', 'max' => 100),
            array('mem_username, mem_password', 'length', 'max' => 50),
            array('mem_sex', 'length', 'max' => 1),
            array('mem_phone', 'length', 'max' => 15),
            array('mem_email', 'length', 'max' => 25),
            array('mem_img', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('mem_id, facebook_id,mem_username,mem_password,mem_fname, mem_lname, mem_sex, mem_phone, mem_email, mem_address, mem_img, mem_level,mem_updatedate,mem_status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
                //'memberLevel' => array(self::BELONGS_TO, 'MemberLevel', 'mem_status'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'mem_id' => 'Mem Id',
            'facebook_id' => 'Facebook Id',
            'mem_username' => 'Mem Username',
            'mem_password' => 'Mem Password',
            'mem_fname' => 'Mem Fname',
            'mem_lname' => 'Mem Lname',
            'mem_sex' => 'Mem Sex',
            'mem_phone' => 'Mem Phone',
            'mem_email' => 'Mem Email',
            'mem_address' => 'Mem Address',
            'mem_img' => 'Mem Img',
            'mem_level' => 'Mem Level',
            'mem_updatedate' => 'Mem Updatedate',
            'mem_status' => 'Mem Status'
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

        $criteria->compare('mem_id', $this->mem_id);
        $criteria->compare('facebook_id', $this->facebook_id);
        $criteria->compare('mem_fname', $this->mem_fname, true);
        $criteria->compare('mem_lname', $this->mem_lname, true);
        $criteria->compare('mem_sex', $this->mem_sex, true);
        $criteria->compare('mem_phone', $this->mem_phone, true);
        $criteria->compare('mem_email', $this->mem_email, true);
        $criteria->compare('mem_address', $this->mem_address, true);
        $criteria->compare('mem_img', $this->mem_img, true);
        $criteria->compare('mem_level', $this->mem_level);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Member the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function afterFind() {
        if ($this->mem_sex == 'M') {
            $this->mem_sex = 'ชาย';
        } else {
            $this->mem_sex = 'หญิง';
        }
        if ($this->mem_status == 0) {
            $this->mem_status_desc = 'Administrator';
        } else {
            $this->mem_status_desc = 'Member';
        }
        $this->mem_updatedate = strtotime($this->mem_updatedate);
        $this->mem_updatedate = date('m/d/Y', $this->mem_updatedate);
        parent::afterFind();
    }

    public function beforeSave() {
        $this->mem_updatedate = new CDbExpression('NOW()');
        return parent::beforeSave();
    }

    public static function gender() {
        return array('M' => 'ชาย', 'F' => 'หญิง');
    }

    public function validatePassword($password) {
        $password = md5($password);
        if ($password == $this->mem_password) {
            return true;
        }
    }

}
