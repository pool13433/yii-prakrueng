<?php
$baseUrl = Yii::app()->baseUrl;
?>
<!-- Content Begin-->
<section id="main-content" style="margin-left: 0px;">
    <section class="site-min-height">
        <div class="row">

            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist" id="myTabs">
                            <li role="presentation" class="active">
                                <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
                                    <h5><i class="glyphicon glyphicon-picture"></i> รูปภาพ</h5>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
                                    <h5><i class="glyphicon glyphicon-list-alt"></i> รายละเอียด</h5>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">
                                    <h5><i class="glyphicon glyphicon-phone-alt"></i> ติดต่อสอบถาม</h5>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#relate" aria-controls="relate" role="tab" data-toggle="tab">
                                    <h5><i class="fa fa-link"></i> พระเครื่องที่เกี่ยวข้อง</h5>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#comment" aria-controls="comment" role="tab" data-toggle="tab">
                                    <h5><i class="fa fa-comments-o"></i> แสดงความคิดเห็น</h5>
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">

                            <!-- Panel Images-->
                            <div role="tabpanel" class="tab-pane active" id="home">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="page-header clearfix">
                                            <h1 class="pull-left"><i class="fa fa-image"></i> 
                                                <u><?= $sacredObject->obj_name ?></u>
                                            </h1>
                                            <h3 class="pull-right">
                                                <button id="btnFavorite" type="button" class="btn btn-danger">
                                                    <i class="fa fa-heart"></i> 
                                                </button>
                                                <button id="btnLike" type="button" class="btn btn-info">
                                                    <i class="fa fa-thumbs-o-up"></i> 
                                                    <strong><?= $sacredObject->obj_like ?></strong>
                                                </button>
                                                <button id="btnView" type="button" class="btn btn-warning" disabled>
                                                    <i class="glyphicon glyphicon-eye-open"></i> 
                                                    <strong><?= $sacredObject->obj_view ?></strong>
                                                </button>
                                            </h3>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                            <div id="mainImage">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <a href="#" class="thumbnail">
                                                        <img id="img_zoom" class="img-responsive zoom" src="<?= $baseUrl . '/images/' . $sacredObject->obj_img ?>"                                                              
                                                             alt="" data-zoom-image="<?= $baseUrl . '/images/' . $sacredObject->obj_img ?>">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-12 col-xs-12">
                                            <div id="albumImage">
                                                <?php foreach ($listSacredObjectImg as $index => $img) { ?>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                        <a href="#" class="thumbnail" data-image="<?= $baseUrl . '/images/' . $img->img_name ?>" data-zoom-image="<?= $baseUrl . '/images/' . $img->img_name ?>"> 
                                                            <img id="img_zoom" class="img-rounded" src="<?= $baseUrl . '/images/' . $img->img_name ?>"/> 
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Panel Images-->

                            <!-- Panel Detail-->
                            <div role="tabpanel" class="tab-pane" id="profile">
                                <div class="panel panel-default">
                                    <div class="panel-body">

                                        <div class="page-header">
                                            <h1><i class="glyphicon glyphicon-list-alt"></i> 
                                                <small><u>ข้อมูลของวัตถุมงคล</u></small>
                                            </h1>
                                        </div>
                                        <dl class="dl-horizontal">
                                            <dt>ชื่อ</dt>
                                            <dd><?= $sacredObject->obj_name ?></dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>ราคา</dt>
                                            <dd><?= $sacredObject->obj_price ?></dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>สร้างเมื่อ</dt>
                                            <dd><?= $sacredObject->obj_born ?></dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>ประเภท</dt>
                                            <dd><?= $sacredObject->type->type_name ?></dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>ต้นกำเนิดอยู่ที่จังหวัด</dt>
                                            <dd><?= $sacredObject->province->pro_name_th ?></dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>อธิบายเพิ่มเติม</dt>
                                            <dd><?= $sacredObject->obj_comment ?></dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <!-- Panel Detail-->

                            <!-- Panel Contact-->
                            <div role="tabpanel" class="tab-pane" id="contact">
                                <div class="panel panel-default">
                                    <div class="panel-body">

                                        <div class="page-header">
                                            <h1><i class="glyphicon glyphicon-phone-alt"></i> 
                                                <small><u>ช่องทางการติดต่อ</u></small>
                                            </h1>
                                        </div>
                                        <?php if (!empty($sacredObject->member)) { ?>
                                            <dl class="dl-horizontal">
                                                <dt>ชื่อเจ้าของ</dt>
                                                <dd><?= (empty($sacredObject->member) ? '<label class="label label-warnning">ไม่พบผู้ปล่อยเช่าในระบบ</label>' : $sacredObject->member->mem_fname . '   ' . $sacredObject->member->mem_lname) ?></dd>
                                            </dl>
                                            <dl class="dl-horizontal">
                                                <dt>โทรศัพท์</dt>
                                                <dd><?= $sacredObject->member->mem_phone ?></dd>
                                            </dl>
                                            <dl class="dl-horizontal">
                                                <dt>อีเมลล์</dt>
                                                <dd><?= $sacredObject->member->mem_email ?></dd>
                                            </dl>
                                        <?php } else { ?>
                                            <div role="alert" class="alert alert-warning alert-dismissible fade in"> 
                                                <button aria-label="Close" data-dismiss="alert" class="close" type="button">
                                                    <span aria-hidden="true">×</span>
                                                </button> 
                                                <strong>ไม่พบข้อมูล</strong> ไม่พบข้อมูลผู้ฝากให้เช่าในระบบ 
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Panel Contact-->

                            <!-- Panel Relate-->
                            <div role="tabpanel" class="tab-pane" id="comment">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="page-header">
                                            <h1><i class="fa fa-comments-o"></i> 
                                                <small><u>แสดงความคิดเห็น</u></small>
                                            </h1>
                                        </div>
                                        <div class="form-group">
                                            <labe class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12">แสดงความคิดเห็น</labe>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <textarea class="form-control" rows="4"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- Panel Relate-->

                            <!-- Panel Recommen-->
                            <div role="tabpanel" class="tab-pane" id="relate">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="page-header">
                                            <h1><i class="fa fa-link"></i> 
                                                <small><u>พระเครื่องที่เกี่ยวข้อง</u></small>
                                            </h1>
                                        </div>
                                        <div class="row">
                                            <?php foreach ($listSacredObjectRelate as $index => $relate) { ?>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <a href="#">
                                                        <div class="panel panel-default">
                                                            <div class="panel-body">
                                                                <a href="#" class="thumbnail">
                                                                    <img src="<?= $baseUrl . '/images/' . $relate->obj_img ?>" alt="..." style="min-height: 200px;">
                                                                </a>
                                                                <p class="pull-right">
                                                                    <a href="<?= Yii::app()->createUrl('site/detail/' . $relate->obj_id) ?>" class="btn btn-warning btn-xs">
                                                                        <i class="fa fa-flag"></i> อ่านต่อ...
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Panel Recommen-->

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
                    'listMemberLastInsert' => $listMemberLastInsert
                ))
                ?>
            </div>
            <!-- Sidebar Right End -->

        </div>
    </section>
</section>

<script type="text/javascript">
    var imageElement = $(".zoom");
    $(function () {
        customElevateZoom();
        updatePageViewer();
        handleElevateZoomer();
        initMemberObjectAction();
    });

    function removeElevateZoom() {
        $('.zoomContainer').remove();
        imageElement.removeData('elevateZoom');
        imageElement.removeData('zoomImage');
    }

    function handleElevateZoomer() {
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            if (e.currentTarget.hash == '#home') {
                customElevateZoom();
            } else {
                removeElevateZoom();
            }
            e.target // newly activated tab
            e.relatedTarget // previous active tab
            removeElevateZoom();
        });
    }

    function customElevateZoom() {
        //initiate the plugin and pass the id of the div containing gallery images 
        imageElement.elevateZoom({
            zoomType: "lens",
            lensShape: "round",
            scrollZoom: true,
            lensSize: 200,
            gallery: 'albumImage',
            cursor: 'pointer',
            galleryActiveClass: 'active',
            imageCrossfade: true,
            //loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'
        });
        //pass the images to Fancybox 
        $(".zoom").bind("click", function (e) {
            var ez = $(this).data('elevateZoom');
            $.fancybox(ez.getGalleryList());
            return false;
        });
    }

    function updatePageViewer() {
        $.get('<?= Yii::app()->createUrl('helper/UpdateSacredObjectView/' . $sacredObject->obj_id) ?>', {},
                function (response) {
                    console.log(' status ::==' + response.status);
                }, 'json');
    }

    function initMemberObjectAction() {
        $('#btnLike').on('click', function () {
            $.get('<?= Yii::app()->createUrl('helper/updateMemberObjectAction') ?>', {
                id: <?= $sacredObject->obj_id ?>,
                action: 'LIKE',
                value: 1
            },
            function (response) {
                $('#btnLike').prop('disabled', true);
            }, 'json');
        });
        $('#btnFavorite').on('click', function () {
            $.get('<?= Yii::app()->createUrl('helper/updateMemberObjectAction') ?>', {
                id: <?= $sacredObject->obj_id ?>,
                action: 'FAVORITE',
                value: 1
            },
            function (response) {
                $('#btnFavorite').prop('disabled', true);
            }, 'json');
        });

        $.get('<?= Yii::app()->createUrl('helper/getMemberObjectAction/' . $sacredObject->obj_id) ?>', {},
                function (response) {
                    if (response != null) {
                        if (response.act_like == 1) {
                            $('#btnLike').prop('disabled', true);
                        }
                        if (response.act_favorite == 1) {
                            $('#btnFavorite').prop('disabled', true);
                        }
                    }
                }, 'json');
    }

</script>
