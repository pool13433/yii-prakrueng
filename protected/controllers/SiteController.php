<?php

class SiteController extends Controller {

    public $data = array();
    private $member = null;
    private $imageWidth = 800;
    private $imageHeight = 600;
    public $publicStatus;
    public $memberStatusDefault;
    public $memberLevelDefault;
    public $regionDefault = 3;
    //memberLevelDefault

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

        $criteria = new CDbCriteria();
        $criteria->select = 'r.reg_id,r.reg_name,(SELECT COUNT(*) FROM province p WHERE p.reg_id = r.reg_id) cnt';
        $criteria->alias = 'r';
        
        // east region
        //$criteria->compare('r.reg_id', $this->regionDefault);
        //$region = Region::model()->find($criteria);        
        $listRegion = Region::model()->findAll($criteria);
        
        $this->data = array(
            'listSacredObjectLastInsert' => $listSacredObjectLastInsert,
            'listSacredType' => $listSacredType,
            'listMemberLastInsert' => $listMemberLastInsert,
            'listRegion' => $listRegion
        );

        if (Yii::app()->session['member']) {
            $this->member = Yii::app()->session['member'];
        } else {
            $this->member = new Member();
        }

        /*
         * Load Config
         */
        $this->memberLevelDefault = WebConfig::getValueByKey('default_level');
        $this->memberStatusDefault = WebConfig::getValueByKey('default_object_public');
        $this->publicStatus = WebConfig::getValueByKey('default_status');
        /*
         * Load Config
         */
    }

    public function actionLogin() {
        if (empty($_POST)) {
            $config = WebConfig::model()->findByAttributes(array('name' => 'facebook_appid'));
            $this->render('login', array('config' => $config));
        } else {
            $this->member = Member::model()->findByAttributes(array(
                'mem_username' => $_POST['username'],
                'mem_password' => $_POST['password'],
            ));
            if (empty($this->member)) {
                Yii::app()->session['message'] = 'ไม่พบข้อมูลของท่านในระบบ';
//$this->redirect(array('site/login'));
                echo CJSON::encode(array(
                    'status' => false,
                    'message' => 'ไม่พบข้อมูลของท่านในระบบ',
                    'url' => ''
                ));
            } else {
                Yii::app()->session['member'] = $this->member;
                $url = Yii::app()->createUrl('site/index');
                if (!empty(Yii::app()->session['last_url'])) {
                    $url = Yii::app()->session['last_url'];
                }
                echo CJSON::encode(array(
                    'status' => true,
                    'message' => '',
                    'url' => $url
                ));
            }
        }
    }

    public function actionRegister() {
        if (empty($_POST)) {
            $this->render('register', array(
                'member' => new Member(),
                'action_url' => Yii::app()->createUrl('site/register')
            ));
        } else {
            if (empty($_POST['id'])) {
                $this->member = new Member();
            } else {
                $this->member = Member::model()->findByPk($this->member->mem_id);
                $this->member->mem_fname = $_POST['fname'];
                $this->member->mem_lname = $_POST['lname'];
                $this->member->mem_address = $_POST['address'];
            }
            $this->member->mem_email = $_POST['email'];
            $this->member->mem_username = $_POST['username'];
            $this->member->mem_password = $_POST['password'];
            $this->member->mem_img = '';
            $this->member->mem_level = $this->memberLevelDefault;
            $this->member->mem_phone = $_POST['phone'];
            $this->member->mem_sex = $_POST['sex'];
            $this->member->mem_status = $this->memberStatusDefault;
            if ($this->member->save(false)) {
                Yii::app()->session['member'] = $this->member;
                echo CJSON::encode(array(
                    'status' => true,
                    'message' => 'ลงทะเบียน สำเร็จ',
                    'url' => Yii::app()->createUrl('site/index')
                ));
            } else {
                echo CJSON::encode(array(
                    'status' => false,
                    'message' => 'เกิดข้อผิดพลาดไม่สามรถลงทะเบียนเข้าใช้งานระบบได้',
                    'url' => ''
                ));
            }
        }
    }

    public function actionLogout() {
        unset(Yii::app()->session['message']);
        unset(Yii::app()->session['member']);
        unset(Yii::app()->session['criteria']);
        unset(Yii::app()->session['last_url']);
        $this->redirect(array('site/index'));
    }

    public function actionIndex() {

        $where_condition = ' obj_status = ' . $this->publicStatus . ' ';
        $pagin_page_size = 15;
        $pagin_page_current = (empty($_GET['page']) ? '1' : $_GET['page']);
        $mem_id = (empty($_GET['user']) ? '' : $_GET['user']);

        $title = 'พระเครื่องยอดนิยม';
        $typeId = (empty($_GET['typeId']) ? '' : $_GET['typeId']);
        $criteria = new CDbCriteria();
        $criteria->select = 'o.*';
        $criteria->alias = 'o';
        $criteria->join = 'LEFT JOIN province p ON p.pro_id = o.pro_id';
        /* if (!empty($typeId)) {
          $where_condition .= 'AND type_id = ' . $typeId;
          $criteria->compare('o.type_id', $typeId);
          $title = SacredType::model()->findByPk($typeId)->type_name;
          } */
        $criteria->compare('obj_status', $this->publicStatus);
        if (!empty($mem_id)) {
            $where_condition .= 'AND mem_id = ' . $mem_id;
            $criteria->compare('o.mem_id', $mem_id, true);
        }
        if (!empty(Yii::app()->session['criteria'])) {
            $criterias = Yii::app()->session['criteria'];
            $criteriaType = $criterias['types'];
            $criteriaRegion = $criterias['region'];
            $criteriaForm = $criterias['form'];
            if (!empty($criteriaForm['price_begin']) && !empty($criteriaForm['price_end'])) {
                $criteria->addBetweenCondition('o.obj_price', $criteriaForm['price_begin'], $criteriaForm['price_end']);
                $where_condition .= ' AND (obj_price between ' . $criteriaForm['price_begin'] . ' AND ' . $criteriaForm['price_end'] . ') ';
            }
            if (!empty($criteriaForm['born_begin']) && !empty($criteriaForm['born_end'])) {
                $criteria->addBetweenCondition('o.obj_born', $criteriaForm['born_begin'], $criteriaForm['born_end']);
                $where_condition .= ' AND (obj_born between ' . $criteriaForm['born_begin'] . ' AND ' . $criteriaForm['born_end'] . ') ';
            }
            if (!empty($criteriaForm['freedom'])) {
                $criteria->compare('o.obj_name', $criteriaForm['freedom'], true);
                $where_condition .= " AND o.obj_name like '%" . $criteriaForm['freedom'] . "%' ";
            }
            if (count($criteriaType) > 0) {
                $arrayCriteria = array();
                foreach ($criteriaType as $key => $value) {
                    $arrayCriteria[] = $value;
                }
                $arrayString = implode(',', $arrayCriteria);
                $criteria->addInCondition('o.type_id', $arrayCriteria);
                $where_condition .= ' AND type_id in (' . $arrayString . ') ';
            }
            if (count($criteriaRegion) > 0) {
                $arrayCriteria = array();
                foreach ($criteriaRegion as $key => $value) {
                    $arrayCriteria[] = $value;
                }
                $arrayString = implode(',', $arrayCriteria);
                $criteria->addInCondition('o.pro_id', $arrayCriteria);
                $where_condition .= ' AND o.pro_id in (' . $arrayString . ') ';
            }
        }
        $criteria->order = 'o.obj_updatedate desc';

        $criteria->limit = $pagin_page_size;
        $criteria->offset = ($pagin_page_current - 1) * $pagin_page_size;
//var_dump($criteria);
//exit();
        $listSacredObject = SacredObject::model()->findAll($criteria);
        $this->data['listSacredObject'] = $listSacredObject;
        $this->data['title'] = $title;

        /*
         * pagination logic 
         */

        $count_object = Yii::app()->db->createCommand()
                ->select('count(*)')
                ->from('sacred_object o')
                ->join('province p', 'p.pro_id = o.pro_id')
                ->where($where_condition)
                ->queryScalar();
        $pagin_page_count = $count_object;
        $pagin_page_all = ceil($pagin_page_count / $pagin_page_size);
        $paramsBegin = array(
            'user' => $mem_id
        );
        if (1 == $pagin_page_current) {
            $paramsBegin['page'] = 1;
        } else {
            $paramsBegin['page'] = ($pagin_page_current - 1);
        }
        $paramsEnd = array();

        if ($pagin_page_all == $pagin_page_current) {
            $paramsEnd['page'] = $pagin_page_all;
        } else {
            $paramsEnd['page'] = ($pagin_page_current + 1);
        }
        if (!empty($mem_id)) {
            $paramsEnd['user'] = $mem_id;
            $paramsBegin['user'] = $mem_id;
        }
        $pagin_url_begin = ($pagin_page_count > 0 ? Yii::app()->createUrl('site/index', $paramsBegin) : 'javascript:void(0)');
        $pagin_url_end = ($pagin_page_count > 0 ? Yii::app()->createUrl('site/index', $paramsEnd) : 'javascript:void(0)');

        $this->data['pagination'] = array(
            'page_size' => $pagin_page_size,
            'page_count' => $pagin_page_count,
            'page_current' => $pagin_page_current,
            'page_all' => $pagin_page_all,
            'page_type_id' => $typeId,
            'page_user_id' => $mem_id,
            'page_url_begin' => $pagin_url_begin,
            'page_url_end' => $pagin_url_end
        );
        /*
         * pagiation logic
         */

        $listSacredNews = SacredNews::model()->findAll(array(
            'order' => 'news_updatedate desc',
            'limit' => 10
        ));
        $this->data['listSacredNews'] = $listSacredNews;
        /*
         * Meta SEO Tag
         */
        $metaDescription = 'พระเครื่อง';
        $sacredObjectType = SacredType::model()->findAll();
        foreach ($sacredObjectType as $index => $type) {
            $metaDescription .= ',' . $type['type_name'];
        }
        foreach ($listSacredObject as $key => $object) {
            $metaDescription .= ',' . $object->obj_name;
        }
        $this->metaDescription = $metaDescription;
        $this->metaKeywords = $metaDescription;
        /*
         * Meta SEO tag
         */

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

        $memberObjectAction = MemberObjectAction::model()->findByAttributes(array(
            'obj_id' => $id,
            'mem_id' => $this->member->mem_id,
        ));
        $this->data['objectAction'] = $memberObjectAction;


//$listQuestionAction = WbQuestion::model()->findAll();
        $listQuestion = Yii::app()->db->createCommand()
                ->select('q.*,m.*')
                ->from('wb_question q')
                ->join('member m', 'm.mem_id = q.mem_id')
                ->where('q.obj_id =:objId', array(
                    ':objId' => $id,
                ))
                ->order('q.ques_updatedate desc')
                ->queryAll();
//echo CJSON::encode($listQuestionAction);
//exit();
        $this->data['listCommentQuestion'] = $listQuestion;

        $this->metaDescription = $sacredObject->obj_name . ',' . $sacredObject->obj_price . ',' . $sacredObject->obj_status_desc . ',' . $sacredObject->obj_comment;
        $this->metaKeywords = $sacredObject->obj_name . ',' . $sacredObject->obj_price . ',' . $sacredObject->obj_status_desc . ',' . $sacredObject->obj_comment;

        $this->render('detail-sacred', $this->data);
    }

    public function actionNewsDetail($id) {
        $news = SacredNews::model()->findByPk($id);
        $this->data['news'] = $news;
        $this->render('detail-news', $this->data);
    }

    public function actionRulesDetail() {
        $listRules = SacredRules::model()->findAll();
        $this->data['listRules'] = $listRules;
        $this->render('detail-rules', $this->data);
    }

    public function actionUpload($id = null) {
        if (empty($this->member->mem_id)) {
            Yii::app()->session['last_url'] = Yii::app()->createUrl('site/upload');
            $this->render('login');
        } else {

            if (empty($_POST)) {
                $listSacredType = SacredType::model()->findAll(array(                    
                    'order' => 'type_name'
                ));
                $listRegion = Region::model()->findAll();
                /*$listProvince = Province::model()->findAll(array(                    
                    //'condition' => 'reg_id = '.$this->regionDefault,
                    'order' => 'pro_name_th'
                ));*/
                if (empty($id)) {
                    $sacredObject = new SacredObject();
                } else {
                    $sacredObject = SacredObject::model()->findByPk($id);
                }
                $this->render('upload', array(
                    'listSacredType' => $listSacredType,
                    'listRegion' => $listRegion,
                    //'listProvince' => $listProvince,
                    'sacredObject' => $sacredObject
                ));
            } else {
                $this->member = Yii::app()->session['member'];
                if (empty($this->member)) {
                    echo CJSON::encode(array(
                        'status' => false,
                        'title' => 'ไม่สามารถลงปล่อยพระเครื่องให้เช่าได้',
                        'message' => 'ท่านยังไม่ได้ Login เข้าระบบ กรุณา Login เข้าระบบก่อน',
                        'url' => Yii::app()->createUrl('site/login')
                    ));
                    exit(0);
                } else {
                    $urlRedirect = Yii::app()->createUrl('site/index');
                    $currentDate = date('Ymd');
                    $pathImage = YiiBase::getPathOfAlias("webroot") . '/images';
                    $utility = new Utilities();
                    if (empty($_POST['id'])) {
                        $sacredObject = new SacredObject();
                        $sacredObject->obj_like = 0;
                    } else {
                        $urlRedirect = Yii::app()->createUrl('site/usersacredlist');
                        $sacredObject = SacredObject::model()->findByPk($_POST['id']);
                    }
                    $sacredObject->obj_born = $_POST['born'];
                    $sacredObject->obj_comment = $_POST['comment'];
                    $sacredObject->obj_location = $_POST['location'];
                    $sacredObject->obj_name = $_POST['name'];
                    $sacredObject->obj_price = $_POST['price'];
                    $sacredObject->pro_id = $_POST['province'];
                    $sacredObject->type_id = $_POST['type'];
                    $sacredObject->mem_id = $this->member->mem_id;
                    $sacredObject->obj_updatedate = new CDbExpression('NOW()');

                    if (!empty($_FILES['fileMain']['name'])) {
                        /*
                         * Manage Image Resize , Rename of File
                         */
                        $subDerectoryMain = '/upload_main/' . $currentDate . '_';
//$imageName = $utility->resizeImage($pathImage . $subDerectoryMain, $_FILES['fileMain'], $this->imageWidth, $this->imageHeight);
                        $imageName = $utility->resizeImagePercent($pathImage . $subDerectoryMain, $_FILES['fileMain'], 0.5);
                        /*
                         * Manage Image Resize , Rename of File
                         */
                        $sacredObject->obj_img = $subDerectoryMain . $imageName;
                    }



                    if ($sacredObject->save(false)) {

                        if (!empty($_FILES['fileOther'])) {
                            $listFileOther = $this->readArrayFiles($_FILES['fileOther']);
                            foreach ($listFileOther as $index => $file) {
                                $sacredImg = new SacredObjectImg();

                                $sacredImg->img_size = $file['size'];
                                $sacredImg->img_ext = $file['type'];
                                $sacredImg->obj_id = $sacredObject->obj_id;
                                /*
                                 * Manage Image Resize , Rename of File
                                 */
                                $subDerectoryOther = '/upload_other/' . $currentDate . '_';
//$imageName = $utility->resizeImage($pathImage . $subDerectoryOther, $file, $this->imageWidth, $this->imageHeight);
                                $imageName = $utility->resizeImagePercent($pathImage . $subDerectoryOther, $file, 0.5);
                                /*
                                 * Manage Image Resize , Rename of File
                                 */
                                $sacredImg->img_name = $subDerectoryOther . $imageName;
                                if (!$sacredImg->save(false)) {
                                    echo CJSON::encode(array(
                                        'status' => false,
                                        'title' => 'ไม่สามารถบันทึกได้',
                                        'message' => 'ไม่สามารถบันทึก รูปภาพที่เกี่ยวข้องได้ กรุณาติดต่อ Admin Page',
                                        'url' => ''
                                    ));
                                    exit();
                                }
                            }
                        }
                        echo CJSON::encode(array(
                            'status' => true,
                            'title' => 'ลงข้อมูลปล่อยเช่าพระสำเร็จ',
                            'message' => 'ลงข้อมูลปล่อยเช่าพระสำเร็จ',
                            'url' => $urlRedirect,
                        ));
                    }
                }
            }
        }
    }

    public function actionFacebookAuthorize() {
        header('Content-Type: application/json');
        $status = false;
        $urlRedirect = '';
        $message = 'เกิดข้อผิดพลาดในการเข้าสู่ระบบ';
        if (!empty($_POST)) {

            /*
             * "id": "1527264324240222",
              "name": "Thaismilesoft Teamwork",
              "first_name": "Thaismilesoft",
              "last_name": "Teamwork",
              "gender": "male",
              "locale": "th_TH",
              "link": "https://www.facebook.com/app_scoped_user_id/1527264324240222/",
              "third_party_id": "eFGQUpOagSdjheqILIqskMo8KoI",
              "installed": true,
              "timezone": 7,
              "updated_time": "2015-01-26T04:05:59+0000",
              "verified": true,
              "age_range": {
              "min": 21
              },
             */

            $facebookId = $_POST['id'];
            $facebook_lname = $_POST['last_name'];
            $facebook_fname = $_POST['first_name'];
            $facebook_gender = ($_POST['gender'] == 'male' ? 'M' : 'F');
            if (!empty($facebookId)) {
                $member = Member::model()->findByAttributes(array(
                    'facebook_id' => $facebookId
                ));
                if (!$member) {
                    $member = new Member();
                }
                $member->facebook_id = $facebookId;
                $member->mem_fname = $facebook_fname;
                $member->mem_lname = $facebook_lname;
                $member->mem_sex = $facebook_gender;
                $member->mem_status = $this->memberStatusDefault;
                $member->mem_level = $this->memberLevelDefault;
                $member->mem_updatedate = new CDbExpression('NOW()');
                if ($member->save(false)) {
                    if (empty($member->mem_phone) && empty($member->mem_username) && empty($member->mem_password)) {
                        $urlRedirect = Yii::app()->createUrl('site/userprofile');
                    } else {
                        $urlRedirect = Yii::app()->createUrl('site/index');
                    }
                    Yii::app()->session['member'] = $member;
                    $status = true;
                }
            } else {
                $message = 'ไม่พบเลข facebookId';
            }
            echo CJSON::encode(array(
                'status' => $status,
                'message' => $message,
                'url' => $urlRedirect
            ));
        }
    }

    public function actionUserSacredList() {
        $criteria = new CDbCriteria();
        $criteria->select = '*';
        $criteria->alias = 'o';
        $criteria->join = ' LEFT JOIN province p ON p.pro_id = o.pro_id';
        $criteria->compare('o.mem_id', $this->member->mem_id);
        $listSacredObject = SacredObject::model()->findAll($criteria);

        $this->data['listSacredObject'] = $listSacredObject;
        $this->render('list-sacred', $this->data);
    }

    public function actionUserDeleteSacred($id) {
        $imagePath = YiiBase::getPathOfAlias("webroot") . '/images';
        $object = SacredObject::model()->findByPk($id);
        $filename = $imagePath . $object->obj_img;
        if (file_exists($filename)) {
            unlink($filename);
        }
        if ($object->delete()) {
            $this->redirect(array('site/usersacredlist'));
        }
    }

    public function actionUserFavoriteList() {
        $criteria = new CDbCriteria();
        $criteria->select = 'o.*';
        $criteria->alias = 'o';
        $criteria->join = 'LEFT JOIN member_object_action a ON a.obj_id=o.obj_id';
        $criteria->compare('a.act_favorite', 1);
        $criteria->compare('a.mem_id', $this->member->mem_id);

        $listSacredObjectFavorite = SacredObject::model()->findAll($criteria);
        $this->data['listSacredObjectFavorite'] = $listSacredObjectFavorite;
        $this->render('list-favorite', $this->data);
    }

    public function actionUserProfile() {
        $member = Yii::app()->session['member'];
        if (empty($_POST)) {
            $this->render('register', array(
                'member' => $member,
                'profile' => $member,
                'password' => false,
                'form_title' => 'แก้ไขข้อมูลส่วนตัว',
                'action_url' => Yii::app()->createUrl('site/userprofile')
            ));
        } else {
            $member->mem_fname = $_POST['fname'];
            $member->mem_lname = $_POST['lname'];
            if (empty($this->member->facebook_id)) {
                $member->mem_username = $_POST['username'];
                $member->mem_password = $_POST['password'];
            }
            $member->mem_sex = $_POST['sex'];
            $member->mem_phone = $_POST['phone'];
            $member->mem_email = $_POST['email'];
            $member->mem_address = $_POST['address'];
            $member->mem_updatedate = new CDbExpression('NOW()');
            if ($member->save(false)) {
                Yii::app()->session['member'] = $member;
                echo CJSON::encode(array(
                    'status' => true,
                    'url' => Yii::app()->createUrl('site/index'),
                ));
            } else {
                echo 'system error';
            }
        }
    }

    public function actionNews() {
        $where_condition = ' 1=1 ';
        $pagin_page_size = 15;
        $pagin_page_current = (empty($_GET['page']) ? '1' : $_GET['page']);

        $criteria = new CDbCriteria();
        $criteria->select = 'n.*';
        $criteria->alias = 'n';
        $criteria->order = 'n.news_updatedate desc';

        $criteria->limit = $pagin_page_size;
        $criteria->offset = ($pagin_page_current - 1) * $pagin_page_size;

        $this->data['listSacredNews'] = SacredNews::model()->findAll($criteria);

        /*
         * pagination logic 
         */

        $count_object = Yii::app()->db->createCommand()
                ->select('count(*)')
                ->from('sacred_news')
                ->where($where_condition)
                ->queryScalar();
        $pagin_page_count = $count_object;
        $pagin_page_all = ceil($pagin_page_count / $pagin_page_size);
        $paramsBegin = array();
        if (1 == $pagin_page_current) {
            $paramsBegin['page'] = 1;
        } else {
            $paramsBegin['page'] = ($pagin_page_current - 1);
        }
        $paramsEnd = array();
        if ($pagin_page_all == $pagin_page_current) {
            $paramsEnd['page'] = $pagin_page_all;
        } else {
            $paramsEnd['page'] = ($pagin_page_current + 1);
        }

        $pagin_url_begin = Yii::app()->createUrl('site/news', $paramsBegin);
        $pagin_url_end = Yii::app()->createUrl('site/news', $paramsEnd);

        $this->data['pagination'] = array(
            'page_size' => $pagin_page_size,
            'page_count' => $pagin_page_count,
            'page_current' => $pagin_page_current,
            'page_all' => $pagin_page_all,
            'page_url_begin' => $pagin_url_begin,
            'page_url_end' => $pagin_url_end
        );
        /*
         * pagiation logic
         */


        $this->render('list-news', $this->data);
    }

    public function actionRules() {
        $listRules = SacredRules::model()->findAll();
        $this->data['listRules'] = $listRules;
        $this->render('rules', $this->data);
    }

//    public function actionFacebook() {
//        $this->render('facebook');
//    }



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
