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
           style="font-size: 2.5em;font-weight: bold"><u>PrakreungMreungThai</u>
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
<!--        <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>-->
        <ul class="nav navbar-nav navbar-right">

            <?php if (empty(Yii::app()->session['member'])) { ?>
                <li>
                    <a href="<?= Yii::app()->createUrl('site/login') ?>"><i class="glyphicon glyphicon-log-in"></i> Login</a>                    
                </li>
                <li>
                    <a href="<?= Yii::app()->createUrl('site/register') ?>"><i class="glyphicon glyphicon-registration-mark"></i> Register</a>
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
                            <li><a href="<?= Yii::app()->createUrl('sacred/indexRegion') ?>">ภูมิภาค</a></li>
                            <li><a href="<?= Yii::app()->createUrl('sacred/indexProvince') ?>">จังหวัดกำเนิด</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?= Yii::app()->createUrl('sacred/indexNews') ?>">ข่าว</a></li>
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
                        <li role="separator" class="divider"></li>
                        <li><a href="<?= Yii::app()->createUrl('site/logout') ?>" onclick="return confirm('ยืนยันการออกจากระบบ')">
                                <i class="fa fa-sign-out"></i> ออกจากระบบ</a>
                        </li>
                    </ul>
                </li>
            <?php } ?>

        </ul>
    </div><!-- /.navbar-collapse -->
</nav>