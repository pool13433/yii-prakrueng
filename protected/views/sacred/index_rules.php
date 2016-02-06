<fieldset>
    <legend>จัดการกฏ
        <a href="<?= Yii::app()->createUrl('sacred/indexRules') ?>" class="btn btn-primary btn-sm"> 
            <i class=" glyphicon glyphicon-plus"></i> ข้อมูลใหม่
        </a>
    </legend>
    <form class="form-horizontal" method="post" action="<?= Yii::app()->createUrl('sacred/rulesSave') ?>">
        <div class="form-group">
            <label class="col-sm-2 control-label">อธิบาย</label>
            <div class="col-sm-8">
                <input type="hidden" name="id" value="<?= $rules->rul_id ?>">
                <textarea class="form-control" rows="5" name="desc" required><?= $rules->rul_desc ?></textarea>
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
            <?php foreach ($listRules as $index => $rules) { ?>
                <tr>
                    <td><?= $rules->rul_id ?></td>
                    <td><?= $rules->rul_desc ?></td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('sacred/indexRules/' . $rules->rul_id) ?>" class="btn btn-warning btn-sm">แก้ไข</a>
                    </td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('sacred/rulesDelete/' . $rules->rul_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบ')">ลบ</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</fieldset>
