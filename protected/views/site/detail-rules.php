<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                ข้อตกลงการสมัครสมาชิก
                เว็บไซต์ PrakruengMuengThai
            </div>
            <div class="panel-body">
                <?php foreach ($listRules as $index => $rules) { ?>
                    <dl class="dl-horizontal">
                        <dt>ข้อที่ <?= ($index + 1) ?></dt>
                        <dd><?= $rules->rul_desc ?></dd>
                    </dl>
                <?php } ?>
            </div>
        </div>        
    </div>
</div>