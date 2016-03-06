<?php
$baseUrl = Yii::app()->baseUrl;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        Yii::app()->clientScript->registerMetaTag($this->getMetaDescription(), 'description');
        Yii::app()->clientScript->registerMetaTag($this->getMetaKeywords(), 'keywords');
        ?>
        <meta name="author" content="พระเครื่องเมืองไทย">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="th">

        <!-- Bootstrap core CSS -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">
        <!--external css-->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/zabuto_calendar.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/gritter/jquery.gritter.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/lineicons/style.css">    

        <!-- Custom styles for this template -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style-responsive.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fancybox/jquery.fancybox.css">

        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/datatables/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/datatables/dataTables.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/datatables/responsive.bootstrap.min.css">

        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/dropzone/dropzone.css">
        
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/pace/templates/pace-theme-flash.tmpl.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/pace/themes/orange/pace-theme-flash.css">

        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/my-style.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/my-navbar.css">

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <style type="text/css">
            @font-face {
                font-family: 'TH-Dan-Vi-Vek';
                src: url('webfont.eot'); /* IE9 Compat Modes */
                src: url('<?php echo Yii::app()->request->baseUrl; ?>/fonts/TH-Dan-Vi-Vek/TH Dan Vi Vek ver 1.03.ttf') format('truetype');
            }            
        </style>
    </head>

    <body>
        <div class="paceDiv"></div>
        <div class="container-fluid">

            <?php $this->renderPartial('/navbar-top') ?>
            <div class="wrapper">
                <div id="fb-root"></div>
                <?php echo $content; ?>
            </div>

        </div> 
        <?php $this->renderPartial('/footer') ?>

        <?php
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($baseUrl . '/js/jquery-1.8.3.min.js');
        $cs->registerScriptFile($baseUrl . '/js/bootstrap.min.js');


        $cs->registerScriptFile($baseUrl . '/js/fancybox/jquery.fancybox.js');

        /*
         * Jquery Datatable
         */
        $cs->registerScriptFile($baseUrl . '/js/datatables/jquery.dataTables.min.js');
        $cs->registerScriptFile($baseUrl . '/js/datatables/dataTables.bootstrap.min.js');
        $cs->registerScriptFile($baseUrl . '/js/datatables/dataTables.responsive.min.js');
        $cs->registerScriptFile($baseUrl . '/js/datatables/responsive.bootstrap.min.js');

        /*
         * Jquery ElevateZoom
         */
        $cs->registerScriptFile($baseUrl . '/js/elevatezoom/jquery.elevateZoom-3.0.8.min.js');
        $cs->registerScriptFile($baseUrl . '/js/elevatezoom/jquery.elevatezoom.js');

        $cs->registerScriptFile($baseUrl . '/js/dropzone/dropzone.min.js');

        $cs->registerScriptFile($baseUrl . '/js/validate/jquery.validate.min.js');
        
        $cs->registerScriptFile($baseUrl . '/js/facebookSDK.js');
        
        $cs->registerScriptFile($baseUrl . '/js/jquery.lazyload.min.js');        
        
        $cs->registerScriptFile($baseUrl . '/js/pace/pace.min.js');        

        $cs->registerScriptFile($baseUrl . '/js/my-function.js');
        ?>
    </body>
</html>
