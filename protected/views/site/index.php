<?php
$baseUrl = Yii::app()->baseUrl;
?>
<!-- Content Begin-->

<div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <section id="main-content" style="margin-left: 0px;">
            <section class="site-min-height">
                <h3><i class="fa fa-angle-right"></i> <?= $title ?></h3>
                <div class="row">
                    <div class="row pull-right">
                        <?php
                        $this->renderPartial('/site/pagination_index', array(
                            'pagination' => $pagination
                        ))
                        ?>
                    </div>
                </div>
                <!-- -- 1st ROW OF PANELS ---->
                <div id="boxPraKreung" class="row">
                    <?php foreach ($listSacredObject as $index => $object) { ?>
                        <div class="col-lg-4 col-md-4 col-sm-4 mb">        
                            <div class="panel panel-warning">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title" style="padding-top: 7.5px;"> <b><i class="fa fa-circle-o"></i> <?= $object->obj_name ?></h4>
                                    <h4 class="panel-title fa fa-money" style="padding-top: 7.5px;"> <?= $object->obj_price ?> บาท</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="thumbnail">
                                        <a class="fancybox" href="<?= $baseUrl . '/images/' . $object->obj_img ?>">                                       
                                            <img class="img-responsive" src="<?= $baseUrl . '/images/' . $object->obj_img ?>"
                                                 style="max-width: 75%;min-height: 180px;" alt="">
                                        </a>                                                                   
                                    </div>
                                    <p class="pull-right">
                                        <a href="<?= Yii::app()->createUrl('site/detail/' . $object->obj_id) ?>" class="btn btn-warning btn-xs">
                                            <i class="fa fa-flag"></i> อ่านต่อ...
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div><!-- /END 6TH ROW OF PANELS -->
                <div class="row">
                    <div class="row pull-right">
                        <?php
                        $this->renderPartial('/site/pagination_index', array(
                            'pagination' => $pagination
                        ))
                        ?>
                    </div>
                </div>
            </section>
        </section>
    </div>    

    <!-- Sidebar Right Begin-->
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?php
        $this->renderPartial('/sidebar_right', array(
            'listSacredObjectLastInsert' => $listSacredObjectLastInsert,
            'listSacredType' => $listSacredType,
            'listMemberLastInsert' => $listMemberLastInsert
        ))
        ?>
        <!-- Sidebar Right End -->

    </div>
</div>
<!-- Co ntent End --> 