<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/sub_header_short.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
         <h1>Reset Password</h1>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->
<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?php echo Yii::app()->createUrl('store'); ?>">Home</a></li>
            <li><a href="#">Reset Password</a></li>
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

        <?php if ($res=Yii::app()->functions->getLostPassToken($_GET['token']) ):?>
  
  
  <form class="uk-form uk-form-horizontal forms" id="forms" onsubmit="return false;">
  <?php echo CHtml::hiddenField('action','changePassword')?>
  <?php echo CHtml::hiddenField('token',$_GET['token'])?>
  <?php echo CHtml::hiddenField('currentController','store')?>

  <h2><?php echo Yii::t("default","Reset Password")?></h2>
  
  <div class="uk-form-row">  
  <?php 
  echo CHtml::passwordField('password',''  
  ,array('class'=>"uk-form-width-large",'data-validation'=>"required",
  'placeholder'=>Yii::t("default","New Password")
  ))
  ?>
  </div>

  <div class="uk-form-row">  
  <?php 
  echo CHtml::passwordField('confirm_password',''  
  ,array('class'=>"uk-form-width-large",'data-validation'=>"required",
  'placeholder'=>Yii::t("default","Confirm Password")
  ))
  ?>
  </div>
  
  <div class="uk-form-row">   
    <input type="submit" value="<?php echo Yii::t("default","Reset")?>" class="change-pass-btn uk-button uk-button-success uk-width-1-4">
  </div>
  </form>
  
  <?php else :?>
  <p class="uk-text-danger"><?php echo Yii::t("default","ERROR: Invalid token.")?></p>
  <?php endif;?>  

    </div>
  </div> <!--main-->
</div> <!--page-right-sidebar--> 

      </div>
    </div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->