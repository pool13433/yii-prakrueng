<?php

class SiteController extends Controller {

    public $data = array();
    private $member = null;
    private $imageWidth = 800;
    private $imageHeight = 600;
    public $publicStatus = 1;
    public $levelDefault = 1; // มือใหม่

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
            $this->member->mem_level = $this->levelDefault;
            $this->member->mem_lname = '';
            $this->member->mem_phone = $_POST['phone'];
            $this->member->mem_sex = $_POST['sex'];
            $this->member->mem_status = 1;
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
        $paramsEnd = array(
        );

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
        $metaDescription = '';
        $sacredObjectType = $this->data['listSacredType'];                
        foreach ($sacredObjectType as $index => $type) {
            $metaDescription .= ','.$type['type_name'];
        }
        foreach ($listSacredObject as $key => $object) {
            $metaDescription .= ','.$object->obj_name;
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
        
        $this->metaDescription = $sacredObject->obj_name.','.$sacredObject->obj_price.','.$sacredObject->obj_status_desc.','.$sacredObject->obj_comment;
        $this->metaKeywords = $sacredObject->obj_name.','.$sacredObject->obj_price.','.$sacredObject->obj_status_desc.','.$sacredObject->obj_comment;

        $this->render('detail-sacred', $this->data);
    }

    public function actionNewsDetail($id) {
        $news = SacredNews::model()->findByPk($id);
        $this->data['news'] = $news;
        $this->render('detail-news', $this->data);
    }

    public function actionUpload() {
        if (empty($this->member->mem_id)) {
            Yii::app()->session['last_url'] = Yii::app()->createUrl('site/upload');
            $this->render('login');
        } else {

            if (empty($_POST)) {
                $listSacredType = SacredType::model()->findAll(array(
                    'order' => 'type_name'
                ));
                $listProvince = Province::model()->findAll(array(
                    'order' => 'pro_name_th'
                ));
                $this->render('upload', array(
                    'listSacredType' => $listSacredType,
                    'listProvince' => $listProvince
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
                    $currentDate = date('Ymd');
                    $pathImage = YiiBase::getPathOfAlias("webroot") . '/images';
                    $utility = new Utilities();

                    $sacredObject = new SacredObject();
                    $sacredObject->obj_born = $_POST['born'];
                    $sacredObject->obj_comment = $_POST['comment'];
                    $sacredObject->obj_location = $_POST['location'];
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
                    $subDerectoryMain = '/upload_main/' . $currentDate . '_';
                    //$imageName = $utility->resizeImage($pathImage . $subDerectoryMain, $_FILES['fileMain'], $this->imageWidth, $this->imageHeight);
                    $imageName = $utility->resizeImagePercent($pathImage . $subDerectoryMain, $_FILES['fileMain'], 0.5);
                    /*
                     * Manage Image Resize , Rename of File
                     */
                    $sacredObject->obj_img = $subDerectoryMain . $imageName;
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
                            'url' => ''
                        ));
                    }
                }
            }
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
