<?php
   $now=date('Y-m-d');
   $now_time='';//date("h:i A");
   
   $marker=Yii::app()->functions->getOptionAdmin('map_marker');
   if (!empty($marker)){
      echo CHtml::hiddenField('map_marker',$marker);
   }
   
   echo CHtml::hiddenField('website_disbaled_auto_cart',
   Yii::app()->functions->getOptionAdmin('website_disbaled_auto_cart'));
   
   $hide_foodprice=Yii::app()->functions->getOptionAdmin('website_hide_foodprice');
   echo CHtml::hiddenField('hide_foodprice',$hide_foodprice);
   
   echo CHtml::hiddenField('accept_booking_sameday',getOption($re_info['merchant_id']
   ,'accept_booking_sameday'));
   
   echo CHtml::hiddenField('customer_ask_address',getOptionA('customer_ask_address'));
    $is_rest = false;
    $cuisine_list=Yii::app()->functions->Cuisine(true);               
    $country_list=Yii::app()->functions->CountryList();
    $resto_cuisine='';
    $rating_star = '';
    $has_reviews=false;
   ?>
<?php 
   if(!empty($_SERVER['HTTP_REFERER'])){
       $_SESSION['previous_url'] = $_SERVER['HTTP_REFERER'];
       
   }
   ?>
<?php
   if (is_array($re_info) && count($re_info)>=1): $is_rest = true;
   
   $merchant_photo=Yii::app()->functions->getOption("merchant_photo",$re_info['merchant_id']);
   $merchant_id=$re_info['merchant_id']; 
   $client_id=Yii::app()->functions->getClientId();  
   
    if (array_key_exists($re_info['country_code'],(array)$country_list)){   
     $country_name=$country_list[$re_info['country_code']];
    } else{ $country_name=$re_info['country_code'];}
    $ratingsData=Yii::app()->functions->getRatings($re_info['merchant_id']); 
    $rating= ($ratingsData['ratings'] != '') ? round($ratingsData['ratings']) : 0 ;
    for($i=1; $i<=5;$i++){
       if($i <= $rating){ 
         $rating_star.="<i class='icon_star voted'></i>";
        }else{
          $rating_star.=" <i class='icon_star'></i>";
        }
    } 
   if ($reviews=Yii::app()->functions->getReviewCounts($merchant_id)){
     $has_reviews=true;
   }
   
   $cuisine=!empty($re_info['cuisine'])?(array)json_decode($re_info['cuisine']):false;
   $resto_address= $re_info['street']." ".$re_info['city']." ".$re_info['state'] ." ".$re_info['post_code'];
   
   $initial_rating='';
   /*$client_id=Yii::app()->functions->getClientId(); */ 
   if ( $your_ratings=Yii::app()->functions->isClientRatingExist($merchant_id,$client_id) ){        
   $initial_rating=$your_ratings['ratings'];
   }    
   echo CHtml::hiddenField('initial_rating',$initial_rating);
   
    echo CHtml::hiddenField('merchant_required_delivery_time',
   Yii::app()->functions->getOption("merchant_required_delivery_time",$merchant_id));
   
   echo CHtml::hiddenField('merchant_id',$merchant_id);
   echo CHtml::hiddenField('is_client_login',Yii::app()->functions->isClientLogin());
   
   $_SESSION['kr_merchant_id']=$merchant_id;
   $_SESSION['kr_merchant_slug']=$data['merchant'];
   
   $minimum_order=Yii::app()->functions->getOption("merchant_minimum_order",$re_info['merchant_id']);
   $delivery_fee=Yii::app()->functions->getOption("merchant_delivery_charges",$re_info['merchant_id']);
   
   $merchant_map_latitude=Yii::app()->functions->getOption("merchant_latitude",$re_info['merchant_id']);
   $merchant_map_longtitude=Yii::app()->functions->getOption("merchant_longtitude",$re_info['merchant_id']);
   
   
   echo CHtml::hiddenField('merchant_map_latitude',$merchant_map_latitude);
   echo CHtml::hiddenField('merchant_map_longtitude',$merchant_map_longtitude);
   echo CHtml::hiddenField('map_title',isIsset($re_info['restaurant_name']));
   echo CHtml::hiddenField('web_session_id',session_id());
   
   //ini_set('display_errors',1);  error_reporting(E_ALL);
   $rating_meanings='';
   if ( isset($ratings['ratings']) && $ratings['ratings'] >=1){
   $rating_meaning=Yii::app()->functions->getRatingsMeaning($ratings['ratings']);
   $rating_meanings=ucwords($rating_meaning['meaning']);
   }
   
   $merchant_address=$re_info['street']." ".$re_info['city'] ." ". $re_info['post_code']; 
   
 
   if(isset($_SESSION['kr_search_address']) && !empty($_SESSION['kr_search_address'])){
       $from_address=$_SESSION['kr_search_address'];
   }else if(isset($_SESSION['kr_client']['client_id']) && !empty($_SESSION['kr_client']['client_id'])){
       $dataAddress = Yii::app()->functions->GetAddressClient($_SESSION['kr_client']['client_id']);
      $from_address = $dataAddress['street']." ".$dataAddress['city']." ".$dataAddress['zipcode'];
   }else{
       $from_address = $_SESSION['myCity'];
   }

   $miles=getDeliveryDistance2($from_address,$merchant_address,$re_info['country_code']);  


   $mt_delivery_miles=Yii::app()->functions->getOption("merchant_delivery_miles",$merchant_id);   
   
   $merchant_distance_type=Yii::app()->functions->getOption("merchant_distance_type",$merchant_id);
   
   $use_distance=0;
   $unit_distance=Yii::t("default","miles");  
   $use_distance1='';
   $ft=false;
   $unit="miles";
   
   if (is_array($miles) && count($miles)>=1){      
     if ( $merchant_distance_type=="km"){
        $use_distance=str_replace(",","",$miles['km']);
        $use_distance1=$miles['km'];
        $unit_distance=Yii::t("default","km");
        $unit="km";
     } else {       
        $use_distance=str_replace(",","",$miles['mi']); 
        $use_distance1=$miles['mi'];
        $unit_distance=Yii::t("default","miles");
     }     
     if (preg_match("/ft/i",$miles['mi'])) {
        $use_distance1=str_replace("ft",'',$miles['mi']);          
          $ft=true;
          $unit="ft";
     }
   }
  // echo $use_distance1;
  // dump($miles);
    $is_ok_delivered=1;
   if (is_numeric($mt_delivery_miles)){
   if ( $mt_delivery_miles>=$use_distance){
     $is_ok_delivered=1;
   } else $is_ok_delivered=2;
   if ($ft==TRUE){
       $is_ok_delivered=1;
   }
   }
   
   echo CHtml::hiddenField('is_ok_delivered',$is_ok_delivered);
   echo CHtml::hiddenField('merchant_delivery_miles',$mt_delivery_miles);
   echo CHtml::hiddenField('from_address',$from_address);
   echo CHtml::hiddenField('unit_distance',$unit_distance);
   
    //$mt_delivery_charges_type=Yii::app()->functions->getOption("merchant_delivery_charges_type",$re_info['merchant_id']);    
   $mt_delivery_estimation=Yii::app()->functions->getOption("merchant_delivery_estimation",$merchant_id);
   $merchant_extenal=Yii::app()->functions->getOption("merchant_extenal",$merchant_id);
   if  (!empty($merchant_extenal)){
      if (!preg_match("/http/i", $merchant_extenal)) {
           $merchant_extenal="http://".$merchant_extenal;
      }
   }  
   $is_merchant_open = Yii::app()->functions->isMerchantOpen($merchant_id);  
   $is_merchant_open1 = $is_merchant_open;
   $merchant_preorder= Yii::app()->functions->getOption("merchant_preorder",$merchant_id);  
   $disbabled_table_booking=Yii::app()->functions->getOption("merchant_table_booking",$merchant_id);  
   
   if ( $merchant_preorder==1){
     $is_merchant_open=true;
   }
   echo CHtml::hiddenField('is_merchant_open',$is_merchant_open==true?1:2);
   $close_msg=Yii::app()->functions->getOption("merchant_close_msg",$merchant_id);
   if (empty($close_msg)){
    $close_msg=Yii::t("default","This restaurant is closed now. Please check the opening times.");
   }
   echo CHtml::hiddenField('merchant_close_msg',ucwords($close_msg));
   
   $merchant_close_store=Yii::app()->functions->getOption('merchant_close_store',$merchant_id);
   echo CHtml::hiddenField('merchant_close_store',$merchant_close_store);
   
   /*check if admin has set default social shared text*/
   $default_share_text=getOptionA('default_share_text');
   if(empty($default_share_text)){
   $default_share_text=t("Come and order at")." ".$re_info['restaurant_name'];
   } else {
   $default_share_text=smarty('merchant-name',$re_info['restaurant_name'],$default_share_text);
   }
   
   $shipping_enabled=Yii::app()->functions->getOption("shipping_enabled",$merchant_id); 
   
    /** add minimum order for pickup status*/
   $merchant_minimum_order_pickup=Yii::app()->functions->getOption('merchant_minimum_order_pickup',$merchant_id);
   if (!empty($merchant_minimum_order_pickup)){
     echo CHtml::hiddenField('merchant_minimum_order_pickup',$merchant_minimum_order_pickup);
     
     echo CHtml::hiddenField('merchant_minimum_order_pickup_pretty',
             displayPrice(baseCurrency(),prettyFormat($merchant_minimum_order_pickup)));
   }
   
    $merchant_maximum_order_pickup=Yii::app()->functions->getOption('merchant_maximum_order_pickup',$merchant_id);
   if (!empty($merchant_maximum_order_pickup)){
     echo CHtml::hiddenField('merchant_maximum_order_pickup',$merchant_maximum_order_pickup);
     
     echo CHtml::hiddenField('merchant_maximum_order_pickup_pretty',
             displayPrice(baseCurrency(),prettyFormat($merchant_maximum_order_pickup)));
   }
   
   endif;?> 
<style>
    .little-search .input-group-addon
{
    background: transparent;
    border-right: none;
    
}
.little-search .form-control
{
    height:32px;
    border-left: none;
   
}
.little-search .form-control:focus{
    border:1px solid #ddd;
    box-shadow: none;
     border-left: none;
}
</style>
<!-- SubHeader =============================================== -->
<section class="parallax-window" data-parallax="scroll" data-image-src="<?php echo Yii::app()->request->baseUrl; ?>/assets/front/img/sub_header_2.jpg" data-natural-width="1400" data-natural-height="470">
   <div id="subheader">
      <div id="sub_content">
         <?php if($is_rest){?>
         <div id="thumb"><img src="<?php if($is_rest){echo Yii::app()->request->baseUrl.'/upload/'.$merchant_photo;}else{echo Yii::app()->request->baseUrl; ?>/assets/images/thumbnail-mini.png<?php }?>" alt=""></div>
         <div class="rating"><?php echo $rating_star;?> (<small><a href="<?php echo Yii::app()->createUrl('store/reviews',array('id'=>$merchant_id));?>">Read <?php echo $reviews;?> reviews</a></small>)</div>
         <h1><?php echo ucwords($re_info['restaurant_name']);?></h1>
         <div><em><?php echo ucwords($re_info['city']);?> Foods</em></div>
         <div><i class="icon_pin"></i><?php echo ucwords($re_info['street']).' '.ucwords($re_info['city']).', '.ucwords($re_info['state']).' '.ucwords($re_info['post_code']).', '.ucwords($country_name);?></div>
         <?php }?>
      </div>
      <!-- End sub_content -->
   </div>
   <!-- End subheader -->
</section>
<!-- End section -->
<!-- End SubHeader ============================================ -->
<div id="position">
   <div class="container">
      <ul>
         <li><a href="<?php echo Yii::app()->createUrl('store');?>">Home</a></li>
        <!--  <li><a href="<?php //if(isset($_SESSION['previous_url'])){echo $_SESSION['previous_url'];}?>">Back To Search</a></li> -->
         <li><a href="javascript:void(0);<?php //if(isset($_SESSION['previous_url'])){echo $_SESSION['previous_url'];}?>">Store</a></li>
         

      </ul>
   </div>
</div>
<!-- Position -->
<!-- Content ================================================== -->
<?php 
   $menu=Yii::app()->functions->getMerchantMenu($merchant_id);  

   $merchant_activated_menu=Yii::app()->functions->getOptionAdmin("admin_activated_menu");
   ?>
<div class="container margin_60_35">
   <div id="container_pin">
      <div class="row">
         <div class="col-md-3">

           <div class="box_style_1" id="cart_box">

            <p>

<!--               <a href="javascript:;" data-toggle="modal" data-target="#myReview" class="write-ratings btn_side rounded2 <?php //echo $has_reviews==true?"active":"";?> ">
                        <?php //echo Yii::t("default","add your rating")?> 
                        </a>-->
                <div class="input-group little-search">
                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-search"></i></span>
                
                <input type="text" class="form-control search_by_menu" id="search_by_menu" name="search_by_menu" placeholder="Search here..."/>
                </div></br>
                <a href="<?php echo Yii::app()->createUrl('store/reviews',array('id'=>$merchant_id));?>" class="write-ratings btn_side rounded2 active ">
                        <?php echo Yii::t("default","add your rating")?> 
                        </a>
            </p>
           
               <ul id="cat_nav">
                  <?php if (is_array($menu) && count($menu)>=1):?>  
                  <?php foreach ($menu as $val):?>
                  <li><a href="#cat-<?php echo str_replace(' ','-', $val['category_name'])?>" class="active"> <?php echo ucwords(qTranslate($val['category_name'],'category_name',$val));?> <span>
                     <?php if (is_array($val['item']) && count($val['item'])>=1):
                        $menuitemcount =0;
                        foreach ($val['item'] as $val_items):
                        $menuitemcount++;
                        endforeach;
                        else: echo $menuitemcount=0; endif;echo "(".$menuitemcount.")";?>
                     </span></a>
                  </li>
                  <?php endforeach;?>
                  <?php endif;?>
               </ul>
           
            <!-- End box_style_1 -->
            <div class="box_style_2 hidden-xs" id="help">
               <i class="icon_info"></i>
               
               <h4><?php echo Yii::t("default","Distance")?>:</br> <span> <?php 
                  //$unit=$unit_distance;
                  if ($ft==TRUE){
                         echo $use_distance1." ft";
                         $unit="ft";
                  } else echo $use_distance1." ".$unit_distance;          
                  ?></span></h4>
               
               <?php if (is_numeric($mt_delivery_miles)):?>
               <h4><?php echo Yii::t("default","Delivery Distance Covered")?>:</br> <span> <?php echo $mt_delivery_miles." ".$unit_distance?></span></h4>
               <?php endif;?>
               <?php 
                  //delivery rates table        
                  $_SESSION['shipping_fee']='';
                  if ( $shipping_enabled==2){
                          $FunctionsK=new FunctionsK();         
                          $delivery_fee=$FunctionsK->getDeliveryChargesByDistance(
                          $merchant_id,
                          $use_distance1,
                          $unit,
                          $delivery_fee);         
                  
                          /*dump($use_distance1);
                          dump($unit);
                          dump($delivery_fee);*/
                          $_SESSION['shipping_fee']=$delivery_fee;
                  }                        
                  ?>
               <?php if ($delivery_fee>=1):?>
               <h4><?php echo Yii::t("default","Delivery Fee")?>:</br> <span>
                  <?php echo displayPrice(getCurrencyCode(),prettyFormat($delivery_fee))?></span>
               </h4>
               <?php else :?>
               <h4><?php echo Yii::t("default","Delivery Fee")?>:</br> <span><?php echo t("Free Delivery")?></span></h4>
               <?php endif;?>
               <h4><?php echo Yii::t("default","Minimum Order")?>:</br> <span><?php 
                  if (is_numeric($minimum_order)):
                      echo displayPrice(getCurrencyCode(),prettyFormat($minimum_order));
                  endif;
                  ?></span></h4>
            </div>
            </div>
           
          
         </div>
         <!-- End col-md-3 -->
         <div class="col-md-6 p-fix-1">
            <div class="box_style_2" id="main_menu">
               <h2 class="inner">Menu</h2>
               <?php  if (is_array($menu) && count($menu)>=1):?>  
               <?php foreach ($menu as $val):?>
               <h3 class="nomargin_top" id="cat-<?php echo str_replace(' ','-', $val['category_name'])?>"><?php echo qTranslate($val['category_name'],'category_name',$val)?></h3>
               <p> <?php echo $val['category_description'];?></p>
               <?php if (is_array($val['item']) && count($val['item'])>=1):?>
               <table class="table table-striped cart-list" id="cart-list-search" >
                  <thead>
                     <tr>
                        <th>
                           Item
                        </th>
                        <th>
                           Price
                        </th>
                        <th>
                           Order
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $x=1; foreach ($val['item'] as $val_item):?>
                     <?php 
                        $atts='';
                        if ( $val_item['single_item']==2){
                         $atts.='data-price="'.$val_item['single_details']['price'].'"';
                         $atts.=" ";
                         $atts.='data-size="'.$val_item['single_details']['size'].'"';
                        }
                        ?> 
                     <tr>
                        <td>
                            <h5> <?php echo $x.'. '.ucwords(qTranslate($val_item['item_name'],'item_name',$val_item));?></h5>
                          
                        </td>
                        
                        
                        <td>
                            <strong class="">
                               
                              <?php if (is_array($val_item['prices']) && count($val_item['prices'])>=1):?>
                              <?php foreach ($val_item['prices'] as $price):?>
                                     <div class="menu-price-multi">
                               <?php if ( !empty($price['size'])):?>
                               <span class="size"> <?php echo ucfirst(qTranslate($price['size'],'size',$price));?></span>
                               <?php endif;?>
                              <?php if (!empty($val_item['discount'])):?>
                              <span class="normal-price left">
                                 <?php 
                                    echo displayPrice(getCurrencyCode(),prettyFormat($price['price']))?>
                              </span>
                              <span class="dis-span">
                                 <?php 
                                    echo displayPrice(getCurrencyCode(),prettyFormat($price['price']-$val_item['discount']));
                                    ?>
                              </span>
                              <?php else :?>
                               
                              <?php echo displayPrice(getCurrencyCode(),prettyFormat($price['price']))?>
                              <?php endif;?>
                               
                               </div>
                              <?php endforeach;?>
                                   
                                  <?php endif;?>
                               
                           </strong>
                        </td>
                        
                        
                        <td class="options">
                              <?php if (is_array($val_item['prices']) && count($val_item['prices'])>=1):?>
                              <?php foreach ($val_item['prices'] as $price):?>
                                  <?php 
                                 $dis=0;
                                 if (!empty($val_item['discount'])):
                                    $dis = $val_item['discount'];
                                 endif;
                                 $attst=''; 
                                 $attst.='data-price="'.round(prettyFormat($price['price']-$dis)).'"';
                                 $attst.=" ";
                                 $attst.='data-size="'.$price['size'].'"';
                          
                                ?> 
                           <a href="javascript:;" rel="<?php echo $val_item['item_id']?>" 
                              class="menu-item <?php echo $val_item['not_available']==2?"item_not_available":''?>"
                              data-single="2" 
                              <?php echo $attst;?>><i class="icon_plus_alt2"></i>
                           </a>
                            
                            <?php endforeach;?>

                          <?php endif;?>
                        </td>
                     </tr>
                     <?php $x++; endforeach;?>
                  </tbody>
               </table>
               <?php else :?>
               <p class="text-warning"><?php echo Yii::t("default","This restaurant has not published their menu yet.")?></p>
               <?php endif;?> 
               <?php endforeach;?>
               <?php endif;?>
               <hr>
            </div>
            <!-- End box_style_1 -->
         </div>
         <!-- End col-md-6 -->
         <?php /*if ( !empty($resto_address)):?>
         <?php echo CHtml::hiddenField("resto_address",$resto_address." ".$country_name)?>
         <?php endif;*/?>
         <?php   
            $disabled_website_ordering=Yii::app()->functions->getOptionAdmin('disabled_website_ordering');
            $merchant_disabled_ordering=Yii::app()->functions->getOption('merchant_disabled_ordering',$merchant_id);
            if ( $merchant_disabled_ordering=="yes"){
                     $disabled_website_ordering="yes";
            }
            ?> 
         <?php if ($disabled_website_ordering==""):?>
         <div class="col-md-3 my-cart">
            <div id="">
            <div class="order-list-wrap">
               <h3>Your Order <i class="icon_cart_alt pull-right"></i></h3>
               <a href="javascript:;" class="clear-cart"><img style="max-height: 25px;" src="<?php  echo Yii::app()->request->baseUrl; ?>/assets/images/imgpsh.png">
<?php echo Yii::t("default","Clear Order")?></a>
               <hr class="bg-less">
               <!-- card section-->
               <div class="item-order-wrap"></div>
               <!--  minium order section-->
             <hr class="bg-less">
               <?php $minimum_order=Yii::app()->functions->getOption('merchant_minimum_order',$merchant_id);?>
               <?php if (!empty($minimum_order)):?>
               <?php 
                  echo CHtml::hiddenField('minimum_order',unPrettyPrice($minimum_order));
                  echo CHtml::hiddenField('minimum_order_pretty',
                   displayPrice(baseCurrency(),prettyFormat($minimum_order))
                  );
                  ?>
               <p class="uk-text-muted"><?php echo Yii::t("default","Subtotal must exceed")?> 
                  <?php echo displayPrice(baseCurrency(),prettyFormat($minimum_order,$merchant_id))?>
               </p>
               <?php endif;?>
               <div  id="options_31">
                  <?php Widgets::applyVoucher($merchant_id);?>
               </div>
<!--               <hr>-->
               <!--  voucher section-->
          
               <!-- Edn options 2 -->
               <hr class="hr-hide">
               <!--  delivery type section-->
               <div class="row" id="options_2">
                  <div class="col-md-12">
                     <?php /*echo Widgets::getDeliveryOption($merchant_id);*/?>
                     <h5><?php /*echo Yii::t("default","Delivery Options")*/?></h5>
                     <?php /*echo CHtml::dropDownList('delivery_type',$now,(array)Yii::app()->functions->DeliveryOptions($merchant_id),array('class'=>'form-control selectpicker'));*/
                      ?>
                  </div>
               </div>
               <?php  echo CHtml::hiddenField('delivery_type','delivery');?>
               <!-- Edn options 2 -->
               <hr  class="hr-hide">
               <?php $merchant_maximum_order=Yii::app()->functions->getOption("merchant_maximum_order",$merchant_id);?>
               <?php if (is_numeric($merchant_maximum_order)):?>
               <?php 
                  echo CHtml::hiddenField('merchant_maximum_order',unPrettyPrice($merchant_maximum_order));
                  echo CHtml::hiddenField('merchant_maximum_order_pretty',baseCurrency().prettyFormat($merchant_maximum_order));
                  ?>
               <p class="uk-text-muted"><?php echo Yii::t("default","Maximum Order is")?> 
                  <?php echo displayPrice(baseCurrency(),prettyFormat($merchant_maximum_order,$merchant_id))?>
               </p>
               <?php endif;?>
               <hr  class="hr-hide">
               <div class="delivery_options uk-form ">
                  <?php echo Yii::t("default","Delivery Date")?>
                  <?php echo CHtml::hiddenField('delivery_date',$now)?>
                  <?php echo CHtml::textField('delivery_date1',
                     FormatDateTime($now,false),array('class'=>"j_date form-control ",'data-id'=>'delivery_date'))?>
                  <hr class="bg-nes">
                  <div class="delivery_asap_wrap">
                     <?php echo Yii::t("default","Delivery Time")?>
                     <?php echo CHtml::textField('delivery_time',$now_time,
                        array('class'=>"timepick ",'placeholder'=>Yii::t("default","Delivery Time")))?>
                     <!--                        <span class="delivery-asap">
                        <span class="uk-text-small uk-text-muted"><?php /*echo Yii::t("default","Delivery ASAP?")*/?></span>
                        <?php /*echo CHtml::checkBox('delivery_asap',false,array('class'=>"icheck"))*/?>
                        </span>
                  </div>
                  <!-- delivery_asap_wrap-->
               </div>
               <hr class="bg-nes">
               <?php 
                  $merchant_close_msg_holiday=Yii::app()->functions->getOption("merchant_close_msg_holiday",$merchant_id);
                  $is_holiday=false;
                  if ( $m_holiday=Yii::app()->functions->getMerchantHoliday($merchant_id)){                   
                       if (in_array($now,(array)$m_holiday)){
                          $is_holiday=true;
                       }
                  }
                  ?>
               <?php if ( $is_holiday ):?>
               <p class="uk-alert uk-alert-warning">
                  <?php 
                     if (!empty($merchant_close_msg_holiday)){
                        echo $th=t($merchant_close_msg_holiday);
                     } else echo $th=t("Sorry merchant is closed");
                     echo CHtml::hiddenField('is_holiday',$th,array('class'=>'is_holiday'));
                     ?>           
               </p>
               <?php else :?>
               <?php if (yii::app()->functions->validateSellLimit($merchant_id) ):?>
               <?php if ( $is_merchant_open1):?>         
               <a href="javascript:;" class="uk-button checkout btn_full uk-button-success"><?php echo Yii::t("default","Order now")?></a>
               <?php else :?>
               <?php if ($merchant_preorder==1):?>
               <a href="javascript:;" class="uk-button checkout btn_full"><?php echo Yii::t("default","Pre-Order")?></a>
               <?php else :?>
               <p class="uk-alert uk-alert-warning"><?php echo Yii::t("default","Sorry merchant is closed.")?></p>
               <p><?php echo Yii::app()->functions->translateDate(date('F d l')."@".timeFormat(date('c'),true));?></p>
               <?php endif;?>
               <?php endif;?>
               <?php else :?>
               <?php $msg=Yii::t("default","This merchant is not currently accepting orders.");?>
               <p class="uk-text-danger"><?php echo $msg;?></p>
               <?php endif;?>   
               <?php endif;?>   
            </div>
            </div>
            <!-- End cart_box -->
         </div>
         <!-- End col-md-3 -->
         <?php endif;?>
      </div>
      <!-- End row -->
   </div>
   <!-- End container pin -->
</div>
<!-- End container -->
<!-- End Content =============================================== -->
<div class="modal fade" id="myReview" tabindex="-1" role="dialog" aria-labelledby="review" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content modal-popup">
         <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
         <form id="forms" name="forms" onsubmit="return false;" class="popup-form">
            <div class="login_icon"><i class="icon_comment_alt"></i></div>
            </br>
            <div id="error_msg_review" class="has_error_msg"></div>
            </br>
            <div class="row">
               <div class="col-md-12">
                   <input id="input-21e" value="<?php echo $rats;?>" type="number" class="rating" min=0 max=5 step=1 data-size="xs" name="initial_review_rating">
<!--                  <select  data-validation="required" class="form-control form-white" name="initial_review_rating"   data-validation-error-msg="You did not select rating">
                     <option value="">Restaurant Ratings</option>
                     <option value="1.0" class="level1">1.0</option>
                     <option value="2.0">2.0</option>
                     <option value="3.0">3.0</option>
                     <option value="4.0">4.0</option>
                     <option value="5.0">5.0</option>
                  </select>-->
               </div>
               <?php echo CHtml::hiddenField('action','addReviews')?>
               <?php echo CHtml::hiddenField('currentController','store')?>
               <?php echo CHtml::hiddenField('merchant-id',$merchant_id)?>  
            </div>
            <!--End Row -->    
            <textarea data-validation="required" name="review_content" id="review_content" class="form-control form-white" style="height:100px" placeholder="Write your review" data-validation-error-msg="You did not enter your review"></textarea>
            <input type="submit" class="btn btn-submit uk-button uk-button-danger right" id="submit-review"  value="<?php echo Yii::t("default","PUBLISH REVIEW")?>">
         </form>
         <div id="message-review"></div>
      </div>
   </div>
</div>
<!-- End review modal -->
