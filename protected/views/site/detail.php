<?php
$baseUrl = Yii::app()->baseUrl;
?>
<style type="text/css">
    #albumImage img{
        border:2px solid white;
    }
    .active img{border:2px solid #333 !important;}
</style>
<div class="row">

    <div class="col-lg-6">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $sacredObject->obj_name ?></h3>
                    </div>
                    <div class="panel-body">
                        <div id="mainImage">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <a href="#" class="thumbnail">
                                    <img id="img_zoom" class="img-responsive zoom" src="<?= $baseUrl ?>/img/prakrueng/a1.jpg" alt="" 
                                         data-zoom-image="<?= $baseUrl ?>/img/prakrueng/a1.jpg">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div id="albumImage">
                            <?php foreach ($listSacredObjectImg as $index => $img) { ?>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
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

    </div>
    <div class="col-lg-6">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title">Panel warning</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="page-header">
                        <h1>Example page header <small>Subtext for header</small></h1>
                    </div
                    <div class="media"> 
                        <div class="media-left"> 
                            <a href="#"> 
                                <img alt="64x64" data-src="holder.js/64x64" class="media-object" style="width: 64px; height: 64px;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/++==" data-holder-rendered="true"> 
                            </a> 
                        </div> 
                        <div class="media-body"> 
                            <h4 class="media-heading">Top aligned media</h4>
                            <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p> <p>Donec sed odio dui. Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                            </p> 
                        </div> 
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    $(function () {
        customElevateZoom();
    });

    function customElevateZoom() {
        //initiate the plugin and pass the id of the div containing gallery images 
        $(".zoom").elevateZoom({
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
