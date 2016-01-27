<?php

class SiteController extends Controller {

    public $data = array();
    private $member = null;

    public function init() {

        $listSacredObjectLastInsert = SacredObject::model()->findAll(
                array(
                    'order' => 'obj_updatedate desc',
                    'limit' => '10'
                )
        );

        $listSacredType = Yii::app()->db->createCommand()
                ->select('t.type_id,t.type_name,count(*) cnt')
                ->from('sacred_object o')
                ->join('sacred_type t', 't.type_id =o.type_id')
                ->group('o.type_id')
                ->queryAll();

        $listMemberLastInsert = Member::model()->findAll(
                array(
                    'order' => 'mem_updatedate desc',
                    'limit' => '10'
                )
        );

        $this->data = array(
            'listSacredObjectLastInsert' => $listSacredObjectLastInsert,
            'listSacredType' => $listSacredType,
            'listMemberLastInsert' => $listMemberLastInsert
        );

        if (Yii::app()->session['member']) {
            $this->member = Yii::app()->session['member'];
        } else {
            $this->member = new Member();
        }
    }

    public function actionLogin() {
        if (empty($_POST)) {
            $this->render('login');
        } else {
            $this->member = Member::model()->findByAttributes(array(
                'mem_username' => $_POST['username'],
                'mem_password' => $_POST['password'],
            ));
            if (empty($this->member)) {
                Yii::app()->session['message'] = 'ไม่พบข้อมูลของท่านในระบบ';
                $this->redirect(array('site/login'));
            } else {
                Yii::app()->session['member'] = $this->member;
                $this->redirect(array('site/index'));
            }
        }
    }

    public function actionRegister() {
        if (empty($_POST)) {
            $this->render('register', array(
                'member' => new Member(),
                'action_url' => 'site/register'
            ));
        } else {
            $this->member = new Member();
            $this->member->mem_address = '';
            $this->member->mem_email = $_POST['email'];
            $this->member->mem_username = $_POST['username'];
            $this->member->mem_password = $_POST['password'];
            $this->member->mem_fname = '';
            $this->member->mem_img = '';
            $this->member->mem_level = '';
            $this->member->mem_lname = '';
            $this->member->mem_phone = $_POST['phone'];
            $this->member->mem_sex = $_POST['sex'];
            $this->member->mem_status = 1;
            if ($this->member->save(false)) {
                Yii::app()->session['member'] = $this->member;
                $this->redirect(array('site/index'));
            } else {
                echo 'system error';
                exit();
            }
        }
    }

    public function actionLogout() {
        unset(Yii::app()->session['message']);
        unset(Yii::app()->session['member']);
        $this->redirect(array('site/index'));
    }

    public function actionIndex() {
        $title = 'พระเครื่องยอดนิยม';
        $typeId = (empty($_GET['typeId']) ? '' : $_GET['typeId']);
        $params = array();
        if (!empty($typeId)) {
            $params['type_id'] = $typeId;
            $title = SacredType::model()->findByPk($typeId)->type_name;
        }
        $listSacredObject = SacredObject::model()->findAllByAttributes($params);
        $this->data['listSacredObject'] = $listSacredObject;
        $this->data['title'] = $title;
        $this->render('index', $this->data);
    }

    public function actionDetail($id) {
        $criteria = new CDbCriteria();
        $criteria->select = 'o.*,m.*';
        $criteria->alias = 'o';
        $criteria->join = 'LEFT JOIN member m ON m.mem_id = o.mem_id';
        $criteria->condition = 'o.obj_id = ' . $id;
        $sacredObject = SacredObject::model()->find($criteria);
        
        
        $this->data['sacredObject'] = $sacredObject;
        $params = array();
        if (!empty($sacredObject->mem_id)) {
            $params = array('mem_id' => $sacredObject->mem_id);
        }
        $listSacredObjectRelate = SacredObject::model()->findAllByAttributes($params);
        $this->data['listSacredObjectRelate'] = $listSacredObjectRelate;

        $listSacredObjectImg = SacredObjectImg::model()->findAllByAttributes(array('obj_id' => $id));
        $this->data['listSacredObjectImg'] = $listSacredObjectImg;

        $this->render('detail', $this->data);
    }

    public function actionUpload() {
        if (empty($_POST)) {
            $listSacredType = SacredType::model()->findAll();
            $listProvince = Province::model()->findAll();
            $this->render('upload', array(
                'listSacredType' => $listSacredType,
                'listProvince' => $listProvince
            ));
        } else {
            if (empty($_POST)) {
                echo '';
            } else {

                $pathImage = YiiBase::getPathOfAlias("webroot") . '/images';

                $sacredObject = new SacredObject();
                $sacredObject->obj_born = $_POST['born'];
                $sacredObject->obj_comment = $_POST['comment'];
                $sacredObject->obj_like = 0;
                $sacredObject->obj_name = $_POST['name'];
                $sacredObject->obj_price = $_POST['price'];
                $sacredObject->pro_id = $_POST['province'];
                $sacredObject->type_id = $_POST['type'];
                $sacredObject->mem_id = $this->member->mem_id;
                $sacredObject->obj_updatedate = new CDbExpression('NOW()');

                /*
                 * Manage Image Resize , Rename of File
                 */
                $subDerectory = '/upload_main/';
                $imageName = Utilities::resizeImage($pathImage . $subDerectory, $_FILES, 300, 300);
                /*
                 * Manage Image Resize , Rename of File
                 */
                $sacredObject->obj_img = $subDerectory . $imageName;
                if ($sacredObject->save(false)) {
                    if (!empty($_FILES['fileOther'])) {
                        var_dump($_FILES['fileOther']);
                        $listFileOther = $this->readArrayFiles($_FILES['fileOther']);
                        foreach ($listFileOther as $index => $file) {
                            $sacredImg = new SacredObjectImg();

                            $sacredImg->img_size = $file['size'];
                            $sacredImg->img_ext = $file['type'];
                            $sacredImg->obj_id = $sacredObject->obj_id;
                            /*
                             * Manage Image Resize , Rename of File
                             */
                            $subDerectory = '/upload_other/';
                            $imageName = Utilities::resizeImage($pathImage . $subDerectory, $_FILES, 300, 300);
                            /*
                             * Manage Image Resize , Rename of File
                             */
                            $sacredImg->img_name = $subDerectory . $imageName;
                            if (!$sacredImg->save(false)) {
                                echo CJSON::encode(array(
                                    'status' => false
                                ));
                                exit();
                            }
                        }
                        echo CJSON::encode(array(
                            'status' => true,
                        ));
                    } else {
                        echo CJSON::encode(array(
                            'status' => true,
                        ));
                    }
                }
            }
        }
    }

    public function actionUserSacredList() {
        $listSacredObject = SacredObject::model()->findAllByAttributes(array('mem_id' => $this->member->mem_id));
        $this->data['listSacredObject'] = $listSacredObject;
        $this->render('list-sacred', $this->data);
    }

    public function actionUserFavoriteList() {
        $criteria = new CDbCriteria();
        $criteria->select = 'o.*';
        $criteria->alias = 'o';
        $criteria->join = 'LEFT JOIN member_object_action a ON a.obj_id=o.obj_id';
        $criteria->condition = 'a.act_favorite = 1';

        $listSacredObjectFavorite = SacredObject::model()->findAll($criteria);
        $this->data['listSacredObjectFavorite'] = $listSacredObjectFavorite;
        $this->render('list-favorite', $this->data);
    }

    public function actionUserProfile() {
        $member = Yii::app()->session['member'];
        if (empty($_POST)) {
            $this->render('register', array(
                'member' => $member,
                'profile' => true,
                'password' => false,
                'form_title' => 'แก้ไขข้อมูลส่วนตัว',
                'action_url' => 'site/userprofile'
            ));
        } else {
            $member->mem_fname = $_POST['fname'];
            $member->mem_lname = $_POST['lname'];
            $member->mem_username = $_POST['username'];
            $member->mem_password = $_POST['password'];
            $member->mem_sex = $_POST['sex'];
            $member->mem_phone = $_POST['phone'];
            $member->mem_email = $_POST['email'];
            $member->mem_address = $_POST['address'];
            $member->mem_updatedate = new CDbExpression('NOW()');
            if ($member->save(false)) {
                Yii::app()->session['member'] = $member;
                $this->redirect(array('site/index'));
            } else {
                echo 'system error';
            }
        }
    }

    private function readArrayFiles(&$file_post) {

        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }

        return $file_ary;
    }

}
