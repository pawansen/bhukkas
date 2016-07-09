
<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/sub_header_short.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
           <h1>Restaurant Signup</h1>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->
<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?php echo Yii::app()->createUrl('store'); ?>">Home</a></li>
            <li><a href="<?php echo Yii::app()->createUrl('store/MerchantRegister'); ?>">Merchant</a></li>
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
 <p class="uk-text-info"><?php echo Yii::t("default","Bank account detail optional.")?></p>
 
 <?php if ($merchant=Yii::app()->functions->getMerchantByToken($_GET['token'])): ?>
   <?php $merchant_id=$merchant['merchant_id'];?>
<form class="uk-form uk-form-horizontal forms" id="forms" onsubmit="return false;">
  <?php echo CHtml::hiddenField('action','merchantAccountInfo')?>
  <?php echo CHtml::hiddenField('currentController','store')?>
  <?php echo CHtml::hiddenField('token',$_GET['token'])?>
  <?php echo CHtml::hiddenField('merchant_id',$merchant_id)?>
 
    
    <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Bank name")?></label>
          <?php echo CHtml::textField('bank_name',
          isset($data['bank_name'])?stripslashes($data['bank_name']):""
          ,array(
          'class'=>'uk-form-width-large',
          ))?>
    </div>           

    <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Account number")?></label>
          <?php echo CHtml::textField('account_number',
          isset($data['account_number'])?$data['account_number']:""
          ,array(
          'class'=>'uk-form-width-large',
          ))?>
    </div>
    
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Branch")?></label>
          <?php echo CHtml::textField('branch',
          isset($data['branch'])?stripslashes($data['branch']):""
          ,array(
          'class'=>'uk-form-width-large',

          ))?>
    </div>
    
    <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","IFSC Code")?></label>
          <?php echo CHtml::textField('ifsc_code',
          isset($data['ifsc_code'])?$data['ifsc_code']:""
          ,array(
          'class'=>'uk-form-width-large',
          ))?>
    </div>
         
<div class="uk-form-row">
<label class="uk-form-label"></label>
<input type="submit" value="<?php echo Yii::t("default","Submit")?>" class="uk-button uk-form-width-medium uk-button-success">
</div>
         
</form>    
     <?php else: ?>
      
    <p class="uk-text-danger"><?php echo Yii::t("default","Sorry but we cannot find what you are looking for.")?></p>
      
      <?php endif; ?>
   </div>
  </div> <!--main-->
</div>  <!--page-->

</div> <!--page-->
	</div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->