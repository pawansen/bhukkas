<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/sub_header_short.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
         <h1>Favourite</h1>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->
<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?php echo Yii::app()->createUrl('store'); ?>">Home</a></li>
            <li><a href="<?php echo Yii::app()->createUrl('store/favouriteRestorantList'); ?>">Favourite</a></li>
        </ul>
    </div>
</div><!-- Position -->
<!-- Content ================================================== -->
<div class="container margin_60_35">
	<div class="row" id="contacts">
    	<div class="col-md-12 col-sm-6">
        	<div class="box_style_2">


        <div class="uk-width-1">
      
        <a href="<?php echo createUrl("store/favouriteRestorantList")?>" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>
        </div>  

          <?php $client_id=Yii::app()->functions->getClientId();?>
          <?php if (is_numeric($client_id)):?>

          <form id="frm_table_list" method="POST" >
          <input type="hidden" name="action" id="action" value="favouriteRestorantList">
          <?php echo CHtml::hiddenField('currentController','store')?>

        <input type="hidden" name="tbl" id="tbl" value="favourite">
        <input type="hidden" name="clear_tbl"  id="clear_tbl" value="clear_tbl">
        <input type="hidden" name="whereid"  id="whereid" value="fav_id">
        <input type="hidden" name="slug" id="slug" value="store/favouriteRestorantList">

          <table id="table_list" class="table table-striped table-hover table-responsive fav-table">
          <thead>
          <tr>
           <th width="5%"><?php echo Yii::t("default","ID")?></th>
           <th width="30%"><?php echo Yii::t("default","Name")?></th>
           <th  width="10%"><?php echo Yii::t("default","City")?></th>  
          
          </tr>
          </thead>
          </table>

          <?php else :?>
          <p class="uk-text-danger"><?php echo Yii::t("default","Profile not available")?></p>
          <?php endif;?>

    

   </div>
    	</div>
    </div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->