<div class="row">

    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">             
        <div class="row">                    
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 panel">
                <h4><i class="glyphicon glyphicon-info-sign"></i> ข่าวสารเกี่ยวกับพระเครื่อง</h4>

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
                <div class="row">
                    <div class="pull-right">
                        <?php
                        $this->renderPartial('/site/pagination_news', array(
                            'pagination' => $pagination
                        ))
                        ?>
                    </div>
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
