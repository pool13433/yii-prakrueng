<div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <section id="main-content" style="margin-left: 0px;">
            <section class="site-min-height">
                <h3><i class="fa fa-angle-right"></i> ข่าวสารเกี่ยวกับพระเครื่อง</h3>
                <div class="row">
                    <div class="row pull-right">
                        <?php
                        $this->renderPartial('/site/pagination_news', array(
                            'pagination' => $pagination
                        ))
                        ?>
                    </div>
                </div>
                <?php foreach ($listSacredNews as $key => $news) { ?>
                    <div class="media">     
                        <div class="media-left"> 
                            <h4><?= $news->news_updatedate ?></h4>
                        </div>
                        <div class="media-body"> 
                            <h4 class="media-heading"><u><?= $news->news_title ?></u></h4> 
                            <p><?= $news->news_detail ?></p> 
                            <p>ที่มา :: <a href="<?= $news->news_link ?>" target="_blank"><?= $news->news_link ?></a></p> 
                        </div> 
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="row pull-right">
                        <?php
                        $this->renderPartial('/site/pagination_news', array(
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
