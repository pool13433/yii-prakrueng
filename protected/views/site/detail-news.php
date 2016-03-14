<?php
$baseUrl = Yii::app()->baseUrl;
?>
<!-- Content Begin-->
<section id="main-content" style="margin-left: 0px;">
    <section class="site-min-height">
        <div class="row">

            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="panel panel-warning panel-news">
                    <div class="panel-heading">
                        <h4><i class="glyphicon glyphicon-info-sign"></i> <?= $news->news_title ?></h4>
                    </div>
                    <div class="panel-body">
                        <?php if (!empty($news->news_img)) { ?>
                            <div class="row">
                                <div class="col-lg-10 col-lg-offset-2 col-sm-10 col-sm-offset-1">                                
                                    <a class="fancybox" href="<?= $baseUrl . '/images' . $news->news_img ?>">                                       
                                        <img class="img-responsive lazyload" alt="Responsive image"
                                             data-src="<?= $baseUrl . '/images' . $news->news_img ?>">
                                    </a>  
                                </div>
                            </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <p><?= $news->news_detail ?></p>
                                <hr/>
                            </div>
                        </div>
                        <p>ที่มา :: <a href="<?= $news->news_link ?>" target="_blank"><?= $news->news_link ?></a></p> 
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
            </div>
            <!-- Sidebar Right End -->

        </div>
    </section>
</section>
