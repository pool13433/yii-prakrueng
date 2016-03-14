<?php

/**
 * This is the model class for table "sacred_news".
 *
 * The followings are the available columns in table 'sacred_news':
 * @property integer $news_id
 * @property string $news_title
 * @property string $news_detail
 * @property string $news_link
 * @property string $news_img
 * @property integer $mem_id
 * @property string $news_updatedate
 * @property integer $news_status
 */
class SacredNews extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sacred_news';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('news_title, news_detail, news_img,mem_id, news_updatedate, news_status', 'required'),
            array('mem_id, news_status', 'numerical', 'integerOnly' => true),
            array('news_title', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('news_id, news_title, news_detail,news_link, mem_id, news_updatedate, news_status', 'safe', 'on' => 'search'),
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
            'news_id' => 'News',
            'news_title' => 'News Title',
            'news_detail' => 'News Detail',
            'news_link' => 'News Link',
            'news_img' => 'news_img',
            'mem_id' => 'Mem',
            'news_updatedate' => 'News Update',
            'news_status' => 'News Status',
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

        $criteria->compare('news_id', $this->news_id);
        $criteria->compare('news_title', $this->news_title, true);
        $criteria->compare('news_detail', $this->news_detail, true);
        $criteria->compare('news_link', $this->news_link, true);
        $criteria->compare('mem_id', $this->mem_id);
        $criteria->compare('news_updatedate', $this->news_updatedate, true);
        $criteria->compare('news_status', $this->news_status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SacredNews the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    protected function afterFind() {
        // convert to display format
        $this->news_updatedate = strtotime($this->news_updatedate);
        $this->news_updatedate = date('m/d/Y', $this->news_updatedate);
        parent::afterFind();
    }

}
