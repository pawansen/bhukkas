<?php
include('Crypto.php');
$db_ext=new DbExt;
$is_merchant=true;

if (isset($is_merchant)){	
        $merchant_workingkey=Yii::app()->functions->getOption('admin_ccAvenue_workingkey',$merchant_id);
	//echo 'merchant';
	
	/*COMMISSION*/
	if ( Yii::app()->functions->isMerchantCommission($merchant_id)){
            $merchant_workingkey=Yii::app()->functions->getOptionAdmin('admin_ccAvenue_workingkey');
	}	
	
} else {
	//echo 'admin';
        $merchant_workingkey=Yii::app()->functions->getOptionAdmin('admin_ccAvenue_workingkey');
}

        $workingKey=$merchant_workingkey;		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
        $flag=false;
        
        $order_id = '';
        $tracking_id = '';
        $bank_ref_no = '';
        $order_status = '';
        $failure_message = '';
        $payment_mode = '';
        $card_name = '';
        $totalAmount = '';
        
	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
                
            if ($i == 0)
                $order_id = $information[1];
            if ($i == 1)
                $tracking_id = $information[1];
            if ($i == 2)
                $bank_ref_no = $information[1];
            if ($i == 3)
                $order_status = $information[1];
            if ($i == 4)
                $failure_message = $information[1];
            if ($i == 5)
                $payment_mode = $information[1];
            if ($i == 6)
                $card_name = $information[1];
            if ($i == 10)
                $totalAmount = $information[1];
     
	}
        
        if($order_status==="Success")
	{
                $flag = true;
     
		//echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
		
	}
	else if($order_status==="Aborted")
	{
                $flag = false;
		//echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
	
	}
	else if($order_status==="Failure")
	{        $flag = false;
		//echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
	}
	else
	{    
                $flag = false;
		//echo "<br>Security Error. Illegal access detected";
	
	}
        
        if($flag == true){
            $params_logs=array(
            'order_id'=>$order_id,
            'payment_type'=>Yii::app()->functions->paymentCode('ccavenue'),
            'raw_response'=>json_encode($decryptValues),
            'date_created'=>date('c'),
            'ip_address'=>$_SERVER['REMOTE_ADDR'],
            'payment_reference'=>$tracking_id
          );
          $db_ext->insertData("{{payment_order}}",$params_logs);

          $params_update=array( 'status'=>'paid');	        
          $db_ext->updateData("{{order}}",$params_update,'order_id',$order_id);

          header('Location: '.Yii::app()->request->baseUrl."/store/receipt/id/".$order_id);
          die();
        }else{
            header('Location: '.Yii::app()->request->baseUrl."/store/ccainit/id/".$order_id.'/status/'.$order_status);
            die();
        }
         
            
 
 
        
    