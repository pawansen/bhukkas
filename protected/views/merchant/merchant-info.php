<?php $mtype=Yii::app()->functions->getMerchantMembershipType(); 
$oninput = "this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');";
?>

<div id="error-message-wrapper"></div>

<ul data-uk-tab="{connect:'#tab-content'}" class="uk-tab uk-active">
<li class="uk-active"><a href="#"><?php echo Yii::t("default","Restaurant Information")?></a></li>

<li><a href="#"><?php echo Yii::t("default","Information")?></a></li>

<!--<li class=""><a href="#"><?php echo Yii::t("default","Login Information")?></a></li>-->
<li class=""><a href="#" class="view-map"><?php echo Yii::t("default","Google Map")?></a></li>
<li class=""><a href="#"><?php echo Yii::t("default","Account Detail")?></a></li>
<?php if ( $mtype==1):?>
<li class=""><a href="#"><?php echo Yii::t("default","Membership Status")?></a></li>
<!--<li class=""><a href="#"><?php echo Yii::t("default","Payment History")?></a></li>-->

<?php endif;?>
</ul>
                                     
<?php 
if (!$data=Yii::app()->functions->getMerchant(Yii::app()->functions->getMerchantID())){
	echo "<div class=\"uk-alert uk-alert-danger\">".
	Yii::t("default","Sorry but we cannot find what your are looking for.")."</div>";
	return ;
}
?>                                   

<form class="uk-form uk-form-horizontal forms" id="forms">
<?php echo CHtml::hiddenField('action','UpdateMerchant')?>
<?php echo CHtml::hiddenField('country_code',isset($data['country_code'])?$data['country_code']:"")?>

<ul class="uk-switcher uk-margin " id="tab-content">
<li class="uk-active">
    <fieldset>        
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Status")?></label>
          <?php 
          switch ($data['status']) {
          	case "expired":
          		echo "<a href=\"".Yii::app()->request->baseUrl."/merchant/MerchantStatus\" class=\"uk-badge uk-badge-danger\">".strtoupper(t($data['status']))."</a>";
          		break;
          	case "active":
          		echo "<a href=\"".Yii::app()->request->baseUrl."/merchant/MerchantStatus\" class=\"uk-badge uk-badge-success\">".strtoupper(t($data['status']))."</a>";
          		break;
          	default:
          		echo "<a href=\"".Yii::app()->request->baseUrl."/merchant/MerchantStatus\" class=\"uk-badge uk-badge-notification\">".strtoupper(t($data['status']))."</a>";
          		break;
          }
          ?>         
        </div>
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Restaurant name")?></label>
          <?php echo CHtml::textField('restaurant_name',
          isset($data['restaurant_name'])?stripslashes($data['restaurant_name']):""
          ,array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"required",
          'data-validation-error-msg' => "You did not enter restaurent name."     
          ))?>
        </div>
        
        <?php if ( Yii::app()->functions->getOptionAdmin('merchant_reg_abn')=="yes"):?>
         <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","ABN")?></label>
          <?php echo CHtml::textField('abn',
          isset($data['abn'])?$data['abn']:""
          ,array(
          'class'=>'uk-form-width-large',
          //'data-validation'=>"required"
          ))?>
        </div>
        <?php endif;?>
        
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Restaurant phone")?></label>
          <?php echo CHtml::textField('restaurant_phone',
          isset($data['restaurant_phone'])?$data['restaurant_phone']:""
          ,array(
          'class'=>'uk-form-width-large'
          ))?>
        </div>
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Contact name")?></label>
          <?php echo CHtml::textField('contact_name',
          isset($data['contact_name'])?$data['contact_name']:""
          ,array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"required",
          'data-validation-error-msg' => "You did not enter contact name."    
          ))?>
        </div>
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Contact phone")?></label>
          <?php echo CHtml::textField('contact_phone',
          isset($data['contact_phone'])?$data['contact_phone']:""
          ,array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"required",
          'data-validation-error-msg' => "You did not enter phone number."    
          ))?>
        </div>
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Contact email")?></label>
          <?php echo CHtml::textField('contact_email',
          isset($data['contact_email'])?$data['contact_email']:""
          ,array(
          'class'=>'uk-form-width-large user-email',
          'data-validation'=>"required",
          'data-validation-error-msg' => "You did not enter email address."    
          ))?>
           <span><input type="checkbox" name="isUserName" id="isUserName"/> Make Username</span>
        </div>
                
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Country")?></label>
          <?php echo CHtml::dropDownList('country_code',
          isset($data['country_code'])?$data['country_code']:"",
          (array)Yii::app()->functions->CountryListMerchant(),          
          array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"required",
          'data-validation-error-msg' => "You did not select country."    
          ))?>
        </div>
                              
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Country code")?></label>
          <?php echo isset($data['country_code'])?$data['country_code']:""?>
        </div>
          
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Street address")?></label>
          <?php echo CHtml::textField('street',
          isset($data['street'])?$data['street']:""
          ,array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"required",
          'data-validation-error-msg' => "You did not enter street address."    
          ))?>
        </div>
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","City")?></label>
          <?php echo CHtml::textField('city',
          isset($data['city'])?$data['city']:""
          ,array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"required",
          'data-validation-error-msg' => "You did not enter city name."   
          ))?> 
        </div>
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Post code/Zip code")?></label>
          <?php echo CHtml::textField('post_code',
          isset($data['post_code'])?$data['post_code']:""
          ,array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"required",
          'data-validation-error-msg' => "You did not enter zip code."    
          ))?>
        </div>
        
		<div class="uk-form-row">
		<label class="uk-form-label"><?php echo Yii::t("default","State/Region")?></label>
		<?php echo CHtml::textField('state',
		isset($data['state'])?$data['state']:""
		,array(
		'class'=>'uk-form-width-large',
		'data-validation'=>"required",
                'data-validation-error-msg' => "You did not enter state."    
		))?>
		</div>              		
		        
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Cuisine")?></label>
          <?php echo CHtml::dropDownList('cuisine[]',
          isset($data['cuisine'])?(array)json_decode($data['cuisine']):"",
          (array)Yii::app()->functions->Cuisine(true),          
          array(
          'class'=>'uk-form-width-large chosen',
          'multiple'=>true,
          'data-validation'=>"required",
          'data-validation-error-msg' => "You did not select cuisine."    
          ))?>
        </div>
        
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Category")?></label>
          <?php echo CHtml::dropDownList('category',
          isset($data['merchant_category'])?$data['merchant_category']:"",
          (array)clientCategory(),         
          array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"required"
          ))?>
        </div>
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Pick Up or Delivery?")?></label>
          <?php echo CHtml::dropDownList('service',
          isset($data['service'])?$data['service']:"",
          (array)Yii::app()->functions->Services(),          
          array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"required",
          'data-validation-error-msg' => "You did not select pick up or delivery only."    
          ))?>
        </div>
                     
<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Username")?></label>
  <?php echo CHtml::textField('username',
  isset($data['username'])?$data['username']:""
  ,array(
  'class'=>'uk-form-width-large user-class'
  ))?>
</div>

<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Password")?></label>
  <?php echo CHtml::passwordField('password',
  ""
  ,array(
  'class'=>'uk-form-width-large',
  'autocomplete'=>"off",    
  ))?>
</div>  
  
    </fieldset>
</li>

<li class="">
<?php echo CHtml::textArea('merchant_information',
Yii::app()->functions->getOption("merchant_information",Yii::app()->functions->getMerchantID())
,array(
 'class'=>"big-textarea"
))?>
</li>



<li>
<?php 
$merchant_id=Yii::app()->functions->getMerchantID();
$merchant_latitude=Yii::app()->functions->getOption("merchant_latitude",$merchant_id);
$merchant_longtitude=Yii::app()->functions->getOption("merchant_longtitude",$merchant_id);
?>
<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Latitude")?></label>
  <?php echo CHtml::textField('merchant_latitude',
  $merchant_latitude
  ,array(
  'class'=>'uk-form-width-large'
  ))?>
</div>
<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Longitude")?></label>
  <?php echo CHtml::textField('merchant_longtitude',
  $merchant_longtitude
  ,array(
  'class'=>'uk-form-width-large'
  ))?>
</div>


<div class="uk-form-row">
<label class="uk-form-label"></label>
<a href="javascript:;" class="get-coordinates"><?php echo t("Click here to get coordinates using your address")?></a>
</div>

<div id="google_map_wrap"></div>

</li>

<li>
    <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Bank name")?></label>
          <?php echo CHtml::textField('bank_name',
          isset($data['bank_name'])?stripslashes($data['bank_name']):""
          ,array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"required",
         'data-validation-error-msg'=>"You did not enter Bank name."

          ))?>
    </div>
    
    <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Account number")?></label>
          <?php echo CHtml::textField('account_number',
          isset($data['account_number'])?$data['account_number']:""
          ,array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"length",  
          'data-validation-length'=> "11-16",  
           'oninput'=>  $oninput    
         
          ))?>
    </div>
    
    <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Branch")?></label>
          <?php echo CHtml::textField('branch',
          isset($data['branch'])?stripslashes($data['branch']):""
          ,array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"required",
         'data-validation-error-msg'=>"You did not enter branch name."

          ))?>
    </div>
    
    <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","IFSC Code")?></label>
          <?php echo CHtml::textField('ifsc_code',
          isset($data['ifsc_code'])?$data['ifsc_code']:""
          ,array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"required",
          'data-validation-error-msg'=>"You did not enter IFSC code."    
          ))?>
    </div>
    

</li>



</ul>    

<div class="uk-form-row">
<label class="uk-form-label"></label>
<input type="submit" value="<?php echo Yii::t("default","Save")?>" class="uk-button uk-form-width-medium uk-button-success">
</div>

</form>