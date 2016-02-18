<fieldset>
    <legend>จัดการสมาชิก
        <a href="<?= Yii::app()->createUrl('member/index') ?>" class="btn btn-primary btn-sm"> 
            <i class=" glyphicon glyphicon-plus"></i> ข้อมูลใหม่
        </a>
        <a href="<?= Yii::app()->createUrl('member/indexLevel') ?>" class="btn btn-info btn-sm">
            <i class="glyphicon glyphicon-list"></i> จัดการระดับ
        </a>
    </legend>
    <form class="form-horizontal" method="post" action="<?= Yii::app()->createUrl('member/memberSave') ?>">
        <div class="form-group">
            <label class="col-sm-2 control-label">รูป</label>
            <div class="col-sm-4">
                <input type="file" class="form-control" name="img" value="<?= $member->mem_fname ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">ชื่อ</label>
            <div class="col-sm-3">
                <input type="hidden" name="id" value="<?= $member->mem_id ?>"/>
                <input type="text" class="form-control" name="fname" value="<?= $member->mem_fname ?>" 
                       required placeholder="ชื่อ">
            </div>
            <label class="col-sm-2 control-label">สกุล</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="lname" value="<?= $member->mem_lname ?>" 
                       required placeholder="สกุล">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">โทร</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="phone" value="<?= $member->mem_phone ?>" 
                       required placeholder="เบอร์โทร">
            </div>
            <label class="col-sm-2 control-label">อีเมลล์</label>
            <div class="col-sm-3">
                <input type="email" class="form-control" name="email" value="<?= $member->mem_email ?>" placeholder="อีเมลล์">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">เพศ</label>
            <div class="col-sm-2">
                <select class="form-control" name="sex" required>
                    <?php if ('F' == $member->mem_sex) { ?>
                        <option value="F" selected>หญิง</option>
                        <option value="M">ชาย</option>
                    <?php } else { ?>
                        <option value="F">หญิง</option>
                        <option value="M" selected>ชาย</option>
                    <?php } ?>
                </select>
            </div>
            <label class="col-sm-2 control-label">ระดับ</label>
            <div class="col-sm-2">
                <select class="form-control" name="level" required>
                    <?php foreach ($listLevel as $index => $level) { ?>
                        <?php if ($level->level_id == $member->mem_level) { ?>
                            <option value="<?= $level->level_id ?>" selected><?= $level->level_name ?></option>
                        <?php } else { ?>
                            <option value="<?= $level->level_id ?>"><?= $level->level_name ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
            <div class="col-sm-2">
                <a href="<?= Yii::app()->createUrl('member/indexLevel') ?>" class="btn btn-info btn-sm">
                    <i class="glyphicon glyphicon-list"></i> จัดการระดับ
                </a>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">สถานะ</label>
            <div class="col-sm-2">
                <label class="radio-inline">
                    <input type="radio" name="status" value="1" <?=($member->mem_status == '1' ? 'checked' : '')?> required> User,Member
                </label>
                <label class="radio-inline">
                    <input type="radio" name="status" value="0" <?=($member->mem_status == '0' ? 'checked' : '')?>> Administrator
                </label>                
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">ที่อยู่</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="address"><?= $member->mem_address ?></textarea>
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
    <legend>ข้อมูลสมาชิก</legend>
    <table class="table table-bordered table-striped datatable">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อ</th>
                <th>สกุล</th>
                <th>โทร</th>                
                <th>อีเมลล์</th>
                <th>สถานะ</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listMember as $index => $mem) { ?>
                <tr>
                    <td><?= ($index + 1) ?></td>
                    <td><?= $mem->mem_fname ?></td>
                    <td><?= $mem->mem_lname ?></td>
                    <td><?= $mem->mem_phone ?></td>
                    <td><?= $mem->mem_email ?></td>
                    <td><?= $mem->mem_status_desc ?></td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('member/index/' . $mem->mem_id) ?>" class="btn btn-warning btn-sm">แก้ไข</a>
                    </td>
                    <td>
                        <a onclick="return confirm('ยืนยันการลบ')" href="<?= Yii::app()->createUrl('member/memberDelete/' . $mem->mem_id) ?>" class="btn btn-danger btn-sm">ลบ</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</fieldset>
