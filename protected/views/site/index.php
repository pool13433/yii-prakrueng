<?php
$baseUrl = Yii::app()->baseUrl;
?>
<!-- Content Begin-->

<div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">                 
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 panel">
                <div class="row">
                    <h3 class="pull-left"><i class="fa fa-angle-right"></i> <?= $title ?></h3>
                    <div class="pull-right">
                        <?php
                        $this->renderPartial('/site/pagination_index', array(
                            'pagination' => $pagination
                        ))
                        ?>
                    </div>
                </div>
                <!-- -- 1st ROW OF PANELS ---->
                <div id="boxPraKreung" class="row">
                    <?php if (count($listSacredObject) == 0) { ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb">        
                            <div role="alert" class="alert alert-warning alert-dismissible fade in"> 
                                <button aria-label="Close" data-dismiss="alert" class="close" type="button">
                                    <span aria-hidden="true">×</span></button> 
                                <strong>ไม่พบข้อมูล</strong> ผลการค้นหาไม่พบข้อมูลจากเงื่อนไขการค้นหา
                            </div>
                        </div>
                    <?php } else { ?>
                        <?php foreach ($listSacredObject as $index => $object) { ?>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mb">        
                                <div class="panel panel-warning">
                                    <div class="panel-heading clearfix">
                                        <h4 class="panel-title" style="padding-top: 7.5px;"> <b><i class="fa fa-circle-o"></i> <?= $object->obj_name ?></h4>
                                        <h4 class="panel-title fa fa-money" style="padding-top: 7.5px;"> <?= $object->obj_price ?> บาท</h4>                                        
                                    </div>
                                    <div class="panel-body">
                                        <div class="thumbnail">
                                            <a class="fancybox" href="<?= $baseUrl . '/images/' . $object->obj_img ?>">                                       
                                                <img class="img-responsive" src="<?= $baseUrl . '/images/' . $object->obj_img ?>"
                                                     style="max-width: 75%;min-height: 200px;max-height: 200px;" alt="">
                                            </a>                                                                   
                                        </div>
                                        <h4 class="pull-left"> 
                                            <i class="fa fa-map-marker"></i> <?= $object->province->pro_name_th ?>
                                        </h4>
                                        <p class="pull-right">
                                            <a href="<?= Yii::app()->createUrl('site/detail/' . $object->obj_id) ?>" class="btn btn-warning">
                                                <i class="fa fa-flag"></i> เพิ่มเติม...
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div><!-- /END 6TH ROW OF PANELS -->
                <div class="row">
                    <div class="pull-right">
                        <?php
                        $this->renderPartial('/site/pagination_index', array(
                            'pagination' => $pagination
                        ))
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 panel">
                <div class="row">
                    <h3 class="pull-left"><i class="fa fa-angle-right"></i> ข่าววงการพระเครื่อง</h3>
                </div>
                <?php foreach ($listSacredNews as $key => $news) { ?>
                    <div class="media">     
                        <div class="media-left"> 
                            <h4><?= $news->news_updatedate ?></h4>
                        </div>
                        <div class="media-body"> 
                            <h4 class="media-heading"><u><?= $news->news_title ?></u></h4> 
                            <p>
                                <?= substr($news->news_detail, 0, 200) ?>
                                <a href="<?= Yii::app()->createUrl('site/newsdetail/' . $news->news_id) ?>"><u>อ่านต่อ...</u></a>
                            </p>                             
                        </div> 
                    </div>
                <?php } ?>
                <div class="row pull-right">
                    <a href="<?= Yii::app()->createUrl('site/news') ?>">
                        <strong><u>ข่าวอื่น ๆ คลิก</u></strong>
                    </a>
                </div> 
            </div>
        </div>
    </div>    

    <!-- Sidebar Right Begin-->
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?php
        $this->renderPartial('/sidebar_right', array(
            'listSacredObjectLastInsert' => $listSacredObjectLastInsert,
            'listSacredType' => $listSacredType,
            'listMemberLastInsert' => $listMemberLastInsert,
            'listRegion' => $listRegion
        ))
        ?>
        <!-- Sidebar Right End -->

    </div>

</div>
<!-- Co ntent End --> 