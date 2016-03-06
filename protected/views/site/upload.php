<?php
$baseUrl = Yii::app()->baseUrl;
?>
<form id="form-upload" method="post" action="<?= Yii::app()->createUrl('site/upload') ?>" class="form-horizontal form-lg" enctype="multipart/form-data">
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h4> <i class="fa fa-shopping-cart"></i> ลงข้อมูลพระเครื่องเพื่อปล่อยเช่า</h4>
        </div>
        <div class="panel-body">
            <!--            <div role="alert" class="alert alert-danger alert-dismissible fade in"> 
                            <button aria-label="Close" data-dismiss="alert" class="close" type="button">
                                <span aria-hidden="true" class="glyphicon glyphicon-remove"></span></button> 
                            <strong><u>กรุณา Login เพื่อเข้าระบบก่อนการลงประกาศขาย</u></strong> 
                            เพื่อความสะดวกในการจัดเก็บข้อมูล
                        </div>-->
            <div class="form-group">
                <label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-4">ชื่อสินค้า<small> *</small></label>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-8">
                    <input type="hidden" id="id" name="id" value="<?= $sacredObject->obj_id ?>"/>
                    <input type="text" class="form-control input-lg" name="name" id="name" value="<?= $sacredObject->obj_name ?>" required/>
                    <span class="label label-warning">กรุณากรอกข้อมูล ชื่อสินค้า</span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-4">จัดอยู่ในหมวดหมู่<small> *</small></label>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-8">                    
                    <select class="form-control  input-lg" name="type" id="type" required>             
                        <option value="" selected>-- กรุณาเลือก --</option>
                        <?php foreach ($listSacredType as $index => $type) { ?>
                            <?php if ($type->type_id == $sacredObject->type_id) { ?>
                                <option value="<?= $type->type_id ?>" selected><?= $type->type_name ?></option>
                            <?php } else { ?>
                                <option value="<?= $type->type_id ?>"><?= $type->type_name ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                    <span class="label label-warning">กรุณาเลือก หมวดหมู่</span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-4">ราคาเช่า<small> *</small></label>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                    <input type="text" class="form-control  input-lg" name="price" id="price" value="<?= $sacredObject->obj_price ?>" required/>
                    <span class="label label-warning">กรุณากรอกข้อมูล ราคาสินค้า</span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-4">ปี พ.ศ. ที่จัดสร้าง<small> *</small></label>
                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-8">
                    <input type="text" class="form-control  input-lg" name="born" id="born" required value="<?= $sacredObject->obj_born ?>"  maxlength="4"/>
                    <span class="label label-warning">กรุณาเลือก ปีที่สร้าง</span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-4">สถานที่รับสินค้า</label>
                <div class="col-lg-6 col-md-6 col-sm-7 col-xs-8">
                    <textarea rows="2" class="form-control  input-lg" name="location" id="location"><?= $sacredObject->obj_location ?></textarea>                    
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-4">พระถูกสร้างที่จังหวัด<small> *</small></label>
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-8">                    
                    <select class="form-control  input-lg" name="province" id="province" required>
                        <option value="" selected>-- กรุณาเลือก --</option>
                        <?php foreach ($listRegion as $index => $region) { ?>
                            <optgroup label=" ภูมิภาค <?= $region->reg_name ?>" style="font-weight: bold;">
                                <?php
                                $listProvince = Province::model()->findAll(array(
                                    'condition' => 'reg_id = ' . $region->reg_id,
                                    'order' => 'pro_name_th'
                                ));
                                ?>
                                <?php foreach ($listProvince as $index => $province) { ?>
                                    <?php if ($province->pro_id == $sacredObject->pro_id) { ?>
                                        <option value="<?= $province->pro_id ?>" selected><?= $province->pro_name_th ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $province->pro_id ?>"><?= $province->pro_name_th ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </optgroup>
                        <?php } ?>
                    </select>
                    <span class="label label-warning">กรุณาเลือกจังหวัดที่เริ่มจัดสร้าง</span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-4">รูปหลัก<small> *</small></label>
                <div class="col-lg-3 col-md-6 col-sm-3 col-xs-7 box-browse-upload">
                    <?php
                    $require = 'required';
                    $pathImage = $baseUrl . '/images/image_main.png';
                    if (!empty($sacredObject->obj_img)) {
                        $pathImage = $baseUrl . '/images' . $sacredObject->obj_img;
                        $require = '';
                    }
                    ?>
                    <input type="file" id="fileMain" name="fileMain" <?= $require ?>/>
                    <a class="thumbnail">

                        <img id="imgMain" class="img-rounded" style="max-width: 60%;" src="<?= $pathImage ?>"/>
                    </a>
                    <span class="label label-warning">กรุณากรอกข้อมูล รูปหลักสินค้า</span>
                </div>                
            </div>
            <div class="form-group">
                <label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-4">รูปอื่นๆ ที่เกี่ยวข้อง</label>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 box-browse-upload">
                    <div class="dropzone" id="my-awesome-dropzone" >
                        <div class="dropzone-previews" style="max-width: 100%"></div>
                        <div class="fallback">
                            <input name="file" type="file" multiple class="form-control"/>
                        </div>                        
                    </div>
                </div>
            </div>
            <?php if (!empty($sacredObject->obj_id)) { ?>
                <div class="form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-4">รูปภาพเดิม</label>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                        <div class="row">
                            <?php $relateImage = SacredObjectImg::model()->findAllByAttributes(array('obj_id' => $sacredObject->obj_id)) ?>
                            <?php foreach ($relateImage as $index => $image) { ?>
                                <div class="col-lg-2 image-container" onclick="removeImage(<?= $image->img_id ?>)">
                                    <img src="<?= $baseUrl . '/images' . $image->img_name ?>" class="img-thumbnail"/>
                                    <div class="after" title="ลบ">
                                        <span class="zoom">
                                            <i class="glyphicon glyphicon-remove-sign"></i>
                                        </span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div> 
                    </div>                
                </div>
            <?php } ?>
            <div class="form-group">
                <label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-4">อธิบายเพิ่มเติม</label>
                <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                    <textarea class="form-control  input-lg" rows="5" id="comment" name="comment"><?= $sacredObject->obj_comment ?></textarea>
                </div>
            </div>


            <div class="form-group">
                <div class="col-lg-9 col-md-9 col-xs-9 col-lg-offset-3 col-md-offset-3 col-sm-offset-4 col-xs-offset-3">                    
                    <button type="button" class="btn btn-success btn-lg" id="submit-all">
                        <i class="glyphicon glyphicon-gift"></i> ประกาศปล่อยเช่าทันที
                    </button>
                    <button type="reset" class="btn btn-warning">
                        <i class="glyphicon glyphicon-remove"></i> เคลีย์ข้อมูล
                    </button>
                </div>
            </div>
        </div>
    </div>

</form>

<script type="text/javascript">

    // The camelized version of the ID of the form element
    var myDropzone = {};
    Dropzone.options.myAwesomeDropzone = {
        // set following configuration
        url: '<?= Yii::app()->createUrl('site/upload') ?>',
        paramName: "fileOther", // The name that will be used to transfer the file
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 10,
        maxFiles: 10,
        addRemoveLinks: true,
        previewsContainer: ".dropzone-previews",
        dictRemoveFile: "Remove",
        dictCancelUpload: "Cancel",
        dictDefaultMessage: "Drop the images you want to upload here",
        dictFileTooBig: "Image size is too big. Max size: 10mb.",
        dictMaxFilesExceeded: "Only 10 images allowed per upload.",
        acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF",
        // The setting up of the dropzone
        init: function () {
            myDropzone = this;
            // Upload images when submit button is clicked.
            $("#submit-all").click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                /*
                 * Jquery - validate form
                 */
                $('#form-upload').submit();
                Pace.restart();
            });
            // sending data
            myDropzone.on("sending", function (file, xhr, data) {
                data.append("name", $('#name').val());
                data.append("type", $('#type').val());
                data.append("price", $('#price').val());
                data.append("born", $('#born').val());
                data.append("location", $('#location').val());
                data.append("province", $('#province').val());
                data.append("comment", $('#comment').val());
                data.append("id", $('#id').val());
                data.append("fileMain", $("#fileMain")[0].files[0]);

            });

            myDropzone.on("totaluploadprogress", function (progress) {
                document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
            });
            // Refresh page when all images are uploaded
            myDropzone.on("complete", function (file) {
                if (myDropzone.getUploadingFiles().length === 0 && myDropzone.getQueuedFiles().length === 0) {
                    //window.location.href = '<?= Yii::app()->createUrl('site/index') ?>';
                }
            });
        },
        success: function (file, response) {
            console.log(response);
            var res = JSON.parse(response);
            if (!res.status) {
                alert(res.message);
            }
            window.location.href = res.url;
        }
    };
    $(function () {
        $('#imgMain').on('click', function () {
            $('#fileMain').trigger('click');
        });
        $("#fileMain").change(function () {
            readURL(this);
        });
        initForm();
        validateFormUpload();
    })
    function validateFormUpload() {
        $('#form-upload').validate({
            rules: {
                name: "required",
                type: "required",
                price: {
                    required: true,
                    number: true
                },
                born: {
                    required: true,
                    number: true,
                    minlength: 4,
                    maxlength: 4,
                    max: new Date().getFullYear() + 543
                },
                province: "required",
//                fileMain: {
//                    required: true,
//                    extension: "png|jpe?g|gif"
//                }
            },
            messages: {
                name: "กรุณากรอกข้อมูล ชื่อสินค้า",
                type: "กรุณาเลือก หมวดหมู่",
                price: {
                    required: "กรุณากรอกข้อมูล ราคาสินค้า",
                    number: "กรุณากรอกตัวเลขเท่านั้น",
                },
                born: {
                    required: "กรุณาเลือก ปีที่สร้าง",
                    number: "กรุณากรอกตัวเลขเท่านั้น",
                    minlength: "กรุณากรอกตัวเลข 4 ตัวอักษร เท่านั้น",
                    maxlength: "กรุณากรอกตัวเลข 4 ตัวอักษร เท่านั้น",
                    max: "กรุณาตรวจสอบปีที่ก่อนเกินปีปัจจุบันหรือไม่",
                },
                province: "กรุณาเลือกจังหวัดที่เริ่มจัดสร้าง",
//                fileMain: {
//                    required: "กรุณากรอกข้อมูล รูปหลักสินค้า",
//                    extension: "กรุณาเลือกไฟล์ประเภท png|jpe?g|gif เท่านั้น"
//                }
            },
            submitHandler: function (form) {
                //$(form).ajaxSubmit();
                console.log(form);
                if (myDropzone.getQueuedFiles().length > 0) {
                    console.log(' == myDropzone.processQueue ==');
                    myDropzone.processQueue();
                } else {
                    console.log(' == ajax ==');
                    Pace.track(function () {
                        $.ajax({
                            url: '<?= Yii::app()->createUrl('site/upload') ?>',
                            type: 'POST',
                            data: new FormData($('#form-upload')[0]),
                            dataType: 'json',
                            async: false,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                console.log(response);
                                if (!response.status) {
                                    alert(response.message);
                                }
                                window.location.href = response.url;
                            },
                            error: function () {
                                alert("error in ajax form submission");
                            }
                        });
                    });
                }

            }
        });
    }

    function initForm() {
        var spans = $('form div.panel div.form-group span.label');
        $.each(spans, function (index, span) {
            $(span).css({'display': 'none'});
        });
    }

    function removeImage(imageId) {
        var isConfirm = confirm('ยืนยันการลบข้อมูลรูปนี้');
        if (isConfirm) {
            $.post('<?= Yii::app()->createUrl('Helper/removeImage') ?>', {
                id: imageId
            }, function (response) {
                if (response.status) {
                    window.location.reload();
                }
            }, 'json');
        }
    }

</script>
