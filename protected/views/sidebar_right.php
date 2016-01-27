<section class="task-panel tasks-widget">
    <div class="panel-heading">
        <div class="pull-left"><h5><i class="fa fa-tasks"></i> ประเภทวัตถุมงคล</h5></div>
        <br>
    </div>
    <div class="panel-body">
        <div class="task-content">
            <ul class="task-list ui-sortable sortable" id="boxPraKreungLastAdd">
                <?php foreach ($listSacredType as $index => $type) { ?>
                    <li class="list-primary">
                        <a href="<?= Yii::app()->createUrl('site/index', array('typeId' => $type['type_id'])) ?>">
                            <i class=" fa fa-ellipsis-v"></i>
                            <div class="task-title">
                                <span class="task-title-sp"><?= $type['type_name'] ?></span>
                                <span class="badge bg-theme"></span>
                                <div class="pull-right hidden-phone">
                                    <button class="btn btn-success btn-xs">
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

<section class="task-panel tasks-widget">
    <div class="panel-heading">
        <div class="pull-left"><h5><i class="fa fa-tasks"></i> พระเครื่องมาใหม่</h5></div>
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
                                    <button class="btn btn-success btn-xs">
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

<section class="task-panel tasks-widget">
    <div class="panel-heading">
        <div class="pull-left"><h5><i class="fa fa-tasks"></i> สมาชิกมาใหม่</h5></div>
        <br>
    </div>
    <div class="panel-body">
        <div class="task-content">
            <ul class="task-list ui-sortable sortable" id="boxPraKreungLastAdd">
                <?php foreach ($listMemberLastInsert as $index => $objectLast) { ?>
                    <li class="list-primary">
                        <a href="<?= Yii::app()->createUrl('site/detail/' . $objectLast->mem_id) ?>">
                            <i class=" fa fa-ellipsis-v"></i>
                            <div class="task-title">
                                <span class="task-title-sp"><?= $objectLast->mem_fname ?></span>
                                <span class="badge bg-theme"></span>
                                <div class="pull-right hidden-phone">
                                    <button class="btn btn-success btn-xs">
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