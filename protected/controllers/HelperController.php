<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class HelperController extends Controller {

    public function actionUpdateSacredObjectView($id) {
        $sacredObject = SacredObject::model()->findByPk($id);
        $sacredObject->obj_view = $sacredObject->obj_view + 1;
        if ($sacredObject->save(false)) {
            echo CJSON::encode(array('status' => true));
        } else {
            echo CJSON::encode(array('status' => false));
        }
    }

    public function actionGetMemberObjectAction($id) {
        $member = Yii::app()->session['member'];
        $memberObjectAction = MemberObjectAction::model()->findByAttributes(array(
            'obj_id' => $id,
            'mem_id' => $member->mem_id
        ));
        echo CJSON::encode($memberObjectAction);
    }

    public function actionUpdateMemberObjectAction() {
        if (!empty($_GET)) {
            $id = $_GET['id'];
            $value = $_GET['value'];

            $member = Yii::app()->session['member'];
            if (empty($member)) {
                 echo CJSON::encode(array(
                    'status' => false,
                    'title' => 'ไม่สามารถลงปล่อยพระเครื่องให้เช่าได้',
                    'message' => 'ท่านยังไม่ได้ Login เข้าระบบ กรุณา Login เข้าระบบก่อน',
                    'url' => Yii::app()->createUrl('site/login')
                ));
                exit(0);
            } else {
                $memberObjectAction = MemberObjectAction::model()->findByAttributes(array(
                    'obj_id' => $id,
                    'mem_id' => $member->mem_id
                ));
                if (!$memberObjectAction) {
                    $memberObjectAction = new MemberObjectAction();
                    $memberObjectAction->mem_id = $member->mem_id;
                    $memberObjectAction->obj_id = $id;
                    $memberObjectAction->act_updatedate = new CDbExpression('NOW()');
                }
                if ($_GET['action'] == 'LIKE') {
                    $memberObjectAction->act_like = $value;
                } else if ($_GET['action'] == 'FAVORITE') {
                    $memberObjectAction->act_favorite = $value;
                }
                echo CJSON::encode(array(
                    'status' => $memberObjectAction->save()
                ));
            }
        }
    }

}
