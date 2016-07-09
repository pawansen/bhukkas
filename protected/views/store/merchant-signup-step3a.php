<?php 
$continue=true;
$msg="";
if ($merchant=Yii::app()->functions->getMerchantByToken($_GET['internal-token'])){			
} else {
	$continue=false;
	$msg=Yii::t("default",'Sorry but we cannot find what you are looking for.');
}

$paypal_con=Yii::app()->functions->getPaypalConnectionAdmin();   
$paypal=new Paypal($paypal_con);

if ($res_paypal=$paypal->getExpressDetail()){	
} else {
	 $continue=false;
	 $msg="Paypay Error: ".$paypal->getError();
}
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

<div class="page merchant-payment-option">
  <div class="main">   
  <div class="inner">
  <div class="spacer"></div>
  
  <?php if ( $continue==TRUE):?>
  <h3><?php echo Yii::t("default","Paypal Verification")?></h3>
  
  <form class="uk-form uk-form-horizontal forms" id="forms" onsubmit="return false;">
  <?php echo CHtml::hiddenField('action','merchantPaymentPaypal')?>
  <?php echo CHtml::hiddenField('currentController','store')?>
  <?php echo CHtml::hiddenField('internal-token',$_GET['internal-token'])?>
  <?php echo CHtml::hiddenField('token',$_GET['token'])?>    
  
  <?php if (isset($_GET['renew'])):?>
      <?php echo CHtml::hiddenField('renew',$_GET['renew'])?>    
      <?php echo CHtml::hiddenField('package_id',$_GET['package_id'])?>    
  <?php endif;?>

  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Paypal Name")?></label>
  <span class="uk-text-bold"><?php echo $res_paypal['FIRSTNAME']." ".$res_paypal['LASTNAME']?></span>
  </div>
  
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Paypal Email")?></label>
  <span class="uk-text-bold"><?php echo $res_paypal['EMAIL']?></span>
  </div>
  
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Selected Package")?></label>
  <span class="uk-text-bold"><?php echo ucwords($merchant['package_name'])?></span>
  </div>
  
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Amount to pay")?></label>
  <span class="uk-text-bold"><?php echo $res_paypal['CURRENCYCODE']." ".$res_paypal['AMT']?></span>
  </div>

   
  <div class="uk-form-row">   
    <input type="submit" value="<?php echo Yii::t("default","Pay Now")?>" class="uk-button uk-button-success uk-width-1-3">
  </div>
  
  </form>
  
  <?php else :?>
  <p class="uk-text-danger"><?php echo $msg;?></p>
  <?php endif;?>
  
  </div>
  </div> <!--main-->
</div>  <!--page-->

</div> <!--page-->
	</div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->