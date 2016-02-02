<div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

        <div class="panel panel-warning">
            <div class="panel-heading">
                <h4><i class="fa fa-sitemap"></i> ข้อมูลพระเครื่องของคุณที่ทำการได้ปล่อยเช่า</h4>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อ</th>
                            <th>ราคา</th>
                            <th>ปีที่สร้าง</th>
                            <th>หมวดหมู่</th>
                            <th>จังหวัด</th>
                            <th>ชอบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listSacredObject as $index => $object) { ?>
                            <tr>
                                <td><?= ($index + 1) ?></td>
                                <td>
                                    <a href="<?=  Yii::app()->createUrl('site/detail/'.$object->obj_id)?>"><?= $object->obj_name ?></a>
                                </td>
                                <td><?= $object->obj_price ?></td>
                                <td><?= $object->obj_born ?></td>
                                <td><?= $object->type->type_name ?></td>
                                <td><?= $object->province->pro_name_th ?></td>
                                <td><?= $object->obj_like ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- Sidebar Right Begin-->
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?php
        $this->renderPartial('/sidebar_right', array(
            'listSacredObjectLastInsert' => $listSacredObjectLastInsert,
            'listSacredType' => $listSacredType,
            'listMemberLastInsert' => $listMemberLastInsert,
            'listRegion' => $listRegion
        ))
        ?>
    </div>
    <!-- Sidebar Right End -->

</div>
<!-- Co ntent End --> 