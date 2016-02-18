<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-warning">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fa fa-search"></i> ค้นหาพระเครื่องเมืองตะวันออก
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <form name="form-criteria" id="form-criteria">
                    <div class="form-group">
                        <label class="">ชื่อ,อื่นๆ</label>                
                        <input type="text" id="freedom" class="form-control" placeholder="ชื่อ,อื่นๆ"/>                                
                    </div>
                    <hr/>
                    <div class="form-group">
                        <label class="">ช่วงราคา</label>                
                        <input type="text" id="price_begin" class="form-control" placeholder="ราคาเริ่มต้น"/>                                
                    </div>
                    <div class="form-group">          
                        <input type="text" id="price_end" class="form-control" placeholder="ราคาสิ้นสุด"/>                
                    </div>
                    <hr/>
                    <div class="form-group">
                        <label class="">ปีที่จัดสร้าง</label>               
                        <input type="text" id="born_begin" maxlength="4" class="form-control" placeholder="ปีเริ่มต้น"/>                
                    </div>
                    <div class="form-group">                
                        <input type="text" id="born_end" maxlength="4" class="form-control" placeholder="ปีสิ้นสุด"/>                
                    </div>
                    <hr/>
                    <button id="btnSubmit" type="button" class="btn btn-warning btn-block">
                        <i class="fa fa-search"></i> ค้นหา
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>        

<section class="task-panel tasks-widget panel sidebar">
    <div class="panel-heading">
        <div class="pull-left"><h3><i class="fa fa-map-marker"></i> จังหวัดทั้งหมดในภาคตะวันออก</h3></div>
        <br>
    </div>
    <div class="panel-body">
        <div class="panel-group" id="accordionRegion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-warning" id="boxPrakreungRegion">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h6 class="panel-title" style="font-size: 0.6em;">
                        <?= $listRegion->reg_name ?> (<?= $listRegion->cnt ?> จังหวัด)<i class="glyphicon glyphicon-chevron-down"></i>
                    </h6>
                </div>
                <div class="panel-collapse">
                    <div class="panel-body">
                        <?php
                        $listProvinceByRegion = Province::model()->findAllByAttributes(array('reg_id' => $listRegion->reg_id), array('order' => 'pro_name_th'));
                        foreach ($listProvinceByRegion as $key => $province) {
                            ?>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="<?= $province->pro_id ?>">
                                    <?= $province->pro_name_th ?>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
</section>

<section class="task-panel tasks-widget panel sidebar">
    <div class="panel-heading">
        <div class="pull-left"><h3><i class="fa fa-tasks"></i> ประเภทวัตถุมงคล</h3></div>
        <br>
    </div>
    <div class="panel-body">
        <div class="task-content">

            <ul class="task-list ui-sortable sortable" id="boxPraKreungLastAdd">                
                <?php foreach ($listSacredType as $index => $type) { ?>
                    <li class="list-primary">
                        <i class=" fa fa-ellipsis-v">
                            <input type="checkbox" class="list-child" value="<?= $type['type_id'] ?>"/> &nbsp;
                        </i>       
                        <?php //Yii::app()->createUrl('site/index', array('typeId' => $type['type_id'])) ?>
                        <a href="javascript:void()">
                            <div class="task-title">                               
                                <span class="task-title">                                    
                                    <?= $type['type_name'] ?>
                                </span>
                                <span class="badge bg-theme"></span>
                                <div class="pull-right hidden-phone">
                                    <button class="btn btn-warning btn-xs">
                                        <?= $type['cnt'] ?>
                                    </button>
                                </div>
                            </div>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</section>



<section class="task-panel tasks-widget panel sidebar">
    <div class="panel-heading">
        <div class="pull-left"><h3><i class="fa fa-list-ul"></i> พระเครื่องมาใหม่</h3></div>
        <br>
    </div>
    <div class="panel-body">
        <div class="task-content">
            <ul class="task-list ui-sortable sortable" id="boxPraKreungLastAdd">
                <?php foreach ($listSacredObjectLastInsert as $index => $objectLast) { ?>
                    <li class="list-primary">
                        <a href="<?= Yii::app()->createUrl('site/detail/' . $objectLast->obj_id) ?>">
                            <i class=" fa fa-ellipsis-v"></i>
                            <div class="task-title">
                                <span class="task-title-sp"><?= $objectLast->obj_name ?></span>
                                <span class="badge bg-theme"></span>
                                <div class="pull-right hidden-phone">
                                    <button class="btn btn-warning btn-xs">
                                        <small><?= $objectLast->obj_updatedate ?></small>
                                    </button>
                                </div>
                            </div>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</section>

<section class="task-panel tasks-widget panel sidebar">
    <div class="panel-heading">
        <div class="pull-left"><h3><i class="fa fa-users"></i> สมาชิกมาใหม่</h3></div>
        <br>
    </div>
    <div class="panel-body">
        <div class="task-content">
            <ul class="task-list ui-sortable sortable" id="boxPraKreungLastAdd">
                <?php foreach ($listMemberLastInsert as $index => $objectLast) { ?>
                    <li class="list-primary">
                        <a href="<?= Yii::app()->createUrl('site/index', array('user' => $objectLast->mem_id)) ?>">
                            <i class=" fa fa-ellipsis-v"></i>
                            <div class="task-title">
                                <span class="task-title-sp"><?= empty($objectLast->mem_fname) ? $objectLast->mem_username : $objectLast->mem_fname ?></span>
                                <span class="badge bg-theme"></span>
                                <div class="pull-right hidden-phone">
                                    <button class="btn btn-warning btn-xs">
                                        <small><?= $objectLast->mem_updatedate ?></small>
                                    </button>
                                </div>
                            </div>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</section>
<script type="text/javascript">
    var checkboxType = $('#boxPraKreungLastAdd input[type="checkbox"]');
    var checkboxRegion = $('#accordionRegion input[type=checkbox]');

    var url = '<?= Yii::app()->createUrl('helper/CollectionCriteria') ?>';
    var redirect = '<?= Yii::app()->createUrl('site/index', array('page' => 1)) ?>';

    $(function () {
        $.get(url, {}, function (collection) {
            renderCriteria(collection);
        }, 'json');
        checkboxType.on('click', function () {
            var checked = 0;
            if ($(this).is(':checked')) { // checked
                checked = 1;
            }
            console.log($(this).is(':checked'));
            var data = {
                group: 'TYPE', value: $(this).val(), checked: checked
            };
            $.post(url, getCriteria(data),
                    function (response) {
                        //renderCriteria(response);                
                        window.location.href = redirect;
                    }, 'json');
        });
        checkboxRegion.on('click', function () {
            var checked = 0;
            if ($(this).is(':checked')) { // checked
                checked = 1;
            }
            console.log($(this).is(':checked'));
            var data = {
                group: 'REGION', value: $(this).val(), checked: checked,
            };
            $.post(url, getCriteria(data),
                    function (response) {
                        //renderCriteria(response);                
                        window.location.href = redirect;
                    }, 'json');
        });
        submitCriteriaForm();
    });
    function renderCriteria(collection) {
        $(checkboxType).each(function (index, checkbox) {
            $.each(collection.types, function (index, checkVal) {
                if (checkVal == $(checkbox).val()) {
                    $(checkbox).attr('checked', true);
                }
            });
        });
        $(checkboxRegion).each(function (index, checkbox) {
            $.each(collection.region, function (index, checkVal) {
                if (checkVal == $(checkbox).val()) {
                    $(checkbox).attr('checked', true);
                }
            });
        });
        $('#price_begin').val(collection.form.price_begin);
        $('#price_end').val(collection.form.price_end);
        $('#born_begin').val(collection.form.born_begin);
        $('#born_end').val(collection.form.born_end);
        $('#freedom').val(collection.form.freedom);
        if ($('#price_begin').val() != '' || $('#price_end').val() != '' || $('#born_begin').val() != ''
                || $('#born_end').val() != '' || $('#freedom').val() != '') {
            $('#collapseOne').collapse({toggle: true});
        } else {
            $('#collapseOne').collapse({toggle: false});
        }
        collapseCustom();
    }
    function getCriteria(data) {
        var criteria = {};
        criteria.price_begin = $('#price_begin').val();
        criteria.price_end = $('#price_end').val();
        criteria.born_begin = $('#born_begin').val();
        criteria.born_end = $('#born_end').val();
        criteria.freedom = $('#freedom').val();
        criteria.checked = data.checked;
        criteria.group = data.group;
        criteria.value = data.value;
        return criteria;
    }
    function submitCriteriaForm() {
        $('#btnSubmit').on('click', function () {
            var data = {
                group: '', value: '', checked: ''
            };
            $.post(url, getCriteria(data), function (response) {
                window.location.href = redirect;
            }, 'json');
        });
    }

    function collapseCustom() {

        var panelRegion = $('#boxPrakreungRegion');
        var panelCollapse = $(panelRegion).find('div.panel-collapse');
        $($(panelRegion).find('a')).on('click', function (e) {
            if ($(this).prop('class') !== 'collapsed') {
                $(this).find('i.glyphicon').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-right');
            } else {
                $(this).find('i.glyphicon').removeClass('glyphicon-chevron-right').addClass('glyphicon-chevron-down');
            }
        });
        $.each(panelCollapse, function (index, groupRegion) {
            var regionId = $(groupRegion).prop('id');
            //console.log('regionId ::=='+regionId);            
            var provinces = $(groupRegion).find('input[type="checkbox"]');
            var countChecked = 0;
            $.each(provinces, function (index, province) {
                //console.log($(province).prop('checked')); 
                var isCheck = $(province).prop('checked');
                if (isCheck) {
                    countChecked++;
                }
            });
            var prevA = $(groupRegion).prev().find('a');
            if (countChecked == 0) {
                $(groupRegion).removeClass('in');
                $(prevA).addClass('collapsed');
                $(prevA).find('i.glyphicon').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-right');
            } else {
                $(groupRegion).addClass('in');
                $(prevA).removeClass('collapsed');
                $(prevA).find('i.glyphicon').removeClass('glyphicon-chevron-right').addClass('glyphicon-chevron-down');
            }
        });
    }
</script>