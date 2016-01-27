
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= Yii::app()->createUrl('site/index') ?>">คนรักพระเครื่อง</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php if (!empty(Yii::app()->session['member'])) { ?>
                    <?php $member = Yii::app()->session['member'] ?>
                    <?php if ($member->mem_status == 'admin') { ?>
                        <!-- someting---->
                    <?php } ?>
                <?php } ?>
            </ul>
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?=  Yii::app()->createUrl('site/upload')?>" class="btn btn-default btn-sm">
                        <i class="glyphicon glyphicon-shopping-cart"></i> อยากปล่อยเช่า
                    </a>
                </li>
                <?php if (empty(Yii::app()->session['member'])) { ?>
                    <li>
                        <a href="<?= Yii::app()->createUrl('site/login') ?>"><i class="glyphicon glyphicon-log-in"></i> Login</a>
                    </li>
                <?php } else { ?>
                    <?php $member = Yii::app()->session['member'] ?>

                    <?php if ($member->mem_status == 0) { ?>
                <!--                        <li><a href="#">ข้อมูลพระเครื่อง <span class="sr-only">(current)</span></a></li>-->

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ข้อมูลพระเครื่อง <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= Yii::app()->createUrl('sacred/index') ?>">พระเครื่อง</a></li>
                                <li><a href="<?= Yii::app()->createUrl('sacred/indexType') ?>">ประเภทพระเครื่อง</a></li>
                                <li><a href="<?= Yii::app()->createUrl('sacred/indexProvince') ?>">จังหวัดกำเนิด</a></li>
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
    </div><!-- /.container-fluid -->
</nav>