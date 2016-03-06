<?php
$baseUrl = Yii::app()->baseUrl;
?>
<div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

        <div class="panel panel-warning">
            <div class="panel-heading">
                <h4><i class="fa fa-sitemap"></i> ข้อมูลพระเครื่องของคุณที่ทำการได้ปล่อยเช่า</h4>
            </div>
            <div class="panel-body" style="overflow: scroll;">
                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>รูป</th>
                            <th>ลำดับ</th>
                            <th>ชื่อ</th>
                            <th>ราคา</th>
                            <th>หมวดหมู่</th>
                            <th>ชอบ</th>
                            <th>สถานะ</th>
                            <th>สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listSacredObject as $index => $object) { ?>
                            <tr>
                                <td>
                                    <a class="fancybox" href="<?= $baseUrl . '/images' . $object->obj_img ?>">                                       
                                        <img class="lazy img-responsive" alt="Responsive image"
                                             data-original="<?= $baseUrl . '/images' . $object->obj_img ?>"
                                             src="<?= $baseUrl . '/images' . $object->obj_img ?>"
                                             style="max-width: 75%;min-height: 100px;max-height: 100px;">
                                        <noscript>
                                        <img src="<?= $baseUrl . '/images' . $object->obj_img ?>" width="640" heigh="480">
                                        </noscript>
                                    </a>         
                                </td>
                                <td><?= ($index + 1) ?></td>
                                <td>
                                    <a href="<?= Yii::app()->createUrl('site/detail/' . $object->obj_id) ?>"><?= $object->obj_name ?></a>
                                </td>
                                <td><?= $object->obj_price ?></td>
                                <td><?= $object->type->type_name ?></td>
                                <td><?= $object->obj_like ?></td>
                                <td>
                                    <div class="btn-group">
                                        <div class="btn-group" role="group">
                                            <a href="<?= Yii::app()->createUrl('site/upload/' . $object->obj_id) ?>" class="btn btn-primary btn-sm">แก้ไข</a>
                                        </div>
                                        <div class="btn-group" role="group">
                                            <a href="<?= Yii::app()->createUrl('Site/UserDeleteSacred/' . $object->obj_id) ?>" 
                                               class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบข้อมูลออกจากระบบ')">ลบ</a>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 15%">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-danger btn-sm <?= ($object->obj_status == 0 ? 'active' : '') ?>"
                                               onclick="changeSacedStatus(<?= $object->obj_id ?>, 0)">
                                            <input type="radio" name="options" id="option1" <?= ($object->obj_status == 0 ? 'checked' : '') ?>> ส่วนตัว
                                        </label>
                                        <label class="btn btn-success btn-sm  <?= ($object->obj_status == 1 ? 'active' : '') ?>"
                                               onclick="changeSacedStatus(<?= $object->obj_id ?>, 1)">
                                            <input type="radio" name="options" id="option2" <?= ($object->obj_status == 1 ? 'checked' : '') ?>> เผยแพร่
                                        </label>
                                    </div>                                    
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

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
    function changeSacedStatus(id, status) {
        $.post('<?= Yii::app()->createUrl('helper/UpdateSacredStatus') ?>', {
            id: id,
            status: status
        }, function (response) {
            if (response.status) {
                //window.location.reload(true);
            } else {
                alert('System error');
            }
        }, 'json');
    }
</script>