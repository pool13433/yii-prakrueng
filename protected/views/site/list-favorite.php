<?php
$baseUrl = Yii::app()->baseUrl;
?>
<div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h4><i class="fa fa-heart"></i> พระที่ท่านชื่นชอบ</h4>
            </div>
            <div class="panel-body">
                <!-- -- 1st ROW OF PANELS ---->
                <div id="boxPraKreung" class="row">
                    <?php foreach ($listSacredObjectFavorite as $index => $object) { ?>
                        <div class="col-lg-4 col-md-4 col-sm-4 mb">        
                            <div class="panel panel-warning">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title" style="padding-top: 7.5px;"><b><i class="fa fa-circle-o"></i> <?= $object->obj_name ?></h4>
                                    <h4 class="panel-title fa fa-money" style="padding-top: 7.5px;"><b> <?= $object->obj_price ?></b></h4>
                                </div>
                                <div class="panel-body">
                                    <div class="thumbnail">
                                        <a class="fancybox" href="<?= $baseUrl . '/images/' . $object->obj_img ?>">                                       
                                            <img class="img-responsive" src="<?= $baseUrl . '/images/' . $object->obj_img ?>"
                                                 style="max-width: 75%;min-height: 180px;" alt="">
                                        </a>                                                                 
                                    </div>
                                    <p class="pull-right">
                                        <button  type="button" class="btn btn-danger btn-xs" title="ลบออกจากพระที่ชื่นชอบ"
                                                 onclick="updateMemberObjectActionFavorite(<?= $object->obj_id ?>)">
                                            <i class="fa fa-heart-o"></i> 
                                        </button>
                                        <a href="<?= Yii::app()->createUrl('site/detail/' . $object->obj_id) ?>" title="อ่านข้อมูลเพิ่มเติม..."
                                           class="btn btn-warning btn-xs">
                                            <i class="fa fa-flag"></i> อ่านต่อ...
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div><!-- /END 6TH ROW OF PANELS -->
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
<!-- Co ntent End --> 
<script type="text/javascript">
    $(document).ready(function () {
        $(".fancybox").fancybox({'width': 400,
            'height': 300,
            'autoSize': false});
    });
    function updateMemberObjectActionFavorite(id) {
        var isConfirm = confirm('ยืนยันการลบข้อมูลพระที่ชื่นชอบออก');
        if (isConfirm) {
            $.get('<?= Yii::app()->createUrl('helper/RemoveMemberObjectActionFavorite') ?>', {
                id: id,
                action: 'FAVORITE',
                value: 0
            },
            function (response) {
                console.log(response);
                if (response.status) {                    
                    window.location.reload(true);
                }else{
                    alert(response.message);
                }

            }, 'json');
        }
    }
</script>