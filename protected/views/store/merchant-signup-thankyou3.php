<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/sub_header_short.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
           <h1>Merchant</h1>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->
<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?php echo Yii::app()->createUrl('store'); ?>">Home</a></li>
            <li><a href="<?php //echo Yii::app()->createUrl('store/tac'); ?>">Merchant</a></li>
        </ul>
    </div>
</div><!-- Position -->
<!-- Content ================================================== -->
<div class="container margin_60_35">
    	<div class="row">
         <div class="col-md-12">
             
<div class="page">
  <div class="main">   
  <div class="inner">
  <div class="spacer"></div>
  
  <?php if ($res=Yii::app()->functions->getMerchantByToken($_GET['token'])):?>
  <p class="uk-text-success"><?php echo Yii::t("default","Congratulation for signing up.")?></p>  
  <p class="uk-text-success"><?php echo Yii::t("default","Please check your email for bank deposit instructions")?></p>  
  <p class="uk-text-muted"><?php echo Yii::t("default","You will receive email once your merchant has been approved. Thank You.")?></p>  
  <?php else :?>
  <p class="uk-text-danger"><?php echo Yii::t("default","Sorry but we cannot find what you are looking for.")?></p>
  <?php endif;?>
  </div>
  </div> <!--main-->
</div> <!--page  -->

</div> <!--page-->
	</div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->