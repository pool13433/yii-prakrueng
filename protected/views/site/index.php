<?php
$baseUrl = Yii::app()->baseUrl;
?>
<!-- Content Begin-->
<section id="main-content" style="margin-left: 0px;">
    <section class="site-min-height">
        <h3><i class="fa fa-angle-right"></i> <?= $title ?></h3>
        <div class="row mt mb">


            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

                <!-- -- 1st ROW OF PANELS ---->
                <div id="boxPraKreung" class="row">
                    <?php foreach ($listSacredObject as $index => $object) { ?>
                        <div class="col-lg-4 col-md-4 col-sm-4 mb">        
                            <div class="panel panel-warning">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title pull-left" style="padding-top: 7.5px;"><b><?= $object->obj_name ?></h4>
                                    <h4 class="panel-title pull-right" style="padding-top: 7.5px;"><b><?= $object->obj_price ?></b></h4>
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
                <div class="row pull-right">
                    <nav>
                        <ul class="pagination">
                            <li>
                                <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                                <a href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
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

    </section><!-- --/wrapper ---- >
</section>
    <!-- Co ntent End --> 
    <script type="text/javascript">
        $(document).ready(function () {
            $(".fancybox").fancybox({'width': 400,
                'height': 300,
                'autoSize': false});
        });
    </script>