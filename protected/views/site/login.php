<div id="login-page">
    <div class="container">

        <form action="<?= Yii::app()->createUrl('site/login') ?>" class="form-login" method="post" id="form-login">
            <h2 class="form-login-heading">เข้าใช้งานระบบ</h2>
            <div class="login-wrap">
                <?php if (!empty(Yii::app()->session['message'])) { ?>
                    <span class="help-block label label-danger"><?= Yii::app()->session['message'] ?></span>
                <?php } ?>
                <div>
                    <input type="text" autofocus="" name="username" placeholder="Username" class="form-control">
                    <span class="help-block label label-danger">กรุณากรอก username</span>
                </div>
                <br>
                <div>
                    <input type="password" name="password" placeholder="Password" class="form-control">
                    <span class="help-block label label-danger">กรุณากรอก password</span>
                </div>
                <label class="checkbox">
                    <span class="pull-right">
                        <a href="login.html#myModal" data-toggle="modal"> ลืม Password?</a>
                    </span>
                </label>
                <button type="submit" class="btn btn-theme btn-block">
                    <i class="fa fa-lock"></i> เข้าระบบทันที
                </button>
                <hr>
                <div class="registration">
                    ยังไม่ได้ลงทะเบียนเป็นสมาชิกระบบ<br>
                    <a href="<?= Yii::app()->createUrl('site/register') ?>" class="">
                        ลงทะเบียนทันที
                    </a>
                </div>
            </div>
        </form>	  	
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#form-login').submit(function (e) {
            var $inputs = $(this).find('input');
            var isValidate = false;
            $inputs.each(function (index, element) {
                var span = $(element).parent().find('span.help-block');
                var label = $(element).parent().parent().find('label [for="' + $(element).prop('for') + '"]');
                if ($(element).val() == '') {
                    isValidate = true;
                    span.text('กรุณากรอกข้อมูล ' + label.text()).addClass('label label-danger');
                } else {
                    span.text('');
                }
            });
            if (isValidate) {
                return false;
            } else {
                return true;
            }
            e.preventDefault();
        });
    });
</script>