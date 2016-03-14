<?php
$baseUrl = Yii::app()->baseUrl;
?>
<!-- Content Begin-->

<div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">       

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 panel">
                <div class="row">
                    <h3 class="col-lg-5 col-md-2 col-sm-12 col-xs-12" style="font-size: 1.6em;">
                        <i class="fa fa-angle-right"></i> <?= $title ?>
                    </h3>

                    <div class="col-lg-6 col-md-9 col-sm-9 col-xs-6">
                        <div class="row pull-right">
                            <?php
                            $this->renderPartial('/site/pagination_index', array(
                                'pagination' => $pagination
                            ))
                            ?>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-1 col-sm-3 pagination col-xs-6">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                จัดเรียง
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="boxColumnSort">
                                <?php foreach ($sortDatas as $key => $sort) { ?>
                                    <li>
                                        <a title="<?= $sort['field'] ?>" 
                                           href="<?= Yii::app()->createUrl('site/index', array('field' => $sort['field'], 'by' => $sort['by'])) ?>">
                                               <?= $sort['label'] ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 panel" id="container-scrollbar"> <!-- class="scrollbar-color" id="container-scrollbar"-->
                <div class="row">
                    <h3 class="pull-right col-lg-12" style="font-size: 1.6em;">
                        [ แสดง <?= $display_length ?> ชิ้น ต่อ 1 หน้า จากข้อมูลทั้งหมด <?= $total_length ?> ชิ้น ]
                    </h3>
                </div>
                <div class="row">
                    <div id="boxPraKreung">
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
                                    <div class="panel panel-warning box-card" style="height: 650px;">
                                        <div class="panel-body" style="height:420px;">
                                            <div class="thumbnail">
                                                <a class="fancybox" href="<?= $baseUrl . '/images' . $object->obj_img ?>">                                       
                                                    <img class="img-responsive lazyload" alt="Responsive image"
                                                         data-src="<?= $baseUrl . '/images' . $object->obj_img ?>"
                                                         style="max-width: 90%;min-height: 250px;max-height: 250px;">
                                                </a>                                                                   
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <strong class="title" style="font-size: 1.1em;">
                                                    <p><?= $object->obj_name; ?></p>
                                                </strong>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <p class="pull-left" style="padding-top: 7.5px;"> 
                                                    <i class="fa fa-money"></i> <?= $object->obj_price ?> บาท
                                                </p>   
                                                <p class="pull-right" style="padding-top: 7.5px;"> 
                                                    <i class="fa fa-clock-o"></i> <?= date("d/m/Y H:m", strtotime($object->obj_updatedate)) ?>
                                                </p>   
                                            </div>
                                        </div>
                                        <div class="panel-footer">
                                            <a href="<?= Yii::app()->createUrl('site/detail/' . $object->obj_id) ?>" 
                                               class="btn btn-warning btn-xs btn-block" style="font-size: 1.5em;font-weight: bold">
                                                <i class="fa fa-share-square-o"></i> รายละเอียด...
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <h3 class="pull-right col-lg-12" style="font-size: 1.6em;">
                        [ แสดง <?= $display_length ?> ชิ้น ต่อ 1 หน้า จากข้อมูลทั้งหมด <?= $total_length ?> ชิ้น ]
                    </h3>
                </div>
            </div>
            <!-- -- 1st ROW OF PANELS ---->

        </div>
        <div class="row">
            <div class="pull-right">
                <?php
                $this->renderPartial('/site/pagination_index', array(
                    'pagination' => $pagination
                ))
                ?>
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