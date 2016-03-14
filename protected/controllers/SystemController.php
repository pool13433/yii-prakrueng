<?php

class SystemController extends Controller {

    public function init() {
        parent::init();
    }

    public function actionConfig() {
        //$displayLength = WebConfig::model()->findByAttributes(array('visible' => 1));
        $configs = WebConfig::model()->findAllByAttributes(array('visible' => 1));
        //var_dump($configs);
        //exit();
        $this->render('/system/config', array('configs' => $configs));
    }

    public function actionSaveConfig() {
        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $config = WebConfig::model()->findByAttributes(array('name' => $key));
                $config->value = $_POST[$key];
                $config->update();
            }
            $this->redirect(array('System/Config'));
        }
    }

}
