<fieldset>
    <legend>จัดการข่าวประชาสัมพันธ์
        <a href="<?= Yii::app()->createUrl('sacred/indexNews') ?>" class="btn btn-primary btn-sm"> 
            <i class=" glyphicon glyphicon-plus"></i> ข้อมูลใหม่
        </a>
    </legend>
    <form class="form-horizontal" method="post" action="<?= Yii::app()->createUrl('sacred/newsSave') ?>">

        <div class="form-group">
            <label class="col-sm-2 control-label">ชื่อ</label>
            <div class="col-sm-4">
                <input type="hidden" name="id" value="<?= $news->news_id ?>">
                <input type="text" class="form-control" name="title" value="<?= $news->news_title ?>" 
                       required autofocus placeholder="หัวข้อ">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">รายละเอียด</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="10" name="detail"><?= $news->news_detail ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">ลิ้งที่มา</label>
            <div class="col-sm-9">
                <input type="url" class="form-control" name="link" value="<?= $news->news_link ?>" 
                       placeholder="ลิ้ง">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button news="submit" class="btn btn-success">
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
                <th>ชื่อ</th>
                <th>รายละเอียด</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listNews as $index => $news) { ?>
                <tr>
                    <td><?= $news->news_id ?></td>
                    <td>
                        <a href="<?=$news->news_link?>" target="_blank"><?= $news->news_title ?></a>
                    </td>
                    <td><?= $news->news_detail ?></td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('sacred/indexNews/' . $news->news_id) ?>" class="btn btn-warning btn-sm">แก้ไข</a>
                    </td>
                    <td>
                        <a href="<?= Yii::app()->createUrl('sacred/newsDelete/' . $news->news_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบ')">ลบ</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</fieldset>
