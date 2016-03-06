
<div id="login-page" class="login">
    <div class="container">

        <form class="form-login form-lg" id="form-login">
            <h2 class="form-login-heading">เข้าใช้งานระบบ</h2>
            <div class="login-wrap">
                <?php if (!empty(Yii::app()->session['message'])) { ?>
                    <div role="alert" class="alert alert-warning alert-dismissible fade in"> 
                        <button aria-label="Close" data-dismiss="alert" class="close" type="button">
                            <span aria-hidden="true">×</span></button> 
                        <strong>Login ไม่สำเร็จ</strong> <?= Yii::app()->session['message'] ?>
                    </div>
                <?php } ?>
                <div class="form-group">
                    <input type="text" autofocus="" name="username" placeholder="Username" class="form-control input-lg">
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" class="form-control input-lg">
                </div>
                <label class="checkbox">
                    <span class="pull-right">
                        <!--                        <a href="#" class="label label-default"> ลืม Password?</a>-->
                    </span>
                </label>
                <button type="submit" class="btn btn-success btn-block">
                    <i class="fa fa-lock"></i> เข้าระบบทันที
                </button>
                <div class="registration">
                    ยังไม่ได้ลงทะเบียนเป็นสมาชิกระบบ<br>
                    <a href="<?= Yii::app()->createUrl('site/rules') ?>" class="btn btn-block btn-xs btn-info">
                        <I class="fa fa-sign-in"></i> ลงทะเบียนทันที
                    </a>
                </div>
                <hr class="facebook"/>
                <button type="button" id="loginBtn"
                        class="btn btn-primary btn-block">
                    <i class="fa fa-facebook large"></i> Facebook Login
                </button>
                <div id="response"></div>
            </div>
        </form>	  	
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function () {
        if (facebookConnect) {
            getUserData();
        }
        $('#loginBtn').on('click', function () {
            //do the login
            Pace.track(function () {
                FB.login(function (response) {
                    if (response.authResponse) {
                        //user just authorized your app
                        document.getElementById('loginBtn').style.display = 'none';
                        getUserData();
                    }
                }, {scope: permissions});
            });
        });
    });

    $(function () {
        //checkUserInDatabase();
        $('#form-login').submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
                username: "required",
                password: "required",
            },
            messages: {
                username: "กรุณากรอกข้อมูล username",
                password: "กรุณากรอกข้อมูล password",
            },
            submitHandler: function (form) {
                //console.log(form);
                //$(form).submit();
                Pace.track(function () {
                    $.ajax({
                        url: '<?= Yii::app()->createUrl('site/login') ?>',
                        data: $(form).serialize(),
                        type: 'POST',
                        dataType: 'JSON',
                        success: function (response) {
                            if (response.status) {
                                window.location.href = response.url;
                            } else {
                                window.location.reload(true);
                            }
                        },
                        error: function () {

                        }
                    });
                });
            }
        });
    });
    /*
     * *************************** Handle Facebook Login *********************************
     */

</script>