<?php
$baseUrl = Yii::app()->baseUrl;
?>
<style type="text/css">
    #albumImage img{
        border:2px solid white;
    }
    .active img{border:2px solid #333 !important;}
</style>

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
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">

                            <!-- Panel Images-->
                            <div role="tabpanel" class="tab-pane active" id="home">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="page-header">
                                            <h1><i class="fa fa-image"></i> 
                                                <u><?= $sacredObject->obj_name ?></u>
                                            </h1>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                            <div id="mainImage">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <a href="#" class="thumbnail">
                                                        <img id="img_zoom" class="img-responsive zoom" src="<?= $baseUrl ?>/img/prakrueng/a1.jpg" alt="" 
                                                             data-zoom-image="<?= $baseUrl ?>/img/prakrueng/a1.jpg">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-12 col-xs-12">
                                            <div id="albumImage">
                                                <?php foreach ($listSacredObjectImg as $index => $img) { ?>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                        <a href="#" class="thumbnail" data-image="<?= $baseUrl . $img->img_name ?>" data-zoom-image="<?= $baseUrl . $img->img_name ?>"> 
                                                            <img id="img_zoom" class="img-rounded" src="<?= $baseUrl . $img->img_name ?>"/> 
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
                                        <dl class="dl-horizontal">
                                            <dt>ชื่อเจ้าของ</dt>
                                            <dd><?= $sacredObject->member->mem_fname . '   ' . $sacredObject->member->mem_lname ?></dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>โทรศัพท์</dt>
                                            <dd><?= $sacredObject->member->mem_phone ?></dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>อีเมลล์</dt>
                                            <dd><?= $sacredObject->member->mem_email ?></dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <!-- Panel Contact-->

                            <!-- Panel Recommen-->
                            <div role="tabpanel" class="tab-pane" id="contact">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                            <div class="page-header">
                                                <h1><i class="glyphicon glyphicon-phone-alt"></i> 
                                                    <small><u>ช่องทางการติดต่อ</u></small>
                                                </h1>
                                            </div>
                                            <dl class="dl-horizontal">
                                                <dt>ชื่อเจ้าของ</dt>
                                                <dd><?= $sacredObject->member->mem_fname . '   ' . $sacredObject->member->mem_lname ?></dd>
                                            </dl>
                                            <dl class="dl-horizontal">
                                                <dt>โทรศัพท์</dt>
                                                <dd><?= $sacredObject->member->mem_phone ?></dd>
                                            </dl>
                                            <dl class="dl-horizontal">
                                                <dt>อีเมลล์</dt>
                                                <dd><?= $sacredObject->member->mem_email ?></dd>
                                            </dl>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Panel Contact-->

                        </div>
                    </div>
                </div>

            </div>
            <!-- Sidebar Right Begin-->
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <?php
                $this->renderPartial('/sidebar_right', array(
                    'listSacredObjectLastInsert' => $listSacredObjectLastInsert,
                    'listSacredType' => $listSacredType
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
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            if (e.currentTarget.hash == '#home') {
                customElevateZoom();
            } else {
                removeElevateZoom();
            }
            e.target // newly activated tab
            e.relatedTarget // previous active tab
            removeElevateZoom();
        })
    });

    function removeElevateZoom() {
        $('.zoomContainer').remove();
        imageElement.removeData('elevateZoom');
        imageElement.removeData('zoomImage');
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

</script>
