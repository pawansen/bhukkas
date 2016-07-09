<?php 
$percent=Yii::app()->functions->getOptionAdmin('admin_commision_percent');
$commision_type=Yii::app()->functions->getOptionAdmin('admin_commision_type');
$currency=adminCurrencySymbol();
?>

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
  <div class="main signup-selection"> 
  <h3><?php echo t("Please Choose A Package Below To Signup")?></h3>
    
  <div class="table">
  <?php if ( FunctionsK::hasMembershipPackage()):?>  
  <li>  
  <a class="a rounded" href="<?php echo Yii::app()->createUrl("/store/merchantsignup")?>">
  <h5><?php echo t("Membership Click here")?></h5>
  <p><?php echo t("You will be charged a monthly or yearly fee")?>.</p>
  </a>
  </li>
  <?php endif;?>
  
  <li>
  <a class="b rounded" href="<?php echo Yii::app()->createUrl("/store/merchantsignupinfo")?>">
  <h5><?php echo t("Commission Click here")?></h5>
  <?php if ( $commision_type=="fixed"):?>  
  <p><?php echo displayPrice($currency,$percent)." ".t("commission per order")?>.</p>
  <?php else:?>
  <p><?php echo standardPrettyFormat($percent)."% ".t("commission per order")?>.</p>
  <?php endif;?>
  </a>
  </li>
  
  </div>
   
  <div class="clear"></div>
  
  </div> <!--main-->
</div> <!--page-->

</div> <!--page-->
	</div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->