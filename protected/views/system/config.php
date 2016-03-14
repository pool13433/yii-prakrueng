<fieldset>
    <legend>ตั้งค่าการใช้งานระบบ</legend>
    <form class="form-horizontal" action="<?= Yii::app()->createUrl('System/SaveConfig') ?>" method="post">
        <?php foreach ($configs as $config) { ?>
            <div class="form-group">
                <label for="<?= $config->name ?>" class="col-sm-2 control-label"><?= $config->label ?></label>
                <div class="col-lg-2 col-md-10 col-sm-10 col-xs-10">
                    <?php if ($config->name == 'image_resize') { ?>
                        <?php $percentResize = WebConfig::getPercentResize(); ?>
                        <select class="form-control" name="<?= $config->name ?>" id="<?= $config->name ?>">
                            <?php foreach ($percentResize as $key => $value) { ?>
                                <?php if ($key == $config->value) { ?>
                                    <option value="<?= $key ?>" selected><?= $value ?></option>
                                <?php } else { ?>
                                    <option value="<?= $key ?>"><?= $value ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    <?php } else { ?>
                        <input type="number" class="form-control" id="<?= $config->name; ?>" 
                               value="<?= $config->value; ?>" required 
                               name="<?= $config->name ?>">
                           <?php } ?>
                </div>
                <label class="col-sm-1 control-label"><?= $config->unit ?></label>
            </div>
        <?php } ?>
        <div class="form-group">
            <div class="col-lg-4 col-lg-offset-2 col-md-10 col-sm-10 col-xs-10">
                <button type="submit" class="btn btn-success">
                    <i class="glyphicon glyphicon-ok"></i> บันทึก
                </button>
            </div>
        </div>
    </form>

</fieldset>