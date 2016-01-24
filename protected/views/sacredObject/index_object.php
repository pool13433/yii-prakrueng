<fieldset>
    <legend>จัดการวัตถุมงคล</legend>
    <form class="form-horizontal" method="post" action="<?= Yii::app()->createUrl('sacredObject/objectSave') ?>">
        <div class="form-group">
            <label class="col-sm-2 control-label">ชื่อ</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="name" value="<?= $sacredObject->obj_name ?>" placeholder="ชื่อ">
            </div>
            <label class="col-sm-1 control-label">ราคา</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="price" value="<?= $sacredObject->obj_price ?>"  placeholder="ราคา">
            </div>
            <label class="col-sm-1 control-label">ปีที่สร้าง</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="year" value="<?= $sacredObject->obj_year ?>"  
                       maxlength="4" placeholder="ปีที่สร้าง">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">ประเภทวัตถดิบที่ใช้ทำ</label>
            <div class="col-sm-2">
                <select class="form-control" name="type">
                    <?php foreach ($listSacredType as $index => $type) { ?>
                        <?php if ($type->type_id == $sacredObject->type_id) { ?>
                            <option value="<?= $type->type_id ?>" selected><?= $type->type_name ?></option>
                        <?php } else { ?>
                            <option value="<?= $type->type_id ?>"><?= $type->type_name ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
            <label class="col-sm-2 control-label">ต้นกำเนิดจากจังหวัด</label>
            <div class="col-sm-3">
                <select class="form-control" name="province">
                    <?php foreach ($listProvince as $index => $province) { ?>
                        <?php if ($province->pro_id == $sacredObject->pro_id) { ?>
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
                <textarea class="form-control" name="comment"><?= $sacredObject->obj_comment ?></textarea>
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
                <th>ลำดับ</th>
                <th>ชื่อ</th>
                <th>ราคา</th>
                <th>ภาพ</th>
                <th>ปีที่สร้าง</th>
                <th>รายละเอียด</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listSacredObject as $index => $object) { ?>
                <tr>
                    <td><?= $object->obj_id ?></td>
                    <td><?= $object->obj_name ?></td>
                    <td><?= $object->obj_price ?></td>
                    <td><?= $object->obj_img ?></td>
                    <td><?= $object->obj_year ?></td>
                    <td><?= $object->obj_comment ?></td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('sacredObject/index/' . $object->obj_id) ?>" class="btn btn-warning btn-sm">แก้ไข</a>
                    </td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('sacredObject/objectDelete/' . $object->obj_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบ')">ลบ</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</fieldset>
