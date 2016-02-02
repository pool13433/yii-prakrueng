<fieldset>
    <legend>จัดการภูมิภาค
        <a href="<?= Yii::app()->createUrl('sacred/indexRegion') ?>" class="btn btn-primary btn-sm"> 
            <i class=" glyphicon glyphicon-plus"></i> ข้อมูลใหม่
        </a>
    </legend>
    <form class="form-horizontal" method="post" action="<?= Yii::app()->createUrl('sacred/regionSave') ?>">
        <div class="form-group">
            <label class="col-sm-2 control-label">ชื่อ</label>
            <div class="col-sm-4">
                <input type="hidden" name="id" value="<?= $region->reg_id ?>">
                <input type="text" class="form-control" name="name" value="<?= $region->reg_name ?>" 
                       required autofocus placeholder="ชื่อ">
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
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listRegion as $index => $region) { ?>
                <tr>
                    <td><?= $region->reg_id ?></td>
                    <td><?= $region->reg_name ?></td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('sacred/indexRegion/' . $region->reg_id) ?>" class="btn btn-warning btn-sm">แก้ไข</a>
                    </td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('sacred/regionDelete/' . $region->reg_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบ')">ลบ</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</fieldset>
