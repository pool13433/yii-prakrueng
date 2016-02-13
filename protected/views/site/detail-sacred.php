<?php
$baseUrl = Yii::app()->baseUrl;
?>
<!-- Content Begin-->
<section id="main-content" style="margin-left: 0px;">
    <section class="site-min-height">
        <div class="row">

            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist" id="myTabs">
                            <li role="presentation" class="active">
                                <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
                                    <h5><i class="glyphicon glyphicon-picture"></i> รูปภาพ</h5>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
                                    <h5><i class="glyphicon glyphicon-list-alt"></i> รายละเอียด</h5>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">
                                    <h5><i class="glyphicon glyphicon-phone-alt"></i> ติดต่อสอบถาม</h5>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#relate" aria-controls="relate" role="tab" data-toggle="tab">
                                    <h5><i class="fa fa-link"></i> พระเครื่องที่เกี่ยวข้อง</h5>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#comment" aria-controls="comment" role="tab" data-toggle="tab">
                                    <h5><i class="fa fa-comments-o"></i> แสดงความคิดเห็น</h5>
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content panel-sacred">

                            <!-- Panel Images-->
                            <div role="tabpanel" class="tab-pane active" id="home">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="page-header clearfix">
                                            <h1 class="pull-left"><i class="fa fa-image"></i> 
                                                <u><?= $sacredObject->obj_name ?></u>
                                            </h1>
                                            <h3 class="pull-right">
                                                <?php
                                                $btnFavoriteTitle = 'โปรดปราาน';
                                                $btnFavoriteClass = '';
                                                $btnFavoriteValue = 0;
                                                $btnLikeClass = '';
                                                $btnLikeValue = 0;
                                                $btnLikeTitle = 'ชื่นชอบ';
                                                if (!empty($objectAction)) {
                                                    if ($objectAction->act_favorite == 1) {
                                                        $btnFavoriteClass = 'btn-danger';
                                                        $btnFavoriteTitle = 'ไม่'.$btnFavoriteTitle;
                                                    }
                                                    if ($objectAction->act_like == 0) {
                                                        $btnLikeClass = 'btn-primary';
                                                        $btnLikeTitle = 'ไม่'.$btnLikeTitle;
                                                    }
                                                    $btnFavoriteValue = $objectAction->act_favorite;
                                                    $btnLikeValue = $objectAction->act_like;
                                                }
                                                ?>
                                                <button id="btnFavorite" type="button" title="<?=$btnFavoriteTitle?>"
                                                        class="btn <?= $btnFavoriteClass ?>" name="<?= $btnFavoriteValue ?>">
                                                    <i class="fa fa-heart"></i> 
                                                </button>
                                                <button id="btnLike" type="button" title="<?=$btnLikeTitle?>"
                                                        class="btn <?= $btnLikeClass ?>" name="<?= $btnLikeValue ?>">
                                                    <i class="fa fa-thumbs-o-up"></i> 
                                                    <strong><?= $sacredObject->obj_like ?></strong>
                                                </button>
                                                <button id="btnView" type="button" class="btn btn-warning" disabled>
                                                    <i class="glyphicon glyphicon-eye-open"></i> 
                                                    <strong><?= $sacredObject->obj_view ?></strong>
                                                </button>
                                            </h3>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                            <div id="mainImage">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <a href="#" class="thumbnail">
                                                        <img id="img_zoom" class="img-responsive zoom" src="<?= $baseUrl . '/images/' . $sacredObject->obj_img ?>"                                                              
                                                             alt="" data-zoom-image="<?= $baseUrl . '/images/' . $sacredObject->obj_img ?>">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-12 col-xs-12">
                                            <div id="albumImage">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                    <a href="#" class="thumbnail" data-image="<?= $baseUrl . '/images/' . $sacredObject->obj_img ?>" data-zoom-image="<?= $baseUrl . '/images/' . $sacredObject->obj_img ?>"> 
                                                        <img id="img_zoom" class="img-rounded" src="<?= $baseUrl . '/images/' . $sacredObject->obj_img ?>"/> 
                                                    </a>
                                                </div>
                                                <?php foreach ($listSacredObjectImg as $index => $img) { ?>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                        <a href="#" class="thumbnail" data-image="<?= $baseUrl . '/images/' . $img->img_name ?>" data-zoom-image="<?= $baseUrl . '/images/' . $img->img_name ?>"> 
                                                            <img id="img_zoom" class="img-rounded" src="<?= $baseUrl . '/images/' . $img->img_name ?>"/> 
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Panel Images-->

                            <!-- Panel Detail-->
                            <div role="tabpanel" class="tab-pane" id="profile">
                                <div class="panel panel-default">
                                    <div class="panel-body">

                                        <div class="page-header">
                                            <h1><i class="glyphicon glyphicon-list-alt"></i> 
                                                <small><u>ข้อมูลของวัตถุมงคล</u></small>
                                            </h1>
                                        </div>
                                        <dl class="dl-horizontal">
                                            <dt>ชื่อ</dt>
                                            <dd><?= $sacredObject->obj_name ?></dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>ราคา</dt>
                                            <dd><?= $sacredObject->obj_price ?> บาท</dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>สร้างเมื่อ</dt>
                                            <dd><?= $sacredObject->obj_born ?></dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>ประเภท</dt>
                                            <dd><?= $sacredObject->type->type_name ?></dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>ต้นกำเนิดอยู่ที่จังหวัด</dt>
                                            <dd><?= $sacredObject->province->pro_name_th ?></dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>สถานที่รับของ</dt>
                                            <dd><?= $sacredObject->obj_location ?></dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>อธิบายเพิ่มเติม</dt>
                                            <dd><?= $sacredObject->obj_comment ?></dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <!-- Panel Detail-->

                            <!-- Panel Contact-->
                            <div role="tabpanel" class="tab-pane" id="contact">
                                <div class="panel panel-default">
                                    <div class="panel-body">

                                        <div class="page-header">
                                            <h1><i class="glyphicon glyphicon-phone-alt"></i> 
                                                <small><u>ช่องทางการติดต่อ</u></small>
                                            </h1>
                                        </div>
                                        <?php if (!empty($sacredObject->member)) { ?>
                                            <dl class="dl-horizontal">
                                                <dt>ชื่อเจ้าของ</dt>
                                                <dd><?= (empty($sacredObject->member) ? '<label class="label label-warnning">ไม่พบผู้ปล่อยเช่าในระบบ</label>' : $sacredObject->member->mem_fname . '   ' . $sacredObject->member->mem_lname) ?></dd>
                                            </dl>
                                            <dl class="dl-horizontal">
                                                <dt>โทรศัพท์</dt>
                                                <dd><?= $sacredObject->member->mem_phone ?></dd>
                                            </dl>
                                            <dl class="dl-horizontal">
                                                <dt>อีเมลล์</dt>
                                                <dd><?= $sacredObject->member->mem_email ?></dd>
                                            </dl>
                                        <?php } else { ?>
                                            <div role="alert" class="alert alert-warning alert-dismissible fade in"> 
                                                <button aria-label="Close" data-dismiss="alert" class="close" type="button">
                                                    <span aria-hidden="true">×</span>
                                                </button> 
                                                <strong>ไม่พบข้อมูล</strong> ไม่พบข้อมูลผู้ฝากให้เช่าในระบบ 
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Panel Contact-->

                            <!-- Panel Relate-->
                            <div role="tabpanel" class="tab-pane" id="comment">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="page-header">
                                            <h1><i class="fa fa-comments-o"></i> 
                                                <small><u>แสดงความคิดเห็น</u></small>
                                            </h1>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="panel">
                                                    <div class="panel-body">
                                                        <div class="form-group">
                                                            <labe class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12">แสดงความคิดเห็น</labe>
                                                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                                                <textarea class="form-control" id="messagePost" rows="4" style="font-size: 1.3em;"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel-footer">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-lg-offset-3">
                                                                <button type="button" id="btnPost" class="btn btn-success" onclick="submitPostComment(<?= $sacredObject->obj_id ?>)">
                                                                    <i class="fa fa-comment"></i> แสดงความคิดเห็น
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                
                                        <div class="row" id="boxComments"> 
                                            <?php foreach ($listCommentQuestion as $index => $question) { ?>                                            
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="page-header">
                                                        <h1><?= $question['ques_message'] ?>                                                            
                                                        </h1>
                                                        <h4 class="pull-left">
                                                            โพสต์โดย :: <?= $question['mem_fname'] ?>
                                                            เมื่อเวลา :: <?= $question['ques_updatedate'] ?>
                                                        </h4>
                                                        <h4 class="pull-right">
                                                            <?php
                                                            $btnClass = '';
                                                            $btnTitle = 'Like';
                                                            $isLike = 0;
                                                            $sessionMember = Yii::app()->session['member'];
                                                            if (!empty($sessionMember->mem_id)) {
                                                                $isUserLikeComment = WbQuestionAction::model()->findByAttributes(array(
                                                                    'ques_id' => $question['ques_id'],
                                                                    'mem_id' => $sessionMember->mem_id,
                                                                ));
                                                                if ($isUserLikeComment) {// แสดงว่าเคย Like comment                                                                    
                                                                    $isLike = $isUserLikeComment->act_like;
                                                                    //echo '<br/> ' . $isUserLikeComment->act_like . '<br/>';
                                                                    if ($isLike == 1) {
                                                                        $btnClass = 'btn-primary';
                                                                        $btnTitle = 'UnLike';
                                                                    } else {
                                                                        $btnClass = '';
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                            <button class="fa fa-thumbs-o-up btn btn-sm btn-like <?= $btnClass ?>" title="<?= $btnTitle ?>"
                                                                    name="<?= $isLike ?>" id="<?= $question['ques_id'] ?>" onclick="actionLikeComment(this)">     
                                                                        <?= $question['ques_like'] ?>
                                                            </button> 
                                                        </h4>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Panel Relate-->

                            <!-- Panel Recommen-->
                            <div role="tabpanel" class="tab-pane" id="relate">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="page-header">
                                            <h1><i class="fa fa-link"></i> 
                                                <small><u>พระเครื่องที่เกี่ยวข้อง</u></small>
                                            </h1>
                                        </div>
                                        <div class="row">
                                            <?php foreach ($listSacredObjectRelate as $index => $relate) { ?>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <a href="#">
                                                        <div class="panel panel-default">
                                                            <div class="panel-body">
                                                                <a href="#" class="thumbnail">
                                                                    <img src="<?= $baseUrl . '/images/' . $relate->obj_img ?>" alt="..." style="min-height: 200px;">
                                                                </a>
                                                                <p class="pull-right">
                                                                    <a href="<?= Yii::app()->createUrl('site/detail/' . $relate->obj_id) ?>" class="btn btn-warning">
                                                                        <i class="fa fa-flag"></i> เพิ่มเติม...
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Panel Recommen-->

                        </div>
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
    </section>
</section>

<script type="text/javascript">
    var imageElement = $(".zoom");
    $(function () {
        customElevateZoom();
        updatePageViewer();
        handleElevateZoomer();
        initMemberObjectAction();
    });

    function initMemberObjectAction() {
        //actionLikeComment();
        actionLikeSacred();
        actionFavoriteSacred();
        //renderDefaultMemberAction();
        //renderQuestionAction();
    }

    function submitPostComment(objectId) {
        var messagePost = $('#messagePost').val();
        if (messagePost != '') {
            $.post('<?= Yii::app()->createUrl('helper/PostComment') ?>', {
                id: objectId,
                message: messagePost
            }, function (response) {
                if (response.status) {
                    //window.location.reload(true);
                    cloneComment(response.comment);
                } else {
                    alert(response.message);
                    window.location.href = response.url;
                }
            }, 'json');
        } else {
            alert('กรุณากรอกข้อความแสดงความคิดเห็นก่อน');
        }
    }

    function cloneComment(comment) {
        var boxComment = htmlBoxComment() //$('#boxComments').children(':first-child').clone();
        $(boxComment).find('h1').text(comment.ques_message);
        $(boxComment).find('h4.pull-left').text('โพสต์โดย :: ' + comment.mem_fname + ' เมื่อเวลา :: ' + comment.ques_updatedate);
        var button = $(boxComment).find('h4.pull-right').find('button.btn-like');
        button.text(' ' + comment.ques_like + ' ');
        button.attr('name', comment.ques_like);
        button.attr('id', comment.ques_id);
        if (comment.act_like != null && comment.act_like == 0) {
            button.addClass('btn-primary');
        }
        var countChildren = $('#boxComments').children().length;
        if (countChildren > 0) {
            $(boxComment).insertBefore($('#boxComments').children(':first-child'));
        } else {
            $('#boxComments').append(boxComment);
        }
        $('#messagePost').val('');
    }

    function htmlBoxComment() {
        var boxComment = '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
        boxComment += '<div class="page-header">';
        boxComment += '	<h1></h1>';
        boxComment += '	<h4 class="pull-left"></h4>';
        boxComment += '	<h4 class="pull-right">';
        boxComment += '         <button name="" class="fa fa-thumbs-o-up btn btn-sm btn-like" onclick="actionLikeComment(this)"> ';
        boxComment += '        </button> ';
        boxComment += '	</h4>';
        boxComment += '</div>';
        boxComment += '</div>';
        return $.parseHTML(boxComment);
    }

    function removeElevateZoom() {
        $('.zoomContainer').remove();
        imageElement.removeData('elevateZoom');
        imageElement.removeData('zoomImage');
    }

    function handleElevateZoomer() {
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            if (e.currentTarget.hash == '#home') {
                customElevateZoom();
            } else {
                removeElevateZoom();
            }
            e.target // newly activated tab
            e.relatedTarget // previous active tab
            removeElevateZoom();
        });
    }

    function customElevateZoom() {
        //initiate the plugin and pass the id of the div containing gallery images 
        imageElement.elevateZoom({
            zoomType: "lens",
            lensShape: "round",
            scrollZoom: true,
            lensSize: 200,
            gallery: 'albumImage',
            cursor: 'pointer',
            galleryActiveClass: 'active',
            imageCrossfade: true,
            //loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'
        });
        //pass the images to Fancybox 
        $(".zoom").bind("click", function (e) {
            var ez = $(this).data('elevateZoom');
            $.fancybox(ez.getGalleryList());
            return false;
        });
    }

    function updatePageViewer() {
        $.get('<?= Yii::app()->createUrl('helper/UpdateSacredObjectView/' . $sacredObject->obj_id) ?>', {},
                function (response) {
                    console.log(' status ::==' + response.status);
                }, 'json');
    }


    function actionLikeComment(elementButton) {
        var element = elementButton;
        var id = $(elementButton).prop('id');
        var likeStatus = $(element).prop('name');
        var data = {
            commentId: id,
            objectId: <?= $sacredObject->obj_id ?>
        };
        if (likeStatus == '1') {
            $(element).attr('name', '0').removeClass('btn-primary');
            data.like = 0;
            $(element).attr('title', 'Like');
        } else {
            $(element).attr('name', '1').addClass('btn-primary');
            data.like = 1;
            $(element).attr('title', 'UnLike');
        }
        $.post('<?= Yii::app()->createUrl('helper/UpdateLikeComment') ?>', data, function (response) {
            if (response.status) {
                $(element).text(response.question.ques_like);
            } else {
                alert(response.message);
                window.location.href = response.url;
            }
        }, 'json');
    }

    function actionLikeSacred() {
        $('#btnLike').on('click', function () {
            var element = this;
            var value = $(this).attr('name');
            $.get('<?= Yii::app()->createUrl('helper/updateMemberObjectAction') ?>', {
                id: <?= $sacredObject->obj_id ?>,
                action: 'LIKE',
                value: value,
            },
                    function (response) {
                        if (response.status) {
                            if (response.action.act_like == '1') {
                                $(element).removeClass('btn-primary');
                                $(element).attr('title', 'ชื่นชอบ');
                            } else {
                                $(element).addClass('btn-primary');
                                $(element).attr('title', 'ไม่ชื่นชอบ');
                            }
                            $(element).attr('name', response.action.act_like);
                            $(element).find('strong').text(response.object.obj_like);
                        } else {
                            alert(response.message);
                            window.location.href = response.url;
                        }
                    }, 'json');
        });
    }

    function actionFavoriteSacred() {
        $('#btnFavorite').on('click', function () {
            var element = this;
            var value = $(this).attr('name');
            $.get('<?= Yii::app()->createUrl('helper/updateMemberObjectAction') ?>', {
                id: <?= $sacredObject->obj_id ?>,
                action: 'FAVORITE',
                value: value
            },
            function (response) {
                if (response.status) {
                    if (response.action.act_favorite == '1') {
                        $(element).addClass('btn-danger');
                        $(element).attr('title','ไม่โปรดปราน');
                    } else {
                        $(element).removeClass('btn-danger');
                        $(element).attr('title','โปรดปราน');
                    }
                    $(element).attr('name', response.action.act_favorite);
                } else {
                    alert(response.message);
                    window.location.href = response.url;
                }
            }, 'json');
        });
    }

</script>
