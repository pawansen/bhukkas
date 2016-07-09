<?php 

 $merchant_id = Yii::app()->request->getParam('id');
 
 $client_id=Yii::app()->functions->getClientId(); 

 $reviewsMerchant=Yii::app()->functions->getReviewsMerchant($merchant_id);
 
 $merchant=Yii::app()->functions->getMerchantById($merchant_id);
 
 $info = Yii::app()->functions->getOption("merchant_information",$merchant_id);
 
 $merchantHours=Yii::app()->functions->getBusinnesHours($merchant_id);

 $rating_star = '';
 $rating= ($merchant['ratings'] != '') ? round($merchant['ratings']) : 0 ;
   for($i=1; $i<=5;$i++){
       if($i <= $rating){ 
         $rating_star.="<i class='icon_star voted'></i>";
        }else{
          $rating_star.=" <i class='icon_star'></i>";
        }
    }
$reviews=Yii::app()->functions->getReviewCounts($merchant_id);
$initial_rating="";
if($your_ratings=Yii::app()->functions->isClientRatingExist($merchant_id,$client_id)){
    
    $initial_rating=$your_ratings['ratings'];
}
  echo CHtml::hiddenField('merchant_id',$merchant_id);   
  echo CHtml::hiddenField('merchant_id_map',$merchant_id);
?>
    <?php $class='hide';$class_ret="";?>
    <?php if (is_numeric($initial_rating) && Yii::app()->functions->isClientLogin() ):?>          
    <?php $class='';$class_ret="hide";?>
    <?php endif;?>
<!-- SubHeader =============================================== -->
<section class="parallax-window" data-parallax="scroll" data-image-src="<?php echo Yii::app()->request->baseUrl; ?>/assets/front/img/sub_header_2.jpg" data-natural-width="1400" data-natural-height="470">
    <div id="subheader">
        <div id="sub_content">
            
            <div id="thumb"><img src="<?php if($merchant && !empty($merchant['merchant_logo'])){echo Yii::app()->request->baseUrl.'/upload/'.$merchant['merchant_logo'];}else{ echo Yii::app()->request->baseUrl; ?>/assets/front/img/thumb_restaurant.jpg<?php }?>" alt=""></div>
            
            <div class="rating"><?php echo $rating_star; ?> ( <small><a href="<?php echo Yii::app()->createUrl('store/reviews',array('id'=>$merchant_id));?>"><?php echo $reviews;?> reviews</a></small> )</div>
            <h1><?php if($merchant){echo ucwords($merchant['restaurant_name']);}?></h1>
            <div><em><?php if($merchant){echo ucwords($merchant['city']);}?> Foods</em></div>
            <div><i class="icon_pin"></i> <?php if($merchant){echo ucwords($merchant['street']).', '.ucwords($merchant['city']).', '.ucwords($merchant['state']).' '.ucwords($merchant['post_code']);}?></div>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->
<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?php echo Yii::app()->createUrl('store');?>">Home</a></li>
            <li><a href="<?php echo Yii::app()->createUrl('/store/menu/merchant/'.$merchant['restaurant_slug']);?>"><?php if($merchant){echo ucwords($merchant['restaurant_name']);}?></a></li>
        </ul>
    </div>
</div><!-- Position -->

<div class="collapse" id="collapseMap">
    <div id="map" class="map"></div>
</div><!-- End Map -->
<!-- Content ================================================== -->
<div class="fullWhite">
<div class="container margin_60_35">
    <div class="row">

        <div class="col-md-4">
            <p>
                <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap">View on map</a>
            </p>
            <div class="box_style_2">
                <h4 class="nomargin_top">Opening time<i class="icon_clock_alt pull-right"></i></h4>
                <ul class="opening_list">
                    <?php if(!empty($merchantHours)){?>

                    
                    <li>Monday <?php if($merchantHours['mon']):?><span><?php echo $merchantHours['mon'] ?></span><?php else:?> <span class="label label-danger">Closed</span><?php  endif;?> </li>
                    <li>Tuesday <?php if($merchantHours['tue']):?><span><?php echo $merchantHours['tue'] ?></span><?php else:?> <span class="label label-danger">Closed</span><?php  endif;?></li>
                    <li>Wednesday <?php if($merchantHours['wed']):?><span><?php echo $merchantHours['wed'] ?></span><?php else:?> <span class="label label-danger">Closed</span><?php  endif;?></li>
                    <li>Thursday <?php if($merchantHours['thu']):?><span><?php echo $merchantHours['thu'] ?></span><?php else:?> <span class="label label-danger">Closed</span><?php  endif;?></li>
                    <li>Friday <?php if($merchantHours['fri']):?><span><?php echo $merchantHours['fri'] ?></span><?php else:?> <span class="label label-danger">Closed</span><?php  endif;?></li>
                    <li>Saturday <?php if($merchantHours['sat']):?><span><?php echo $merchantHours['sat'] ?></span><?php else:?> <span class="label label-danger">Closed</span><?php  endif;?></li>
                    <li>Sunday <?php if($merchantHours['sun']):?><span><?php echo $merchantHours['sun'] ?></span><?php else:?> <span class="label label-danger">Closed</span><?php  endif;?></li>
                    <?php }?>
                </ul>
            </div>
<!--            <div class="box_style_2 hidden-xs" id="help">
                <i class="icon_lifesaver"></i>
                <h4>Need <span>Help?</span></h4>
                <a href="tel://<?php if($merchant){ echo $merchant['restaurant_phone'];}?>" class="phone"><?php if($merchant){ echo $merchant['restaurant_phone'];}?></a>
            </div>-->
        </div>

        <div class="col-md-8">
            <div class="box_style_2">
                <h2 class="inner">Description</h2>
                <h3 class="nomargin_top">About us</h3>
                <p>
                    <?php if(!empty($info)): echo $info; endif;?>
                </p>
                     <?php if ( Yii::app()->functions->isClientLogin()): ?>
                    <div class="<?php echo $class_ret;?>">
                    <a href="javascript:;" class="btn btn-success add_bottom_15" data-toggle="modal" data-target="#myReview">Leave a review</a>
                    </div>
                      <?php else:?>
                        <div class="">
                    <a href="javascript:;" class="btn btn-success add_bottom_15" data-toggle="modal" data-target="#myReview">Leave a review</a>
                    </div>
                     <?php endif;?>
                <div id="summary_review">
                    <div id="general_rating">
                        <?php echo $reviews;?> Reviews
                        <div class="rating">
                            <?php echo $rating_star; ?>
                        </div>
                    </div>

                    <div class="row" id="rating_summary">
                    </div><!-- End row -->
                   
 
<!--                    <div class="<?php echo $class;?>">
                  <a href="javascript:;" class=" btn_2 add_bottom_15"><?php   echo Yii::t("default","remove my ratings")?></a>
                    </div>-->
                </div><!-- End summary_review -->
                 <hr>
                <?php if($reviewsMerchant):foreach($reviewsMerchant as $review):$rating_star_user="";?>
                <div class="review_strip_single">
                    <p style="font-size: 15px;"><b><?php echo ucwords($review['name']);?></b>
                        <?php if($review['client_id'] == $client_id):?>
                        <span><a class="remove-rating"><i class="fa fa-edit"></i></a></span>
                        <?php endif;?>
						 <small class="pull-right"><b> - <?php echo date('d F Y H:i A',strtotime($review['date_created']));?> -</b></small>
                    </p>
                   
                   
                    <p>
                        "<?php echo ucwords($review['review']);?>"
                    </p>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="rating">
                            
                         <?php  $rating= ($review['rating'] != '') ? round($review['rating']) : 0 ;
                                for($i=1; $i<=5;$i++){
                                    if($i <= $rating){ 
                                      $rating_star_user.="<i class='icon_star voted'></i>";
                                     }else{
                                       $rating_star_user.=" <i class='icon_star'></i>";
                                     }
                                }
                         echo $rating_star_user;
                         ?>

                            </div>
                            
                        </div>
                    </div><!-- End row -->
                </div><!-- End review strip -->

               <?php endforeach;endif;?> 
            </div><!-- End box_style_1 -->
        </div>
    </div><!-- End row -->
</div><!-- End container -->
</div>
<!-- End Content =============================================== -->
<?php  if($class != ''):?>
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
					<div class="col-md-12 text-left">
						<label class="l1">Restaurant Ratings</label>
						 <input id="input-21e" value="0" type="number" class="rating" min=0 max=5 step=1 data-size="xs" name="initial_review_rating">
					</div>
<!--                    <div class="col-md-12" style="display:none;">
                      <select  data-validation="required" class="form-control form-white form-green" name="initial_review_rating"   data-validation-error-msg="You did not select rating">
                           <option value="">Restaurant Ratings</option>
                           <option value="1.0" class="level1">1.0</option>
                            <option value="2.0">2.0</option>
                            <option value="3.0">3.0</option>
                            <option value="4.0">4.0</option> 
                            <option value="5.0">5.0</option> 
                        </select>                          
                    </div>-->
                    
                    <?php echo CHtml::hiddenField('action','addReviews')?>
                    <?php echo CHtml::hiddenField('currentController','store')?>
                    <?php echo CHtml::hiddenField('merchant-id',$merchant_id)?>  
                </div><!--End Row -->    

                <textarea data-validation="required" name="review_content" id="review_content" class="form-control form-white" style="height:100px" placeholder="Write your review" data-validation-error-msg="You did not enter your review"></textarea>
           
                <input type="submit" class="btn btn-submit uk-button btn-mine right" id="submit-review"  value="<?php echo Yii::t("default","PUBLISH REVIEW")?>">
            </form>
            <div id="message-review"></div>
        </div>
    </div>
</div><!-- End review modal -->   
<?php endif;?>
<div class="modal fade" id="editMyReview" tabindex="-1" role="dialog" aria-labelledby="review-rating" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-popup">
            <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
            <form id="editReview" name="editMyReview" onsubmit="return false;" class="popup-form">  
                <div class="login_icon"><i class="icon_comment_alt"></i></div>
	            </br>
	        <div id="error_msg_review" class="has_error_msg"></div>
                </br>
                <div class="row">
                    <div class="col-md-12  text-left">
                        <label class="l1">Restaurant Ratings</label>
                        <?php $rats=0;$rev="";$rvid=0; if($reviewsMerchant):foreach($reviewsMerchant as $review):
                            if($review['client_id'] == $client_id):
                                $rats = $review['rating'];
                                $rev = ucwords($review['review']);
                                $rvid = $review['id'];
                            endif;
                        endforeach;endif;?>
		  <input id="input-21e" value="<?php echo $rats;?>" type="number" class="rating" min=0 max=5 step=1 data-size="xs" name="initial_review_rating">
<!--                      <select  data-validation="required" class="form-control form-white form-green" name="initial_review_rating"   data-validation-error-msg="You did not select rating" id="initial_ratings">
                           <option value="">Restaurant Ratings</option>
                           <option value="1.0" class="level1">1.0</option>
                            <option value="2.0">2.0</option>
                            <option value="3.0">3.0</option>
                            <option value="4.0">4.0</option> 
                            <option value="5.0">5.0</option> 
                        </select>                          -->
                    </div>
                    
                    <?php echo CHtml::hiddenField('action','editReviewsRating')?>
                    <?php echo CHtml::hiddenField('currentController','store')?>
                    <?php echo CHtml::hiddenField('merchant-id',$merchant_id)?>
                    <?php echo CHtml::hiddenField('reviewId',$rvid)?>
                </div><!--End Row -->    

                <textarea data-validation="required" name="review_content" id="review_content_text" class="form-control form-white" style="height:100px" placeholder="Write your review" data-validation-error-msg="You did not enter your review"><?php echo$rev;?></textarea>
           
                <input type="submit" class="btn btn-submit uk-button uk-button-info btn-mine right"  value="<?php echo Yii::t("default","UPDATE REVIEW")?>">
            </form>
            <div id="message-review"></div>
        </div>
    </div>
</div>
