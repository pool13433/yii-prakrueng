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
            <div class="panel-footer">
                <div class="row">
                    <div class="col-lg-2 col-lg-offset-5">
                        <div class="form-group">
                            <label class="control-label">
                                <input type="checkbox" id="chkRules" /> ยอมรับข้อตกลงการใช้งาน
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2 col-lg-offset-4">
                        <a id="btnSubmitRules" disabled href="javascript:void(0)" 
                           class="btn btn-success btn-block">
                            <i class="glyphicon glyphicon-ok-sign"></i><strong style="font-size: 1.4em"> ตกลง</strong>
                        </a>
                    </div>
                    <div class="col-lg-2">
                        <?php
                        $finalUrl = str_replace("//", "//www.", Yii::app()->getBaseUrl(true)) . '/site/login';
                        $finalUrl = str_replace('www.www.', 'www.', $finalUrl);
                        ?>
                        <a href="<?= $finalUrl ?>" 
                           class="btn btn-warning btn-block">
                            <i class="glyphicon glyphicon-log-in"></i><strong style="font-size: 1.4em"> เข้าระบบ</strong>
                        </a>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>
<script type="text/javascript">
    $(function () {
        submitRules();
        $('#chkRules').on('click', function () {
            submitRules();
        });
    });
    function submitRules() {
        if ($('#chkRules').is(':checked')) {
            $('#btnSubmitRules').attr('disabled', false).attr('href', '<?= Yii::app()->createUrl('site/register') ?>');
        } else {
            $('#btnSubmitRules').attr('disabled', true).attr('href', 'javascript:void(0)');
        }
    }
</script>
