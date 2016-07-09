<?php
$error1='';
$action='';
$merchant_hash='';
$success=false;
$status='';

if (isset($is_merchant)){	
	$merchant_key=Yii::app()->functions->getOption('admin_ccAvenue_key',$merchant_id);
	$merchant_access_code=Yii::app()->functions->getOption('admin_ccAvenue_accesscode',$merchant_id);
	$paymode=Yii::app()->functions->getOption('admin_ccAvenue_mode',$merchant_id);
        $merchant_workingkey=Yii::app()->functions->getOption('admin_ccAvenue_workingkey',$merchant_id);
	//echo 'merchant';
	
	/*COMMISSION*/
	if ( Yii::app()->functions->isMerchantCommission($merchant_id)){
            $merchant_key=Yii::app()->functions->getOptionAdmin('admin_ccAvenue_key');
	    $merchant_access_code=Yii::app()->functions->getOptionAdmin('admin_ccAvenue_accesscode');
	    $paymode=Yii::app()->functions->getOptionAdmin('admin_ccAvenue_mode');
            $merchant_workingkey=Yii::app()->functions->getOptionAdmin('admin_ccAvenue_workingkey');
	}	
	
} else {
	//echo 'admin';
	$merchant_key=Yii::app()->functions->getOptionAdmin('admin_ccAvenue_key');
	$merchant_access_code=Yii::app()->functions->getOptionAdmin('admin_ccAvenue_accesscode');
	$paymode=Yii::app()->functions->getOptionAdmin('admin_ccAvenue_mode');
        $merchant_workingkey=Yii::app()->functions->getOptionAdmin('admin_ccAvenue_workingkey');
}


if ( $paymode=="Sandbox"){
    $PAYU_BASE_URL = "https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction";
} else $PAYU_BASE_URL = "https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction";

$extra_params='';
if (isset($_GET['renew'])){
	$extra_params="/renew/1/package_id/".$package_id;
}

if (isset($is_merchant)){	
   $return_url=Yii::app()->getBaseUrl(true)."/store/ccainit/id/".$_GET['id'];
} else {
   $return_url=Yii::app()->getBaseUrl(true)."/store/merchantSignup/Do/step3b/token/$my_token/gateway/payu".$extra_params;
   if (isset($_GET['type'])){
   	  if ( $_GET['type']=="purchaseSMScredit"){
   	  	  $return_url=Yii::app()->getBaseUrl(true)."/merchant/ccainit/?type=purchaseSMScredit&package_id=".$package_id;
   	  }
   }   
}


?>

<?php if ( !empty($error1)):?>
<div class="uk-alert uk-alert-danger"><?php echo $error1;?></div>  
<?php elseif ($success==TRUE):?>
<div class="uk-alert uk-alert-success"><?php echo Yii::t("default","Payment Successful")?></div>  
<?php echo CHtml::hiddenField('payu_status',$status)?>
<?php endif;?>
<h2><?php echo Yii::t("default","Pay using CCAvenue")?></h2>
<?php $client_info = Yii::app()->functions->getClientInfo(Yii::app()->functions->getClientId());?>

<form  name="payuForm" id="payuForm" method="POST" action="<?php echo $action?>" class="uk-form uk-form-horizontal" >
    

<?php echo CHtml::hiddenField('tid',$return_url)?> 
<?php echo CHtml::hiddenField('merchant_id',$return_url)?>   
<?php echo CHtml::hiddenField('order_id',$return_url)?>
<?php echo CHtml::hiddenField('amount',$return_url)?> 
<?php echo CHtml::hiddenField('currency',$return_url)?>   
<?php echo CHtml::hiddenField('redirect_url',$return_url)?>
<?php echo CHtml::hiddenField('cancel_url',$return_url)?> 
<?php echo CHtml::hiddenField('language',$return_url)?>   
<?php echo CHtml::hiddenField('billing_name',$return_url)?>
<?php echo CHtml::hiddenField('billing_address',$return_url)?> 
<?php echo CHtml::hiddenField('billing_state',$return_url)?>   
<?php echo CHtml::hiddenField('billing_zip',$return_url)?>
<?php echo CHtml::hiddenField('billing_country',$return_url)?> 
<?php echo CHtml::hiddenField('billing_tel',$return_url)?>   
<?php echo CHtml::hiddenField('billing_email',$return_url)?>
    
<?php echo CHtml::hiddenField('delivery_name',$return_url)?> 
<?php echo CHtml::hiddenField('delivery_address',$return_url)?>   
<?php echo CHtml::hiddenField('delivery_city',$return_url)?> 
<?php echo CHtml::hiddenField('delivery_state',$return_url)?> 
<?php echo CHtml::hiddenField('delivery_zip',$return_url)?>   
<?php echo CHtml::hiddenField('delivery_country',$return_url)?>      
<?php echo CHtml::hiddenField('delivery_tel',$return_url)?> 
           
<?php echo CHtml::hiddenField('encRequest',$payment_description)?>
<?php echo CHtml::hiddenField('access_code',$return_url)?>   
    
    
    
    
    
    
    
    
<input type="hidden" name="key" value="<?php echo $merchant_key ?>" />
<input type="hidden" name="hash" id="hash" value="<?php echo $merchant_hash ?>"/>
<input type="hidden" name="txnid" value="<?php echo $payment_ref ?>" />




<div class="uk-form-row">
<label class="uk-form-label"><?php echo Yii::t("default","Amount to pay")?></label>
<?php echo CHtml::textField('amounts',
$amount_to_pay
,array(
'class'=>'uk-form-width-large',
'disabled'=>true
))?>
</div>    

<div class="uk-form-row">
<label class="uk-form-label"><?php echo Yii::t("default","Name")?></label>
<?php echo CHtml::textField('firstname',
isset($client_info['first_name'])?$client_info['first_name']." ".$client_info['last_name']:''
,array(
'class'=>'uk-form-width-large',
'data-validation'=>"required"
))?>
</div>    

<div class="uk-form-row">
<label class="uk-form-label"><?php echo Yii::t("default","Email address")?></label>
<?php echo CHtml::textField('email',
isset($client_info['email_address'])?$client_info['email_address']:''
,array(
'class'=>'uk-form-width-large',
'data-validation'=>"required"
))?>
</div>    

<div class="uk-form-row">
<label class="uk-form-label"><?php echo Yii::t("default","Phone")?></label>
<?php echo CHtml::textField('phone',
isset($client_info['contact_phone'])?$client_info['contact_phone']:''
,array(
'class'=>'uk-form-width-large',
'data-validation'=>"required"
))?>
</div>    

<div class="uk-form-row">
<label class="uk-form-label"></label>
<input type="submit" value="<?php echo Yii::t("default","Pay Now")?>" class="uk-button uk-form-width-medium uk-button-success">
</div>   
      
</form>