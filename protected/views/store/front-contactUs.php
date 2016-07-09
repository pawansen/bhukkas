<?php $website_address=Yii::app()->functions->getOptionAdmin('website_address');
$website_contact_phone=Yii::app()->functions->getOptionAdmin('website_contact_phone');
$website_contact_email=Yii::app()->functions->getOptionAdmin('website_contact_email');
$contact_content=Yii::app()->functions->getOptionAdmin('contact_content');

$country=Yii::app()->functions->adminCountry();
$fields=yii::app()->functions->getOptionAdmin('contact_field');
if (!empty($fields)){
	$fields=json_decode($fields);
}
?>

<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/sub_header_short.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
         <h1>Contact Us</h1>
         <p><i class="icon_pin"></i> <?php echo $website_address ." ".$country;?></p>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?php echo Yii::app()->createUrl('store'); ?>">Home</a></li>
            <li><a href="<?php echo Yii::app()->createUrl('store/contact'); ?>">Contact Us</a></li>
        </ul>
    </div>
</div><!-- Position -->

<!-- Content ================================================== -->
<div class="container margin_60_35">
    
    
    <?php $contact_map=yii::app()->functions->getOptionAdmin('contact_map');
$map_latitude=yii::app()->functions->getOptionAdmin('map_latitude');
$map_longitude=yii::app()->functions->getOptionAdmin('map_longitude');

$marker=Yii::app()->functions->getOptionAdmin('map_marker');
if (!empty($marker)){
   echo CHtml::hiddenField('map_marker',$marker);
}

$fields=yii::app()->functions->getOptionAdmin('contact_field');
if (!empty($fields)){
	$fields=json_decode($fields);
}

?>
    
   
	<div class="row" id="contacts">
    	<div class="col-md-6 col-sm-6">
        	<div class="box_style_2">
            	<h2 class="inner">Customer service</h2>
                <p class="add_bottom_30"></p>
                <p><a href="tel://<?php echo $website_contact_phone;?>" class="phone"><i class="icon-phone-circled"></i>  <?php echo $website_contact_phone;?></a></p>
                <p class="nopadding"><a href="mailto:<?php echo $website_contact_email;?>"><i class="icon-mail-3"></i> <?php echo $website_contact_email;?></a></p>
            </div>
    	</div>
        <div class="col-md-6 col-sm-6">
        	<div class="box_style_2">
            	<h2 class="inner">Restaurant Support</h2>
                <p class="add_bottom_30"></p>
                <p><a href="tel://<?php echo $website_contact_phone;?>" class="phone"><i class="icon-phone-circled"></i>  <?php echo $website_contact_phone;?></a></p>
                <p class="nopadding"><a href="mailto:<?php echo $website_contact_email;?>"><i class="icon-mail-3"></i> <?php echo $website_contact_email;?></a></p>
            </div>
    	</div>
            
    <div class="col-md-6 col-sm-6">
       <div class="box_style_2">
       <h2 class="inner">Contact Us</h2>
       <p class="add_bottom_30"></p>
      
                
    <form class="uk-form uk-form-horizontal forms" id="contactUs" onsubmit="return false;">
  <?php echo CHtml::hiddenField('action','contacUsSubmit')?>
  <?php echo CHtml::hiddenField('currentController','store')?>
  
  <div class="uk-form-row">   
  <p class="nomargin"><?php //echo $website_address ." ".$country;?></p>
  <p class="nomargin uk-text-muted"><?php //echo $website_contact_phone;?></p>
  <p class="nomargin uk-text-muted"><?php //echo $website_contact_email;?></p>
  </div>
  
  
  <p><?php echo $contact_content;?></p>
  
  <?php //if ( $contact_map==1):?>
<!--  <div id="google_map_wrap"></div>-->
  <?php 
 /*echo CHtml::hiddenField('map_title',yii::app()->functions->getOptionAdmin('website_title'));
  echo CHtml::hiddenField('map_latitude',$map_latitude);
  echo CHtml::hiddenField('map_longitude',$map_longitude);*/
  ?>
  <?php //endif;?>
  
  <?php if (is_array($fields) && count($fields)>=1):?>
  <?php foreach ($fields as $val):?>
  
  <?php  
  $placeholder='';
  $validate_default="required";
  $oninput="";
  $data_validation_error_msg = "You have not answered all required fields";
  switch ($val) {
  	case "name":
  		$placeholder="Name";
                $data_validation_error_msg="You did not enter Name";
  		break;
  	case "email":  
  	    $placeholder="Email address";
  	    $validate_default="email";
            $data_validation_error_msg="You did not enter valid E-mail";
  		break;
  	case "phone":  
  	    $placeholder="Phone";
            $data_validation_error_msg="You did not enter phone";
            $oninput = "this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');";
  		break;
  	case "country":  
  	    $placeholder="Country";
            $data_validation_error_msg="You did not enter country";
  		break;
  	case "message":  
  	    $placeholder="Message";
            $data_validation_error_msg="You did not enter message";
  		break;	  	
  	default:
  		break;
  }
  ?>
  
  <div class="uk-form-row">   
    <?php if ( $val=="message"):?>
    <?php echo CHtml::textArea($val,'',array(
		'class'=>'uk-width-1-1',
		'data-validation'=>"required" ,
		'placeholder'=>Yii::t("default",$placeholder)
		))?>
    <?php else :?>
		<?php echo CHtml::textField($val,'',array(
		'class'=>'uk-width-1-1',	
		'data-validation'=>$validate_default ,
		'placeholder'=>Yii::t("default",$placeholder),
                'data-validation-error-msg'=>$data_validation_error_msg ,
                  'oninput'=>  $oninput
		))?>
	<?php endif;?>
  </div>
  <?php endforeach;?>  
  <div class="uk-form-row">   
      <input type="submit" value="<?php echo Yii::t("default","Submit")?>" class="uk-button uk-button-success uk-width-1-3">
   </div>
  <?php endif;?> 
       
  </form>
                
                
            </div>
    	</div>
    </div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->
  