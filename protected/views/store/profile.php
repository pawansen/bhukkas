<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/sub_header_short.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
         <h1>Profile</h1>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->
<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?php echo Yii::app()->createUrl('store'); ?>">Home</a></li>
            <li><a href="<?php echo Yii::app()->createUrl('store/Profile'); ?>">Profile</a></li>
        </ul>
    </div>
</div><!-- Position -->
<!-- Content ================================================== -->
<div class="container margin_60_35">
	<div class="row" id="contacts">
    	<div class="col-md-12 col-sm-12">


<div class="page-right-sidebar">
  <div class="main">
  <div class="inner">
  
<?php 
echo CHtml::hiddenField('mobile_country_code',Yii::app()->functions->getAdminCountrySet(true));
?>  
  
  <form class="profile-forms uk-form uk-form-horizontal forms" id="contactUs" onsubmit="return false;">
   
  <?php echo CHtml::hiddenField('action','updateClientProfile')?>
  <?php echo CHtml::hiddenField('currentController','store')?>
 
  <h2><?php echo Yii::t("default","Profile")?></h2>
  
  <?php $client_id=Yii::app()->functions->getClientId();?>
  <?php if ($data=Yii::app()->functions->getClientInfo($client_id) ):?>
  
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","First Name")?></label>
  <?php 
  echo CHtml::textField('first_name',$data['first_name'],
  array(
    'class'=>'uk-form-width-large',
    'data-validation'=>"required",
    'data-validation-error-msg'=>"You did not enter first name",
    'onkeypress' => "return onlyAlphabets(event,this);"
  ));
  ?>
  </div>
  
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Last Name")?></label>
  <?php 
  echo CHtml::textField('last_name',$data['last_name'],
  array(
    'class'=>'uk-form-width-large',
    'data-validation'=>"required",
    'data-validation-error-msg'=>"You did not enter last name",
    'onkeypress' => "return onlyAlphabets(event,this);"
  ));
  ?>
  </div>
  
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Email address")?></label>
  <span><?php echo $data['email_address'];?></span>
  </div>  
  
  <?php 
  $FunctionsK=new FunctionsK();
  $FunctionsK->clientRegistrationCustomFields(true,$data);
  ?>
     
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Change Password")?></label>
  <?php 
  echo CHtml::passwordField('password','',
  array(
    'class'=>'uk-form-width-large',
    //'data-validation'=>"required"
  ));
  ?>
  </div>
  
  <h3><?php echo Yii::t("default","Address")?></h3>  
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Street")?></label>
  <?php 
  echo CHtml::textField('street',$data['street'],
  array(
    'class'=>'uk-form-width-large',
    'data-validation'=>"required",
    'data-validation-error-msg'=>"You did not enter street"
  ));
  ?>
  </div>
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","City")?></label>
  <?php 
  echo CHtml::textField('city',$data['city'],
  array(
    'class'=>'uk-form-width-large',
    'data-validation'=>"required",
    'data-validation-error-msg'=>"You did not enter city"
  ));
  ?>
  </div>
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","State")?></label>
  <?php 
  echo CHtml::textField('state',$data['state'],
  array(
    'class'=>'uk-form-width-large',
    'data-validation'=>"required",
    'data-validation-error-msg'=>"You did not enter state"
  ));
  ?>
  </div>
  <?php $oninput = "this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');";?>
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Postal Code/Zip Code")?></label>
  <?php 
  echo CHtml::textField('zipcode',$data['zipcode'],
  array(
    'class'=>'uk-form-width-large',
    'data-validation'=>"length number", 
    'data-validation-length'=>"6-6",
      'oninput'=>  $oninput
     

  ));
  ?>
  </div>
  
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Contact phone")?></label>
  <?php 
  echo CHtml::textField('contact_phone',$data['contact_phone'],
  array(
    'class'=>'uk-form-width-large mobile_inputs',
    'data-validation'=>"length number", 
    'data-validation-length'=>"10-12" ,
      'oninput'=>  $oninput

  ));
  ?>
  </div>  
  
  <div class="uk-form-row">
   <label class="uk-form-label"></label>
    <input type="submit" value="<?php echo Yii::t("default","Save")?>" class="uk-button uk-form-width-medium uk-button-success">
  </div>  

  
  <?php else :?>
  <p class="uk-text-danger"><?php echo Yii::t("default","Profile not available")?></p>
  <?php endif;?>  
  </form>
    
  </div>
  </div> <!--main-->
</div> <!--page-right-sidebar--> 
    	</div>
    </div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->
  <script language="Javascript" type="text/javascript">
 
        function onlyAlphabets(e, t) {
            try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))
                    return true;
                else
                    return false;
            }
            catch (err) {
                alert(err.Description);
            }
        }
 
    </script>