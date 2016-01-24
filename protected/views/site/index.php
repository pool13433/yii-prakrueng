<?php
$baseUrl = Yii::app()->baseUrl;
?>
<!-- Content Begin-->
<section id="main-content" style="margin-left: 0px;">
    <section class="site-min-height">
        <h3><i class="fa fa-angle-right"></i> <?= $title ?></h3>
        <div class="row mt mb">


            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

                <!-- -- 1st ROW OF PANELS ---->
                <div id="boxPraKreung" class="row">
                    <?php foreach ($listSacredObject as $index => $object) { ?>
                        <div class="col-lg-4 col-md-4 col-sm-4 mb">          
                            <div class="weather-2 pn">             
                                <div class="weather-2-header">                     
                                    <div class="row">                         
                                        <div class="col-lg-12 col-sm-12 col-xs-12">                             
                                            <p><?= $object->obj_name ?></p>                        
                                        </div>                     
                                    </div>             
                                </div><!-- /weather-2 header -->             
                                <div class="row centered">             
                                    <div class="col-lg-10 col-lg-offset-1 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 desc">                     
                                        <div class="project-wrapper">                       
                                            <div class="project">                            
                                                <div class="photo-wrapper">                                
                                                    <div class="photo">                                   
                                                        <a class="fancybox" href="<?= $baseUrl ?>/img/prakrueng/a1.jpg">                                       
                                                            <img class="img-responsive" src="<?= $baseUrl ?>/img/prakrueng/a1.jpg" alt=""></a>                           
                                                    </div>                                 
                                                    <div class="overlay">

                                                    </div>                             
                                                </div>                          
                                            </div>                       
                                        </div>                
                                    </div>             
                                </div>             
                                <div class="row data">                     
                                    <div class="col-sm-6 col-xs-6 goleft">                         
                                        <h4>ราคา</h4>                        
                                        <h6>เจ้าของ</h6>                         
                                        <h6>โทร</h6>                     
                                    </div>                     
                                    <div class="col-sm-6 col-xs-6 goright">                         
                                        <h4>999999</h4>                         
                                        <h6>Poolsawat Apin</h6>                         
                                        <h5>0801166617</h5>                     
                                    </div>                 
                                </div>    
                                <div class="row data">                     
                                    <div class="col-sm-6 col-xs-6 pull-right">
                                        <a href="<?= Yii::app()->createUrl('site/detail/' . $object->obj_id) ?>"><p class="goright"><i class="fa fa-flag"></i> อ่านต่อ...</p></a>
                                    </div>              
                                </div> 
                            </div>
                        </div>
                    <?php } ?>
                </div><!-- /END 6TH ROW OF PANELS -->

            </div>

            <!-- Sidebar Right Begin-->
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <?php
                $this->renderPartial('/sidebar_right', array(
                    'listSacredObjectLastInsert' => $listSacredObjectLastInsert,
                    'listSacredType' => $listSacredType
                ))
                ?>
            </div>
            <!-- Sidebar Right End -->

        </div>

        </secti on><!-- --/wrapper ---- >
</section>
        <!-- Co ntent End --> 
        <script type="text/javascript">
            $(document).ready(function () {
                $(".fancybox").fancybox({'width': 400,
                    'height': 300,
                    'autoSize': false});
            });
        </script>