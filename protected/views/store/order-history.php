<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/sub_header_short.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
         <h1>Order History</h1>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->
<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?php echo Yii::app()->createUrl('store'); ?>">Home</a></li>
            <li><a href="javascript:void(0)<?php //echo Yii::app()->createUrl('store/orderHistory'); ?>">Order History</a></li>
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
  <div class="left-content left">
   <h3><?php echo Yii::t("default","Your Recent Order")?></h3>
   
   <?php if ( Yii::app()->functions->isClientLogin()):?>
   <?php $client_id=Yii::app()->functions->getClientId();?>
   <?php if ( $res=Yii::app()->functions->clientHistyOrder($client_id)):?>
   <ul class="uk-list uk-list-striped order-history">
    <?php foreach ($res as $val):?>    
    <li>
      <h4 class="mct-detail">
        <a class="add-to-cart" href="javascript:;" data-id="<?php echo $val['order_id']?>" >
          <i class="fa fa-calendar-o"></i> 
          <?php echo ucwords($val['merchant_name'])?> - 
          <?php echo Yii::app()->functions->translateDate(prettyDate($val['date_created']))?>          
        </a>
		</h4>
		<div class="recipt-detail">
        <a href="javascript:;" class="view-receipt" data-id="<?php echo $val['order_id']?>" >
         <i class="fa fa-file-text-o"></i> <?php echo Yii::t("default","View Receipt")?>
        </a>
        <a href="javascript:;" class="view-order-history" data-id="<?php echo $val['order_id'];?>">
            <i class="fa fa-history"></i> <?php echo t("View status history")?>
         </a>
        
        <span><i class="fa fa-fire"></i> <?php echo t($val['status'])?></span>        
      </div>                    
      <?php if ( $order_details=Yii::app()->functions->clientHistyOrderDetails($val['order_id']) ):?>
      <ul class="ul-item" >      
       <?php //foreach ($order_details as $val_sub):?>
<!--       <li class=" "><i class="fa fa-angle-right"></i> <?php //echo $val_sub['item_name']?></li>-->
       <?php //endforeach;?>
       
          
          <?php if ( $resh=FunctionsK::orderHistory($val['order_id'])):?>                    
               <table class="uk-table uk-table-hover order-order-history show-history-<?php echo $val['order_id']?>">
                 <thead>
                   <tr>
                    <th class="uk-text-muted"><?php echo t("Date/Time")?></th>
                    <th class="uk-text-muted"><?php echo t("Status")?></th>
                    <th class="uk-text-muted"><?php echo t("Remarks")?></th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php foreach ($resh as $valh):?>
                   <tr style="font-size:12px;">
                     <td><?php                       
                      echo FormatDateTime($valh['date_created'],true);
                      ?></td>
                     <td><?php echo t($valh['status'])?></td>
                     <td><?php echo $valh['remarks']?></td>
                   </tr>
                   <?php endforeach;?>
                 </tbody>
               </table> 
          <?php else :?>                
            <p class="uk-text-danger order-order-history show-history-<?php echo $val['order_id']?>">
              <?php echo t("No history found")?>
            </p>
          <?php endif;?>
       
      </ul>
      <?php endif;?>
    </li>
    <?php endforeach;?>
   </ul>
   <?php else :?>
     <p class="uk-text-danger"><?php echo Yii::t("default","No order history")?></p>
   <?php endif;?>
   <?php else :?>
   <p class="uk-text-danger"><?php echo Yii::t("default","You need to login first.")?></p>
   <?php endif;?>
   
  </div>
  
  <div class="right-content right">
  
  </div>
  <div class="clear"></div>
  
  </div>
  </div> <!--main-->
</div>  <!--page-right-sidebar-->

    	</div>
    </div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->
<style type="text/css">
.fancybox-wrap {z-index: 99999999;}  
</style>