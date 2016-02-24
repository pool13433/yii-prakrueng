<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class HelperController extends Controller {

    public function init() {
        header('Content-Type: application/json');
        parent::init();
    }

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
        $memberObjectAction = new MemberObjectAction();
        if ($member) {
            $memberObjectAction = MemberObjectAction::model()->findByAttributes(array(
                'obj_id' => $id,
                'mem_id' => $member->mem_id
            ));
        }
        echo CJSON::encode($memberObjectAction);
    }

    public function actionUpdateMemberObjectAction() {
        if (empty(Yii::app()->session['member']->mem_id)) {
            Yii::app()->session['last_url'] = Yii::app()->createUrl('site/detail/' . $_GET['id']);
            echo CJSON::encode(array(
                'status' => false,
                'message' => 'กรุณา Login เข้าระบบก่อน',
                'url' => Yii::app()->createUrl('site/login')
            ));
        } else {
            $status = false;
            if (!empty($_GET)) {
                $id = $_GET['id'];
                $value = ($_GET['value'] == "0" ? "1" : "0");

                $member = Yii::app()->session['member'];
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

                $sacredObject = SacredObject::model()->findByPk($id);
                if ($_GET['action'] == 'LIKE') {
                    $memberObjectAction->act_like = $value;
                    if ($value == 0) {
                        $sacredObject->obj_like = ($sacredObject->obj_like + 1);
                    } else {
                        $sacredObject->obj_like = ($sacredObject->obj_like - 1);
                    }
                } else if ($_GET['action'] == 'FAVORITE') {
                    $memberObjectAction->act_favorite = $value;
                }
                $status = $memberObjectAction->save(false);

                $sacredObject->obj_updatedate = new CDbExpression('NOW()');
                $status = $sacredObject->save(false);

                echo CJSON::encode(array(
                    'status' => $status,
                    'object' => $sacredObject,
                    'action' => $memberObjectAction,
                    'message' => '',
                    'url' => ''
                ));
            }
        }
    }

    public function actionRemoveMemberObjectActionFavorite() {
        if (empty(Yii::app()->session['member']->mem_id)) {
            Yii::app()->session['last_url'] = Yii::app()->createUrl('site/userfavoritelist');
            echo CJSON::encode(array(
                'status' => false,
                'message' => 'กรุณา Login เข้าระบบก่อน',
                'url' => Yii::app()->createUrl('site/login')
            ));
        } else {
            $status = false;
            if (!empty($_GET)) {
                $id = $_GET['id'];
                $value = $_GET['value'];

                $member = Yii::app()->session['member'];
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
                $memberObjectAction->act_favorite = $value;
                $status = $memberObjectAction->save(false);

                echo CJSON::encode(array(
                    'status' => $status,
                    'action' => $memberObjectAction,
                    'message' => '',
                    'url' => ''
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
            if (empty($_POST['price_begin']) && empty($_POST['price_end']) &&
                    empty($_POST['born_begin']) && empty($_POST['born_end']) && empty($_POST['freedom'])) {
                $collectionForm = $criteriaFilter->collectionForm;
            } else {
                if (!empty($_POST['price_begin']) && !empty($_POST['price_end'])) {
                    $collectionForm['price_begin'] = $_POST['price_begin'];
                    $collectionForm['price_end'] = $_POST['price_end'];
                }
//            else {
//                $collectionForm['price_begin'] = '';
//                $collectionForm['price_end'] = '';
//            }
                if (!empty($_POST['born_begin']) && !empty($_POST['born_end'])) {
                    $collectionForm['born_begin'] = $_POST['born_begin'];
                    $collectionForm['born_end'] = $_POST['born_end'];
                }
//            else {
//                $collectionForm['born_begin'] = '';
//                $collectionForm['born_end'] = '';
//            }
                if (!empty($_POST['freedom'])) {
                    $collectionForm['freedom'] = $_POST['freedom'];
                }
//            else{
//                $collectionForm['freedom'] = '';
//            }
            }
            $criteria['form'] = $collectionForm;
            $criteria['types'] = $collectionType;
            $criteria['region'] = $collectionRegion;
            Yii::app()->session['criteria'] = $criteria;
        }
        echo CJSON::encode($criteria);
    }

    public function actionUpdateSacredStatus() {
        if (!empty($_POST)) {
            $id = $_POST['id'];
            $status = $_POST['status'];
//            $object = SacredObject::model()->updateByPk($id, array(
//                'obj_status' => $status,
//                'obj_updatedate' => new CDbExpression('NOW()')
//            ));            
            $object = SacredObject::model()->findByPk($id);
            $object->obj_status = $status;
            $object->obj_updatedate = new CDbExpression('NOW()');
            echo CJSON::encode(array(
                'status' => $object->update(),
                'message' => '',
                'url' => '',
            ));
        }
    }

    public function actionPostComment() {
        if (!empty($_POST)) {
            $objectId = $_POST['id'];
            $message = $_POST['message'];

            if (empty(Yii::app()->session['member']->mem_id)) {
                Yii::app()->session['last_url'] = Yii::app()->createUrl('site/detail/' . $objectId);
                echo CJSON::encode(array(
                    'status' => false,
                    'message' => 'กรุณา Login เข้าระบบก่อน',
                    'url' => Yii::app()->createUrl('site/login')
                ));
            } else {
                $question = new WbQuestion();
                $question->ques_message = $message;
                $question->ques_like = 0;
                $question->ques_updatedate = new CDbExpression('NOW()');
                $question->obj_id = $objectId;
                $question->mem_id = Yii::app()->session['member']->mem_id;

                if ($question->save()) {
                    $listQuestionAction = Yii::app()->db->createCommand()
                            ->select('q.*,qa.act_id,qa.act_like,m.mem_id,qa.act_updatedate,m.mem_fname,m.mem_lname')
                            ->from('wb_question q')
                            ->leftJoin('wb_question_action qa', 'qa.ques_id = q.ques_id')
                            ->join('member m', 'm.mem_id = q.mem_id')
                            ->where('q.obj_id =:objId and q.ques_id =:quesId', array(
                                ':objId' => $objectId,
                                ':quesId' => $question->ques_id))
                            ->queryRow();
                    echo CJSON::encode(array(
                        'status' => true,
                        'comment' => $listQuestionAction,
                        'message' => '',
                        'url' => ''
                    ));
                }
            }
        }
    }

    public function actionUpdateLikeComment() {
        if (!empty($_POST)) {
            if (empty(Yii::app()->session['member']->mem_id)) {
                Yii::app()->session['last_url'] = Yii::app()->createUrl('site/detail/' . $_POST['objectId']);
                echo CJSON::encode(array(
                    'status' => false,
                    'message' => 'กรุณา Login เข้าระบบก่อน',
                    'url' => Yii::app()->createUrl('site/login')
                ));
            } else {

                $like = $_POST['like'];
                $commentId = $_POST['commentId'];
                $action = WbQuestionAction::model()->findByAttributes(array(
                    'ques_id' => $commentId,
                    'mem_id' => Yii::app()->session['member']->mem_id
                ));
                if (!$action) {
                    $action = new WbQuestionAction();
                    $action->mem_id = Yii::app()->session['member']->mem_id;
                    $action->ques_id = $commentId;
                    $action->act_updatedate = new CDbExpression('NOW()');
                }
                $action->act_like = $like;

                $question = WbQuestion::model()->findByPk($commentId);
                if ($like == 0) {
                    $question->ques_like = ($question->ques_like - 1);
                } else {
                    $question->ques_like = ($question->ques_like + 1);
                }
                if ($question->save()) {
                    if ($action->save(false)) {
                        echo CJSON::encode(array(
                            'status' => true,
                            'question' => $question
                        ));
                    } else {
                        
                    }
                } else {
                    echo 'System Error';
                }
            }
        }
    }

    public function actionAuthen() {
        if (empty($_POST)) {
            
        } else {
            $status = false;
            $member = new Member();
            $facebook_id = $_POST['facebook_id'];
            if (!empty($facebook_id)) {
                $member = Member::model()->findByAttributes(array(
                    'facebook_id' => $facebook_id
                ));
                if ($member) {
                    $status = true;
                }
            }
            echo CJSON::encode(array(
                'status' => $status,
                'member' => $member
            ));
        }
    }

    public function actionLoginFB() {
        $member = new Member();
        $member->mem_email = '*';
        $member->facebook_id = $_POST['facebook_id'];
        $member->mem_updatedate = new CDbExpression('NOW()');
        $member->mem_level = 1;
        $member->mem_status = 1;
        $member->mem_username = '*';
        $status = false;
        if ($member->save(false)) {
            Yii::app()->session['member'] = $member;
            $status = true;
        }
        echo CJSON::encode(array(
            'status' => $status,
            'member' => $member
        ));
    }

    public function actionRemoveImage() {
        if (!empty($_POST)) {
            $baseImage = YiiBase::getPathOfAlias("webroot") . '/images';

            $imageId = $_POST['id'];
            $image = SacredObjectImg::model()->findByPk($imageId);
            $filename = $baseImage . $image->img_name;
            if (file_exists($filename)) {
                unlink($filename);
            }
            $status = $image->delete();
            echo CJSON::encode(array(
                'status' => $status
            ));
        }
    }

}
