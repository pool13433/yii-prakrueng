<?php

class SiteController extends Controller {

    public $data = array();

    public function init() {

        $listSacredObjectLastInsert = SacredObject::model()->findAll(
                array('order' => 'obj_updatedate desc')
        );

        $listSacredType = Yii::app()->db->createCommand()
                ->select('t.type_id,t.type_name,count(*) cnt')
                ->from('sacred_object o')
                ->join('sacred_type t', 't.type_id =o.type_id')
                ->group('o.type_id')
                ->queryAll();
        $this->data = array(
            'listSacredObjectLastInsert' => $listSacredObjectLastInsert,
            'listSacredType' => $listSacredType
        );
    }

    public function actionLogin() {
        if (empty($_POST)) {            
            $this->render('login');
        } else {
            $member = Member::model()->findByAttributes(array(
                'mem_username' => $_POST['username'],
                'mem_password' => $_POST['password'],
            ));
            if (empty($member)) {
                Yii::app()->session['message']='ไม่พบข้อมูลของท่านในระบบ';
                $this->redirect(array('site/login'));
            } else {
                Yii::app()->session['member'] = $member;
                $this->redirect(array('site/index'));                
            }
        }
    }

    public function actionRegister() {
        if (empty($_POST)) {
            $this->render('register');
        } else {
            $member = new Member();
            $member->mem_address = '';
            $member->mem_email = $_POST['email'];
            $member->mem_username = $_POST['username'];
            $member->mem_password = $_POST['password'];
            $member->mem_fname = '';
            $member->mem_img = '';
            $member->mem_level = '';
            $member->mem_lname = '';
            $member->mem_phone = $_POST['phone'];
            $member->mem_sex = $_POST['sex'];
            $member->mem_status = 1;
            if ($member->save(false)) {
                Yii::app()->session['member'] = $member;
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
        $sacredObject = SacredObject::model()->findByPk($id);
        $this->data['sacredObject'] = $sacredObject;

        $listSacredObjectImg = SacredObjectImg::model()->findAllByAttributes(array('obj_id' => $id));
        $this->data['listSacredObjectImg'] = $listSacredObjectImg;

        $this->render('detail', $this->data);
    }

}
