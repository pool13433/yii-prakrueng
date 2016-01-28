<?php
$baseUrl = Yii::app()->baseUrl;
?>
<form id="form-upload" method="post" action="<?= Yii::app()->createUrl('site/upload') ?>" class="form-horizontal" enctype="multipart/form-data">
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h4> <i class="fa fa-shopping-cart"></i> ลงข้อมูลพระเครื่องเพื่อปล่อยเช่า</h4>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-4">ชื่อสินค้า</label>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-8">
                    <input type="text" class="form-control" name="name" id="name" required/>
                    <span class="label label-warning">กรุณากรอกข้อมูล ชื่อสินค้า</span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-4">จัดอยู่ในหมวดหมู่</label>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-8">                    
                    <select class="form-control" name="type" id="type" required>             
                        <option value="" selected>-- กรุณาเลือก --</option>
                        <?php foreach ($listSacredType as $index => $type) { ?>
                            <option value="<?= $type->type_id ?>"><?= $type->type_name ?></option>
                        <?php } ?>
                    </select>
                    <span class="label label-warning">กรุณาเลือก หมวดหมู่</span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-4">ราคาเช่า</label>
                <div class="col-lg-4 col-md-4 col-sm-3 col-xs-6">
                    <input type="text" class="form-control" name="price" id="price" required/>
                    <span class="label label-warning">กรุณากรอกข้อมูล ราคาสินค้า</span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-4">ปีที่สร้าง</label>
                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-8">
                    <input type="text" class="form-control" name="born" id="born" required maxlength="4"/>
                    <span class="label label-warning">กรุณาเลือก ปีที่สร้าง</span>
                </div>
            </div>


            <div class="form-group">
                <label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-4">กำเนิดจากจังหวัด</label>
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-8">                    
                    <select class="form-control" name="province" id="province" required>
                        <option value="" selected>-- กรุณาเลือก --</option>
                        <?php foreach ($listProvince as $index => $province) { ?>
                            <option value="<?= $province->pro_id ?>"><?= $province->pro_name_th ?></option>
                        <?php } ?>
                    </select>
                    <span class="label label-warning">กรุณาเลือกจังหวัดที่เริ่มจัดสร้าง</span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-4">รูปหลัก</label>
                <div class="col-lg-3 col-md-6 col-sm-3 col-xs-7 box-browse-upload">
                    <input type="file" id="fileMain" name="fileMain"/>
                    <a class="thumbnail">
                        <img id="imgMain" class="img-rounded" style="max-width: 60%;" src="<?= $baseUrl . '/images/image_main.png' ?>"/>
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
                            <input name="file" type="file" multiple/>
                        </div>                        
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-4">อธิบายเพิ่มเติม</label>
                <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                    <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                </div>
            </div>


            <div class="form-group">
                <div class="col-lg-9 col-md-9 col-xs-9 col-lg-offset-3 col-md-offset-3 col-sm-offset-4 col-xs-offset-3">                    
                    <button type="button" class="btn btn-success btn-sm" id="submit-all">
                        <i class="glyphicon glyphicon-gift"></i> ประกาศปล่อยเช่าทันที
                    </button>
                    <button type="reset" class="btn btn-warning btn-sm">
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
            });
            // sending data
            myDropzone.on("sending", function (file, xhr, data) {
                data.append("name", $('#name').val());
                data.append("type", $('#type').val());
                data.append("price", $('#price').val());
                data.append("born", $('#born').val());
                data.append("province", $('#province').val());
                data.append("comment", $('#comment').val());
                data.append("fileMain", $("#fileMain")[0].files[0]);
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
            if (res.status) {
                window.location.href = '<?= Yii::app()->createUrl('site/index') ?>'
            } else {
                alert(res.message);
                window.location.href = res.url;
            }
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
                console.log($(form).find('input[type="file"]').val());
                if ($(form).find('input[type="file"]').val() == '') {
                    alert('กรุณาเลือก รูปหลัก');
                    $(form).find('input[type="file"]').focus();
                    return false;
                }
                if (myDropzone.getQueuedFiles().length > 0) {
                    console.log(' == myDropzone.processQueue ==');
                    myDropzone.processQueue();
                } else {
                    console.log(' == ajax ==');
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
                            if (response.status) {
                                window.location.href = '<?= Yii::app()->createUrl('site/index') ?>'
                            } else {
                                alert(response.message);
                                window.location.href = response.url;
                            }
                        },
                        error: function () {
                            alert("error in ajax form submission");
                        }
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

</script>