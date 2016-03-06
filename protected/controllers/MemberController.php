<?php

class MemberController extends Controller {
    /*
     *  ********************** Function Member ***************************
     */

    public $memberStatusDefault;
    public $memberLevelDefault;

    public function init() {
        $sessionMember = Yii::app()->session['member'];
        if (empty($sessionMember->mem_id)) {
            $this->render('../authen');
            exit();
        }
        /*
         * Load Config
         */
        $this->memberLevelDefault = WebConfig::getValueByKey('default_level');
        $this->memberStatusDefault = WebConfig::getValueByKey('default_object_public');
        /*
         * Load Config
         */
    }

    public function actionIndex($id = null) {


        $member = new Member();
        if (!empty($id)) {
            $member = Member::model()->findByPk($id);
        }

        $listMember = Member::model()->findAll();
        $listLevel = MemberLevel::model()->findAll();

        $this->render('index_member', array(
            'member' => $member,
            'listMember' => $listMember,
            'listLevel' => $listLevel
        ));
    }

    public function actionMemberSave() {
        if (empty($_POST['id'])) {
            $member = new Member();
        } else {
            $member = Member::model()->findByPk($_POST['id']);
        }
        $member->mem_address = $_POST['address'];
        $member->mem_email = $_POST['email'];
        $member->mem_fname = $_POST['fname'];
        $member->mem_img = $_POST['img'];
        $member->mem_level = $_POST['level'];
        $member->mem_lname = $_POST['lname'];
        $member->mem_status = $_POST['status'];
        $member->mem_phone = $_POST['phone'];
        $member->mem_sex = $_POST['sex'];
        $member->mem_updatedate = new CDbExpression('NOW()');

        if ($member->save(false)) {
            $this->redirect(array('member/index'));
        } else {
            echo 'System Error';
        }
    }

    public function actionMemberDelete($id) {
        if (Member::model()->findByPk($id)->delete()) {
            $this->redirect(array('member/index'));
        }
    }

    /*
     *  ********************** Function Member ***************************
     */

    public function actionIndexLevel($id = null) {
        $level = new MemberLevel();
        if (!empty($id)) {
            $level = MemberLevel::model()->findByPk($id);
        }

        $listLevel = MemberLevel::model()->findAll();

        $this->render('index_level', array(
            'level' => $level,
            'listLevel' => $listLevel
        ));
    }

    public function actionLevelSave() {
        if (empty($_POST['id'])) {
            $level = new MemberLevel();
        } else {
            $level = MemberLevel::model()->findByPk($_POST['id']);
        }
        $level->level_name = $_POST['name'];
        $level->level_updatedate = new CDbExpression('NOW()');

        if ($level->save(false)) {
            $this->redirect(array('member/indexLevel'));
        } else {
            echo 'System Error';
        }
    }

    public function actionLevelDelete($id) {
        if (MemberLevel::model()->findByPk($id)->delete()) {
            $this->redirect(array('member/indexLevel'));
        }
    }

}
