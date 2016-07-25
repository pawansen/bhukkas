<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/sub_header_short.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
         <h1>Address</h1>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->
<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?php echo Yii::app()->createUrl('store'); ?>">Home</a></li>
            <li><a href="<?php echo Yii::app()->createUrl('store/address'); ?>">Address</a></li>
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
  
  <div class="uk-width-1">
<!--<a href="<?php //echo createUrl("store/addressbook/do/add")?>" class="uk-button"><i class="fa fa-plus"></i> <?php //echo Yii::t("default","Add New")?></a>-->
<a href="<?php echo createUrl("store/addressbook")?>" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>
</div>  
  
  <form class="uk-form uk-form-horizontal forms" id="contactUs" onsubmit="return false;">
  <?php echo CHtml::hiddenField('action','addAddressBook')?>
  <?php echo CHtml::hiddenField('currentController','store')?>  
  <?php if (isset($_GET['id'])):?>
  <?php echo CHtml::hiddenField('id',$_GET['id'])?>
  <?php endif?>
  <?php echo CHtml::hiddenField('redirect',createUrl("store/addressbook"))?>

  
  
  <div style="height:20px;"></div>
  <div class="col-md-6">
    <?php if (Yii::app()->functions->isClientLogin()):?>
    
      <div class="uk-form-row">                  
          <?php echo CHtml::textField('street',
          isset($data['street'])?$data['street']:''
          ,array(
           'class'=>'uk-width-1-1',
           'placeholder'=>Yii::t("default","Address"),
           'data-validation'=>"required",
           'data-validation-error-msg'=>"You did not enter street address"  
          ))?>
       </div>             
              
       <div class="uk-form-row">                  
          <?php echo CHtml::textField('city',
          isset($data['city'])?$data['city']:''
          ,array(
           'class'=>'uk-width-1-1',
           'placeholder'=>Yii::t("default","City"),
          'data-validation'=>"required",
          'data-validation-error-msg'=>"You did not enter city" 
          ))?>
       </div>             

       <div class="uk-form-row">                  
          <?php echo CHtml::textField('state',
          isset($data['state'])?$data['state']:''
          ,array(
           'class'=>'uk-width-1-1',
           'placeholder'=>Yii::t("default","State"),
          'data-validation'=>"required",
          'data-validation-error-msg'=>"You did not enter state"  
          ))?>
       </div>             
       
       <div class="uk-form-row">                  
          <?php echo CHtml::textField('zipcode',
          isset($data['state'])?$data['zipcode']:''
          ,array(
           'class'=>'uk-width-1-1',
           'placeholder'=>Yii::t("default","Zip code"),
           'data-validation'=>"length number", 
           'data-validation-length'=>"6-6"
          ))?>
       </div>             
       
       <div class="uk-form-row">                  
          <?php echo CHtml::textField('location_name',
          isset($data['location_name'])?$data['location_name']:''
          ,array(
           'class'=>'uk-width-1-1',
           'placeholder'=>Yii::t("default","Location Name")           
          ))?>
       </div>             
       
       <?php $merchant_default_country=Yii::app()->functions->getOptionAdmin('merchant_default_country'); ?>
       <div class="uk-form-row">                  
          <?php 
          echo CHtml::dropDownList('country_code',
          isset($data['country_code'])?$data['country_code']:$merchant_default_country
          ,(array)Yii::app()->functions->CountryListMerchant(),array(
            'class'=>'uk-width-1-1',
            'data-validation'=>"required"
          ));
          ?>
       </div>             
       
       <div class="uk-form-row">                  
          <?php 
          echo CHtml::checkBox('as_default',
          $data['as_default']==2?true:false
          ,array('class'=>"icheck",'value'=>2));
          echo " ".t("Default");
          ?>
       </div>             
   
       <div class="uk-form-row">   
      <input type="submit" value="<?php echo Yii::t("default","Submit")?>" class="uk-button uk-button-success uk-width-1-4">
       </div>
      </div>
     </div> 
    <?php else :?> 
    <p class="uk-text-danger"><?php echo Yii::t("default","Sorry but you need to login first.")?></p>
    <?php endif;?>
    
  </form>
    </div>
  </div> <!--main-->
</div> <!--page-right-sidebar--> 

      </div>
    </div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->