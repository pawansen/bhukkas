<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<head>

<!-- IE6-8 support of HTML5 elements --> 
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!--[if IE]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"  />
<meta name="viewport" content="width=device-width" />
<meta name="keywords" content="Bukkas delivery food, fast food, sushi, take away, chinese, italian food">
<meta name="description" content="">
<meta name="author" content="Bukkas">
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<link rel="shortcut icon" href="<?php echo  Yii::app()->request->baseUrl; ?>/favicon12.ico?ver=1.0" />
<?php Widgets::analyticsCode();?>
</head>
<body>
<!-- Header -->
<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col--md-4 col-sm-4 col-xs-6">

                <?php Widgets::websiteLogo();?>
            </div>
            <nav class="col--md-8 col-sm-8 col-xs-6">
            <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
            <div class="main-menu">
                <div id="header_menu">
                    <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/logo.png" width="190" height="23" alt="" data-retina="true">
                </div>
                <a href="#" class="open_close" id="close_in"><i class="icon_close"></i></a>
                 <?php //$this->widget('zii.widgets.CMenu', Yii::app()->functions->topMenu());?>
                <ul>
<!--                <li><a href="<?php //echo Yii::app()->createUrl('store'); ?>">Home</a></li>-->
<!--                    <li><a href="<?php //echo $this->createUrl('store/searchArea',array('cu'=>'all')); ?>">Restaurants</a></li>-->
<!--                    <li><a href="<?php //echo Yii::app()->createUrl('store/about'); ?>">About us</a></li>-->
<!--                    <li><a href="<?php //echo Yii::app()->createUrl('store/faq'); ?>">Faq</a></li>-->
                       <li class="submenu"><a href="javascript:void(0);" class="show-submenus"><i class="fa fa-shopping-cart"></i> Cart<i class="icon-down-open-mini"></i></a>
                     <?php //if(isset($_SESSION['kr_item']) && count($_SESSION['kr_item']) >= 1){?>
                         <ul>
                             <li><div class="item-order-wrap">No Item added yet!</div></li>
                             <?php if(isset( Yii::app()->session['rest_slug']) && !empty(Yii::app()->session['rest_slug'])){?>
                             <li> <a class="btn btn-warning" href="<?php echo Yii::app()->request->baseUrl; ?>/store/menu/merchant/<?php if(isset( Yii::app()->session['rest_slug'])){echo  Yii::app()->session['rest_slug'];}?>">
                                <i class=""></i> <?php echo Yii::t("default","ORDER NOW")?></a></li>
                             <?php }?>
                         </ul>
                     <?php //}?>
                     </li>
                    
                    <?php  $enabled_commission = Yii::app()->functions->getOptionAdmin('admin_commission_enabled');
                           $signup_link = "/store/merchantsignup";
                           if ($enabled_commission == "yes") {
                                $signup_link = "/store/merchantsignupselection";
                    }?>
                 
                    <?php if ( !Yii::app()->functions->isClientLogin()): ?>
                    <li class="top_front_sigin"><a href="#0" data-toggle="modal" data-target="#login_2"> <i class="fa fa-user"></i> Log in or Sign up</a></li>
                    <?php endif;?>
                    
              
                    
                    
                   <li class="submenu front-user-display" style="<?php if ( !Yii::app()->functions->isClientLogin()): echo "display: none";endif;?>">
                    <a href="javascript:void(0);" class="show-submenu"> <?php echo ucwords(Yii::app()->functions->getClientName());?><i class="icon-down-open-mini"></i></a>
                        <ul>
                            <li>
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/store/Profile">
                                <i class=""></i> <?php echo Yii::t("default","Profile")?></a>
                                </li>
                                <li>
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/store/orderHistory">
                                <i class=""></i> <?php echo Yii::t("default","Order History")?></a>
                                </li>

                                <li>
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/store/addressbook">
                                <i class=""></i> <?php echo Yii::t("default","Address Book")?></a>
                                </li>
                            
                                <li>
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/store/myreviews">
                                <i class=""></i> <?php echo Yii::t("default","Reviews")?></a>
                                </li>
                            
                                <li>
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/store/favouriteRestorantList">
                                <i class=""></i> <?php echo Yii::t("default","Favourite")?></a>
                                </li>

                                <?php if (Yii::app()->functions->getOptionAdmin('disabled_cc_management')==""):?>
<!--                                <li>
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/store/Cards">
                                <i class=""></i> <?php echo Yii::t("default","Credit Cards")?></a>
                                </li>-->
                                <?php endif;?>
                                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/store/logout">
                                <i class=""></i> <?php echo Yii::t("default","Logout")?></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- End main-menu -->
            </nav>
        </div>
        <!-- End row -->
    </div>
    <!-- End container -->
</header>
<!-- End Header -->
<input type="hidden"  name="cureentlang" id="cureentlang" />

<input type="hidden"  name="merchant_id" id="merchant_id" value="<?php if(isset( Yii::app()->session['slug_merchant_id'])){echo  Yii::app()->session['slug_merchant_id'];}?>"/>
<input type="hidden"  name="cureentlat" id="cureentlat" />

<input type="hidden"  name="cureentLocationlang" id="cureentLocationlang" />
<input type="hidden"  name="cureentLocationlat" id="cureentLocationlat" />

<input type="hidden" name="cityId" id="setCityId" value="<?php echo isset(Yii::app()->session['cid']) && Yii::app()->session['cid'] != null ?Yii::app()->session['cid']:'';?>" />
<input type="hidden" name="cityName" id="cityName" value="<?php echo isset(Yii::app()->session['myCity']) && Yii::app()->session['myCity'] != null ?Yii::app()->session['myCity']:'';?>" />
 <?php echo $content;  ?>
<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
             <?php //$this->widget('zii.widgets.CMenu', Yii::app()->functions->frontBottomMenu());?>
            <ul>
               <li class="top_front_signup"><a href="#0" data-toggle="modal" data-target="#partnerUs"> Partner With Us</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('store/about'); ?>">About Us</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('store/faq'); ?>">Help</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('store/contact'); ?>">Contact Us</a></li>
                 <?php if ( !Yii::app()->functions->isClientLogin()):?>
                <li><a href="<?php echo Yii::app()->createUrl('store/MerchantRegister'); ?>">Merchant Signup</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('merchant'); ?>">Merchant Signin</a></li>
                <?php endif;?>
                <li><a href="<?php echo Yii::app()->createUrl('store/tac'); ?>">Terms and conditions</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div id="social_footer">
                   <ul>
                    <?php $fbHref= Yii::app()->functions->getOptionAdmin("admin_fb_page");
                    $twitterHref = Yii::app()->functions->getOptionAdmin("admin_twitter_page");
                    $googleHref = Yii::app()->functions->getOptionAdmin("admin_google_page");
                    ?>
                    <li><a href="<?php if(isset($fbHref) && !empty($fbHref)){ echo $fbHref ;} ?>" target="_blank"><i class="icon-facebook"></i></a></li>
                    <li><a href="<?php if(isset($twitterHref) && !empty($twitterHref)){ echo $twitterHref ;} ?>" target="_blank"><i class="icon-twitter"></i></a></li>
                    <li><a href="<?php if(isset($googleHref) && !empty($googleHref)){ echo $googleHref ;} ?>" target="_blank"><i class="icon-google"></i></a></li>
                    </ul>
                    <p>&copy; Bhukkas 2016</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->
<div class="layer"></div>
<!-- Mobile menu overlay mask -->
 

<!-- Register modal -->   
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myRegister" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-popup">
			<a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
    
        
    <form id="form-signup" class="popup-form form-signup" onsubmit="return false;" method="POST">
      <?php echo CHtml::hiddenField('action','clientRegistrationModal')?>
    <?php 
   $verification=Yii::app()->functions->getOptionAdmin("website_enabled_mobile_verification");	    
    if ( $verification=="yes"){
        echo CHtml::hiddenField('verification',$verification);
    }
    ?>  
     <div class=""> <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/logo.png" width="250" height="" alt="" data-retina="true" class=""></div>
    <div id="has_error_message_signup"></div>
    </br>
    <div class="has_error_msg"></div>
     <?php echo CHtml::textField('first_name','',array(
       'class'=>'form-control form-white',
       'placeholder'=>Yii::t("default","First Name"),
       'data-validation'=>"required"
      ))?>
        <?php echo CHtml::textField('last_name','',array(
       'class'=>'form-control form-white',
       'placeholder'=>Yii::t("default","Last Name"),
       'data-validation'=>"required"
      ))?>
     <?php echo CHtml::textField('contact_phone','',array(
       'class'=>'form-control form-white',
       'placeholder'=>yii::t("default","Mobile"),
       'data-validation'=>"required",
       'data-validation'=>"length number", 
       'data-validation-length'=>"min10",
       'data-validation-length'=>"max12",
      
      ))?>
     <?php echo CHtml::textField('email_address','',array(
       'class'=>'form-control form-white',
       'placeholder'=>yii::t("default","Email address"),
       'data-validation'=>"email",
       'data-validation-error-msg'=>"You did not enter a valid e-mail"
      ))?>
    <?php 
     $FunctionsK=new FunctionsK();
     $FunctionsK->clientRegistrationCustomFields();
     ?>
     <?php echo CHtml::passwordField('password','',array(
       'class'=>'form-control form-white',
       'placeholder'=>Yii::t("default","Password"),
       'data-validation'=>"length required",
       'data-validation-length'=>"min6",
      ))?>
     <?php echo CHtml::passwordField('cpassword','',array(
       'class'=>'form-control form-white',
       'placeholder'=>Yii::t("default","Confirm Password"),
       'data-validation'=>"required" ,
       'data-validation'=>"confirmation",

      ))?> 
      <?php if ( Yii::app()->functions->getOptionAdmin('website_terms_customer')=="yes"):?>
        <?php 
        $terms_link=Yii::app()->functions->getOptionAdmin('website_terms_customer_url');
        $terms_link=Yii::app()->functions->prettyLink($terms_link);
        ?>
      <?php 
        echo CHtml::checkBox('terms_n_condition',false,array(
         'value'=>2,
         'class'=>"",
         'data-validation'=>"required",
         'data-validation-error-msg'=>"You did not check Terms & Conditions"
        ));
        echo " ". t("I Agree To")." <a href=\"$terms_link\" target=\"_blank\">".t("The Terms & Conditions")."</a>";
        ?> 
   <?php endif;?>

    <div id="pass-info" class="clearfix"></div>
				<div class="checkbox-holder text-left">
					<div class="checkbox">
						<input type="checkbox" value="1" id="check_2" name="check_2"  data-validation="required"/>
						<label for="check_2"><span>I Agree to the <strong><a href="<?php echo Yii::app()->createUrl('store/tac'); ?>">Terms &amp; Conditions</a></strong></span></label>
					</div>
				</div>
				<input type="submit" class="btn btn-submit" value="<?php echo Yii::t("default","Create Account") ?>"/>
			</form>
   
		</div>
	</div>
</div>
<!-- End Register modal -->  

<!-- Login modal --> 
 <div class="modal fade" id="login_2" tabindex="-1" role="dialog" aria-labelledby="myLogin" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-popup">
  <div id="login_hidden">    
    <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
    <form class="popup-form" id="frm-modal-login" onsubmit="return false;" onsubmit="return false;" method="POST">
    <div id="has_error_message"></div>
        <?php echo CHtml::hiddenField('action','clientLoginModal')?>
    <?php echo CHtml::hiddenField('do-action', isset($_GET['do-action'])?$_GET['do-action']:'' )?>
    <?php echo CHtml::hiddenField('rating', isset($_GET['rating'])?$_GET['rating']:'' )?>

     <div class=""> <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/logo.png" width="250" height="" alt="" data-retina="true" class=""></div>

         <?php echo CHtml::textField('username','',
             array('class'=>'form-control form-white','placeholder'=>Yii::t("default","Email"),
       
                 'data-validation'=>"email",
       'data-validation-error-msg'=>"You did not enter a valid e-mail"))?>
           <?php echo CHtml::passwordField('password','',
          array('class'=>'form-control form-white','placeholder'=>Yii::t("default","Password"),'data-validation'=>"required"))?>


     <div class="text-left">
         <a onclick="hiddenForms();" href="javascript:void(0);">Forgot Password?</a>
     </div>
     <input type="submit" class="btn btn-submit" value="<?php echo Yii::t("default","Login")?>"/>
     </br></br>
       <div class="text-left">If You don't have account ?
         <a onclick="showRegisterModel();" href="javascript:void(0);">Sign up</a>
     </div>
    </form>
  
  </div><!-- end login hidden-->
  <div id="forgot_hidden" style="display:none">  
       <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
       <form id="frm-modal-forgotpass" class="popup-form" method="POST" onsubmit="return false;">
       </br>
    
        
             <div class=""> <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/logo.png" width="250" height="" alt="" data-retina="true" class=""></div>
    <?php echo CHtml::hiddenField('action','forgotPassword')?>
     <?php echo CHtml::hiddenField('do-action',$_GET['do-action'])?>     
     <h3 style="color:#fff;"><?php echo Yii::t("default","Forgot Password")?></h3>
            <div class="has_error_msg"></div>    
    <div class="uk-form-row">
       <?php echo CHtml::textField('username-email','',
        array('class'=>'form-control form-white','placeholder'=>Yii::t("default","Email address"),
       'data-validation'=>"email",
       'data-validation-error-msg'=>"You did not enter a valid e-mail"))?>
     </div>
         
    <div class="uk-form-row">
      <input type="submit" value="<?php echo Yii::t("default","Retrieve Password")?>" class="btn btn-submit">
    </div>     
     
    </form>
    
      <a href="javascript:;" class="back-link left" onclick="formShow()"><i class="fa fa-angle-left"></i> <?php echo Yii::t("default","Back")?></a>      
    <div style="height:10px;"></div>
      
  </div> <!-- end forgot hidden-->
  
		</div>
	</div>
</div><!-- End modal -->    


<!-- Partner with us modal -->   
<div class="modal fade" id="partnerUs" tabindex="-1" role="dialog" aria-labelledby="myPartner" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-popup">
			<a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
    <div class="has_error_message_signup"></div>
        
    <form id="form-partner" class="popup-form form-signup" onsubmit="return false;" method="POST">
      <?php echo CHtml::hiddenField('action','partnerRegistration')?>
  <div class=""> <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/logo.png" width="250" height="" alt="" data-retina="true" class=""></div>
        <h3 style="color:#FFFFFF;">Add your restaurant on bhukkas.com </br> Get Listed Today</h3>
    </br>
    <div id="partner-error"></div>
     <?php echo CHtml::textField('full_name','',array(
       'class'=>'form-control form-white',
       'placeholder'=>Yii::t("default","Your Name"),
       'data-validation'=>"required",
      'data-validation-error-msg'=>"You did not enter your name"
      ))?>
  
     <?php echo CHtml::textField('contact_phone','',array(
       'class'=>'form-control form-white',
       'placeholder'=>yii::t("default","Phone Number"),
       'data-validation'=>"required",
       'data-validation'=>"length number", 
       'data-validation-length'=>"min10",
       'data-validation-length'=>"max12",
      
      ))?>
     <?php echo CHtml::textField('email_address','',array(
       'class'=>'form-control form-white',
       'placeholder'=>yii::t("default","Email Id"),
       'data-validation'=>"email",
       'data-validation-error-msg'=>"You did not enter a valid e-mail"
      ))?>
       <?php echo CHtml::textField("restaurant_name",'',array(
       'class'=>'form-control form-white',
       'placeholder'=>Yii::t("default","Restaurant's Name"),
       'data-validation'=>"required",
       'data-validation-error-msg'=>"You did not enter restaurant name"
      ))?>
        <?php echo CHtml::textField("city",'',array(
       'class'=>'form-control form-white',
       'placeholder'=>Yii::t("default","City"),
       'data-validation'=>"required",
            'data-validation-error-msg'=>"You did not enter city"
      ))?>
        <?php echo CHtml::textField("address",'',array(
       'class'=>'form-control form-white',
       'placeholder'=>Yii::t("default","Address"),
       'data-validation'=>"required",
       'data-validation-error-msg'=>"You did not enter address"
      ))?>
      <?php echo CHtml::textArea("comment",'',array(
       'class'=>'form-control form-white',
       'placeholder'=>Yii::t("default","Comments"),
      ))?>

    <div id="pass-info" class="clearfix"></div>
<input type="submit" class="btn btn-submit" value="<?php echo Yii::t("default","Submit") ?>"/>
   </form>
   
		</div>
	</div>
</div>
<!-- End partner modal -->  
    <!--email modal-->
    <div class="modal fade" id="emailSubscribe" tabindex="-1" role="dialog" aria-labelledby="myPartner" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-popup">
			<a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
    <div class="has_error_message_signup"></div>
        
    <form id="form-email" class="popup-form form-signup" onsubmit="return false;" method="POST">
      <?php echo CHtml::hiddenField('action','emailsubscription')?>
  <div class=""> <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/logo.png" width="250" height="" alt="" data-retina="true" class=""></div>
        <h3 style="color:#FFFFFF;">Add your email for subscription </br> Get Listed Today</h3>
    </br>
    <div id="email-error"></div>
    
    <?php echo CHtml::textField("city",'',array(
       'class'=>'form-control form-white',
       'placeholder'=>Yii::t("default","City"),
       'data-validation'=>"required",
            'data-validation-error-msg'=>"You did not enter city"
      ))?>
    
     <?php echo CHtml::textField('email_address','',array(
       'class'=>'form-control form-white',
       'placeholder'=>yii::t("default","Email Id"),
       'data-validation'=>"email",
       'data-validation-error-msg'=>"You did not enter a valid e-mail"
      ))?>
      
    <div id="pass-info" class="clearfix"></div>
<input type="submit" class="btn btn-submit" value="<?php echo Yii::t("default","Submit") ?>"/>
   </form>
   
		</div>
	</div>
</div>
    <!--email modal-->
<!-- review modal -->   

</body>
</html>