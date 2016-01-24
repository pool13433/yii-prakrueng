
<fieldset>
    <legend>จัดการระดับ  
        <a href="<?= Yii::app()->createUrl('member/indexLevel') ?>" class="btn btn-primary btn-sm"> 
            <i class=" glyphicon glyphicon-plus"></i> ข้อมูลใหม่
        </a>
        <a href="<?= Yii::app()->createUrl('member/index') ?>" class="btn btn-info btn-sm">
            <i class="glyphicon glyphicon-user"></i> จัดการผู้ใช้งาน
        </a>
    </legend>
    <form class="form-horizontal" method="post" action="<?= Yii::app()->createUrl('member/levelSave') ?>">

        <div class="form-group">
            <label class="col-sm-2 control-label">ชื่อ</label>
            <div class="col-sm-3">
                <input type="hidden" name="id" value="<?= $level->level_id ?>"/>
                <input type="text" class="form-control" name="name" value="<?= $level->level_name ?>" 
                       autofocus required placeholder="ชื่อ">
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
    <legend>ข้อมูลระดับ</legend>
    <table class="table table-bordered table-striped datatable">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อ</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listLevel as $index => $level) { ?>
                <tr>
                    <td><?= ($index + 1) ?></td>
                    <td><?= $level->level_name ?></td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('member/indexLevel/' . $level->level_id) ?>" class="btn btn-warning btn-sm">แก้ไข</a>
                    </td>
                    <td>
                        <a onclick="return confirm('ยืนยันการลบ')" href="<?= Yii::app()->createUrl('member/levelDelete/' . $level->level_id) ?>" class="btn btn-danger btn-sm">ลบ</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</fieldset>
