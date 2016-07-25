<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/sub_header_short.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
         <h1>Contact Us</h1>
         <p><i class="icon_pin"></i> <?php echo $website_address ." ".$country;?></p>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?php echo Yii::app()->createUrl('store'); ?>">Home</a></li>
            <li><a href="<?php echo Yii::app()->createUrl('store/contact'); ?>">Contact Us</a></li>
        </ul>
    </div>
</div><!-- Position -->

<div class="page-right-sidebar" id="contact-page">
  <div class="main">
  <div class="inner">
  <?php
   $_GET=array_flip($_GET);   
   $slug=$_GET[''];
   ?>
  <?php if ($data=yii::app()->functions->getCustomPageBySlug($slug)):?>
  <h2><?php echo $data['page_name']?></h2>
    
  <p><?php echo $data['content']?></p>
  
  <?php   
  /*SET SEO META*/
  if (!empty($data['seo_title'])){
     $this->pageTitle=ucwords($data['seo_title']);
     Yii::app()->clientScript->registerMetaTag($data['seo_title'], 'title'); 
  }
  if (!empty($data['meta_description'])){   
     Yii::app()->clientScript->registerMetaTag($data['meta_description'], 'description'); 
  }
  if (!empty($data['meta_keywords'])){   
     Yii::app()->clientScript->registerMetaTag($data['meta_keywords'], 'keywords'); 
  }
  ?>
  
  <?php else :?>
  <p class="uk-text-danger"><i class="fa fa-info-circle"></i> <?php echo Yii::t("default","Sorry but we cannot find what you are looking for.")?></p>
  <?php endif;?>
  
  </div>
  </div> <!--main-->
</div> <!--page-->

         
            </div>
    	</div>
    </div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->