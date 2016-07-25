<div class="uk-width-1">
<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/sponsoredMerchantList/Do/Add" class="uk-button"><i class="fa fa-plus"></i> <?php echo Yii::t("default","Add New")?></a>
<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/sponsoredMerchantList" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>
</div>

<?php 
if (isset($_GET['id'])){
	if (!$data=Yii::app()->functions->getMerchant($_GET['id'])){
		echo "<div class=\"uk-alert uk-alert-danger\">".
		Yii::t("default","Sorry but we cannot find what your are looking for.")."</div>";
		return ;
	}
}
?>                                   

<div class="spacer"></div>

<form class="uk-form uk-form-horizontal forms" id="forms">
<?php echo CHtml::hiddenField('action','sponsoreMerchantAdd')?>
<?php echo CHtml::hiddenField('id',isset($_GET['id'])?$_GET['id']:"");?>
<?php if (!isset($_GET['id'])):?>
<?php echo CHtml::hiddenField("redirect",Yii::app()->request->baseUrl."/admin/sponsoredMerchantList/")?>
<?php endif;?>


<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Merchant")?></label>
  <?php echo CHtml::dropDownList('merchant_id',
  isset($data['merchant_id'])?$data['merchant_id']:''
  ,(array)Yii::app()->functions->merchantList(),
  array('class'=>"uk-form-width-large chosen",
        'data-validation'=>"required",
        'data-validation-error-msg' => "You did not select merchant."))?>
</div>

<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Expiration Date")?></label>
  <?php echo CHtml::hiddenField('expiration',isset($data['sponsored_expiration'])?$data['sponsored_expiration']:"")?>
  <?php echo CHtml::textField('expiration1',
  isset($data['sponsored_expiration'])?$data['sponsored_expiration']:""
  ,array(
      'class'=>"uk-form-width-large j_date",
//  'class'=>'uk-form-width-medium j_date',
  'data-validation'=>"required",
  'data-validation-error-msg' => "You did not select expiration date",  
  'autocomplete' => "off",    
  'data-id'=>"expiration"
  ))?>
</div>

       <div class="uk-form-row"> 
 <label class="uk-form-label"><?php echo Yii::t('default',"Upload Icon")?></label>
  <div style="display:inline-table;margin-left:1px;" class="button uk-button" id="spicydish"><?php echo Yii::t('default',"Browse")?></div>	  
  <DIV  style="display:none;" class="spicydish_chart_status" >
	<div id="percent_bar" class="spicydish_percent_bar"></div>
	<div id="progress_bar" class="spicydish_progress_bar">
	  <div id="status_bar" class="spicydish_status_bar"></div>
	</div>
  </DIV>		  
</div> 
    <?php $cuisin_image=isset($data['image'])?$data['image']:'';?>
<?php if (!empty($cuisin_image)):?>
<div class="uk-form-row"> 
<?php else :?>
<div class="input_block preview_spicydish">
<?php endif;?>
<label><?php echo Yii::t('default',"Preview")?></label>
<div class="image_preview_spicydish" style="width:150px">
 <?php if (!empty($cuisin_image)):?>
 <input type="hidden" name="image" value="<?php echo $cuisin_image;?>">
 <img  class="uk-thumbnail" src="<?php echo Yii::app()->request->baseUrl."/upload/".$cuisin_image;?>" alt="" title="">
 <p><a href="javascript:rm_spicydish_preview();"><?php echo Yii::t("default","Remove image")?></a></p>
 <?php endif;?>
</div>
</div>
    
<div class="uk-form-row">
<label class="uk-form-label"></label>
<input type="submit" value="<?php echo Yii::t("default","Save")?>" class="uk-button uk-form-width-medium uk-button-success">
</div>

</form>