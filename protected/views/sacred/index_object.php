<?php
$baseUrl = Yii::app()->baseUrl;
$image = '/image_main.png';
if (!empty($sacred->obj_img)) {
    $image = $sacred->obj_img;
}
?>
<fieldset>
    <legend>จัดการวัตถุมงคล</legend>
    <form class="form-horizontal" method="post" action="<?= Yii::app()->createUrl('sacred/objectSave') ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-4">รูปหลัก</label>
            <div class="col-lg-3 col-md-6 col-sm-3 col-xs-7 box-browse-upload">
                <input type="file" id="fileMain" name="fileMain" <?=(empty($sacred->obj_id) ? 'required' : '')?>/>
                <a class="thumbnail">
                    <img id="imgMain" class="img-rounded" style="max-width: 60%;" src="<?= $baseUrl . '/images' . $image ?>"/>
                </a>
                <span class="label label-warning">กรุณากรอกข้อมูล รูปหลักสินค้า</span>
            </div>                
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">ชื่อ</label>
            <div class="col-sm-4">
                <input type="hidden" name="id" value="<?=$sacred->obj_id?>"/>
                <input type="text" class="form-control" name="name" value="<?= $sacred->obj_name ?>" required  placeholder="ชื่อ">
            </div>
            <label class="col-sm-1 control-label">ราคา</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="price" value="<?= $sacred->obj_price ?>" required placeholder="ราคา">
            </div>
            <label class="col-sm-1 control-label">ปีที่สร้าง</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="year" value="<?= $sacred->obj_born ?>"  
                       maxlength="4" placeholder="ปีที่สร้าง" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">ประเภทวัตถดิบที่ใช้ทำ</label>
            <div class="col-sm-2">
                <select class="form-control" name="type" required>
                    <?php foreach ($listSacredType as $index => $type) { ?>
                        <?php if ($type->type_id == $sacred->type_id) { ?>
                            <option value="<?= $type->type_id ?>" selected><?= $type->type_name ?></option>
                        <?php } else { ?>
                            <option value="<?= $type->type_id ?>"><?= $type->type_name ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
            <label class="col-sm-2 control-label">ต้นกำเนิดจากจังหวัด</label>
            <div class="col-sm-3">
                <select class="form-control" name="province" required>
                    <?php foreach ($listProvince as $index => $province) { ?>
                        <?php if ($province->pro_id == $sacred->pro_id) { ?>
                            <option value="<?= $province->pro_id ?>" selected><?= $province->pro_name_th ?></option>
                        <?php } else { ?>
                            <option value="<?= $province->pro_id ?>"><?= $province->pro_name_th ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">รายละเอียด</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="comment"><?= $sacred->obj_comment ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success btn-lg">บันทึก</button>
            </div>
        </div>
    </form>
</fieldset>
<fieldset>
    <legend>จัดการวัตถุมงคล</legend>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ภาพ</th>
                <th>ชื่อ</th>
                <th>ราคา</th>                
                <th>ปีที่สร้าง</th>
                <th>รายละเอียด</th>
                <th style="width: 10%;">รูปที่เกี่ยวข้อง</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listSacredObject as $index => $object) { ?>
                <tr>
                    <td title="<?=$object->obj_img?>">
                        <a href="<?= $baseUrl.'/images'.$object->obj_img ?>" class="thumbnail fancybox">
                            <img src="<?= $baseUrl.'/images'.$object->obj_img ?>" 
                                 style="max-height: 100px;max-width: 100px;"
                                 alt="...">
                        </a>
                     </td>
                    <td><?= $object->obj_name ?></td>
                    <td><?= $object->obj_price ?></td>                    
                    <td><?= $object->obj_born ?></td>
                    <td><?= $object->obj_comment ?></td>
                    <td style="text-align: center"><?= $object->count_img ?></td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('sacred/index/' . $object->obj_id) ?>" class="btn btn-warning btn-sm">แก้ไข</a>
                    </td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('sacred/objectDelete/' . $object->obj_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบ')">ลบ</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</fieldset>
<script type="text/javascript">
    $(function () {
        $('#imgMain').on('click', function () {
            $('#fileMain').trigger('click');
        });
        $("#fileMain").change(function () {
            readURL(this);
        });
    })
</script>
