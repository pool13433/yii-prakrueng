<fieldset>
    <legend>จัดการประเภทวัตถุมงคล
        <a href="<?= Yii::app()->createUrl('sacred/indexProvince') ?>" class="btn btn-primary btn-sm"> 
            <i class=" glyphicon glyphicon-plus"></i> ข้อมูลใหม่
        </a>
    </legend>
    <form class="form-horizontal" method="post" action="<?= Yii::app()->createUrl('sacred/provinceSave') ?>">
        <div class="form-group">
            <label class="col-sm-2 control-label">ชื่อ</label>
            <div class="col-sm-4">
                <input type="hidden" name="id" value="<?= $province->pro_id ?>">
                <input type="text" class="form-control" name="name_th" value="<?= $province->pro_name_th ?>" 
                       required autofocus placeholder="ชื่อ">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">ชื่ออังกฤษ</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="name_eng" value="<?= $province->pro_name_eng ?>" 
                       required autofocus placeholder="ชื่อ">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">ภูมิภาค</label>
            <div class="col-sm-4">
                <select class="form-control" name="region" required>
                    <?php foreach ($listRegion as $index => $region) { ?>
                        <?php if ($region->reg_id == $province->reg_id) { ?>
                            <option value="<?= $region->reg_id ?>" selected><?= $region->reg_name ?></option>
                        <?php } else { ?>
                            <option value="<?= $region->reg_id ?>"><?= $region->reg_name ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">
                    <i class="glyphicon glyphicon-saved"></i> บันทึก
                </button>
            </div>
        </div>
    </form>
</fieldset>
<fieldset>
    <legend>ข้อมูลประเภทวัตถุมงคล</legend>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อไทย</th>
                <th>ภูมิภาค</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listProvince as $index => $province) { ?>
                <tr>
                    <td><?= $province->pro_id ?></td>
                    <td><?= $province->pro_name_th ?></td>
                    <td><?= $province->region->reg_name ?></td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('sacred/indexProvince/' . $province->pro_id) ?>" class="btn btn-warning btn-sm">แก้ไข</a>
                    </td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('sacred/provinceDelete/' . $province->pro_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบ')">ลบ</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</fieldset>
