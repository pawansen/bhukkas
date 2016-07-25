<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="<?php echo Yii::app()->request->baseUrl; ?>/assets/front/img/sub_header_short.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
            <h1>Terms and Conditions</h1>
        </div>
        <!-- End sub_content -->
    </div>
    <!-- End subheader -->
</section>
<!-- End section -->
<!-- End SubHeader ============================================ -->
<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?php echo Yii::app()->createUrl('store'); ?>">Home</a></li>
            <li><a href="javascript:void(0)<?php //echo Yii::app()->createUrl('store/tac'); ?>">T & C</a></li>
        </ul>
    </div>
</div>
<!-- Position -->
<!-- Content ================================================== -->
<div class="container margin_60_35">
    <div class="row">
        <div class="col-md-12">
            <h3 class="nomargin_top"><?php
                if (isset($cmsData['title']) && !empty($cmsData['title'])) {
                    echo "Some Words Terms and Conditions";
                }
                ?> </h3>
        </div>
    </div>
    <!-- End row -->
    <div role="main" class="main">
        <div class="content full" id="content">
            <div class="container" style="min-height:500px;">
                <div class="page">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <p> <?php
                if (isset($cmsData['description']) && !empty($cmsData['description'])) {
                    echo $cmsData['description'];
                }
                ?> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End container -->