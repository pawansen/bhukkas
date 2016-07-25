<?php 
if (!isset($_SESSION)) { session_start(); }

 unset($_SESSION['previous_url']);

$_SESSION['search_type']='';
if (Yii::app()->getRequest()->getQuery('id')){
	$_SESSION['kr_search_cuisine'] = Yii::app()->getRequest()->getQuery('id');
	$_SESSION['search_type']='kr_search_cuisine';
}

if (isset($_GET['city'])){
	$_SESSION['kr_search_city']=$_GET['city'];
	$_SESSION['search_type']='kr_search_city';
}


$_SESSION['search_type']='';
if (isset($_GET['s'])){
	$_SESSION['kr_search_address']=$_GET['s'];
	$_SESSION['search_type']='kr_search_address';
}

if (isset($_GET['foodname'])){
	$_SESSION['kr_search_foodname']=$_GET['foodname'];
	$_SESSION['search_type']='kr_search_foodname';
}


if (isset($_GET['category'])){
	$_SESSION['kr_search_category']=$_GET['category'];
	$_SESSION['search_type']='kr_search_category';
}

if (isset($_GET['restaurant-name'])){
	$_SESSION['kr_search_restaurantname']=$_GET['restaurant-name'];
	$_SESSION['search_type']='kr_search_restaurantname';
}

if (isset($_GET['street-name'])){
	$_SESSION['kr_search_streetname']=$_GET['street-name'];
	$_SESSION['search_type']='kr_search_streetname';
}


unset($_SESSION['kr_item']);
unset($_SESSION['kr_merchant_id']);

$marker=Yii::app()->functions->getOptionAdmin('map_marker');
if (!empty($marker)){
   echo CHtml::hiddenField('map_marker',$marker);
}

?>

<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/sub_header_short.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
	<div id="sub_content">
            <h1> <?php /*if(isset($_SESSION['totalOtable'])){echo $_SESSION['totalOtable'];}*/?>    <span class="countResult"></span> results in your zone</h1>
      <div><i class="icon_pin"></i> 
     <?php /*Widgets::frontViewContact(); */?>
     <?php if($_GET['cu'] == ''){ if(isset($_SESSION['kr_search_address'])){ echo ucwords($_SESSION['kr_search_address']) ;}else{ ?>
          <?php if(isset(Yii::app()->session['myCity'])){
             
             echo Yii::app()->session['myCity'];

     }} }else{?>
         <?php if(isset(Yii::app()->session['myCity'])){
             
             echo Yii::app()->session['myCity'];

     } ?>
     <?php }?>
      </div>
    </div><!-- End sub_content -->
</div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

    <div id="position">
        <div class="container">
            <ul>
                <li><a href="<?php echo Yii::app()->createUrl('store');?>">Home</a></li>
                <li><a href="#0">Restaurant</a></li>
            </ul>
        </div>
    </div><!-- Position -->
    
    <div class="collapse" id="collapseMap">
		<div id="map" class="map"></div>
<!--                  <div class="map" id="map_area"></div>-->
               
   </div><!-- End Map -->

<!-- Content ================================================== -->
<div id="change_search_location" style="display: none">
<?php Widgets::searchFrontApi();?>
</div>
<div class="container margin_60_35">
	<div class="row">
            <div class="col-md-3 mCustomScrollbar">
                
            <div class="grid-1 left filter-options" id="filters_col"> 
                	<p>
				<a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap">View on map</a>
                                <a class="btn_map change_location" href="javascript:void(0);">Change Location</a>
			</p>
                <?php echo CHtml::hiddenField('sort_filter','')?>
                <?php //Yii::app()->widgets->searchMerchantFront()?>
                <?php Yii::app()->widgets->searchByCuisineFront()?>   
                <?php //Yii::app()->widgets->searchRatingsFront()?>
                <?php Yii::app()->widgets->searchByDeliveryTypeFront()?>    
                <?php Yii::app()->widgets->searchMinimumOrderFront()?>     
                    
             </div> <!--END grid-1-->
            </div>
            <!--End col-md -->

  	<form id="frm_table_list" method="POST" >
    <input type="hidden" name="action" id="action" value="searchArea">
    <?php echo CHtml::hiddenField('currentController','store')?>
    <input type="hidden" name="tbl" id="tbl" value="searchArea">
    <?php 
       if (isset($_GET['restaurant-name'])){
       	   echo CHtml::hiddenField('restaurant-name',isset($_GET['restaurant-name'])?$_GET['restaurant-name']:'');
       } elseif (isset($_GET['street-name'])) {
       	   echo CHtml::hiddenField('street-name',isset($_GET['street-name'])?$_GET['street-name']:'');
       } elseif (isset($_GET['category'])) {  
       	   echo CHtml::hiddenField('category',isset($_GET['category'])?$_GET['category']:'');
       	} elseif (isset($_GET['foodname'])) {  
       	   echo CHtml::hiddenField('foodname',isset($_GET['foodname'])?$_GET['foodname']:''); 
       } elseif (isset($_GET['stype'])) {  
       	   echo CHtml::hiddenField('stype',isset($_GET['stype'])?$_GET['stype']:'');  
       	   switch ($_GET['stype']) {
       	   	case 1:
       	   		echo CHtml::hiddenField('zipcode',isset($_GET['zipcode'])?$_GET['zipcode']:'');       	   		
       	   		break;
       	   	case 2:
       	   		echo CHtml::hiddenField('city',isset($_GET['city'])?$_GET['city']:''); 
       	   		echo CHtml::hiddenField('area',isset($_GET['area'])?$_GET['area']:''); 
       	   		break;
       	   	case 3:
       	   		echo CHtml::hiddenField('address',isset($_GET['address'])?$_GET['address']:'');       	   		
       	   		break;	
       	   	default:
       	   		break;
       	   }
       }elseif(Yii::app()->getRequest()->getQuery('id')){
           
            echo CHtml::hiddenField('filter_cuisine',Yii::app()->getRequest()->getQuery('id'));
            
       }elseif(isset($_GET['cu']) && !empty($_GET['cu'])){
           
            echo CHtml::hiddenField('cuid',$_GET['cu']);
            
       } else {
       	   echo CHtml::hiddenField('s',isset($_GET['s'])?$_GET['s']:'');
           echo CHtml::hiddenField('city',isset($_GET['city'])?$_GET['city']:'');
       }
       
       echo CHtml::hiddenField('st',isset($_GET['st'])?$_GET['st']:'',array('class'=>"st"));
    ?>    
 
    </form>

  
		<div class="col-md-9 mCustomScrollbar" style="max-height:300px;">
    <?php //echo Yii::t("default","Restaurant Searching is currently down for maintenance.")?>
<!--      <div id="resturant_list_search"></div>-->
    <table id="table_list" class="uk-table uk-table-condensed">
<!--            <table id="table_list" class="uk-table uk-table-hover uk-table-striped uk-table-condensed">-->

    <thead>
    <tr style="display:none;">
      <th width="8%"></th>
      <th width="20%"><?php /*echo Yii::t("default","Restaurant")*/?></th>
      <th width="8%"><?php /*echo Yii::t("default","Rating")*/?></th>
      <th width="15%"><?php /*echo Yii::t("default","Minimum")*/?></th>
      <!--<th width="5%">Pay By</th>-->
    </tr>
    </thead>
    <tbody>       
    </tbody>    
    </table>  
		</div><!-- End col-md-9-->
        
	</div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->
