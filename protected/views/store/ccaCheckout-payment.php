<?php
$db_ext=new DbExt;
$error='';
 $my_token=isset($_GET['token'])?$_GET['token']:'';

$package_id=isset($_GET['package_id'])?$_GET['package_id']:'';	
$is_merchant=true;

$amount_to_pay=0;
$payment_description=Yii::t("default",'Payment to merchant');

$back_url=Yii::app()->request->baseUrl."/store/PaymentOption";
$payment_ref=Yii::app()->functions->generateCode()."TT".Yii::app()->functions->getLastIncrement('{{order}}');

if ( $data=Yii::app()->functions->getOrder($_GET['id'])){		
	
	$merchant_id=isset($data['merchant_id'])?$data['merchant_id']:'';	
	$payment_description.=isset($data['merchant_name'])?" ".$data['merchant_name']:'';	
	
	$amount_to_pay=isset($data['total_w_tax'])?Yii::app()->functions->standardPrettyFormat($data['total_w_tax']):'';
	
	/*dump($payment_description);
	dump($amount_to_pay);*/
	
} else{ $error=Yii::t("default","Failed. Cannot process payment"); 
}

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
   $return_url=Yii::app()->getBaseUrl(true)."/store/ccaInvoice/id/".$_GET['id'];
} else {
   $return_url=Yii::app()->getBaseUrl(true)."/store/merchantSignup/Do/step3b/token/$my_token/gateway/payu".$extra_params;
   if (isset($_GET['type'])){
   	  if ( $_GET['type']=="purchaseSMScredit"){
   	  	  $return_url=Yii::app()->getBaseUrl(true)."/merchant/ccainit/?type=purchaseSMScredit&package_id=".$package_id;
   	  }
   }   
}
$client_info = Yii::app()->functions->getClientInfo(Yii::app()->functions->getClientId());

$client_address = Yii::app()->functions->GetAddressClient(Yii::app()->functions->getClientId());

        $ccdata['redirect_url'] = $return_url;
        $ccdata['cancel_url'] = $return_url;
        $ccdata['merchant_id'] = $merchant_key;
        $ccdata['language'] = 'EN';
        $ccdata['customer_identifier'] = '';
        $ccdata['billing_name'] = $client_info['first_name']." ".$client_info['last_name'];
        $ccdata['billing_address'] = $client_address['street'];
        $ccdata['billing_city'] = $client_address['city'];
        $ccdata['billing_state'] = $client_address['state'];
        $ccdata['billing_zip'] = $client_address['zipcode'];
        $ccdata['billing_country'] = "India";
        $ccdata['billing_tel'] = $client_info['contact_phone'];
        $ccdata['billing_email'] = $client_info['email_address'];

        $ccdata['delivery_city'] = $client_address['city'];
        $ccdata['delivery_state'] = $client_address['state'];
        $ccdata['delivery_country'] = "India";
        $ccdata['delivery_name'] = $client_info['first_name']." ".$client_info['last_name'];
        $ccdata['delivery_zip'] = $client_address['zipcode'];
        $ccdata['delivery_address'] = $client_address['street'];
        $ccdata['delivery_tel'] = $client_info['contact_phone'];
        $ccdata['delivery_email'] = $client_info['email_address'];
        
        $ccdata['order_id'] = $_POST['oid'];
        $ccdata['currency'] = "INR";
        $ccdata['amount'] = $_POST['amt'];

?>

<html>
<head>
<title> Non-Seamless-kit</title>
</head>
<body>
<center>
      <?php if ( !empty($error)):?>
  <p class="uk-text-danger"><?php echo $error;?></p>  
  
    <?php else :?>
  
  
<?php   include('Crypto.php');

	$merchant_data='';
	foreach ($ccdata as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}
        $encrypted_data=encrypt($merchant_data,$merchant_workingkey); // Method for encrypting the data.
        //dump($merchant_data);
        //exit();
	//https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction
?>
<!-- <form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> -->
<form method="post" name="redirect" action="<?php echo $PAYU_BASE_URL;?>"> 
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$merchant_access_code>";
?>
</form>
</center>
<script language='javascript'>document.redirect.submit();
</script>
</body>
</html>

  <?php endif;?>  