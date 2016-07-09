

<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/sub_header_short.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
         <h1>Reviews</h1>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->
<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?php echo Yii::app()->createUrl('store'); ?>">Home</a></li>
            <li><a href="<?php echo Yii::app()->createUrl('store/myreviews'); ?>">Reviews</a></li>
        </ul>
    </div>
</div><!-- Position -->
<!-- Content ================================================== -->
<div class="container margin_60_35">
	<div class="row" id="contacts">
    	<div class="col-md-12 col-sm-6">
        	<div class="box_style_2">
  
               <?php $client_id=Yii::app()->functions->getClientId();?>
                <?php if (is_numeric($client_id)):?>
         
               <form id="frm_table_list" method="POST" >
                <input type="hidden" name="action" id="action" value="getClientReviews">
                <?php echo CHtml::hiddenField('currentController','store')?>

              <input type="hidden" name="tbl" id="tbl" value="review">
              <input type="hidden" name="clear_tbl"  id="clear_tbl" value="clear_tbl">
              <input type="hidden" name="whereid"  id="whereid" value="client_id">
              <input type="hidden" name="slug" id="slug" value="store/myreviews">

                <table id="table_list" class="table uk-table-hover uk-table-striped uk-table-condensed review-table">
                <thead>
                <tr>
                 <th width="25%"><?php echo Yii::t("default","Restaurant Name")?></th>
                 <th width="25%"><?php echo Yii::t("default","Rating")?></th>
                 <th  width="40%"><?php echo Yii::t("default","Review")?></th>
                </tr>
                </thead>
                </table>
               </form>
             
             
               <?php else :?>
                <p class="uk-text-danger"><?php echo Yii::t("default","Review not available")?></p>
             <?php endif;?>
         </div>
    	</div>
    </div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->

