<?php

class SacredController extends Controller {

    public $imagePath = "";
    //public $imageSize = 400;
    private $imageWeight = 800;
    private $imageHeight = 600;
    private $resizeUpload = 0.5;

    public function init() {
        $sessionMember = Yii::app()->session['member'];
        if (empty($sessionMember->mem_id)) {
            $this->render('../authen');
            exit();
        }
        $this->imagePath = YiiBase::getPathOfAlias("webroot") . '/images';
    }

    public function actionIndex($id = null) {
        $sacred = new SacredObject();
        if (!empty($id)) {
            $sacred = SacredObject::model()->findByPk($id);
        }
        $criteria = new CDbCriteria();
        $criteria->select = ' o.*,(SELECT count(*) FROM sacred_object_img i WHERE i.obj_id = o.obj_id) as count_img';
        $criteria->alias = 'o';
        $listSacredObject = SacredObject::model()->findAll($criteria);

        $listProvince = Province::model()->findAll(array('order' => 'pro_name_th'));
        $listSacredType = SacredType::model()->findAll();
        $listYear = Utilities::getYear();

        $this->render('index_object', array(
            'sacred' => $sacred,
            'listSacredObject' => $listSacredObject,
            'listProvince' => $listProvince,
            'listSacredType' => $listSacredType,
            'listYear' => $listYear
        ));
    }

    public function actionObjectSave() {
        if (empty($_POST['id'])) {
            $sacred = new SacredObject();
        } else {
            $sacred = SacredObject::model()->findByPk($_POST['id']);
        }
        if (!empty($_FILES['fileMain']['name']) && is_array($_FILES['fileMain'])) {
            $filename = $this->imagePath . $sacred->obj_img;
            if (file_exists($filename)) {
                unlink($filename);
            }
            $utility = new Utilities();
            /*
             * Manage Image Resize , Rename of File
             */
            $subDerectory = '/upload_main/';
            $imageName = $utility->resizeImage($this->imagePath . $subDerectory, $_FILES['fileMain'], $this->imageWeight, $this->imageHeight);
            $sacred->obj_img = $subDerectory . $imageName;
            /*
             * Manage Image Resize , Rename of File
             */
        }

        $sacred->obj_comment = $_POST['comment'];
        $sacred->obj_like = 1; //$_POST['like'];
        $sacred->obj_name = $_POST['name'];
        $sacred->obj_price = $_POST['price'];
        $sacred->obj_born = $_POST['year'];
        $sacred->type_id = $_POST['type'];
        $sacred->pro_id = $_POST['province'];
        $sacred->obj_updatedate = new CDbExpression('NOW()');

        if ($sacred->save(false)) {
            $this->redirect(array('sacred/index'));
        } else {
            echo 'System Error';
        }
    }

    public function actionObjectDelete($id) {
        $object = SacredObject::model()->findByPk($id);
        $filename = $this->imagePath . $object->obj_img;
        if (file_exists($filename)) {
            unlink($filename);
        }
        if ($object->delete()) {
            $this->redirect(array('sacred/index'));
        }
    }

    /*
     * *************************** Sacred Object Type **************************************
     */

    public function actionIndexType($id = null) {
        $sacredType = new SacredType();
        if (!empty($id)) {
            $sacredType = SacredType::model()->findByPk($id);
        }

        $listSacredType = SacredType::model()->findAll();
        $this->render('index_type', array(
            'listSacredType' => $listSacredType,
            'sacredType' => $sacredType
        ));
    }

    public function actionTypeSave() {
        if (empty($_POST['id'])) {
            $sacredType = new SacredType();
        } else {
            $sacredType = SacredType::model()->findByPk($_POST['id']);
        }
        $sacredType->type_name = $_POST['name'];
        $sacredType->type_updatedate = new CDbExpression('NOW()');

        if ($sacredType->save(false)) {
            $this->redirect(array('sacred/indexType'));
        } else {
            echo 'System Error';
        }
    }

    public function actionTypeDelete($id) {
        if (SacredType::model()->findByPk($id)->delete()) {
            $this->redirect(array('sacred/indexType'));
        }
    }

    /*
     * *************************** Sacred Object Type **************************************
     */


    /*
     * *************************** Sacred Object Province **************************************
     */

    public function actionIndexProvince($id = null) {
        $province = new Province();
        if (!empty($id)) {
            $province = Province::model()->findByPk($id);
        }
        $listRegion = Region::model()->findAll(array(
            'order' => 'reg_id'
        ));
        $listProvince = Province::model()->findAll(array(
            'order' => 'pro_name_th desc',
        ));
        $this->render('index_province', array(
            'listProvince' => $listProvince,
            'province' => $province,
            'listRegion' => $listRegion
        ));
    }

    public function actionProvinceSave() {
        if (empty($_POST['id'])) {
            $province = new Province();
        } else {
            $province = Province::model()->findByPk($_POST['id']);
        }
        $province->pro_name_th = $_POST['name_th'];
        $province->pro_name_eng = $_POST['name_eng'];
        $province->reg_id = $_POST['region'];
        $province->pro_updatedate = new CDbExpression('NOW()');

        if ($province->save(false)) {
            $this->redirect(array('sacred/indexProvince'));
        } else {
            echo 'System Error';
        }
    }

    public function actionProvinceDelete($id) {
        if (Province::model()->findByPk($id)->delete()) {
            $this->redirect(array('sacred/indexProvince'));
        }
    }

    /*
     * *************************** Sacred Object Province **************************************
     */


    /*
     * *************************** Sacred Object News **************************************
     */

    public function actionIndexNews($id = null) {
        $news = new SacredNews();
        if (!empty($id)) {
            $news = SacredNews::model()->findByPk($id);
        }

        $listNews = SacredNews::model()->findAll();
        $this->render('index_news', array(
            'listNews' => $listNews,
            'news' => $news
        ));
    }

    public function actionNewsSave() {
        $pathImage = YiiBase::getPathOfAlias("webroot") . '/images';
        if (empty($_POST['id'])) {
            $news = new SacredNews();
        } else {
            $news = SacredNews::model()->findByPk($_POST['id']);
        }
        $utility = new Utilities();
        $currentDate = date('Ymd');
        if (!empty($_FILES['image']['name'])) {
            $subDerectoryMain = '/upload_news/' . $currentDate . '_';
            $imageName = $utility->resizeImagePercent($pathImage . $subDerectoryMain, $_FILES['image'], $this->resizeUpload);
            $news->news_img = $subDerectoryMain . $imageName;
        } else {
            $news->news_img = '';
        }
        $news->news_title = $_POST['title'];
        $news->news_detail = $_POST['detail'];
        $news->news_link = $_POST['link'];
        $news->news_updatedate = new CDbExpression('NOW()');

        if ($news->save(false)) {
            $this->redirect(array('sacred/indexNews'));
        } else {
            echo 'System Error';
        }
    }

    public function actionNewsDelete($id) {
        if (SacredNews::model()->findByPk($id)->delete()) {
            $this->redirect(array('sacred/indexNews'));
        }
    }

    /*
     * *************************** Sacred Object Province **************************************
     */


    /*
     * *************************** Region **************************************
     */

    public function actionIndexRegion($id = null) {
        $region = new Region();
        if (!empty($id)) {
            $region = Region::model()->findByPk($id);
        }

        $listRegion = Region::model()->findAll();
        $this->render('index_region', array(
            'listRegion' => $listRegion,
            'region' => $region
        ));
    }

    public function actionRegionSave() {
        if (empty($_POST['id'])) {
            $region = new Region();
        } else {
            $region = Region::model()->findByPk($_POST['id']);
        }
        $region->reg_name = $_POST['name'];
        $region->reg_updatedate = new CDbExpression('NOW()');

        if ($region->save(false)) {
            $this->redirect(array('sacred/indexRegion'));
        } else {
            echo 'System Error';
        }
    }

    public function actionRegionDelete($id) {
        if (Region::model()->findByPk($id)->delete()) {
            $this->redirect(array('sacred/indexRegion'));
        }
    }

    /*
     * *************************** Region **************************************
     */

    /*
     * *************************** Rules **************************************
     */

    public function actionIndexRules($id = null) {
        $rules = new SacredRules();
        if (!empty($id)) {
            $rules = SacredRules::model()->findByPk($id);
        }

        $listRules = SacredRules::model()->findAll();
        $this->render('index_rules', array(
            'listRules' => $listRules,
            'rules' => $rules
        ));
    }

    public function actionRulesSave() {
        if (empty($_POST['id'])) {
            $rules = new SacredRules();
        } else {
            $rules = SacredRules::model()->findByPk($_POST['id']);
        }
        $rules->rul_desc = $_POST['desc'];
        $rules->rul_updatedate = new CDbExpression('NOW()');
        //var_dump($rules->save());
        //exit();
        if ($rules->save()) {
            $this->redirect(array('sacred/indexRules'));
        } else {
            echo 'System Error';
        }
    }

    public function actionRulesDelete($id) {
        if (SacredRules::model()->findByPk($id)->delete()) {
            $this->redirect(array('sacred/indexRules'));
        }
    }

    /*
     * *************************** Rules **************************************
     */
}
