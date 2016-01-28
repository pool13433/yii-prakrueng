<!-- BASIC FORM ELELEMNTS -->
<form  id="form-register" class="form-horizontal style-form" method="post" action="<?= Yii::app()->createUrl($action_url) ?>">
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h4><i class="fa fa-angle-right"></i> <?= (empty($form_title) ? 'ลงทะเบียนเพื่อเข้าร่วมเป็นสมาชิกของเรา' : $form_title) ?></h4>
        </div>
        <div class="panel-body">
            <div class="row mt">
                <div class="col-lg-12">


                    <div class="form-group">
                        <label for="username" class="col-sm-2 col-sm-2 control-label">username</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="username" value="<?= $member->mem_username ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 col-sm-2 control-label">password</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="password" id="password"  value="<?= $member->mem_password ?>">
                        </div>
                        <label for="confirm_password" class="col-sm-2 col-sm-2 control-label">confirm password</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password"  value="<?= $member->mem_password ?>">
                        </div>
                    </div>

                    <?php if (!empty($profile) && $profile) { ?>
                        <div class="form-group">
                            <label for="fname" class="col-sm-2 col-sm-2 control-label">ชื่อจริง</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="fname" value="<?= $member->mem_fname ?>">
                            </div>
                            <label for="lname" class="col-sm-2 col-sm-2 control-label">นามสกุล</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="lname" value="<?= $member->mem_lname ?>">
                            </div>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">เพศ</label>
                        <div class="col-sm-2">
                            <select class="form-control" name="sex" required>
                                <option value="" selected>-- กรุณาเลือก --</option>
                                <?php if ($member->mem_sex == "F") { ?>
                                    <option value="F" selected>หญิง</option>
                                    <option value="M">ชาย</option>
                                <?php } else { ?>
                                    <option value="F">หญิง</option>
                                    <option value="M" selected>ชาย</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-2 col-sm-2 control-label">โทรศัพท์</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="phone" maxlength="10" value="<?= $member->mem_phone ?>">
                        </div>
                        <label for="email" class="col-sm-2 col-sm-2 control-label">อีเมลล์</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="email" value="<?= $member->mem_email ?>">
                        </div>
                    </div>

                    <?php if (!empty($profile) && $profile) { ?>
                        <div class="form-group">
                            <label for="phone" class="col-sm-2 col-sm-2 control-label">ที่อยู่</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="address" rows="4"><?= $member->mem_address ?></textarea>
                            </div>
                        </div>
                    <?php } ?>


                </div><!-- col-lg-12-->      	
            </div><!-- /row -->
        </div>
        <div class="panel-footer">
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn btn-success">
                        <i class="glyphicon glyphicon-ok-sign"></i> ลงทะเบียน
                    </button>
                    <?php if (empty($profile)) { ?>
                        <a href="<?= Yii::app()->createUrl("site/login") ?>" class="btn btn-warning btn-sm">
                            <i class="glyphicon glyphicon-arrow-left"></i> กลับเพื่อไป Login
                        </a>
                    <?php } ?>
                </div>
            </div>  
        </div>
    </div>
</form>

<script type = "text/javascript" >
    $(function () {
        $('#form-register').validate({
            rules: {
                username: "required",
                password: {
                    required: true,
                    equalTo: '#confirm_password'
                },
                confirm_password: {
                    required: true,
                    equalTo: '#password'
                },
                sex: "required",
                phone: {
                    required: true,
                    number: true,
                    maxlength: 10,
                },
                email: {
                    required: true,
                    email: true,
                }
            },
            messages: {
                username: "กรุณากรอก username",
                password: {
                    required: "กรุณากรอก password",
                    equalTo: 'กรุณากรอก password ให้ตรงกัน'
                },
                confirm_password: {
                    required: "กรุณากรอก confirm password",
                    equalTo: 'กรุณากรอก confirm password ให้ตรงกัน'
                },
                sex: "กรุณาเลือกเพศ",
                phone: {
                    required: "กรุณากรอกเบอร์โทรศัพท์",
                    number: "กรุณากรอกเบอร์โทรศัพท์ เป็นตัวเลขเท่านั้น",
                    maxlength: "กรุณากรอกเบอร์โทรศัพท์ เป็นตัวเลขไม่เกิน 10 ตัวอักษร",
                },
                email: {
                    required: "กรุณากรอกข้อมูล email",
                    email: "กรุณากรอกข้อมูล email ให้ถูกต้องตามรูปแบบ",
                }
            },
            submitHandler: function (form) {
                $(form).submit();
            }
        });
    });

</script>