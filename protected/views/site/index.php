<?php
$baseUrl = Yii::app()->baseUrl;
?>
<!-- Content Begin-->

<div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">       

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 panel">
                <div class="row">
                    <h3 class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="font-size: 1.6em;">
                        <i class="fa fa-angle-right"></i> <?= $title ?>
                    </h3>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <!--                        <div class="row pull-right">
                        <?php
                        $this->renderPartial('/site/pagination_index', array(
                            'pagination' => $pagination
                        ))
                        ?>
                                                </div>-->
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 pagination col-xs-12">
                        <div class="pull-right">
                            <div class="btn-group" role="group" aria-label="...">
                                <a class="btn btn-warning layout design-list" data-value="list">
                                    <i class="glyphicon glyphicon-th-list"></i>
                                </a>
                                <a class="btn btn-warning active layout design-block" data-value="block">
                                    <i class="glyphicon glyphicon-th"></i>
                                </a>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <strong>เรียงตาม <?= $sort_select ?></strong>
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
                                            <div class="thumbnail col-lg-4">
                                                <a class="fancybox" href="<?= $baseUrl . '/images' . $object->obj_img ?>">                                       
                                                    <img class="img-responsive lazyload" alt="Responsive image"
                                                         data-src="<?= $baseUrl . '/images' . $object->obj_img ?>"
                                                         style="max-width: 90%;min-height: 250px;max-height: 250px;">
                                                </a>                                                                   
                                            </div>
                                            <div class="content1 col-lg-8 col-md-12 col-sm-12 col-xs-12">
                                                <strong class="title" style="font-size: 1.1em;">
                                                    <p><?= $object->obj_name; ?></p>
                                                </strong>
                                            </div>
                                            <div class="content2 col-lg-8 col-md-12 col-sm-12 col-xs-12">
                                                <p class="pull-left" style="padding-top: 7.5px;"> 
                                                    <i class="fa fa-money"></i> <?= $object->obj_price ?> บาท
                                                </p>   
                                                <p class="pull-right" style="padding-top: 7.5px;"> 
                                                    <i class="fa fa-clock-o"></i> <?= date("d/m/Y H:m", strtotime($object->obj_updatedate)) ?>
                                                </p>   
                                            </div>
                                            <div class="content3 col-lg-8 col-md-12 col-sm-12 col-xs-12">
                                                <dl class="dl-horizontal">
                                                    <dt>ราคา</dt>
                                                    <dd><?= $object->obj_price ?> บาท</dd>
                                                </dl>
                                                <dl class="dl-horizontal">
                                                    <dt>ประเภท</dt>
                                                    <dd><?= $object->type->type_name ?></dd>
                                                </dl>
                                                <dl class="dl-horizontal">
                                                    <dt>ต้นกำเนิดอยู่ที่จังหวัด</dt>
                                                    <dd><?= $object->province->pro_name_th ?></dd>
                                                </dl>
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
<script type="text/javascript">
    $(document).ready(function () {
        var layoutDesign = getCookie('layout');
        changeLayoutDesign(layoutDesign);
        $(document).on('click', 'a.layout', function () {
            var value = $(this).attr('data-value');
            setCookie('layout', value, 30);
            changeLayoutDesign(value);
        });
    });

    function changeLayoutDesign(value) {
        if (value === 'list') {
            $('a.design-list').addClass('active');
            $('a.design-block').removeClass('active');
            $('#boxPraKreung').find('.col-lg-4.mb')
                    .removeClass('col-lg-4')
                    .removeClass('col-md-4')
                    .addClass('col-lg-12')
                    .addClass('col-md-12');
            $('#boxPraKreung').find('div.panel-body').css({'height': '300px'});
            $('#boxPraKreung').find('div.panel.panel-warning.box-card').css({'height': '360px'});
            $('#boxPraKreung').find('div.content1,div.content2')
                    .css({'font-size': '1.5em'})
                    .removeClass('col-lg-12').addClass('col-lg-8');
            $('#boxPraKreung').find('div.content2').css({'display': 'none'});
            $('#boxPraKreung').find('div.content3').css({'font-size': '1.4em', 'display': 'block'});
            $('#boxPraKreung').find('div.thumbnail').removeClass('col-lg-12').addClass('col-lg-4');
        } else {
            $('a.design-block').addClass('active');
            $('a.design-list').removeClass('active');
            $('#boxPraKreung').find('.col-lg-12.mb')
                    .removeClass('col-lg-12')
                    .removeClass('col-md-12')
                    .addClass('col-lg-4')
                    .addClass('col-md-4');
            $('#boxPraKreung').find('div.panel-body').css({'height': '420px'});
            $('#boxPraKreung').find('div.box-card').css({'height': '650px'});
            $('#boxPraKreung').find('div.content1,div.content2')
                    .css({'font-size': '1.0em'})
                    .removeClass('col-lg-8').addClass('col-lg-12');
            $('#boxPraKreung').find('div.content2').css({'display': 'block'})
            $('#boxPraKreung').find('div.content3').css({'font-size': '1.3em', 'display': 'none'});
            $('#boxPraKreung').find('div.thumbnail').removeClass('col-lg-4').addClass('col-lg-12');
        }
    }
</script>