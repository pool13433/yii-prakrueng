<form  id="form-change" class="form-horizontal style-form form-lg">
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h3><i class="fa fa-angle-right"></i> แก้ไชช้อมูลรหัสผ่านใหม่</h3>
        </div>
        <div class="panel-body">
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="username" class="col-sm-2 col-sm-2 control-label">username<small> *</small></label>
                        <div class="col-sm-4">
                            <input type="hidden" name="id" value="<?= $member->mem_id ?>">
                            <input type="text" class="form-control input-lg" readonly
                                   name="username" id="username" value="<?= $member->mem_username ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 col-sm-2 control-label">รหัสผ่าน เก่า <small> *</small></label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control input-lg" name="passwordOld" id="passwordOld"  value="<?= $member->mem_password ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 col-sm-2 control-label">รหัสผ่าน ใหม่<small> *</small></label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control input-lg" name="passwordNew" id="passwordNew"  value="<?= $member->mem_password ?>">
                        </div>
                        <label for="confirm_password" class="col-sm-2 col-sm-2 control-label">ยืนยันรหัสผ่านใหม่ อีกครั้ง <small> *</small></label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control input-lg" name="confirmPasswordNew" id="confirmPasswordNew"  value="<?= $member->mem_password ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn btn-success">
                        <i class="glyphicon glyphicon-ok-sign"></i> เปลี่ยนรหัสผ่าน
                    </button>
                </div>
            </div>  
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $('#passwordOld').focusout(function () {
            var elePassword = this
            var passwordLength = $(this).val().length;
            if (passwordLength > 0) {
                $.post('<?= Yii::app()->createUrl('Helper/CheckPasswordOld') ?>', {
                    username: $('#username').val(),
                    password: $('#passwordOld').val(),
                }, function (resp) {
                    if (!resp.status) {
                        alert('รหัสผ่านเก่าไม่ถูกต้องกรุณากรอกอีกครั้ง');
                        $(elePassword).val('');
                        $(elePassword).focus();
                    }
                }, 'json')
            }
        });

        $('#form-change').submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
                username: "required",
                passwordOld: "required",
                passwordNew: {
                    required: true,
                    equalTo: '#confirmPasswordNew'
                },
                confirmPasswordNew: {
                    required: true,
                    equalTo: '#passwordNew'
                },
            },
            messages: {
                username: "กรุณากรอก username",
                passwordOld: "กรุณากรอก รหัสผ่านเก่า",
                passwordNew: {
                    required: "กรุณากรอก รหัสใหม่",
                    equalTo: 'กรุณากรอก รหัสใหม่ ให้ตรงกัน'
                },
                confirmPasswordNew: {
                    required: "กรุณากรอก ยืนยันรหัสผ่านใหม่",
                    equalTo: 'กรุณากรอก ยืนยันรหัสผ่านใหม่ ให้ตรงกัน'
                },
            },
            submitHandler: function (form) {
                $.ajax({
                    url: '<?= Yii::app()->createUrl('Helper/SaveChanePasswordNew') ?>',
                    data: $(form).serialize(),
                    type: 'POST',
                    dataType: 'JSON',
                    success: function (response) {
                        if (response.status) {
                            window.location.href = response.url;
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function () {

                    }
                });
            }
        });

    });
</script>