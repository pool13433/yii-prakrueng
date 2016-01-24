<!-- BASIC FORM ELELEMNTS -->
<div class="row mt">
    <div class="col-lg-12">
        <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i> ลงทะเบียนเพื่อเข้าร่วมเป็นสมาชิกของเรา</h4>
            <form  id="form-register" class="form-horizontal style-form" method="post" action="<?= Yii::app()->createUrl('site/register') ?>">

                <div class="form-group">
                    <label for="username" class="col-sm-2 col-sm-2 control-label">username</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="username">
                        <span class="help-block label label-danger">กรุณากรอก username</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-2 col-sm-2 control-label">password</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="password">
                        <span class="help-block label label-danger">กรุณากรอก password  4 อักษรขึ้นไป</span>
                    </div>
                    <label for="confirm-password" class="col-sm-2 col-sm-2 control-label">confirm password</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="confirm-password">
                        <span class="help-block label label-danger">กรุณากรอกยืนยัน password อีกครั้ง</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">เพศ</label>
                    <div class="col-sm-2">
                        <select class="form-control" name="sex" required>
                            <option value="F">หญิง</option>
                            <option value="M">ชาย</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-sm-2 col-sm-2 control-label">โทรศัพท์</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="phone">
                        <span class="help-block label label-danger">กรุณากรอกเบอร์โทรศัพท์ 10 หลัก</span>
                    </div>
                    <label for="email" class="col-sm-2 col-sm-2 control-label">อีเมลล์</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="email">
                        <span class="help-block label label-danger">กรุณากรอกอีเมลล์</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="glyphicon glyphicon-ok-sign"></i> ลงทะเบียน
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- col-lg-12-->      	
</div><!-- /row -->

<script type="text/javascript">
    $(function () {
        $('#form-register').submit(function (e) {

            var $inputs = $(this).find('input');
            var isValidate = false;
            $inputs.each(function (index, element) {
                var span = $(element).parent().find('span');
                var label = $(element).parent().parent().find('label [for="' + $(element).prop('for') + '"]');
                span.text('');
                if ($(element).val() == '') {
                    isValidate = true;
                    $(element).parent().find('span').text('กรุณากรอกข้อมูล ' + label.text()).addClass('label label-danger');
                }
            });
            if (isValidate) {
                console.log('countValidate.length :;==' + isValidate);
                return false;
            } else {
                return true;
            }
            e.preventDefault();
        })
    })
</script>