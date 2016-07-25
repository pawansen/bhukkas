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
	
} else $error=Yii::t("default","Failed. Cannot process payment");  

?>
<!-- SubHeader =============================================== -->
<section class="parallax-window"  id="short"  data-parallax="scroll" data-image-src="<?php echo Yii::app()->request->baseUrl; ?>/assets/front/img/sub_header_cart.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
    	<div id="sub_content">
    	 <h1>Place your Order</h1>
            <div class="bs-wizard">
                <div class="col-xs-4 bs-wizard-step complete">
                  <div class="text-center bs-wizard-stepnum"><strong>1.</strong> Your details</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="cart.html" class="bs-wizard-dot"></a>
                </div>
                               
                <div class="col-xs-4 bs-wizard-step active">
                  <div class="text-center bs-wizard-stepnum"><strong>2.</strong> Payment</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#0" class="bs-wizard-dot"></a>
                </div>
            
              <div class="col-xs-4 bs-wizard-step disabled">
                  <div class="text-center bs-wizard-stepnum"><strong>3.</strong> Finish!</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="cart_3.html" class="bs-wizard-dot"></a>
                </div>  
		</div><!-- End bs-wizard --> 
        </div><!-- End sub_content -->
	</div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->
    <div id="position">
        <div class="container">
            <ul>
                <li><a href="<?php echo Yii::app()->createUrl('store'); ?>">Home</a></li>
            </ul>
        </div>
    </div><!-- Position -->
    
<!-- Content ================================================== -->
<!-- Content ================================================== -->
<div class="container margin_60_35">
	<div id="container_pin">
		<div class="row">
			<div class="col-md-3">
				<div class="box_style_2 hidden-xs info">
					<h4 class="nomargin_top">Delivery time <i class="icon_clock_alt pull-right"></i></h4>
					<p>
						Lorem ipsum dolor sit amet, in pri partem essent. Qui debitis meliore ex, tollit debitis conclusionemque te eos.
					</p>
					<hr>
					<h4>Secure payment <i class="icon_creditcard pull-right"></i></h4>
					<p>
						Lorem ipsum dolor sit amet, in pri partem essent. Qui debitis meliore ex, tollit debitis conclusionemque te eos.
					</p>
				</div><!-- End box_style_2 -->
<!--                
				<div class="box_style_2 hidden-xs" id="help">
					<i class="icon_lifesaver"></i>
					<h4>Need <span>Help?</span></h4>
					<a href="tel://004542344599" class="phone">+45 423 445 99</a>
					<small>Monday to Friday 9.00am - 7.30pm</small>
				</div>-->
			</div><!-- End col-md-3 -->
                        
	<div class="col-md-6">
	<div class="box_style_2">

<div class="page-right-sidebar payment-option-page">
  <div class="main">  
  <?php if ( !empty($error)):?>
  <p class="uk-text-danger"><?php echo $error;?></p>  
  <?php else :?>
  
  <?php require_once("payu.php")?>
  <?php 
  if ( $success==TRUE){
   	  //dump($_POST);
   	  $data_post=$_POST;	
   	  $params_logs=array(
      'order_id'=>$_GET['id'],
      'payment_type'=>Yii::app()->functions->paymentCode('payumoney'),
      'raw_response'=>json_encode($data_post),
      'date_created'=>date('c'),
      'ip_address'=>$_SERVER['REMOTE_ADDR'],
      'payment_reference'=>$data_post['txnid']
    );
    $db_ext->insertData("{{payment_order}}",$params_logs);
    
    $params_update=array( 'status'=>'paid');	        
    $db_ext->updateData("{{order}}",$params_update,'order_id',$_GET['id']);
    
    header('Location: '.Yii::app()->request->baseUrl."/store/receipt/id/".$_GET['id']);
    die();						
  }
  ?>
  
  <?php endif;?>      
  <div style="height:10px;"></div>
<!--  <a href="<?php echo $back_url;?>"><?php echo Yii::t("default","Go back")?></a>-->
  
  </div>
</div>
            
        </div>
        </div>
                        
<!--           <div class="col-md-3">
				<div id="cart_box">
					<h3>Your order <i class="icon_cart_alt pull-right"></i></h3>
                                         <div class="item-order-wrap"></div>
					<table class="table table_summary">
					<tbody>
					<tr>
						<td>
							<a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> <strong>1x</strong> Enchiladas
						</td>
						<td>
							<strong class="pull-right">$11</strong>
						</td>
					</tr>
					<tr>
						<td>
							<a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> <strong>2x</strong> Burrito
						</td>
						<td>
							<strong class="pull-right">$14</strong>
						</td>
					</tr>
					<tr>
						<td>
							<a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> <strong>1x</strong> Chicken
						</td>
						<td>
							<strong class="pull-right">$20</strong>
						</td>
					</tr>
					<tr>
						<td>
							<a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> <strong>2x</strong> Corona Beer
						</td>
						<td>
							<strong class="pull-right">$9</strong>
						</td>
					</tr>
					<tr>
						<td>
							<a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> <strong>2x</strong> Cheese Cake
						</td>
						<td>
							<strong class="pull-right">$12</strong>
						</td>
					</tr>
					</tbody>
					</table>
					<hr>
					<div class="row" id="options_2">
						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
							<label><input type="radio" value="" checked name="option_2" class="icheck">Delivery</label>
						</div>
						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
							<label><input type="radio" value="" name="option_2" class="icheck">Take Away</label>
						</div>
					</div> Edn options 2 
					<hr>
					<table class="table table_summary">
					<tbody>
					<tr>
						<td>
							 Subtotal <span class="pull-right">$56</span>
						</td>
					</tr>
					<tr>
						<td>
							 Delivery fee <span class="pull-right">$10</span>
						</td>
					</tr>
					<tr>
						<td class="total">
							 TOTAL <span class="pull-right">$66</span>
						</td>
					</tr>
					</tbody>
					</table>
					<hr>
					<a class="btn_full" href="cart_3.html">Confirm your order</a>
				</div> End cart_box 
			</div>-->
                        <!-- End col-md-3 -->             
                        
                        
                        
 		</div><!-- End row -->
	</div><!-- End container pin-->
</div><!-- End container -->
<!-- End Content =============================================== -->                       