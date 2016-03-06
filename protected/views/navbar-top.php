
<nav id="my-menu" class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?= Yii::app()->createUrl('site/index') ?>" 
           style="font-size: 2.5em;font-weight: bold"><u>สุดยอดพระเครื่อง</u>
        </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
            <li>
                <a href="<?= Yii::app()->createUrl('site/news') ?>">
                    <i class="fa fa-rss-square"></i> ข่าวสารเกี่ยวกับพระเครื่อง
                </a>
            </li>
            <li>
                <a href="<?= Yii::app()->createUrl('site/upload') ?>">
                    <i class="fa fa-sitemap"></i> อยากปล่อยเช่า
                </a>
            </li> 
        </ul>
        <ul class="nav navbar-nav navbar-right">

            <?php if (empty(Yii::app()->session['member'])) { ?>
                <li>
                    <?php
                    /*
                     * Manage URL Domain
                     */
                    $finalUrl = str_replace("//", "//www.", Yii::app()->getBaseUrl(true)) . '/site/login';
                    $finalUrl = str_replace('www.www.', 'www.', $finalUrl);
                    ?>
                    <a href="<?= $finalUrl ?>">
                        <i class="glyphicon glyphicon-log-in"></i>
                        เข้าระบบ</a>                    
                </li>
                <li>
                    <a href="<?= Yii::app()->createUrl('site/rules') ?>"><i class="glyphicon glyphicon-registration-mark"></i> ลงทะเบียน</a>
                </li>
            <?php } else { ?>
                <?php $member = Yii::app()->session['member'] ?>

                <?php if ($member->mem_status == 0) { ?>
                                                                                                                                                                                                                                                                                                                                <!--                    <li><a href="#">ข้อมูลพระเครื่อง <span class="sr-only">(current)</span></a></li>-->

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ข้อมูลพระเครื่อง <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= Yii::app()->createUrl('sacred/index') ?>">พระเครื่อง</a></li>
                            <li><a href="<?= Yii::app()->createUrl('sacred/indexType') ?>">ประเภทพระเครื่อง</a></li>
                            <li role="separator" class="divider"></li>
        <!--                            <li><a href="<?= Yii::app()->createUrl('sacred/indexRegion') ?>">ภูมิภาค</a></li>-->
                            <li><a href="<?= Yii::app()->createUrl('sacred/indexProvince') ?>">จังหวัดกำเนิด</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?= Yii::app()->createUrl('sacred/indexNews') ?>">ข่าว</a></li>
                            <li><a href="<?= Yii::app()->createUrl('sacred/indexRules') ?>">กฏกติกา</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ข้อมูลสมาชิก <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= Yii::app()->createUrl('member/index') ?>">สมาชิก</a></li>
                            <li><a href="<?= Yii::app()->createUrl('member/indexLevel') ?>">ระดับสมาชิก</a></li>
                        </ul>
                    </li>
                <?php } ?>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="glyphicon glyphicon-user"></i> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?= Yii::app()->createUrl('site/usersacredlist') ?>">
                                <i class="fa fa-sitemap"></i>  พระเครื่องที่ปล่อยเช่า
                            </a>
                        </li>
                        <li>
                            <a href="<?= Yii::app()->createUrl('site/userfavoritelist') ?>">
                                <i class="fa fa-heart"></i> พระเครื่องที่ชื่อชอบ
                            </a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="<?= Yii::app()->createUrl('site/userprofile') ?>">
                                <i class="fa fa-user"></i> แก้ไขข้อมูลส่วนตัว
                            </a>
                        </li>
                        <?php if (empty($member->facebook_id)) { ?>
                            <li>
                                <a href="<?= Yii::app()->createUrl('site/passwordChange') ?>">
                                    <i class="fa fa-lock"></i> แก้ไขข้อมูลรหัสผ่าน
                                </a>
                            </li>
                        <?php } ?>
                        <li role="separator" class="divider"></li>
                        <li><a href="javascript:void(0)" id="handleLogout">
                                <i class="fa fa-sign-out"></i> ออกจากระบบ</a>
                        </li>
                    </ul>
                </li>
            <?php } ?>

        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
<?php $config = WebConfig::model()->findByAttributes(array('name' => 'facebook_appid')); ?>
<script type="text/javascript">
    var facebookConnect = false;
    /*
     * http://code.runnable.com/UTlPL1-f2W1TAAAZ/get-user-details-email-address-with-javascript-sdk-for-facebook
     * @type Array|@call;join
     */
    var permissions = [
        'email',
        'user_birthday',
        'user_likes'
    ].join(',');
    var fields = [
        'id',
        'name',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'locale',
        'languages',
        'link',
        //'username',
        'third_party_id',
        'installed',
        'timezone',
        'updated_time',
        'verified',
        'age_range',
        'bio',
        'birthday'
    ].join(',');

    $(document).ready(function () {
        handleLogout();
    });

    window.fbAsyncInit = function () {
        //SDK loaded, initialize it
        FB.init({
            appId: '<?= $config->value ?>',
            status: true, // check login status
            cookie: true, // enable cookies to allow the server to access the session
            xfbml: true  // parse XFBML
        });
        //check user session and refresh it
        FB.getLoginStatus(function (response) {
            if (response.status === 'connected') {
                //user is authorized
                var accessToken = response.authResponse.accessToken;
                if (accessToken) {
                    facebookConnect = true;
                    FB.logout(function (response) {
                        // user is now logged out
                        console.log('response ::' + response);
                    });
                    handleLogout();
                }
            } else {
                //user is not authorized
            }
        });
    };
    function getUserData() {

        FB.api('/me', {fields: fields}, function (response) {
            console.log(JSON.stringify(response, null, '\t'));
            //document.getElementById('response').innerHTML = 'Hello ' + response.name;
            $.post('<?= Yii::app()->createUrl('site/FacebookAuthorize') ?>', response, function (authorize) {
                if (authorize.status) {
                    window.location.href = authorize.url;
                } else {
                    alert(authorize.message);
                }
            }, 'json');
        });
    }

    function handleLogout() {
        $('#handleLogout').on('click', function () {
            var isConf = confirm('ยืนยันการออกจากระบบ');
            if (isConf) {

                window.location.href = '<?= Yii::app()->createUrl('site/logout') ?>';
            }
        });
    }



    //load the JavaScript SDK
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = '<?= Yii::app()->baseUrl . '/js/facebookSDK.js' ?>'; //"//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    /*
     * *************************** Handle Facebook Login *********************************
     */
</script>