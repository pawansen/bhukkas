<?php 
//$cuisine=Yii::app()->functions->Cuisine(false);
//$city=Yii::app()->functions->getCityList();
?>
<section class="parallax-window" id="home" data-parallax="scroll" data-image-src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/sub_header_home.jpg" data-natural-width="1400" data-natural-height="550">
    <div id="subheader">
        <div id="sub_content">

            <div class="row">

                <?php 
                        /*if ( Yii::app()->controller->action->id =="index"){
                        if (getOptionA('home_search_mode')!="postcode"){
                         if ( getOptionA('enabled_advance_search') =="yes"){
                            Widgets::searchAdvanced();
                         } else Widgets::searchFrontApi();

                        } else {
                         Widgets::searchByZipCodeOptions();
                        }
                       }*/
                      if ( Yii::app()->controller->action->id =="index"){
                        Widgets::searchFrontApi();
                       }
                  ?>
               
            </div>
            <section class="clearfix "> 
                <div class="col-md-10 col-md-offset-2" id="error-message-wrapper"></div>
                <?php Widgets::frontCuisineList();?>
            </section>
        
        </div>
    </div>
    
</section>
<!-- End SubHeader -->
    <!-- start section --> 
<section class="white_bg ad-bg clearfix hidden-xs">
    <div class="container">
        <section class="row add-img">
            <aside class="col-md-3 m-t-xs-10 col-sm-6">
                <a href="<?php echo Yii::app()->CreateUrl('/store/menu/merchant/mcdonalds');?>"> <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/1.png" class="img-responsive" alt=""></a>
            </aside>
            <aside class="col-md-3 m-t-xs-10 col-sm-6 add-hide">
                <a href="<?php echo Yii::app()->CreateUrl('/store/menu/merchant/kfc');?>">
            <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/2.png" class="img-responsive" alt="">
                </a>
            </aside>
            <aside class="col-md-3 m-t-xs-10 col-sm-6 add-hide">
                <a href="<?php echo Yii::app()->CreateUrl('/store/menu/merchant/vrindavan-restaurant');?>">
            <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/3.png" class="img-responsive" alt="">
                </a>
            </aside>
            <aside class="col-md-3 m-t-xs-10 col-sm-6 add-hide">
                <a href="<?php echo Yii::app()->CreateUrl('/store/menu/merchant/nevedhhya-restaurant');?>">
            <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/4.png" class="img-responsive" alt="">
                </a>
            </aside>
            <aside class="visible-xs">
              <button class="btn btn-sm show-add-btn pull-right"><span class="add-btn-text">Show All</span> <span class="add-btn-text" style="display:none">Show Less</span></button>
            </aside>
        </section>
    </div>
</section>
<!-- end section -->    
 <!-- strat section -->

 <section class="white_bg pop-bg" style="background-image: url('<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/Hotel-section.png')">
    
    <div class="container">
        <section class="row">
         <aside class="col-md-5 main_title">

            <h2 class="nomargin_top">Popular Restaurants in <span class="selectCity cl_yellow"><?php  if(isset(Yii::app()->session['myCity'])){   
        echo ucwords(Yii::app()->session['myCity']);
     }?></span> </h2>
            <p>A curated list of restaurants in <span class="selectCity cl_yellow"><?php  if(isset(Yii::app()->session['myCity'])){   
        echo ucwords(Yii::app()->session['myCity']);
     }?></span></p> 
         </aside>
         <aside class="col-md-7 col-xs-12">
      
             <article class="clearfix" id="merchant_list_dispaly">
                
                 <?php Widgets::frontfeaturedMerchant();?>
                 
             </article>
             <article class="clearfix" id="merchant_list_dispaly_feature">
 
                 <?php Widgets::frontfeaturedMerchantNext();?>
                
             </article>

         
         </aside>
        </section>
    </div>
</section>
<!-- end section -->
<!-- start section --> 
<section class="white_bg">
    <div class="container margin_60">
        <aside class="main_title">
            <h2 class="nomargin_top">Popular Cusines in <span class="selectCity cl_yellow"><?php  if(isset(Yii::app()->session['myCity'])){   
        echo ucwords(Yii::app()->session['myCity']);
     }?></span> </h2>
            <p>A Curated Collections Of Cusine</p>
        </aside>

        <aside class="clearfix popular-cusine">
            
            <?php Widgets::frontCuisionpopular();?>

        </aside>

    </div>
</section>
<!-- end section -->   
<!-- start section -->       
<section class="high_light">
    <div class="container">
        <article class="col-sm-8 col-xs-12">
        <h3 class="bottom-head">Choose from over 2,000 Restaurants</h3>
        <p>We are adding restaurants in your city faster then you think. Voila!</p>
        </article>
       <article class="col-sm-2 col-xs-6">
        <a href="<?php echo $this->createUrl('store/searchArea',array('cu'=>'all')); ?>"> all Restaurants</a>
        </article>
        <article class="col-sm-2 col-xs-6">
            <a href="#0" data-toggle="modal" data-target="#partnerUs"> Partner With Us &nbsp;</a>
       </article>
    </div>
     <div class="container">
        
    </div>
    </br>
</section> 
   
<!-- End section -->
<!--<div class="home-page"></div>

<div class="ie-no-supported-msg">
<div class="main">
<h2><?php //echo Yii::t("default","Oopps..It Seems that you are using browser which is not supported.")?></h2>
<p class="uk-text-danger">
<?php //echo Yii::t("default","Restaurant will not work properly..")?>
<?php //echo Yii::t("default","Please use firefox,chrome or safari instead. THANK YOU!")?></p>
</div>
</div>

<div class="browse-wrapper" style="display:none;">
  <div class="main" style="min-height: 0;">
      <h2 class="uk-h2"><i class="fa fa-bars"></i> Featured Restaurant</h2>            
  </div>
</div> END browse-wrapper-->
 <!-- SubHeader -->