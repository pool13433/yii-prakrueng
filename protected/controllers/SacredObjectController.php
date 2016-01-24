<?php

class SacredObjectController extends Controller {

    public function actionIndex($id = null) {
        $sacredObject = new SacredObject();
        if (!empty($id)) {
            $sacredObject = SacredObject::model()->findByPk($id);
        }
                
        $listSacredObject = SacredObject::model()->findAll();
        $listProvince = Province::model()->findAll(array('order'=>'pro_name_th'));
        $listSacredType = SacredType::model()->findAll();
        $listYear = Utilities::getYear();
        $this->render('index_object', array(
            'sacredObject' => $sacredObject,
            'listSacredObject' => $listSacredObject,
            'listProvince' => $listProvince,
            'listSacredType' => $listSacredType,
            'listYear' => $listYear
        ));
    }

    public function actionObjectSave() {
        if(empty($_POST['id'])){
            $sacredObject = new SacredObject();
        }else{
            $sacredObject = SacredObject::model()->findByPk($_POST['id']);
        }
        $sacredObject->obj_comment = $_POST['comment'];
        $sacredObject->obj_img = '323'; //$_POST['ime'];
        $sacredObject->obj_like = 1;//$_POST['like'];
        $sacredObject->obj_name = $_POST['name'];
        $sacredObject->obj_price = $_POST['price'];
        $sacredObject->obj_born =$_POST['year'];
        $sacredObject->type_id =$_POST['type'];
        $sacredObject->pro_id = $_POST['province'];
        $sacredObject->obj_updatedate = new CDbExpression('NOW()');
        
        if ($sacredObject->save(false)) {
         $this->redirect(array('sacredObject/index'));   
        }else{
            echo 'System Error';
        }
    }
    
    public function actionObjectDelete($id){
        if(SacredObject::model()->findByPk($id)->delete()){
            $this->redirect(array('sacredObject/index'));   
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
                
        $listSacredType= SacredType::model()->findAll();
        $this->render('index_type', array(
            'listSacredType' => $listSacredType,
            'sacredType' => $sacredType
        ));
    }

    public function actionTypeSave() {
        if(empty($_POST['id'])){
            $sacredType = new SacredType();
        }else{
            $sacredType = SacredType::model()->findByPk($_POST['id']);
        }
        $sacredType->type_name = $_POST['name'];
        $sacredType->type_updatedate = new CDbExpression('NOW()');
        
        if ($sacredType->save(false)) {
         $this->redirect(array('sacredObject/indexType'));   
        }else{
            echo 'System Error';
        }
    }
    
    public function actionTypeDelete($id){
        if(SacredType::model()->findByPk($id)->delete()){
            $this->redirect(array('sacredObject/indexType'));   
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
                
        $listProvince= Province::model()->findAll();
        $this->render('index_province', array(
            'listProvince' => $listProvince,
            'province' => $province
        ));
    }

    public function actionProvinceSave() {
        if(empty($_POST['id'])){
            $province = new Province();
        }else{
            $province = Province::model()->findByPk($_POST['id']);
        }
        $province->pro_name_th = $_POST['name_th'];
        $province->pro_name_eng = $_POST['name_eng'];
        $province->pro_updatedate = new CDbExpression('NOW()');
        
        if ($province->save(false)) {
         $this->redirect(array('sacredObject/indexProvince'));   
        }else{
            echo 'System Error';
        }
    }
    
    public function actionProvinceDelete($id){
        if(Province::model()->findByPk($id)->delete()){
            $this->redirect(array('sacredObject/indexProvince'));   
        }
    }
     /*
     * *************************** Sacred Object Province **************************************
     */
    

}
