<?php

class AdminController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }
    
    public function actionSacredIndex(){
        $this->render('index_sacred_object');
    }

}
