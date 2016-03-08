<!-- BASIC FORM ELELEMNTS -->
<form  id="form-register" class="form-horizontal style-form form-lg">
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h3><i class="fa fa-angle-right"></i> <?= (empty($form_title) ? 'ลงทะเบียนเพื่อเข้าร่วมเป็นสมาชิกของเรา' : $form_title) ?></h3>
        </div>
        <div class="panel-body">
            <div class="row mt">
                <div class="col-lg-12">
                    <?php if (empty($profile->facebook_id) && empty(Yii::app()->session['member'])) { ?>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 col-sm-2 control-label">username<small> *</small></label>
                            <div class="col-sm-4">
                                <input type="hidden" name="id" value="<?= $member->mem_id ?>">
                                <input type="text" class="form-control input-lg" name="username" value="<?= $member->mem_username ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 col-sm-2 control-label">password <small> *</small></label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control input-lg" name="password" id="password"  value="<?= $member->mem_password ?>">
                            </div>
                            <label for="confirm_password" class="col-sm-2 col-sm-2 control-label">confirm password <small> *</small></label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control input-lg" name="confirm_password" id="confirm_password"  value="<?= $member->mem_password ?>">
                            </div>
                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <label for="fname" class="col-sm-2 col-sm-2 control-label">ชื่อจริง <small> *</small></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control input-lg" name="fname" value="<?= $member->mem_fname ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lname" class="col-sm-2 col-sm-2 control-label">นามสกุล</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="lname" value="<?= $member->mem_lname ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">เพศ <small> *</small></label>
                        <div class="col-sm-3">
                            <select class="form-control input-lg" name="sex" required>
                                <option value="" selected>-- กรุณาเลือก --</option>
                                <?php $genders = Member::gender() ?>
                                <?php foreach ($genders as $key => $gender) { ?>
                                    <?php if ($member->mem_sex == $key) { ?>
                                        <option value="<?= $key ?>" selected><?= $gender ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $key ?>"><?= $gender ?></option>
                                    <?php } ?>
                                <?php } ?>                                                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-2 col-sm-2 control-label">โทรศัพท์ <small> *</small></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control input-lg" name="phone" maxlength="10" value="<?= $member->mem_phone ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 col-sm-2 control-label">อีเมลล์</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="email" value="<?= $member->mem_email ?>">
                        </div>
                    </div>

                    <?php if (!empty($profile) && $profile) { ?>
                        <div class="form-group">
                            <label for="phone" class="col-sm-2 col-sm-2 control-label">ที่อยู่</label>
                            <div class="col-sm-8">
                                <textarea class="form-control input-lg" name="address" rows="4"><?= $member->mem_address ?></textarea>
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
    $.validator.addMethod("regex", function (value, element, regexp) {
        var check = false;
        return this.optional(element) || regexp.test(value);
    }, "Please check your input.");

    $(function () {
        $('#form-register').submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
                username: {
                    required: true,
                    regex: /^[a-zA-Z0-9]+$/
                },
                password: {
                    required: true,
                    equalTo: '#confirm_password',
                    regex: /^[a-zA-Z0-9]+$/
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
                fname: "required"
            },
            messages: {
                username: {
                    require: "กรุณากรอก username",
                    regex: 'กรุณากรอก ตัวเลขกับอักษรภาษาอังกฤษเท่านั้น',
                },
                password: {
                    required: "กรุณากรอก password",
                    equalTo: 'กรุณากรอก password ให้ตรงกัน',
                    regex: 'กรุณากรอก ตัวเลขกับอักษรภาษาอังกฤษเท่านั้น',
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
                fname: "กรุณากรอกชื่อ"
            },
            submitHandler: function (form) {
                $.ajax({
                    url: '<?= $action_url ?>',
                    data: $(form).serialize(),
                    type: 'POST',
                    dataType: 'JSON',
                    success: function (response) {
                        if (response.status) {
                            window.location.href = response.url;
                        } else {
                            alert(response.message);
                            //window.location.reload(true);
                        }
                    },
                    error: function () {

                    }
                });
            }
        });
    });

</script>