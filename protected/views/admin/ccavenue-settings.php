<?php
$enabled=Yii::app()->functions->getOptionAdmin('admin_ccAvenue_enabled');
$paymode=Yii::app()->functions->getOptionAdmin('admin_ccAvenue_mode');
?>

<div id="error-message-wrapper"></div>

<form class="uk-form uk-form-horizontal forms" id="forms">
<?php echo CHtml::hiddenField('action','adminCCAvenue')?>

<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Enabled CCAvenue")?>?</label>
  <?php 
  echo CHtml::checkBox('admin_ccAvenue_enabled',
  $enabled=="yes"?true:false
  ,array(
    'value'=>"yes",
    'class'=>"icheck"
  ))
  ?> 
</div>

<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Mode")?></label>
  <?php 
  echo CHtml::radioButton('admin_ccAvenue_mode',
  $paymode=="Sandbox"?true:false
  ,array(
    'value'=>"Sandbox",
    'class'=>"icheck"
  ))
  ?>
  <?php echo Yii::t("default","Sandbox")?>
  <?php 
  echo CHtml::radioButton('admin_ccAvenue_mode',
  $paymode=="live"?true:false
  ,array(
    'value'=>"live",
    'class'=>"icheck"
  ))
  ?>	
  <?php echo Yii::t("default","live")?> 
</div>

<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Merchant Key")?></label>
  <?php 
  echo CHtml::textField('admin_ccAvenue_key',
  Yii::app()->functions->getOptionAdmin('admin_ccAvenue_key')
  ,array(
    'class'=>"uk-form-width-large"
  ))
  ?>
</div>

<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Access Code")?></label>
  <?php 
  echo CHtml::textField('admin_ccAvenue_accesscode',
  Yii::app()->functions->getOptionAdmin('admin_ccAvenue_accesscode')
  ,array(
    'class'=>"uk-form-width-large"
  ))
  ?>
</div>
    
    
<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Working Key")?></label>
  <?php 
  echo CHtml::textField('admin_ccAvenue_workingkey',
  Yii::app()->functions->getOptionAdmin('admin_ccAvenue_workingkey')
  ,array(
    'class'=>"uk-form-width-large"
  ))
  ?>
</div>



<div class="uk-form-row">
<label class="uk-form-label"></label>
<input type="submit" value="<?php echo Yii::t("default","Save")?>" class="uk-button uk-form-width-medium uk-button-success">
</div>

</form>