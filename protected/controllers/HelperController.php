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

    public function actionCollectionCriteria() {
        $criteria = array();
        $criteriaFilter = new CriteriaFilter();
        $collectionType = $criteriaFilter->collectionType;
        $collectionRegion = $criteriaFilter->collectionRegion;
        $collectionForm = $criteriaFilter->collectionForm;
        //Yii::app()->session['criteria'] = null;
        if (!empty(Yii::app()->session['criteria'])) {
            $criteria = Yii::app()->session['criteria'];
            $collectionType = $criteria['types'];
            $collectionForm = $criteria['form'];
            $collectionRegion = $criteria['region'];
        } else {
            Yii::app()->session['criteria'] = array(
                'types' => $collectionType,
                'form' => $collectionForm,
                'region' => $collectionRegion
            );
        }
        if (!empty($_POST)) {

            if (is_numeric($_POST['checked']) && !empty($_POST['value'])) {
                $checked = $_POST['checked'];
                $value = intval($_POST['value']);
                if ($_POST['group'] == 'REGION') {
                    if ($checked == 1) {
                        $collectionRegion[$value] = $value;
                    } else {
                        if (($key = array_search($value, $collectionRegion)) != false) {
                            unset($collectionRegion[$key]);
                        }
                    }
                } else if ($_POST['group'] == 'TYPE') {
                    if ($checked == 1) {
                        $collectionType[$value] = $value;
                    } else {
                        if (($key = array_search($value, $collectionType)) != false) {
                            unset($collectionType[$key]);
                        }
                    }
                }
            }

            if (!empty($_POST['price_begin']) && !empty($_POST['price_end'])) {
                $collectionForm['price_begin'] = $_POST['price_begin'];
                $collectionForm['price_end'] = $_POST['price_end'];
            } else {
                $collectionForm['price_begin'] = '';
                $collectionForm['price_end'] = '';
            }
            if (!empty($_POST['born_begin']) && !empty($_POST['born_end'])) {
                $collectionForm['born_begin'] = $_POST['born_begin'];
                $collectionForm['born_end'] = $_POST['born_end'];
            } else {
                $collectionForm['born_begin'] = '';
                $collectionForm['born_end'] = '';
            }
            $criteria['form'] = $collectionForm;
            $criteria['types'] = $collectionType;
            $criteria['region'] = $collectionRegion;
            Yii::app()->session['criteria'] = $criteria;
        }
        echo CJSON::encode($criteria);
    }

}
