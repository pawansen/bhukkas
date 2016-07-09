<?php
class Widgets extends CApplicationComponent
{
    
        public function searchMerchantFront(){
            ?>

                <div class="filter_type search-box-wrap" id="filter_type_cuisine_end">
                         <h4><?php echo Yii::t("default","Filter Results")?></h4>
                    <h6>Distance</h6>
                   <input type="text" id="range" value="" name="range">
                </div>
         <?php
            
        }                
	
	public function searchMerchant()
	{
		?>
		<div class="search-box-wrap">
	       <h4><?php echo Yii::t("default","Search by name")?></h4>
	       <a href="javascript:;" class="frm_search_name_clear uk-text-muted"><?php echo Yii::t("default","[Clear]")?></a>
	       <ul class="uk-list ">	       
	       <li>
	        <div class="text-field-wrap">
	          <form id="frm_search_name" class="frm_search_name" onsubmit="return false;">
	           <?php  echo CHtml::textField('filter_name','',array(
	             'class'=>"filter_name",
	             'placeholder'=>""
	           ))?>
	           <button class="button_filter"><i class="fa fa-search"></i></button>
	           </form>
	        </div>
	       </li>
	       </ul>	       	       
	    </div> search-box-wrap
                   
                
		<?php
	}
        
        public function emailTemplatesContact($data){
            
           $html =  ' <html>

<body style="width:100%; float:left;  font-family:arial;">

    <div class="main" style="width:900px; margin:0px auto">

        <div style="">
            <img src="'.$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl.'/assets/images/1463638947-logo.png" style="margin:17px 30% 0;"/>
        </div>
        <h1 style="margin:16px 7px 2% 39%">Contact Detail</h1>
        <table width="600" border="1|0" cellspacing="0" cellpadding="10px" style="margin:0 auto;" borderColor="WHITE">
            <tr>
                <th  style="text-align:left">Information</th>
                <th  style="text-align:left">Detail</th>
            </tr>';
            unset($data['CurrentController']);
            foreach ($data as $key=>$val) { 
                if($val != 'store'){
	        $html.= '<tr>
                <td>
                    '.ucwords($key).'
                </td>
                <td>
                    '.$val.'
                </td>
            </tr>';
            }}
                       
        $html .= '</table>
        </h4>
         <h4 style="margin:5px 0px">- Warm Regards</h4>
        
        <h4 style="margin:5px 0px">Bhukkas Team</h4>
       
    </div>
</body>

</html>';
           
           return $html;
            
        }
        
        
         public function emailTplUserRegisterAdmin($data){
            
           $html =  ' <html>

<body style="width:100%; float:left;  font-family:arial;">

    <div class="main" style="width:900px; margin:0px auto">

        <div style="">
            <img src="'.$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl.'/assets/images/1463638947-logo.png" style="margin:17px 30% 0;"/>
        </div>
        <h1 style="margin:16px 7px 2% 39%">New User Registration</h1>
        <table width="600" border="1|0" cellspacing="0" cellpadding="10px" style="margin:0 auto;" borderColor="WHITE">
            <tr>
                <th  style="text-align:left">Information</th>
                <th  style="text-align:left">Detail</th>
            </tr>';
        
	        $html.= '<tr>
                <td>
                    Name
                </td>
                <td>
                    '.$data['first_name'].' '.$data['last_name'].'
                </td>
            </tr>
            <tr>
                <td>
                    Email
                </td>
                <td>
                    '.$data['email_address'].'
                </td>
            </tr>
            <tr>
                <td>
                    Phone
                </td>
                <td>
                    '.$data['contact_phone'].'
                </td>
            </tr>';
                       
        $html .= '</table>
        </h4>
         <h4 style="margin:5px 0px">- Warm Regards</h4>
        
        <h4 style="margin:5px 0px">Bhukkas Team</h4>
       
    </div>
</body>

</html>';
           
           return $html;
            
        }
        
        function emailTplUserRegisterUser($data = ''){
            
            $website_address=Yii::app()->functions->getOptionAdmin('website_address');
            $website_contact_phone=Yii::app()->functions->getOptionAdmin('website_contact_phone');
            $website_contact_email=Yii::app()->functions->getOptionAdmin('website_contact_email');
            
             $html =  ' <html>

<body style="width:100%; float:left;  font-family:arial;">

    <div class="main" style="width:900px; margin:0px auto">

        <div style="">
            <img src="'.$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl.'/assets/images/1463638947-logo.png" style="margin:17px 30% 0;"/>
        </div>
        <h1 style="margin:16px 7px 2% 39%">Thanks for the Registration</h1>
        <p>Dear '.$data['first_name'].' '.$data['last_name'].',
 
Thank you for registering for the bhukkas.com.  We have a great event planned and know that you will better food quality.
 
If you have any questions please contact by phone '.$website_contact_phone.' & email '.$website_contact_email.'.</p>
    
<a href="'.$_SERVER['HTTP_HOST'].Yii::app()->CreateUrl('/store').'">click here to login</a>
        
         <h4 style="margin:5px 0px">- Warm Regards</h4>
        
        <h4 style="margin:5px 0px">Bhukkas Team</h4>
       
    </div>
</body>

</html>';
           
           return $html;
        }
        
        function emailTplForgotPassword($data,$token){
            
             $url=Yii::app()->getBaseUrl(true)."/store/forgotPassword/?token=".$token;
            
             $html =  ' <html>

<body style="width:100%; float:left;  font-family:arial;">

    <div class="main" style="width:900px; margin:0px auto">

        <div style="">
            <img src="'.$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl.'/assets/images/1463638947-logo.png" style="margin:17px 30% 0;"/>
        </div>
        <h1 style="margin:16px 7px 2% 25%">Click on the link below to change your password.</h1>
        <p>Dear '.$data['first_name'].' '.$data['last_name'].',</p>
    
<a href="'.$url.'">"'.$url.'"</a>
        
         <h4 style="margin:5px 0px">- Warm Regards</h4>
        
        <h4 style="margin:5px 0px">Bhukkas Team</h4>
       
    </div>
</body>

</html>';
           
           return $html;
        }
        
        public function serachByShorting(){
            
            ?>
               <div data-uk-dropdown="{mode:'click'}" class="filter_type uk-button-dropdown search-box-wrap">
                   <h6> <button class="uk-button btn btn-success"><?php echo Yii::t("default","Sort By")?> <span class="sortby_text"></span><i class="uk-icon-caret-down"></i></button></h6>
	   
	    <div class="uk-dropdown" >
	        <ul class="uk-nav uk-nav-dropdown">
<!--				<li>
				<a href="javascript:;" data-id="restaurant_name" class="sort_filter" data-text="<?php echo t("Name")?>">
				<?php echo Yii::t("default","Name")?>
				</a>				
				</li>-->
				
				<li>
				<a href="javascript:;" data-id="ratings" class="sort_filter" data-text="<?php echo t("Rating")?>" >
				<?php echo Yii::t("default","Rating")?>
				</a>
				</li>
				
				<li>
				<a href="javascript:;" data-id="minimum_order" class="sort_filter" data-text="<?php echo t("Minimum Order")?>">
				<?php echo Yii::t("default","Minimum Order")?>
				</a>
				</li>
				
				<li>
				<a href="javascript:;" data-id="distance" class="sort_filter" data-text="<?php echo t("Distance")?>">
				<?php echo Yii::t("default","Distance")?>
				</a>
				</li>
                                
                                <li>
				<a href="javascript:;" data-id="delivery_charges" class="sort_filter" data-text="<?php echo t("Delivery Fee")?>">
				<?php echo Yii::t("default","Delivery Fee")?>
				</a>
				</li>
				
	        </ul>
	    </div>
	</div>
            <?php
        }
	
        public function searchRatingsFront()
	{
		?>
                        <div>
                            <a class="more-filter">
                                 <span class="filter-text-all">Show All</span>
                                 <span class="filter-text-all" style="display:none">Show Less</span>
                            </a>
                         </div>

            		<div class="filter_type search-box-wrap minium_order_filter">
						<h6>Ratings <a data-toggle="collapse" href="#ratings_col" aria-expanded="false" aria-controls="ratings_col" id="filters_col_ratings"> <i class="pull-right fa fa-caret-up"></i></a></h6>
						<ul class="to-hide" id="ratings_list">
							<li><label><input type="checkbox" name="ratings[]" value="5" class="filter_by filter_ratings icheck"><span class="rating"> 
							<i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i>
							</span></label></li>
							<li><label><input type="checkbox" name="ratings[]" value="4" class="filter_by filter_ratings icheck"><span class="rating">
							<i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
							</span></label></li>
							<li><label><input type="checkbox" name="ratings[]" value="3" class="filter_by filter_ratings icheck"><span class="rating">
							<i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i>
							</span></label></li>
							<li><label><input type="checkbox" name="ratings[]" value="2" class="filter_by filter_ratings icheck"><span class="rating">
							<i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i>
							</span></label></li>
							<li><label><input type="checkbox" name="ratings[]" value="1" class="filter_by filter_ratings icheck"><span class="rating">
							<i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i>
							</span></label></li>
						</ul>
					</div>
		<?php
	}
        
	public function searchFreeDelivery()
	{
		?>
		<div class="search-box-wrap filter_type">
                    <h6>Delivery <a data-toggle="collapse" href="#ratings_col" aria-expanded="false" aria-controls="ratings_col" id="filters_col_bt"> </a></h6>
	       <a href="javascript:;">
	       <i class="right fa fa-caret-up"></i>
	       <div class="clear"></div>
	       </a>
	       <ul class="uk-list uk-list-striped to-hide">	       
	       <li>
	    
	       </li>
               <li><label> <?php 
	          echo CHtml::checkBox('filter_by[]',false,array(
	          'value'=>'free-delivery',
	          'class'=>"filter_by filter_promo icheck"
	          ));
	          ?>  Free Delivery</label></li>
	       </ul>	       	       
	    </div> <!--search-box-wrap-->
		<?php
	}
	
        public function searchByDeliveryTypeFront(){
            $services=Yii::app()->functions->Services();
            ?>
            <div class="filter_type search-box-wrap">
                    <h6>Delivery Type <a data-toggle="collapse" href="#ratings_col" aria-expanded="false" aria-controls="ratings_col" id="filters_col_service"> <i class="pull-right fa fa-caret-up"></i></a></h6>
                    <ul class="to-hide" id="service_list">
                            <?php if (is_array($services) && count($services)>=1):?>
	       <?php foreach ($services as $key=> $val):?>
                        
                   <li><label>    <?php 
	          echo CHtml::checkBox('filter_delivery_type[]',false,array(
	          'value'=>$key,
	          'class'=>"filter_by filter_delivery_type icheck"
	          ));
	          ?><span>   <?php echo ucfirst($val)?></span></label></li>

                       <?php endforeach;?>
	       <?php endif;?>
                    </ul>
                     
            </div>
            
            <?php
        }
        
	public function searchByDeliveryType()
	{
		$services=Yii::app()->functions->Services();		
		?>
		<div class="search-box-wrap">
	       <a href="javascript:;">
	       <h4 class="left"><?php echo Yii::t("default","Filter Results")?></h4> <i class="right fa fa-caret-up"></i>
	       <div class="clear"></div>
	       </a>
	       <ul class="uk-list uk-list-striped to-hide">
	       <?php if (is_array($services) && count($services)>=1):?>
	       <?php foreach ($services as $key=> $val):?>
	       <li>
	       <div class="uk-grid">
	          <div class="uk-width-1-2">
	          <?php echo ucfirst($val)?>
	          </div>
	          <div class="uk-width-1-2">
	          <div class="right">
	          <?php 
	          echo CHtml::checkBox('filter_delivery_type[]',false,array(
	          'value'=>$key,
	          'class'=>"filter_by filter_delivery_type icheck"
	          ));
	          ?>
	          </div>
	          </div>
	        </div>
	       </li>
	       <?php endforeach;?>
	       <?php endif;?>
	       </ul>
	    </div> <!--search-box-wrap-->
		<?php
	}
	
        public function searchByCuisineFront(){
            $cuisine=Yii::app()->functions->Cuisine(false);
            $colorCounts=1; 
            ?>
                 <div class="search-box-wrap filter_type">
                    <h6>Choose Cuisine <a href="javascript:;" id="filters_col_cu"> <div class="clear"></div></a></h6>
                    <ul class="uk-list to-hide" id="cusine_list">
                        
                          <?php if (is_array($cuisine) && count($cuisine)>=1):?>	       
	                  <?php foreach ($cuisine as $val): ?>
                        <li>  <?php 
                                echo CHtml::checkBox('filter_cuisine[]',false,array(
                                'value'=>$val['cuisine_id'],
                                'class'=>"filter_by icheck filter_cuisine"
                                ));
                                ?><label><span>   &nbsp;<?php echo ucfirst($val['cuisine_name'])?></span></label><i class='color_<?php echo $colorCounts;?>'></i></li>
                           <?php $colorCounts++;
                            if($colorCounts == 7){
                                $colorCounts = 1;
                            }?>
                           <?php endforeach;?>
	                   <?php endif;?> 
                    </ul>
                    <div>
                     <a class="show-filter">
                          <span class="filter-text">Show More</span>
                          <span class="filter-text" style="display:none">Show Less</span>
                     </a>
                  </div>
             </div>
            
            <?php 
            
        }
        
	public function searchByCuisine()
	{
		$cuisine=Yii::app()->functions->Cuisine(false);				
		?>
		<div class="search-box-wrap">	       
	       <a href="javascript:;">
	       <h4 class="left"><?php echo Yii::t("default","Choose Cuisine")?></h4> <i class="right fa fa-caret-down"></i>
	       <div class="clear"></div>
	       </a>
	       <ul class="uk-list to-hide" style="display:none;">
	       <?php if (is_array($cuisine) && count($cuisine)>=1):?>	       
	       <?php foreach ($cuisine as $val): ?>
	       <li>
	        <div class="uk-grid">
	          <div class="uk-width-1-2">
	          <?php echo ucfirst($val['cuisine_name'])?>
	          </div>
	          <div class="uk-width-1-2">
	          <div class="right">
	          <?php 
	          echo CHtml::checkBox('filter_cuisine[]',false,array(
	          'value'=>$val['cuisine_id'],
	          'class'=>"filter_by icheck filter_cuisine"
	          ));
	          ?>
	          </div>
	          </div>
	        </div>
	       </li>
	       <?php endforeach;?>
	       <?php endif;?>
	       </ul>       
	    </div> <!--search-box-wrap-->
		<?php
	}
	
        public function searchMinimumOrderFront(){
            
           $minimum_list=array(
		  '100'=>"< ".getCurrencyCode()."100",
		  '250'=>"< ".getCurrencyCode()."250",
		  '500'=>"< ".getCurrencyCode()."500",
		  '1000'=>"< ".getCurrencyCode()."1000"
		);
           ?>
                 
             <div class="filter_type minium_order_filter">
                 <h6>Minimum Delivery <a data-toggle="collapse" href="#ratings_col" aria-expanded="false" aria-controls="ratings_col" id="filters_col_min_order"> <i class="pull-right fa fa-caret-up"></i></a></h6>
                    <ul class="to-hide" id="min_order_list">
                         <?php foreach ($minimum_list as $key=>$val):?>
                        <li> <?php 
                            echo CHtml::radioButton('filter_minimum[]',false,array(
                            'value'=>$key,
                            'class'=>"filter_by_radio filter_minimum icheck"
                            ));
                            ?><label><span> &nbsp;<?php echo $val;?></span></label></li>
                         <?php endforeach;?> 
                    </ul>
             </div>
            <?php
        }
        
	public function searchMinimumOrder()
	{
		$minimum_list=array(
		  '5'=>"< ".getCurrencyCode()."5",
		  '10'=>"< ".getCurrencyCode()."10",
		  '15'=>"< ".getCurrencyCode()."15",
		  '20'=>"< ".getCurrencyCode()."20"
		);		
		?>
		<div class="search-box-wrap">	       
	       <a href="javascript:;">
	       <h4 class="left"><?php echo Yii::t("default","Minimum Delivery")?></h4> <i class="right fa fa-caret-up"></i>
	       <div class="clear"></div>
	       </a>
	       
	      <a href="javascript:;" class="filter_minimum_clear uk-text-muted"><?php echo Yii::t("default","[Clear]")?></a>
	      
	       <ul class="uk-list uk-list-striped to-hide">
	      <?php foreach ($minimum_list as $key=>$val):?>
	      <li>
	       <div class="uk-grid">
	          <div class="uk-width-1-2">
	            <?php echo $val;?>
	          </div>
	          <div class="uk-width-1-2">
	          <div class="right">
	          <?php 
	          echo CHtml::radioButton('filter_minimum[]',false,array(
	          'value'=>$key,
	          'class'=>"filter_by_radio filter_minimum icheck"
	          ));
	          ?>
	          </div>
	          </div>
	        </div>
	       </li>	       
	      <?php endforeach;?> 	       	      
	       </ul>	       	       
	    </div> <!--search-box-wrap-->
		<?php
	}
	
	public function getOperationalHours($merchant_id='')
	{
        $stores_open_day=Yii::app()->functions->getOption("stores_open_day",$merchant_id);
		$stores_open_starts=Yii::app()->functions->getOption("stores_open_starts",$merchant_id);
		$stores_open_ends=Yii::app()->functions->getOption("stores_open_ends",$merchant_id);
		$stores_open_custom_text=Yii::app()->functions->getOption("stores_open_custom_text",$merchant_id);
		
		$stores_open_day=!empty($stores_open_day)?(array)json_decode($stores_open_day):false;
		$stores_open_starts=!empty($stores_open_starts)?(array)json_decode($stores_open_starts):false;
		$stores_open_ends=!empty($stores_open_ends)?(array)json_decode($stores_open_ends):false;
		$stores_open_custom_text=!empty($stores_open_custom_text)?(array)json_decode($stores_open_custom_text):false;
		
		
		$stores_open_pm_start=Yii::app()->functions->getOption("stores_open_pm_start",$merchant_id);
		$stores_open_pm_start=!empty($stores_open_pm_start)?(array)json_decode($stores_open_pm_start):false;
		
		$stores_open_pm_ends=Yii::app()->functions->getOption("stores_open_pm_ends",$merchant_id);
		$stores_open_pm_ends=!empty($stores_open_pm_ends)?(array)json_decode($stores_open_pm_ends):false;		
						
		$tip='';						
		$open_starts='';
		$open_ends='';
		$open_text='';
		$tip.="<ul class=\"hr_op rounded2\"><i class=\"fa fa-caret-up\"></i>";
		if (is_array($stores_open_day) && count($stores_open_day)>=1){
			foreach ($stores_open_day as $val_open) {	
				if (array_key_exists($val_open,(array)$stores_open_starts)){
					$open_starts=timeFormat($stores_open_starts[$val_open],true);
				}							
				if (array_key_exists($val_open,(array)$stores_open_ends)){
					$open_ends=timeFormat($stores_open_ends[$val_open],true);
				}							
				if (array_key_exists($val_open,(array)$stores_open_custom_text)){
					$open_text=$stores_open_custom_text[$val_open];
				}					
				
				$pm_starts=''; $pm_ends=''; $pm_opens='';
				if (array_key_exists($val_open,(array)$stores_open_pm_start)){
					$pm_starts=timeFormat($stores_open_pm_start[$val_open],true);
				}											
				if (array_key_exists($val_open,(array)$stores_open_pm_ends)){
					$pm_ends=timeFormat($stores_open_pm_ends[$val_open],true);
				}								
				/*if (!empty($pm_starts) && !empty($pm_ends)){
					$pm_opens="$pm_starts - $pm_ends";
				}*/
				
				$full_time='';
				if (!empty($open_starts) && !empty($open_ends)){					
					$full_time=$open_starts." - ".$open_ends."&nbsp;&nbsp;";
				}			
				if (!empty($pm_starts) && !empty($pm_ends)){
					if ( !empty($full_time)){
						$full_time.=" - ";
					}				
					$full_time.="$pm_starts - $pm_ends";
				}
									
				/*$tip.='<li>
				<span>'.ucwords(Yii::t("default",$val_open)).'</span>
				<value>'.$open_starts.
				" - ".$open_ends."&nbsp;&nbsp;".$pm_opens."&nbsp;".ucfirst($open_text).
				'</value>
				</li>';*/
				
				$tip.='<li>
				<span>'.ucwords(Yii::t("default",$val_open)).'</span>
				<value>'.$full_time."&nbsp;".ucfirst($open_text).
				'</value>
				</li>';
				
				$open_starts='';
		        $open_ends='';
		        $open_text='';
			}
		} else $tip.="<li>".Yii::t("default","Not available.")."</li>";
		$tip.="<div class=\"clear\"></div>";
		$tip.="</ul>";
								
		$tips="<a class=\"opening-hours-wrap\" href=\"javascript:;\">".Yii::t("default","Hours of Operation")."$tip</a>";	
		return $tips;
	}
	
	public static function languageBar($controller='store',$force=false)
	{
		$show_language=Yii::app()->functions->getOptionAdmin('show_language');		
		if ( $force==TRUE){
			$show_language='';
		}
		
		if ($controller=="admin" || $controller=="merchant"){
		   $show_language=getOptionA('show_language_backend');		
		}
		
		$list=Yii::app()->functions->getLanguageList();		
		if ($show_language==""):
		if (is_array($list) && count($list)>=1):
		?>
		<div data-uk-dropdown="{mode:'click'}" class="uk-button-dropdown language-wrapper">
		  <button class="uk-button uk-button-success"><i class="fa fa-globe"></i> <i class="uk-icon-caret-down"></i></button>
		  <div class="uk-dropdown" >
		   <ul class="uk-nav uk-nav-dropdown">	    
		    <li>
		    <a href="<?php echo Yii::app()->request->baseUrl."/$controller/Setlanguage/Id/-9999"?>"> 
		    <?php echo Yii::app()->functions->getFlagByCode('US')." ". Yii::t("default","English") ?>
		    </a>
		    </li>
		   <?php foreach ($list as $val):?>		   
		    <li>
		    <a href="<?php echo Yii::app()->request->baseUrl."/$controller/Setlanguage/Id/".$val['lang_id']; ?>"> 
		    <?php echo Yii::app()->functions->getFlagByCode($val['country_code'])." ".ucwords($val['language_code'])?>
		    </a>
		    </li>
		   <?php endforeach;?>  
		   </ul>
		  </div>
		</div>
		<?php
		endif;
		endif;
	}
	
	public static function smsBalance()
	{
		$enabled=Yii::app()->functions->getOptionAdmin("mechant_sms_enabled");
		if ( $enabled==""):
		?>
		<div class="sms_credit_wrap">
		<p><?php echo Yii::t("default","SMS Credits")?>: <?php echo Yii::app()->functions->getMerchantSMSCredit(Yii::app()->functions->getMerchantID());?></p>
		</div>
		<?php
		endif;
	}
	
	public static function applyVoucher($merchant_id='')
	{
		$enabled=Yii::app()->functions->getOption('merchant_enabled_voucher',$merchant_id);
		if ( $enabled!="yes"){
			return ;
		}		
		$style='';
		$has_voucher=false;		
		$code='';
		$text=Yii::t("default","Use Voucher");
         if (isset($_SESSION['voucher_code'])){		         	
         	if (!empty($_SESSION['voucher_code']['voucher_name'])){
         		$has_voucher=true;         		
         		$style="display:none;";
         		$code=$_SESSION['voucher_code']['voucher_name'];
         		$text=Yii::t("default","Remove Voucher");
         	}		         
        }         
		?>
            <style>
                .voucher_wrap
                {
                  width:100%;
                  float:left;
                }
                .voucher_wrap .uk-width-1-1
                {
                    width:38%;
                    float:left;
                    height:30px;
                    margin-top:5px;
                }
                .voucher_wrap .btn-wrap
                {
                    width:62%;
                    float:left;
                }
                .voucher_wrap .btn-wrap a
                {
                    margin-left: 10px;
                    margin-top: 10px;
                }
            </style>
		<div class="voucher_wrap">                      
        <?php echo CHtml::textField('voucher_code',$code
        ,array(
          'placeholder'=>t("Enter Voucher here"),
          'class'=>"uk-width-1-1 form-control col-sm-7",
          'style'=>$style
        ))?>
                    <div class="btn-wrap">
                        <a href="javascript:;" class="uk-button uk-button-success apply_voucher"><?php echo $text?></a></div>           
        </div>
		<?php
	}
	
	public function displayMerchant($data='')
	{		
		$ccCon=ccController();	
		
		$total_records=0;
		$path_to_upload=Yii::getPathOfAlias('webroot')."/upload";
		if (is_array($data) && count($data)>=1):		   
		   $total_records= (integer) $data['0']['total_records'];		   
		   foreach ($data as $val):
		   //$address=$val['street']." ".$val['city']." ".$val['state']." ".$val['post_code'] ." ".$val['country_code'];
		   //$address=$val['street']." ".$val['city']." ".$val['state']." ".$val['country_code'];
		   $address=$val['street']." ".$val['city']." ".$val['state'];
		   
		   $is_merchant_open = Yii::app()->functions->isMerchantOpen($val['merchant_id']); 
		   $merchant_preorder= Yii::app()->functions->getOption("merchant_preorder",$val['merchant_id']);
		   
		   $ratings=Yii::app()->functions->getRatings($val['merchant_id']);	    				
		   $rating_meanings='';
		   if ( $ratings['ratings'] >=1){
				$rating_meaning=Yii::app()->functions->getRatingsMeaning($ratings['ratings']);
				$rating_meanings=ucwords($rating_meaning['meaning']);
		   }	    	
		   		 		  
           $tag_open='';
		   if ( $is_merchant_open==TRUE){
		       $tag_open='<div class="uk-badge uk-badge-success">'.t("Open").'</div>';
		   } else {
			  if ($merchant_preorder){
				  $tag_open='<div class="uk-badge uk-badge-success">'.t("Pre-Order").'</div>';
		      } else $tag_open='<div class="uk-badge uk-badge-danger">'.t("Closed").'</div>';
		   }  
									   		
		   $rating="<div class=\"rate-wrap\">
			<h6 class=\"rounded2\" data-uk-tooltip=\"{pos:'bottom-left'}\" title=\"$rating_meanings\" >".
			number_format($ratings['ratings'],1)."</h6>
			<span>".$ratings['votes']." ".Yii::t("default","Votes")."</span>			
			</div>";		  
		   
		   $merchant_id=$val['merchant_id'];
           $lat=Yii::app()->functions->getOption("merchant_latitude",$merchant_id);
           $long=Yii::app()->functions->getOption("merchant_longtitude",$merchant_id);           
		   ?>
		   <div class="links" data-id="<?php echo $address;?>" >
		   <div class="uk-grid" id="restaurant-mini-list">
		     <div class="uk-width-3-10">		     
		      <a href="<?php echo baseUrl()."$ccCon/menu/merchant/".$val['restaurant_slug']?>">
		      <?php if (!empty($val['merchant_logo'])):?>
		      <img class="uk-thumbnail uk-thumbnail-mini" src="<?php echo Yii::app()->request->baseUrl."/upload/".$val['merchant_logo'];?>">
		      <?php else :?>
		      <img class="uk-thumbnail uk-thumbnail-mini" src="<?php echo Yii::app()->request->baseUrl."/assets/images/thumbnail-medium.png";?>">
		      <?php endif;?>
		      </a>
		     </div>
		     <div class="uk-width-7-10">
		        <h5><a href="<?php echo baseUrl()."$ccCon/menu/merchant/".$val['restaurant_slug']?>">
		        <?php echo $val['restaurant_name']?></a>
		       </h5>
		        <p class="uk-text-muted">That is an<?php echo $address?></p>
		        <a class="view-map" href="javascript:;" data-id="<?php echo $address;?>" data-lat="<?php echo $lat;?>" data-long="<?php echo $long;?>" data-merchantname="<?php echo ucwords($val['restaurant_name'])?>" >
		        <i class="fa fa-map-marker"></i>
 <?php echo Yii::t("default","View Map")?></a>
                <?php echo $tag_open;?>
		        <?php echo $rating;?>		        		       
		     </div>
		   </div>
		   </div>
		   <?php
		   endforeach;
		   		   		   
		   $path=Yii::getPathOfAlias('webroot')."/protected/vendor";
		   require_once $path."/Pagination/Pagination.class.php";
		   $page = isset($_GET['page']) ? ((int) $_GET['page']) : 1;		   
		   $pagination = new Pagination();
           $pagination->setCurrent($page);
           $pagination->setRPP(10);           
           $pagination->setTotal($total_records);           
           echo $pagination->parse();		              
		   
		else :
		?><p class="uk-text-muted"><?php echo Yii::t("default","No data available")?></p><?php
		endif;
	}
	
	public function bookTable($merchant_id='')
	{		
		/*$fully_booked_msg=Yii::app()->functions->getOption("fully_booked_msg",$merchant_id)*/
		?>				
		
		<h3><?php echo Yii::t("default","Booking Information")?></h3>
		 <form class="uk-form uk-form-horizontal forms" id="frm-book" onsubmit="return false;">
		 <?php echo CHtml::hiddenField('action','bookATable')?>
	     <?php echo CHtml::hiddenField('currentController','store')?>
	     <?php echo CHtml::hiddenField('merchant-id',$merchant_id)?>
      
	      <div class="uk-form-row">
			  <label class="uk-form-label"><?php echo Yii::t("default","Number Of Guests")?></label>
			  <?php echo CHtml::textField('number_guest',''			 
			  ,array(
			  'class'=>'numeric_only',
			  'data-validation'=>"required"
			  ))?>
		 </div>
		 
		 <div class="uk-form-row">
			  <label class="uk-form-label"><?php echo Yii::t("default","Date Of Booking")?></label>
			  <?php echo CHtml::hiddenField('date_booking')?>
			  <?php echo CHtml::textField('date_booking1',''			 
			  ,array(
			  'class'=>'date_booking',
			  'data-validation'=>"required",
			  'data-id'=>'date_booking'
			  ))?>
		 </div>
		 
		 <div class="uk-form-row">
			  <label class="uk-form-label"><?php echo Yii::t("default","Time")?></label>
			  <?php echo CHtml::textField('booking_time',''			 
			  ,array(
			  'class'=>'timepick',
			  'data-validation'=>"required"
			  ))?>
		 </div>
		 
		 <h3><?php echo Yii::t("default","Contact Information")?></h3>
		 
		 <div class="uk-form-row">
			  <label class="uk-form-label"><?php echo Yii::t("default","Name")?></label>
			  <?php echo CHtml::textField('booking_name',''			 
			  ,array(
			  'class'=>'uk-form-width-large',
			  'data-validation'=>"required"
			  ))?>
		 </div>
		 
		 <div class="uk-form-row">
			  <label class="uk-form-label"><?php echo Yii::t("default","Email")?></label>
			  <?php echo CHtml::textField('email',''			 
			  ,array(
			  'class'=>'uk-form-width-large',
			  'data-validation'=>"email"
			  ))?>
		 </div>
		 
		 <div class="uk-form-row">
			  <label class="uk-form-label"><?php echo Yii::t("default","Mobile")?></label>
			  <?php echo CHtml::textField('mobile',''			 
			  ,array(
			  'class'=>'uk-form-width-large',
			  'data-validation'=>"required"
			  ))?>
		 </div>
		 
		 <div class="uk-form-row">
			  <label class="uk-form-label"><?php echo Yii::t("default","Your Instructions")?></label>
			  <?php echo CHtml::textArea('booking_notes',''			 
			  ,array(
			  'class'=>'uk-form-width-large'			 
			  ))?>
		 </div>
		 
		 <div class="uk-form-row">
         <input type="submit" value="<?php echo Yii::t("default","Book a Table")?>" class="book-table-button uk-button uk-form-width-medium uk-button-success">
         </div>

      </form>
		<?php
	}
	
	public function shareWidget($merchant_name='')
	{
		$admin_merchant_share=yii::app()->functions->getOptionAdmin('admin_merchant_share');
		if ($admin_merchant_share==1){
			return ;
		}
		$title=Yii::t("default","Come and order at")." ".$merchant_name;		
		$url=Yii::app()->getBaseUrl(true).'/store/menu/merchant/'.$_GET['merchant'];		
		$fb='https://www.facebook.com/sharer/sharer.php?u='.$url.'&display=popup';
		$twitter="https://twitter.com/share?url=$url&text=$title";
		$linkin="http://www.linkedin.com/shareArticle?mini=true&url=$url&title=$title";
		$google="https://plus.google.com/share?url=$url";
		?>
		<div class="share-wrap">
         <p class="uk-text-bold"><?php echo Yii::t("default",'Share this restaurant')?></p>
         <ul>         
         <li><a href="javascript:;" class="share" rel="<?php echo $fb;?>"><i class="fa fa-facebook-square"></i></a></li>
         <li><a href="javascript:;" class="share" rel="<?php echo $twitter;?>"><i class="fa fa-twitter-square"></i></a></li>
         <li><a href="javascript:;" class="share" rel="<?php echo $linkin;?>"><i class="fa fa-linkedin-square"></i></a></li>
         <li><a href="javascript:;" class="share" rel="<?php echo $google;?>"><i class="fa fa-google-plus-square"></i></a></li>
         <div class="clear"></div>
         </ul>
       </div> <!--share-wrap-->      
		<?php
	}
	
	public function analyticsCode()
	{
		$code=Yii::app()->functions->getOptionAdmin('admin_header_codes');
		if (!empty($code)){
			echo $code;
		}
	}
	
	public function orderBar()
	{
		$show_bar=false;
		$page_name=Yii::app()->controller->action->id;
		switch ($page_name) {
			case "searchArea":
			case "menu":	
			case "checkout":
			case "PaymentOption":
			case "paypalInit":
			case "paypalVerify":				
			case "stripeInit":
			case "mercadoInit":	
			case "sisowinit":
			case "payuinit":	
				$show_bar=true;				
				break;
		
			default:
				break;
		}
		
		$step=1;
		switch ($page_name) {
			case "searchArea":
				$step=2;
				break;
			case "menu":
				$step=3;
				break;
			case "checkout":	
			case "PaymentOption":
			case "paypalInit":	
			case "stripeInit":
			case "mercadoInit":	
			case "paypalVerify":
			case "sisowinit":	
			case "payuinit":
			    $step=4;
			    break;
			default:
				break;
		}		
				
		$kr_merchant_slug=isset($_SESSION['kr_merchant_slug'])?$_SESSION['kr_merchant_slug']:'';
		
		
		if (isset($_SESSION['search_type'])){
			switch ($_SESSION['search_type']) {
				case "kr_search_foodname":
					$search_str="foodname=".urlencode($_SESSION['kr_search_foodname']);
					break;
					
				case "kr_search_category":
					$search_str="category=".urlencode($_SESSION['kr_search_category']);
					break;
					
				case "kr_search_restaurantname":
					$search_str="restaurant-name=".urlencode($_SESSION['kr_search_restaurantname']);
					break;	
				
				case "kr_search_streetname":
					$search_str="street-name=".urlencode($_SESSION['kr_search_streetname']);
					break;	
							
				default:
					$search_str="s=".urlencode($_SESSION['kr_search_address']);
					break;
			}
		}

		if ($show_bar):
		?>
		<div class="sub-header"  data-uk-sticky >
		 <div class="main">
		    <ul class="order-steps">
		      <li class="active">
		        <a href="<?php echo Yii::app()->request->baseUrl;?>/store"><?php echo Yii::t("default","Search")?></a>  
		        <div class="line"></div>      
		      </li>
		      <li class="<?php echo $step>=2?"active":""; echo $step==2?" current":"";?>">
		         <a href="<?php echo Yii::app()->request->baseUrl; ?>/store/searchArea?<?php echo $search_str?>"><?php echo Yii::t("default","Pick Merchant")?></a>
		         <div class="line"></div>      
		      </li>
		      <li class="<?php echo $step>=3?"active":""; echo $step==3?" current":"";?> ">
		        <a href="<?php echo Yii::app()->request->baseUrl."/store/menu/merchant/".$kr_merchant_slug; ?>"><?php echo Yii::t("default","Create your order")?></a>
		        <div class="line"></div>
		      </li>
		      <li class="<?php echo $step>=4?"active":""; echo $step==4?" current":"";?> ">
		       <a href="javascript:;"><?php echo Yii::t("default","Checkout")?></a>
		       <div class="line"></div>
		      </li>
		    </ul>
		 </div>
		</div> <!--END sub-header-->
		<div class="clear"></div>
		<?php
		endif;					
	}

	public function merhantSignupBar()
	{
		$show_bar=false;
		$page_name=Yii::app()->controller->action->id;				
		if ($page_name=="merchantSignup"):
		
		$steps=1;
		if (isset($_GET['Do'])){	
			switch ($_GET['Do']) {
				case "step2":
					$steps=2;
					break;
			    case "step3":
			    case "step3a":	
			    case "step3b":
					$steps=3;
					break;	
			    case "step4":
			    case "thankyou1":					
			    case "thankyou2":
			    case "thankyou3":
			        $steps=4;
			        break;	
				default:
					break;
			}
		}	
		
		$merchant_email_verification=Yii::app()->functions->getOptionAdmin('merchant_email_verification');
        echo CHtml::hiddenField('merchant_email_verification',$merchant_email_verification);
		?>
		<div class="sub-header merchant-step-section"  data-uk-sticky >
		  <div class="main">
		    <ul class="order-steps">
		      <li class="<?php echo $steps>=1?"active":""; echo $steps==1?" current":"";?>" >
		        <a href="<?php echo Yii::app()->request->baseUrl;?>/store/merchantSignup"><?php echo Yii::t("default","Select Package")?></a>  
		        <div class="line"></div>
		      </li>
		            
		      <li class="<?php echo $steps>=2?"active":""; echo $steps==2?" current":"";?>" >
		        <a href="javascript:;"><?php echo Yii::t("default","Merchant information")?></a>  
		        <div class="line"></div>
		      </li>
		      
		      <li class="<?php echo $steps>=3?"active":""; echo $steps==3?" current":"";?>" >
		        <a href="javascript:;"><?php echo Yii::t("default","Payment Information")?></a>  
		        <div class="line"></div>
		      </li>
		      
		      <?php if ( $merchant_email_verification==""):?>
		      <li class="<?php echo $steps>=4?"active":""; echo $steps==4?" current":"";?>">
		        <a href="javascript:;"><?php echo Yii::t("default","Activation")?></a>  
		        <div class="line"></div>
		      </li>
		      <?php else :?>
		      <li class="<?php echo $steps>=4?"active":""; echo $steps==4?" current":"";?>">
		        <a href="javascript:;"><?php echo Yii::t("default","Finish")?></a>  
		        <div class="line"></div>
		      </li>
		      <?php endif;?>
		      
		    </ul>
		  </div>
		</div>
		<div class="clear"></div>
		<?php
		endif;
	}
	
 public static function searchFrontApi(){
    $kr_search_adrress='';
    if (isset($_SESSION['kr_search_address'])){
    $kr_search_adrress=$_SESSION['kr_search_address'];
    }

   // $home_search_text=Yii::app()->functions->getOptionAdmin('home_search_text');
    if (empty($home_search_text)){
   // $home_search_text=Yii::t("default","Find restaurants near you");
    } 
   	//$placholder_search=Yii::t("default","Street Address,City,State");
    //$home_search_subtext=Yii::app()->functions->getOptionAdmin('home_search_subtext');
    if (empty($home_search_subtext)){
    // $home_search_subtext=Yii::t("default","Order Delivery Food Online From Local Restaurants");
    }
    $citys=Yii::app()->functions->getLocationCity();

     $currentCity="";                           
     if(isset(Yii::app()->session['myCity'])){
             
        $currentCity = Yii::app()->session['myCity'];
     }
     $category = "";
     if(isset(Yii::app()->session['category'])){
        $category = Yii::app()->session['category']; 
     }
    
  /*if ( Yii::app()->controller->action->id =="index"):*/
		?>
  <form  action="<?php echo baseUrl()."/store/searchArea"?>" class="forms-search" id="forms-search" method="GET">
    <article class="clearfix m-t-120">
        <div class="col-md-3 p-lr-0 col-md-offset-1 col-sm-5">
            <div class="input-group full-width">
                <span class="input-group-addon search-addon" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                <select data-validation-error-msg="You did not select city" data-validation="required" class="form-control selectpicker" data-width="100%" name="city" id="citySearchSelect">
                   <?php if(!empty($citys)):
                       foreach($citys as $city):?>
                    <option <?php if(strtolower(strtolower($city['city'])) == strtolower($currentCity)):echo"selected";endif;?> value="<?php echo $city['cid'];?>"><?php echo ucwords($city['city']);?></option>
                       <?php endforeach; endif;?>
<!--                    <option value="indore" selected>Indore</option>-->
                </select>
            </div>
        </div>
        <div class="col-md-3 p-lr-0 col-sm-5">
            <div class="input-group full-width">
<!--                <span class="input-group-addon search-addon" id="basic-addon1"><i class="fa fa-tags"></i></span>-->
                <select data-validation-error-msg="You did not select category" data-validation="required" class="form-control selectpicker" data-width="100%" name="categorys" id="categorySelect">
                        
                    <option value="all" <?php if(strtolower(strtolower($category)) == "all"):echo"selected";endif;?>>All</option>
                    <option value="restaurants" <?php if(strtolower(strtolower($category)) == "restaurants"):echo"selected";endif;?>>Restaurants</option>
                    <option value="bakeries" <?php if(strtolower(strtolower($category)) == "bakeries"):echo"selected";endif;?>>Bakeries</option>
                    <option value="cafe" <?php if(strtolower(strtolower($category)) == "cafe"):echo"selected";endif;?>>Cafe</option>
                    <option value="sweet" <?php if(strtolower(strtolower($category)) == "sweet"):echo"selected";endif;?>>Sweet</option>
                    
                </select>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 m-tb-xs-10 p-lr-0">
<!--                    <input type="text" placeholder="Location" class="form-control custom-input">-->
            <input data-validation-error-msg="You did not enter a valid address" type="text" data-validation="required" class="form-control custom-input" name="s" id="s" placeholder="<?php echo Yii::t("default",$placholder_search)?>" value="" />
           
        </div>
        <div class="col-md-1 col-sm-1 col-sm-offset-0 col-xs-6 col-xs-offset-3 p-lr-0">
             <button type="submit" class="btn btn-block btn-search">
                <i class="fa fa-search visible-sm visible-md"></i><span class="hidden-sm hidden-md">Search</span>
              </button>
        </div>
       
    </article>
       
  </form>
		<?php
		/*endif; */
     
 }

	public function searchBox()
	{
		$kr_search_adrress='';
		if (isset($_SESSION['kr_search_address'])){
			$kr_search_adrress=$_SESSION['kr_search_address'];
		}
		
		$home_search_text=Yii::app()->functions->getOptionAdmin('home_search_text');
		if (empty($home_search_text)){
			$home_search_text=Yii::t("default","Find restaurants near you");
		}
		
		$home_search_subtext=Yii::app()->functions->getOptionAdmin('home_search_subtext');
		if (empty($home_search_subtext)){
			$home_search_subtext=Yii::t("default","Order Delivery Food Online From Local Restaurants");
		}
		
		$home_search_mode=Yii::app()->functions->getOptionAdmin('home_search_mode');
		$placholder_search=Yii::t("default","Street Address,City,State");
		if ( $home_search_mode=="postcode" ){
			$placholder_search=Yii::t("default","Enter your postcode");
		}
		$placholder_search=Yii::t("default",$placholder_search);
		if ( Yii::app()->controller->action->id =="index"):
		?>
		<div class="banner-wrap">
		<div class="search-wrap">  
		  <div data-animation="fadeIn" class="counter animated hiding" data-delay="500" >
			   <div class="search-wrapper rounded2">
			      <div class="inner">
			        <h2><?php echo Yii::t("default",$home_search_text)?></h2>       
			        <p class="uk-text-muted"><?php echo Yii::t("default","Enter Your address below")?>:</p> 
			        <div class="search-input-wrap">
			        
			        <form class="forms-search" id="forms-search" action="<?php echo baseUrl()."/store/searchArea"?>">
			          <input type="text" data-validation="required" name="s" id="s" placeholder="<?php echo Yii::t("default",$placholder_search)?>" value="<?php echo $kr_search_adrress;?>" >
			          <button type="submit"><i class="fa fa-search"></i></button>
			        </form>
			          
			        </div>			        
			        <p><?php echo Yii::t("default",$home_search_subtext)?> </p>			        
			      </div>
			   </div>
		   </div> <!--animated-->
		   </div> <!--search-wrap-->
		</div> <!--END header-wrap-->
		<?php
		endif;		
	}
	
	public function timezoneList()
	{
			$t= array (
			'(UTC-11:00) Midway Island' => 'Pacific/Midway',
			'(UTC-11:00) Samoa' => 'Pacific/Samoa',
			'(UTC-10:00) Hawaii' => 'Pacific/Honolulu',
			'(UTC-09:00) Alaska' => 'US/Alaska',
			'(UTC-08:00) Pacific Time (US &amp; Canada)' => 'America/Los_Angeles',
			'(UTC-08:00) Tijuana' => 'America/Tijuana',
			'(UTC-07:00) Arizona' => 'US/Arizona',
			'(UTC-07:00) Chihuahua' => 'America/Chihuahua',
			'(UTC-07:00) La Paz' => 'America/Chihuahua',
			'(UTC-07:00) Mazatlan' => 'America/Mazatlan',
			'(UTC-07:00) Mountain Time (US &amp; Canada)' => 'US/Mountain',
			'(UTC-06:00) Central America' => 'America/Managua',
			'(UTC-06:00) Central Time (US &amp; Canada)' => 'US/Central',
			'(UTC-06:00) Guadalajara' => 'America/Mexico_City',
			'(UTC-06:00) Mexico City' => 'America/Mexico_City',
			'(UTC-06:00) Monterrey' => 'America/Monterrey',
			'(UTC-06:00) Saskatchewan' => 'Canada/Saskatchewan',
			'(UTC-05:00) Bogota' => 'America/Bogota',
			'(UTC-05:00) Eastern Time (US &amp; Canada)' => 'US/Eastern',
			'(UTC-05:00) Indiana (East)' => 'US/East-Indiana',
			'(UTC-05:00) Lima' => 'America/Lima',
			'(UTC-05:00) Quito' => 'America/Bogota',
			'(UTC-04:00) Atlantic Time (Canada)' => 'Canada/Atlantic',
			'(UTC-04:30) Caracas' => 'America/Caracas',
			'(UTC-04:00) La Paz' => 'America/La_Paz',
			'(UTC-04:00) Santiago' => 'America/Santiago',
			'(UTC-03:30) Newfoundland' => 'Canada/Newfoundland',
			'(UTC-03:00) Brasilia' => 'America/Sao_Paulo',
			'(UTC-03:00) Buenos Aires' => 'America/Argentina/Buenos_Aires',
			'(UTC-03:00) Georgetown' => 'America/Argentina/Buenos_Aires',
			'(UTC-03:00) Greenland' => 'America/Godthab',
			'(UTC-02:00) Mid-Atlantic' => 'America/Noronha',
			'(UTC-01:00) Azores' => 'Atlantic/Azores',
			'(UTC-01:00) Cape Verde Is.' => 'Atlantic/Cape_Verde',
			'(UTC+00:00) Casablanca' => 'Africa/Casablanca',
			'(UTC+00:00) Edinburgh' => 'Europe/London',
			'(UTC+00:00) Greenwich Mean Time : Dublin' => 'Etc/Greenwich',
			'(UTC+00:00) Lisbon' => 'Europe/Lisbon',
			'(UTC+00:00) London' => 'Europe/London',
			'(UTC+00:00) Monrovia' => 'Africa/Monrovia',
			'(UTC+00:00) UTC' => 'UTC',
			'(UTC+01:00) Amsterdam' => 'Europe/Amsterdam',
			'(UTC+01:00) Belgrade' => 'Europe/Belgrade',
			'(UTC+01:00) Berlin' => 'Europe/Berlin',
			'(UTC+01:00) Bern' => 'Europe/Berlin',
			'(UTC+01:00) Bratislava' => 'Europe/Bratislava',
			'(UTC+01:00) Brussels' => 'Europe/Brussels',
			'(UTC+01:00) Budapest' => 'Europe/Budapest',
			'(UTC+01:00) Copenhagen' => 'Europe/Copenhagen',
			'(UTC+01:00) Ljubljana' => 'Europe/Ljubljana',
			'(UTC+01:00) Madrid' => 'Europe/Madrid',
			'(UTC+01:00) Paris' => 'Europe/Paris',
			'(UTC+01:00) Prague' => 'Europe/Prague',
			'(UTC+01:00) Rome' => 'Europe/Rome',
			'(UTC+01:00) Sarajevo' => 'Europe/Sarajevo',
			'(UTC+01:00) Skopje' => 'Europe/Skopje',
			'(UTC+01:00) Stockholm' => 'Europe/Stockholm',
			'(UTC+01:00) Vienna' => 'Europe/Vienna',
			'(UTC+01:00) Warsaw' => 'Europe/Warsaw',
			'(UTC+01:00) West Central Africa' => 'Africa/Lagos',
			'(UTC+01:00) Zagreb' => 'Europe/Zagreb',
			'(UTC+02:00) Athens' => 'Europe/Athens',
			'(UTC+02:00) Bucharest' => 'Europe/Bucharest',
			'(UTC+02:00) Cairo' => 'Africa/Cairo',
			'(UTC+02:00) Harare' => 'Africa/Harare',
			'(UTC+02:00) Helsinki' => 'Europe/Helsinki',
			'(UTC+02:00) Istanbul' => 'Europe/Istanbul',
			'(UTC+02:00) Jerusalem' => 'Asia/Jerusalem',
			'(UTC+02:00) Kyiv' => 'Europe/Helsinki',
			'(UTC+02:00) Pretoria' => 'Africa/Johannesburg',
			'(UTC+02:00) Riga' => 'Europe/Riga',
			'(UTC+02:00) Sofia' => 'Europe/Sofia',
			'(UTC+02:00) Tallinn' => 'Europe/Tallinn',
			'(UTC+02:00) Vilnius' => 'Europe/Vilnius',
			'(UTC+03:00) Baghdad' => 'Asia/Baghdad',
			'(UTC+03:00) Kuwait' => 'Asia/Kuwait',
			'(UTC+03:00) Minsk' => 'Europe/Minsk',
			'(UTC+03:00) Nairobi' => 'Africa/Nairobi',
			'(UTC+03:00) Riyadh' => 'Asia/Riyadh',
			'(UTC+03:00) Volgograd' => 'Europe/Volgograd',
			'(UTC+03:30) Tehran' => 'Asia/Tehran',
			'(UTC+04:00) Abu Dhabi' => 'Asia/Muscat',
			'(UTC+04:00) Baku' => 'Asia/Baku',
			'(UTC+04:00) Moscow' => 'Europe/Moscow',
			'(UTC+04:00) Muscat' => 'Asia/Muscat',
			'(UTC+04:00) St. Petersburg' => 'Europe/Moscow',
			'(UTC+04:00) Tbilisi' => 'Asia/Tbilisi',
			'(UTC+04:00) Yerevan' => 'Asia/Yerevan',
			'(UTC+04:30) Kabul' => 'Asia/Kabul',
			'(UTC+05:00) Islamabad' => 'Asia/Karachi',
			'(UTC+05:00) Karachi' => 'Asia/Karachi',
			'(UTC+05:00) Tashkent' => 'Asia/Tashkent',
			'(UTC+05:30) Chennai' => 'Asia/Calcutta',
			'(UTC+05:30) Kolkata' => 'Asia/Kolkata',
			'(UTC+05:30) Mumbai' => 'Asia/Calcutta',
			'(UTC+05:30) New Delhi' => 'Asia/Calcutta',
			'(UTC+05:30) Sri Jayawardenepura' => 'Asia/Calcutta',
			'(UTC+05:45) Kathmandu' => 'Asia/Katmandu',
			'(UTC+06:00) Almaty' => 'Asia/Almaty',
			'(UTC+06:00) Astana' => 'Asia/Dhaka',
			'(UTC+06:00) Dhaka' => 'Asia/Dhaka',
			'(UTC+06:00) Ekaterinburg' => 'Asia/Yekaterinburg',
			'(UTC+06:30) Rangoon' => 'Asia/Rangoon',
			'(UTC+07:00) Bangkok' => 'Asia/Bangkok',
			'(UTC+07:00) Hanoi' => 'Asia/Bangkok',
			'(UTC+07:00) Jakarta' => 'Asia/Jakarta',
			'(UTC+07:00) Novosibirsk' => 'Asia/Novosibirsk',
			'(UTC+08:00) Beijing' => 'Asia/Hong_Kong',
			'(UTC+08:00) Chongqing' => 'Asia/Chongqing',
			'(UTC+08:00) Hong Kong' => 'Asia/Hong_Kong',
			'(UTC+08:00) Krasnoyarsk' => 'Asia/Krasnoyarsk',
			'(UTC+08:00) Kuala Lumpur' => 'Asia/Kuala_Lumpur',
			'(UTC+08:00) Perth' => 'Australia/Perth',
			'(UTC+08:00) Singapore' => 'Asia/Singapore',
			'(UTC+08:00) Taipei' => 'Asia/Taipei',
			'(UTC+08:00) Ulaan Bataar' => 'Asia/Ulan_Bator',
			'(UTC+08:00) Urumqi' => 'Asia/Urumqi',
			'(UTC+09:00) Irkutsk' => 'Asia/Irkutsk',
			'(UTC+09:00) Osaka' => 'Asia/Tokyo',
			'(UTC+09:00) Sapporo' => 'Asia/Tokyo',
			'(UTC+09:00) Seoul' => 'Asia/Seoul',
			'(UTC+09:00) Tokyo' => 'Asia/Tokyo',
			'(UTC+09:30) Adelaide' => 'Australia/Adelaide',
			'(UTC+09:30) Darwin' => 'Australia/Darwin',
			'(UTC+10:00) Brisbane' => 'Australia/Brisbane',
			'(UTC+10:00) Canberra' => 'Australia/Canberra',
			'(UTC+10:00) Guam' => 'Pacific/Guam',
			'(UTC+10:00) Hobart' => 'Australia/Hobart',
			'(UTC+10:00) Melbourne' => 'Australia/Melbourne',
			'(UTC+10:00) Port Moresby' => 'Pacific/Port_Moresby',
			'(UTC+10:00) Sydney' => 'Australia/Sydney',
			'(UTC+10:00) Yakutsk' => 'Asia/Yakutsk',
			'(UTC+11:00) Vladivostok' => 'Asia/Vladivostok',
			'(UTC+12:00) Auckland' => 'Pacific/Auckland',
			'(UTC+12:00) Fiji' => 'Pacific/Fiji',
			'(UTC+12:00) International Date Line West' => 'Pacific/Kwajalein',
			'(UTC+12:00) Kamchatka' => 'Asia/Kamchatka',
			'(UTC+12:00) Magadan' => 'Asia/Magadan',
			'(UTC+12:00) Marshall Is.' => 'Pacific/Fiji',
			'(UTC+12:00) New Caledonia' => 'Asia/Magadan',
			'(UTC+12:00) Solomon Is.' => 'Asia/Magadan',
			'(UTC+12:00) Wellington' => 'Pacific/Auckland',
			'(UTC+13:00) Nuku\'alofa' => 'Pacific/Tongatapu'
			);
			
			$t=array_flip($t);
			return $t;
	}
	
	public function searchAdvanced()
	{
		$kr_search_adrress='';		
		if (isset($_SESSION['kr_search_address'])){
			$kr_search_adrress=$_SESSION['kr_search_address'];
		}
		
		$home_search_text=Yii::app()->functions->getOptionAdmin('home_search_text');
		if (empty($home_search_text)){
			$home_search_text=Yii::t("default","Find restaurants near you");
		}
		
		$home_search_subtext=Yii::app()->functions->getOptionAdmin('home_search_subtext');
		if (empty($home_search_subtext)){
			$home_search_subtext=Yii::t("default","Order Delivery Food Online From Local Restaurants");
		}
		
		$home_search_mode=Yii::app()->functions->getOptionAdmin('home_search_mode');
		$placholder_search=Yii::t("default","Street Address,City,State");
		if ( $home_search_mode=="postcode" ){
			$placholder_search=Yii::t("default","Enter your postcode");
		}
		$placholder_search=Yii::t("default",$placholder_search);
		
		?>
		<div class="advance-search" id="advance-search">
		<div class="banner-wrap">
		   <div class="search-wrap">
		   <div data-animation="fadeIn" class="counter animated hiding" data-delay="500" >
		   
		   <div id="search-tabs">
		      <ul>
				<li><a href="#tabs-1" class="adv-a" data-id="1"><?php echo t("Search by address")?></a></li>
				<li><a href="#tabs-2" class="adv-a" data-id="2"><?php echo t("Restaurant name")?></a></li>
				<li><a href="#tabs-3" class="adv-a" data-id="3"><?php echo t("Street name");?></a></li>
				<li><a href="#tabs-4" class="adv-a" data-id="4"><?php echo t("Cuisine")?></a></li>
				<li><a href="#tabs-5" class="adv-a" data-id="4"><?php echo t("Food")?></a></li>
			  </ul>
			  			               				
			  <div id="tabs-1">
			  
			    <div class="inner">
			        <h2><?php echo Yii::t("default",$home_search_text)?></h2>       
			        <p class="uk-text-muted"><?php echo Yii::t("default","Enter Your address below")?>:</p> 
			        <div class="search-input-wrap">
			        
			        <form class="forms-search" id="forms-search" action="<?php echo baseUrl()."/store/searchArea"?>">
			          <input type="text" data-validation="required" name="s" id="s" placeholder="<?php echo Yii::t("default",$placholder_search)?>" value="<?php echo $kr_search_adrress;?>" >
			          <button type="submit"><i class="fa fa-search"></i></button>
			        </form>
			          
			        </div>			        
			        <p><?php echo Yii::t("default",$home_search_subtext)?> </p>			        
			      </div>
			  
			  </div> <!--end tab-->
			  
			  <div id="tabs-2">
			  
			     <div class="inner">			     
			        <h2><?php echo Yii::t("default","Find Restaurant by Name")?></h2>			        
			        <div class="search-input-wrap">			        
			        <form class="forms-search" id="forms-search" action="<?php echo baseUrl()."/store/searchArea"?>">
			        
			        <?php echo CHtml::hiddenField('st',$kr_search_adrress,array('class'=>"st"));	?>
			        
			        <div class="uk-autocomplete uk-form" data-uk-autocomplete="{source:'store/autoresto',minLength:2}">
			        <input type="text" data-validation="required" name="restaurant-name" 
		                id="restaurant-name" placeholder="<?php echo t("Restaurant name")?>" >
			        </div>
			          <button type="submit"><i class="fa fa-search"></i></button>			        
			          
			        </form>			        			          
			        </div>			        
			        <p><?php echo Yii::t("default",$home_search_subtext)?> </p>			        
			      </div> <!--inner-->
			  </div>  <!--tab 2-->
			  
			  <div id="tabs-3">
			  
			     <div class="inner">			     
			        <h2><?php echo Yii::t("default","Find Restaurant by Street name")?></h2>			        
			        <div class="search-input-wrap">			        
			        <form class="forms-search" id="forms-search" action="<?php echo baseUrl()."/store/searchArea"?>">
			        
			        <?php echo CHtml::hiddenField('st',$kr_search_adrress,array('class'=>"st"));	?>
			        
			        <div class="uk-autocomplete uk-form" data-uk-autocomplete="{source:'store/autostreetname',minLength:2}">
			        <input type="text" data-validation="required" name="street-name" 
		                id="street-name" placeholder="<?php echo t("Street name")?>" >
			        </div>
			        
			          <button type="submit"><i class="fa fa-search"></i></button>
			        </form>			        			          
			        </div>			        
			        <p><?php echo Yii::t("default",$home_search_subtext)?> </p>			        
			      </div> <!--inner-->   
			  
			  </div> <!--tab 3-->
			  
			  <div id="tabs-4">
			  
			     <div class="inner">			     
			        <h2><?php echo Yii::t("default","Find Restaurant by Cuisine")?></h2>			        
			        <div class="search-input-wrap">			        
			        <form class="forms-search" id="forms-search" action="<?php echo baseUrl()."/store/searchArea"?>">
			        
			        <?php echo CHtml::hiddenField('st',$kr_search_adrress,array('class'=>"st"));	?>
			        
			        <div class="uk-autocomplete uk-form" data-uk-autocomplete="{source:'store/autocategory',minLength:2}">
			        <input type="text" data-validation="required" name="category" 
		                id="category" placeholder="<?php echo t("Enter Cuisine")?>" >
			        </div>
			        
			          <button type="submit"><i class="fa fa-search"></i></button>
			        </form>			        			          
			        </div>			        
			        <p><?php echo Yii::t("default",$home_search_subtext)?> </p>			        
			      </div> <!--inner-->   
			  
			  </div> <!--tab 4-->
			  
			  <div id="tabs-5">
			     <div class="inner">	
			        <h2><?php echo Yii::t("default","Find Restaurant by Food")?></h2>
			        
			        <div class="search-input-wrap">			        
			        <form class="forms-search" id="forms-search" action="<?php echo baseUrl()."/store/searchArea"?>">
			        
			        <?php echo CHtml::hiddenField('st',$kr_search_adrress,array('class'=>"st"));	?>
			        
			        <div class="uk-autocomplete uk-form" data-uk-autocomplete="{source:'store/autofoodname',minLength:2}">
			        <input type="text" data-validation="required" name="foodname" 
		                id="foodname" placeholder="<?php echo t("Enter Food Name")?>" >
			        </div>
			        
			          <button type="submit"><i class="fa fa-search"></i></button>
			        </form>			        			          
			        </div>			        
			        <p><?php echo Yii::t("default",$home_search_subtext)?> </p>			        
			        
			     </div> <!--inner-->
			  </div> <!--tabs-5-->
			  
		   </div> <!--end tabs-->
		   
		   </div>
		   </div> <!--search-wrap-->
		</div> <!--banner-wrap-->
		</div>
		<?php 
	}
	
	
	public function merchantGallery($merchant_id='')
	{				
		$gallery=Yii::app()->functions->getOption("merchant_gallery",$merchant_id);
        $gallery=!empty($gallery)?json_decode($gallery):false;
		?>		
		<div class="merchant-gallery-wrap">
		 <?php if (is_array($gallery) && count($gallery)>=1):?>
		    <?php foreach ($gallery as $val):?>
		    <a href="<?php echo uploadURL()."/".$val?>" title=""><img src="<?php echo uploadURL()."/".$val?>"></a>
		    <?php endforeach;?>
		 <?php else :?>
		 <p class="uk-text-danger"><?php echo t("gallery not available")?></p>
		 <?php endif;?>		 
		</div> <!--merchant-gallery-wrap-->
		<div class="clear"></div>
		<?php
	}
	
	public function offers($merchant_id='',$display=1)
	{		
		ob_start();
		$price_above=Yii::app()->functions->getOption("free_delivery_above_price",$merchant_id);				
		if (is_numeric($price_above) && $price_above>=1){
			?>
			<div class="offers-wrap">	
			<?php if ( $display==1):?>
			<?php echo t("Free Delivery On")." ".displayPrice(getCurrencyCode(),prettyFormat($price_above));?>
			<?php else :?>			
			<span style="font-size:11px;line-height:normal;">
			<?php echo t("Free Delivery On")." ".displayPrice(getCurrencyCode(),prettyFormat($price_above));?>
			</span>
			<?php endif;?>
			</div>
			<?php
		}
		
		if ( $res=Yii::app()->functions->getMerchantOffersActive($merchant_id)):
		?>
                  
		<div class="offers-wrap">				  
		  <?php if ( $display==1):?>
		  <?php echo number_format($res['offer_percentage'],0);?>% <?php echo t("off today on orders over")?> 
		  <?php echo displayPrice(getCurrencyCode(),prettyFormat($res['offer_price']));?>
		  <?php else :?>
		  <?php echo number_format($res['offer_percentage'],0);?>% <?php echo t("Off")?>
		  <?php endif;?>
		</div>
             
		<?php
		endif;
		$content = ob_get_contents();
        ob_end_clean();
        return $content;
	}
	
	public function featuredMerchant()
	{
		if ($res=Yii::app()->functions->getFeatureMerchant2()):				   
		?>
		<div class="featured-restaurant-list" id="featured-restaurant-list">
          <div class="main">          
           <h2><?php echo t("Featured Restaurants")?></h2>
           <div class="feature-merchant-loader"><i class="fa fa-spinner fa-spin"></i></div>
           
           <div class="bxslider-1">
           <ul class="bxslider"> 
           <?php foreach ($res as $val):?>
           <?php            
           $merchant_logo=$val['merchant_logo'];
           if (empty($merchant_logo)){
           	   $merchant_logo=assetsURL()."/images/thumbnail-mini.png";
           } else $merchant_logo=uploadURL()."/$merchant_logo";
           ?>
           <li>
           <a href="<?php echo baseUrl()."/store/menu/merchant/".$val['restaurant_slug']?>">
           <img src="<?php echo $merchant_logo?>" alt="<?php echo $val['restaurant_name']?>" />
           <p><?php echo $val['restaurant_name']?></p>
           </a>
           </li>           
           <?php endforeach;?>
           </ul>
           </div>
           
           
           <div class="bxslider-2">
           <ul class="bxslider2"> 
           <?php foreach ($res as $val):?>
           <?php            
           $merchant_logo=$val['merchant_logo'];
           if (empty($merchant_logo)){
           	   $merchant_logo=assetsURL()."/images/thumbnail-mini.png";
           } else $merchant_logo=uploadURL()."/$merchant_logo";
           ?>
           <li>
           <a href="<?php echo baseUrl()."/store/menu/merchant/".$val['restaurant_slug']?>">
           <img src="<?php echo $merchant_logo?>" alt="<?php echo $val['restaurant_name']?>" />
           <p><?php echo $val['restaurant_name']?></p>
           </a>
           </li>           
           <?php endforeach;?>
           </ul>
           </div>
           
           <div class="bxslider-3">
           <ul class="bxslider3"> 
           <?php foreach ($res as $val):?>
           <?php            
           $merchant_logo=$val['merchant_logo'];
           if (empty($merchant_logo)){
           	   $merchant_logo=assetsURL()."/images/thumbnail-mini.png";
           } else $merchant_logo=uploadURL()."/$merchant_logo";
           ?>
           <li>
           <a href="<?php echo baseUrl()."/store/menu/merchant/".$val['restaurant_slug']?>">
           <img src="<?php echo $merchant_logo?>" alt="<?php echo $val['restaurant_name']?>" />
           <p><?php echo $val['restaurant_name']?></p>
           </a>
           </li>           
           <?php endforeach;?>
           </ul>
           </div>
                     
        </div>
        </div> <!--featured-cuisine-list-->
		<?php
		endif;
	}
	
 public function frontfeaturedMerchant(){
  
     		if ($res=Yii::app()->functions->getFeatureMerchant2()):		?>
           <?php $counts=1; foreach ($res as $val):if($counts <=4):?> 
          <?php            
           $merchant_logo=$val['merchant_logo'];
           if (empty($merchant_logo)){
           	   $merchant_logo=assetsURL()."/images/thumbnail-mini.png";
           } else $merchant_logo=uploadURL()."/$merchant_logo";
           ?>
           <figcaption class="col-md-3 col-sm-3">
                    <aside class="pop-hotel">
                        <a href="<?php echo baseUrl()."/store/menu/merchant/".$val['restaurant_slug']?>">
                       <div class="thumbnail">
                            <div class="caption">
                                <h4><?php echo ucwords($val['restaurant_name']);?></h4>
                            </div>
                            <img src="<?php echo $merchant_logo;?>" alt="" class="img-responsive">
                        </div>
                       </a>
                    </aside>
           </figcaption>
           
     <?php $counts++; endif;endforeach;endif;		
 }
  public function frontfeaturedMerchantNext(){
  
     		if ($res=Yii::app()->functions->getMerchantAll()):	?>
           <?php $counts=1; foreach ($res as $val):if($counts <=7):?> 
          <?php            
           $merchant_logo=$val['merchant_logo'];
           if (empty($merchant_logo)){
           	   $merchant_logo=assetsURL()."/images/about-us.png";
           } else $merchant_logo=uploadURL()."/$merchant_logo";
           ?>
           <figcaption class="col-md-3 col-sm-3">
                    <aside class="pop-hotel">
                       <a href="<?php echo baseUrl()."/store/reviews/".$val['merchant_id']?>">
                       <div class="thumbnail">
                            <div class="caption">
                                <h4><?php echo ucwords($val['restaurant_name']);?></h4>
                            </div>
                            <img src="<?php echo $merchant_logo;?>" alt="" class="img-responsive">
                        </div>
                       </a>   
                    </aside>
           </figcaption>
           
     <?php $counts++; endif; endforeach;?>
         <figcaption class="col-md-3 col-sm-3">
                     <aside class="pop-hotel">
                          <a href="<?php echo $this->createUrl('store/searchArea',array('cu'=>'all')); ?>">
                           <div class="thumbnail">
                                <div class="caption">
                                    <h4>More</h4>
                                </div>
                                <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/Hotel8.png" alt="" class="img-responsive">
                            </div>
                          </a>   
                    </aside>
        </figcaption>
    <?php endif;		
 }
 
 public function frontCuisineList(){
     if($cuisine=Yii::app()->functions->Cuisine(true)):?>
         
        <h1>See what people are ordering in <span class="selectCity cl_yellow"><?php  if(isset(Yii::app()->session['myCity'])){   
        echo ucwords(Yii::app()->session['myCity']);
     }?></span></h1>
        <ul class="list-inline text-center">
         <?php $counts=1; if(!empty($cuisine)):foreach ($cuisine as $key=>$value):if($counts <= 21):?>
            <li><a href="<?php echo $this->createUrl('store/searchArea',array('name'=>$value,'id'=>$key));?>"><?php echo ucwords($value); ?></a></li>
            <?php $counts++; endif;endforeach; endif;?>
        </ul>
            
   <?php endif;
 }
 
  public function frontSponseredMerchant(){
     if($merchant=Yii::app()->functions->frontFeaturedMerchantList()):
     foreach ($merchant as $rest):
         $img = ($rest['sponsored_image']) ? uploadURL().'/'.$rest['sponsored_image'] : uploadURL().'/100X100.png'?>
        <aside class="col-md-3 m-t-xs-10 col-sm-6">
            <a href="<?php echo Yii::app()->CreateUrl('/store/menu/merchant/'.$rest['restaurant_slug']);?>" title="<?php echo $rest['restaurant_name'];?>"> <img width="227" height="270" src="<?php echo $img;?>" class="img-responsive" alt=""></a>
        </aside>
            
    <?php endforeach; endif;
 }
 
 public function frontCuisionpopular1(){
     
     ?>
                 <article class="col-md-2 col-sm-4 col-xs-6">
                 <aside class="pop-dish">
                     <a href="<?php echo $this->createUrl('store/searchArea',array('cu'=>'pizza'));?>">
                        <div class="thumbnail">
                        <div class="caption">
                            <h4>Pizza</h4>
                        </div>
                        <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/pizza.png" alt="" class="img-responsive">
                        </div>
                     </a>
                </aside>
             </article>
            <article class="col-md-2 col-sm-4 col-xs-6">
                 <aside class="pop-dish">
                     <a href="<?php echo $this->createUrl('store/searchArea',array('cu'=>'chinese'));?>">
                    <div class="thumbnail">
                    <div class="caption">
                        <h4>Chinese</h4>
                       </div>
                    <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/chinese.png" alt="" class="img-responsive">
                    </div>
                    </a> 
                </aside>
             </article>
              <article class="col-md-2 col-sm-4 col-xs-6 cusine-hide">

                 <aside class="pop-dish">
                      <a href="<?php echo $this->createUrl('store/searchArea',array('cu'=>'non veg'));?>">
                        <div class="thumbnail">
                        <div class="caption">
                            <h4>Non Veg</h4>
                           </div>
                        <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/Non-veg.png" alt="" class="img-responsive">
                        </div>
                      </a>
                 </aside>
             </article>
              <article class="col-md-2 col-sm-4 col-xs-6 cusine-hide">
                     <aside class="pop-dish">
                      <a href="<?php echo $this->createUrl('store/searchArea',array('cu'=>'veg'));?>">
                        <div class="thumbnail">
                        <div class="caption">
                            <h4>Veg</h4>
                           </div>
                        <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/Sushi.png" alt="" class="img-responsive">
                        </div>
                      </a>
                     </aside>
             </article>
             <article class="col-md-2 col-sm-4 col-xs-6 cusine-hide">
                     <aside class="pop-dish">
                          <a href="<?php echo $this->createUrl('store/searchArea',array('cu'=>'thai'));?>">
                        <div class="thumbnail">
                        <div class="caption">
                            <h4>Thai</h4>
                           </div>
                        <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/thai.png" alt="" class="img-responsive">
                        </div>
                          </a>
                    </aside>
             </article>
             <article class="col-md-2 col-sm-4 col-xs-6 cusine-hide">
                     <aside class="pop-dish">
                          <a href="<?php echo $this->createUrl('store/searchArea',array('cu'=>'veg'));?>">
                        <div class="thumbnail">
                        <div class="caption">
                            <h4>Veg</h4>
                           </div>
                        <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/Veg.png" alt="" class="img-responsive">
                        </div>
                          </a>
                    </aside>
             </article> 
            <article class="visible-xs">
               <button class="btn btn-sm show-cusine-btn pull-right"><span class="cusine-text">Show All</span><span class="cusine-text" style="display:none">Show Less</span></button>
            </article>
        
    <?php
 }
 
  public function frontCuisionpopular(){
     
      //$imageArray = array('pizza.png','chinese.png','Non-veg.png','Sushi.png','thai.png','Veg.png','');                          
      if($cuisine=Yii::app()->functions->CuisineFeatured(false)):?>
        <?php $counts=1; $ct=0; if(!empty($cuisine)):foreach ($cuisine as $key=>$value):if($counts <= 6):?>
                 <article class="col-md-2 col-sm-4 col-xs-6 cusine-hide">
                 <aside class="pop-dish">
                     <a href="<?php echo $this->createUrl('store/searchArea',array('name'=>$value['cuisine_name'],'id'=>$value['cuisine_id']));?>">
                        <div class="thumbnail">
                        <div class="caption">
                            <h4><?php echo ucwords($value['cuisine_name']); ?></h4>
                        </div>
     <img src="<?php echo (!empty($value['image'])) ?  Yii::app()->request->baseUrl.'/upload/'.$value['image'] : Yii::app()->request->baseUrl.'/assets/images/about-us.png';?>" alt="" class="img-responsive">
                        </div>
                     </a>
                </aside>
             </article>
        
           <?php $counts++;$ct++; endif;endforeach; endif;?>
            <article class="visible-xs">
               <button class="btn btn-sm show-cusine-btn pull-right"><span class="cusine-text">Show All</span><span class="cusine-text" style="display:none">Show Less</span></button>
            </article>
    <?php endif;
 }
 
	public function displayMenu($menu='',$mode='',$mtid='')
	{		
		?>
		<?php if ( $mode==2 || $mode==1):?>
		<div class="<?php echo $mode==2?"active-menu-2":"active-menu-$mode"?>">
				
		<div class="categories-wrap-mobile">
		<div data-uk-dropdown="{mode:'click'}" class="uk-button-dropdown">
	    <button class="uk-button"><?php echo Yii::t("default","Categories")?> <span class="sortby_text"></span><i class="uk-icon-caret-down"></i></button>
	    <div class="uk-dropdown" >
	        <ul class="uk-nav uk-nav-dropdown">
	        <?php foreach ($menu as $val):?>
	        <li>
	        <a href="javascript:;" data-id="cat-<?php echo $val['category_id']?>" class="goto-category">
	        <?php echo ucwords($val['category_name'])?>
	        </a>
	       </li>
	        <?php endforeach;?>    
	        </ul>
	    </div>
	    </div>	  
	    </div> <!--categories-wrap-->  
	    <!--<div class="clear"></div>-->
		
		<?php foreach ($menu as $val): //dump($val);?>
		  <h2 class="cat-<?php echo $val['category_id']?>">
		  <?php echo qTranslate($val['category_name'],'category_name',$val)?>
		  <?php //echo Widgets::displayCatSpicyIconByID($val['category_id'])?>
		  <?php echo Widgets::displaySpicyIconNew($val['dish'])?>
		  </h2>
		  
		  <?php if (!empty($val['category_description'])):?>
		  <p><?php echo qTranslate($val['category_description'],'category_description',$val)?></p>
		  <?php endif;?>
		  
		  <p style="margin-top:-10px;" class="uk-text-small uk-text-muted"><?php echo Widgets::categorySpicyNotes($val['category_id']);?></span>
		  <?php if (is_array($val['item']) && count($val['item'])>=1):?>
		  
		  <?php $x=1;?>		  		 
		  <?php foreach ($val['item'] as $item): //dump($item);?>		 
		  <?php 		  
		  $atts='';
		  if ( $item['single_item']==2){
		  	  $atts.='data-price="'.$item['single_details']['price'].'"';
		  	  $atts.=" ";
		  	  $atts.='data-size="'.$item['single_details']['size'].'"';
		  }
		  ?>
           <a href="javascript:;" rel="<?php echo $item['item_id']?>" 
		   class="menu-item <?php echo $item['not_available']==2?"item_not_available":''?>" 
		   data-single="<?php echo $item['single_item']?>" 		   
		   <?php echo $atts;?>
		   >

		  <div class="table-div <?php echo count($val['item'])==$x?"last":''?>">
		    <div class="table-col-1"><?php Widgets::displayMenuPic($item['photo'])?></div>
		    <div class="table-col-2">
		        <div class="ux-price">
		         <samp></samp>
		         <h4>
		         <?php echo qTranslate($item['item_name'],'item_name',$item)?>
		         <?php echo Widgets::displaySpicyIconNew($item['dish']);?> 
		         </h4>
		         <?php //echo Widgets::displaySpicyIcon($item['spicydish'],'',$mtid);?> 		         
		         
		         <h5 class="hide-food-price">
		         <?php if ( !empty($item['discount'])):?>
		           <span class="strike-tru">
		           <?php echo displayPrice(getCurrencyCode(),
		            prettyFormat($item['prices'][0]['price']))?>
		           </span>
                  <?php echo displayPrice(getCurrencyCode(),
                     prettyFormat($item['prices'][0]['price']-$item['discount']))?>
		         <?php else :?>
		         <?php echo displayPrice(getCurrencyCode(),prettyFormat($item['prices'][0]['price']))?>
		         <?php endif;?>		         
		         </h5>
		        </div>
		        <p><?php echo qTranslate($item['item_description'],'item_description',$item)?></p>
		        <?php if ($item['not_available']==2):?>
		        <p class="uk-text-danger"><?php echo t("This item is not available")?></p>
		        <?php endif;?>
		    </div>
		  </div>
		  </a>
		  <?php $x++;?>
		  <?php endforeach;?>
		  
		  <?php else :?>
		  <p class="uk-text-muted"><?php echo t("No food item");?></p>
		  <?php endif;?>
		<?php endforeach;?>
		</div> <!--active-menu-2-->
		<?php endif;?>
		
		<?php
	}
        
        public function getDeliveryOption($merchant_id = ''){
            
            $res = Yii::app()->functions->MerchantDeliveryOption($merchant_id);
            $optionButton = "";
            if($res){
                
     
                      switch ($res) {
                        case 2:
                            $optionButton =  " <div class='col-lg-6 col-md-12 col-sm-12 col-xs-6'>
                                 <label><input type='radio' value='delivery' checked name='delivery_type' class='icheck'>    Delivery</label>
                             </div>"; 
                            break;
                        case 3:
                            $optionButton =  " <div class='col-lg-6 col-md-12 col-sm-12 col-xs-6'>
                                 <label><input type='radio' value='pickup' checked name='delivery_type' class='icheck'> Pickup</label>
                             </div>"; 
                            break;
                        default:
                            $optionButton =  " <div class='col-lg-6 col-md-12 col-sm-12 col-xs-6'>
                                 <label><input type='radio' value='delivery' checked name='delivery_type' class='icheck'> Delivery</label>
                             </div><div class='col-lg-6 col-md-12 col-sm-12 col-xs-6'>
                                 <label><input type='radio' value='pickup'  name='delivery_type' class='icheck'> Pickup</label>
                             </div>";
                            break;
                    }
                return $optionButton;
            }
        }
	
	public function displayMenuPic($image='')
	{		
		$path_to_upload=Yii::getPathOfAlias('webroot')."/upload/$image";
		$url_image=uploadURL()."/$image";
		$url_none_image=assetsURL()."/images/thumbnail-mini.png";		
		if (file_exists($path_to_upload) && !empty($image)){			
			echo "<img src=\"$url_image\" alt=\"\" title=\"\">";
		} else echo "<img src=\"$url_none_image\" alt=\"\" title=\"\">"; 
	}
	
public function merchantPaymentList($merchant_id='')
	{		
		?>
		<h3><?php echo Yii::t("default","Choose how to pay")?></h3>
		<?php			

		$is_commision=false;
		if ( Yii::app()->functions->isMerchantCommission($merchant_id)){			
			$is_commision=true;
		}
		 
        $paymentgateway=Yii::app()->functions->getMerchantListOfPaymentGateway();        
        
        $enabled_paypal=Yii::app()->functions->getOption('enabled_paypal',$merchant_id);        
        $enabled_paypal=$enabled_paypal=="yes"?true:false;     
        if ( $enabled_paypal==true){
        	$enabled_paypal=in_array("paypal",(array)$paymentgateway)?true:false; 
        } 
                        
        $enabled_stripe=Yii::app()->functions->getOption('stripe_enabled',$merchant_id);        
        $enabled_stripe=$enabled_stripe=="yes"?true:false;     
        if ( $enabled_stripe==true){
        	$enabled_stripe=in_array("stripe",(array)$paymentgateway)?true:false; 
        }           
        
        $merchant_mercado_enabled=Yii::app()->functions->getOption('merchant_mercado_enabled',$merchant_id);         
        $merchant_mercado_enabled=$merchant_mercado_enabled=="yes"?true:false;             
        if ( $merchant_mercado_enabled==true){
        	$merchant_mercado_enabled=in_array("mercadopago",(array)$paymentgateway)?true:false; 
        }           
                
        $merchant_disabled_cod=Yii::app()->functions->getOption('merchant_disabled_cod',$merchant_id);                
        if (!in_array("cod",(array)$paymentgateway)){
        	$merchant_disabled_cod="yes";
        }
        $merchant_disabled_ccr=Yii::app()->functions->getOption('merchant_disabled_ccr',$merchant_id);                
        if (!in_array("ocr",(array)$paymentgateway)){
        	$merchant_disabled_ccr="yes";
        }

                       
        $merchant_sisow_enabled=Yii::app()->functions->getOption('merchant_sisow_enabled',$merchant_id);                 
        $merchant_sisow_enabled=$merchant_sisow_enabled=="yes"?true:false;     
        if ( $merchant_sisow_enabled==true){
        	$merchant_sisow_enabled=in_array("ide",(array)$paymentgateway)?true:false; 
        }           
        
        $merchant_payu_enabled=Yii::app()->functions->getOption('merchant_payu_enabled',$merchant_id);        
        $merchant_payu_enabled=$merchant_payu_enabled=="yes"?true:false;     
        if ( $merchant_payu_enabled==true){
        	$merchant_payu_enabled=in_array("payu",(array)$paymentgateway)?true:false; 
        } 

        $merchant_ccAvenue_enabled=Yii::app()->functions->getOption('merchant_ccAvenue_enabled',$merchant_id);        
        $merchant_ccAvenue_enabled=$merchant_ccAvenue_enabled=="yes"?true:false;     
        if ( $merchant_ccAvenue_enabled==true){
        	$merchant_ccAvenue_enabled=in_array("cca",(array)$paymentgateway)?true:false; 
        }  
        
        $merchant_paysera_enabled=Yii::app()->functions->getOption('merchant_paysera_enabled',$merchant_id);        
        $merchant_paysera_enabled=$merchant_paysera_enabled=="yes"?true:false;     
        if ( $merchant_paysera_enabled==true){
        	$merchant_paysera_enabled=in_array("pys",(array)$paymentgateway)?true:false; 
        }   
        
        $payon_delivery_enabled=Yii::app()->functions->getOption('merchant_payondeliver_enabled',$merchant_id);         
        $payon_delivery_enabled=$payon_delivery_enabled=="yes"?true:false;                  

        if ( $payon_delivery_enabled==true){
            $payon_delivery_enabled=in_array("pyr",(array)$paymentgateway)?true:false;
        }
                       
        $merchant_enabled_barclay=Yii::app()->functions->getOption('merchant_enabled_barclay',$merchant_id);
        $merchant_enabled_barclay=$merchant_enabled_barclay=="yes"?true:false;     
        if ( $merchant_enabled_barclay==true){
        	$merchant_enabled_barclay=in_array("bcy",(array)$paymentgateway)?true:false; 
        }   
        
        $merchant_enabled_epaybg=Yii::app()->functions->getOption('merchant_enabled_epaybg',$merchant_id);
        $merchant_enabled_epaybg=$merchant_enabled_epaybg=="yes"?true:false;     
        if ( $merchant_enabled_epaybg==true){
        	$merchant_enabled_epaybg=in_array("epy",(array)$paymentgateway)?true:false; 
        } 
        
        /*AUTHORIZE.NET*/
        $merchant_enabled_autho=Yii::app()->functions->getOption('merchant_enabled_autho',$merchant_id);        
        $merchant_enabled_autho=$merchant_enabled_autho=="yes"?true:false;     
        if ( $merchant_enabled_autho==true){
        	$merchant_enabled_autho=in_array("atz",(array)$paymentgateway)?true:false; 
        }
        
        /*OFFLINE BANK DEPOSIT*/
        $mt_bankdeposit_enabled=Yii::app()->functions->getOption('merchant_bankdeposit_enabled',$merchant_id);        
        $mt_bankdeposit_enabled=$mt_bankdeposit_enabled=="yes"?true:false;     
        if ( $mt_bankdeposit_enabled==true){
        	$mt_bankdeposit_enabled=in_array("obd",(array)$paymentgateway)?true:false; 
        }        
        
        /*IF MERCHANT COMMISION*/  
        if ($is_commision){        	
            $enabled_paypal=in_array("paypal",(array)$paymentgateway)?true:false; 
            $enabled_stripe=in_array("stripe",(array)$paymentgateway)?true:false; 
            $merchant_mercado_enabled=in_array("mercadopago",(array)$paymentgateway)?true:false; 
            $merchant_sisow_enabled=in_array("ide",(array)$paymentgateway)?true:false; 
            $merchant_payu_enabled=in_array("payu",(array)$paymentgateway)?true:false; 
            $merchant_ccAvenue_enabled=in_array("cca",(array)$paymentgateway)?true:false; 
            $merchant_paysera_enabled=in_array("pys",(array)$paymentgateway)?true:false; 
            $merchant_enabled_barclay=in_array("bcy",(array)$paymentgateway)?true:false; 
            $merchant_enabled_epaybg=in_array("epy",(array)$paymentgateway)?true:false;    
            $payon_delivery_enabled=in_array("pyr",(array)$paymentgateway)?true:false;          
            $merchant_enabled_autho=in_array("atz",(array)$paymentgateway)?true:false;                                 
            $mt_bankdeposit_enabled=in_array("obd",(array)$paymentgateway)?true:false;                                 
        } 
        
        /** master offline swicth*/
        $merchant_switch_master_cod=Yii::app()->functions->getOption("merchant_switch_master_cod",$merchant_id);
        $merchant_switch_master_ccr=Yii::app()->functions->getOption("merchant_switch_master_ccr",$merchant_id);   
        $merchant_switch_master_pyr=Yii::app()->functions->getOption("merchant_switch_master_pyr",$merchant_id);   
        if ( $merchant_switch_master_cod==2){
        	$merchant_disabled_cod="yes";
        }	
        if ( $merchant_switch_master_ccr==2){
        	$merchant_disabled_ccr="yes";
        } 
        if ($merchant_switch_master_pyr==2){
        	$payon_delivery_enabled=false;
        }               
        ?>
         
         <div class="uk-panel uk-panel-box">
         
         <?php if ($merchant_disabled_cod!="yes"):?>
         <div class="uk-form-row">
         <?php echo CHtml::radioButton('payment_opt',false,
         array('class'=>"payment_cod icheck payment_option",'value'=>'cod'))?> <?php echo Yii::t("default","Cash On delivery")?>
         </div>
         
         <div class="uk-form-row change_wrap">
         <?php echo CHtml::textField('order_change','',array(
          'placeholder'=>t("change? For how much?"),
          'style'=>"width:200px;"
         ))?>
         </div>
         
         <?php endif;?>
         
         
         <?php if ($merchant_disabled_ccr!="yes"):?>
         <div class="uk-form-row">
         <?php echo CHtml::radioButton('payment_opt',false,
         array('class'=>"icheck payment_opt payment_option",'value'=>"ccr"))?> <?php echo Yii::t("default","Offline Credit Card")?>
         </div>
         <?php endif;?>
       
         <!--PAY ON DELIVER-->         
         <?php if ( $payon_delivery_enabled==TRUE):?>  
          <div class="uk-form-row">         
         <?php echo CHtml::radioButton('payment_opt',false,
         array('class'=>"icheck payment_pyr payment_option",'value'=>"pyr"))?> <?php echo Yii::t("default","Pay On Delivery")?>
         </div>
         
         <div class="spacer"></div>
         
         <?php 
         $provider_list=Yii::app()->functions->getPaymentProviderMerchant($merchant_id);
         /*COMMISSION*/
         if ( Yii::app()->functions->isMerchantCommission($merchant_id)){	          	
         	$provider_list=Yii::app()->functions->getPaymentProviderListActive();         	
         }	         
         ?>
         <div class="payment-provider-wrap">
            <?php if (is_array($provider_list) && count($provider_list)>=1):?>
               <?php foreach ($provider_list as $val_provider_list): ?>
                   <li>
		            <?php echo CHtml::radioButton('payment_provider_name',false,array(
		              'class'=>"icheck",
		              'value'=>$val_provider_list['payment_name']
		            ))?>
		            <img src="<?php echo uploadURL()."/".$val_provider_list['payment_logo']?>">
		            </li>
               <?php endforeach;?>
               <div class="clear"></div>
            <?php else :?>   
              <p class="uk-text-danger"><?php echo t("no type of payment")?></p>  
            <?php endif;?>
         </div><!-- END payment-provider-wrap-->
         
         <?php endif;?>
         <!--PAY ON DELIVER-->       
         
         <?php if ($enabled_paypal==TRUE):?>
<!--         <div class="uk-form-row">
         <?php echo CHtml::radioButton('payment_opt',false,
         array('class'=>"icheck payment_option",'value'=>"pyp"))?> <?php echo Yii::t("default","Paypal")?>
         </div>        -->
         <?php endif;?>
         
         <?php if ( $enabled_stripe==TRUE):?>
<!--         <div class="uk-form-row">
         <?php echo CHtml::radioButton('payment_opt',false,
         array('class'=>"icheck payment_option",'value'=>'stp'))?> <?php echo Yii::t("default","Stripe")?>
         </div>-->
         <?php endif;?>
         
         <?php if ( $merchant_mercado_enabled==TRUE):?>
<!--         <div class="uk-form-row">
         <?php echo CHtml::radioButton('payment_opt',false,
         array('class'=>"icheck payment_option",'value'=>'mcd'))?> <?php echo Yii::t("default","Mercadopago")?>
         </div>-->
         <?php endif;?>
                  
                  
         <?php if ( $merchant_sisow_enabled==TRUE):?>
<!--         <div class="uk-form-row">
         <?php echo CHtml::radioButton('payment_opt',false,
         array('class'=>"icheck payment_option",'value'=>'ide'))?> <?php echo Yii::t("default","Sisow")?>
         </div>-->
         <?php endif;?>         
         

         
         <?php if ( $merchant_paysera_enabled==TRUE):?>
<!--         <div class="uk-form-row">
         <?php echo CHtml::radioButton('payment_opt',false,
         array('class'=>"icheck payment_option",'value'=>'pys'))?> <?php echo Yii::t("default","Paysera")?>
         </div>-->
         <?php endif;?>
         
         <?php if ( $merchant_enabled_barclay==TRUE):?>
<!--         <div class="uk-form-row">
         <?php echo CHtml::radioButton('payment_opt',false,
         array('class'=>"icheck payment_option",'value'=>'bcy'))?> <?php echo Yii::t("default","Barclaycard")?>
         </div>-->
         <?php endif;?>
         
         <?php if ( $merchant_enabled_epaybg==TRUE):?>
<!--         <div class="uk-form-row">
         <?php echo CHtml::radioButton('payment_opt',false,
         array('class'=>"icheck payment_option",'value'=>'epy'))?> <?php echo Yii::t("default","EpayBg")?>
         </div>-->
         <?php endif;?>
                  
         <?php if ( $merchant_enabled_autho==TRUE):?>
<!--         <div class="uk-form-row">
         <?php echo CHtml::radioButton('payment_opt',false,
         array('class'=>"icheck payment_option",'value'=>'atz'))?> <?php echo Yii::t("default","Authorize.net")?>
         </div>-->
         <?php endif;?>
         
         <?php if ( $mt_bankdeposit_enabled==TRUE):?>
<!--         <div class="uk-form-row">
         <?php echo CHtml::radioButton('payment_opt',false,
         array('class'=>"icheck payment_option",'value'=>'obd'))?> <?php echo Yii::t("default","Offline Bank Deposit")?>
         </div>-->
         <?php endif;?>
         
         <?php if ( $merchant_payu_enabled==TRUE):?>
         <div class="uk-form-row">
         <?php echo CHtml::radioButton('payment_opt',false,
         array('class'=>"icheck payment_option",'value'=>'payu'))?> <?php echo Yii::t("default","PayUmoney")?>
             <img width="120" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/front/img/paymentlogo.jpg" />
         </div>
         <?php endif;?>
         
       <?php if ( $merchant_ccAvenue_enabled==TRUE):?>
         <div class="uk-form-row">
         <?php echo CHtml::radioButton('payment_opt',false,
         array('class'=>"icheck payment_option",'value'=>'cca'))?> <?php echo Yii::t("default","ccAvenue")?>
             <img width="120" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/front/img/paymentlogo.jpg" />
         </div>
         <?php endif;?>
         
         </div> <!--uk-panel-->
                          
        <?php
	}
	
	public function displaySpicyIcon($spicydish=1,$style='',$mtid='')
	{
		if ($spicydish==2){
			//$spicydish=Yii::app()->functions->getOptionAdmin('spicydish');
			$spicydish=Yii::app()->functions->getOption('spicydish',$mtid);
			if (empty($spicydish)){
				$resp="<img class=\"spicydish-icon $style\" src=\"".assetsURL()."/images/spicy.png"."\">";
			} else $resp="<img class=\"spicydish-icon $style\" src=\"".uploadURL()."/$spicydish"."\">";
			return $resp;
		}
		return '';
	}
	
	public function displaySpicyIconByID($item_id=1)
	{
		if ($resp=Yii::app()->functions->getFoodItem($item_id)){
			return self::displaySpicyIcon($resp['spicydish'],'',$resp['merchant_id']);
		}	
		return '';
	}
	
	public function displayCatSpicyIconByID($cat_id=1)
	{		
		if ($resp=Yii::app()->functions->getCategory($cat_id)){						
			return self::displaySpicyIcon($resp['spicydish'],'spicydish-cat',$resp['merchant_id']);
		}	
		return '';
	}
	
	public static function FaxBalance()
	{
		$enabled=Yii::app()->functions->getOptionAdmin("fax_enabled");
		if ( $enabled==2):
		?>
		<div class="fax_credit_wrap">
		<p><?php echo Yii::t("default","Fax Credits")?>: <?php echo Yii::app()->functions->getMerchantFaxCredit(Yii::app()->functions->getMerchantID());?></p>
		</div>
		<?php
		endif;
	}
	
	public function categorySpicyNotes($cat_id='')
	{
		if ( $res=Yii::app()->functions->getCategory($cat_id)){
			return $res['spicydish_notes'];
		}		
		return '';
	}
        
        public static function websiteLogo()
	{
            $receipt_logo=Yii::app()->functions->getOptionAdmin('website_logo');
            ?>
                <a href="<?php echo Yii::app()->createUrl('store'); ?>" id="logo">
                      <?php if($receipt_logo):?>   
                     <img src="<?php echo Yii::app()->request->baseUrl;?>/upload/<?php echo $receipt_logo;?>"  alt="" data-retina="true" class="hidden-xs">
                     <img src="<?php echo Yii::app()->request->baseUrl;?>/upload/<?php echo $receipt_logo;?>"  alt="" data-retina="true" class="hidden-lg hidden-md hidden-sm">
                         <?php else:?>
                         <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/logo.png"  alt="" data-retina="true" class="hidden-xs">
                     <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/logo.png"  alt="" data-retina="true" class="hidden-lg hidden-md hidden-sm">
                         <?php endif;?>

                     </a>
	<?php		
	}
	
	public static function receiptLogo()
	{
		if ( Yii::app()->functions->getOptionAdmin('website_enabled_rcpt')==2){
			$receipt_logo=Yii::app()->functions->getOptionAdmin('website_receipt_logo');
			if (!empty($receipt_logo)){
			   return '<img  class="rc_logo" src="'.websiteUrl()."/upload"."/$receipt_logo".'">';	
			}		
		}	
	}	
	
	public  static function displaySpicyIconNew($dish='',$class='')
	{		
		$result='';
		if (!empty($dish)){
			$dish=json_decode($dish);
			if (is_array($dish) && count($dish)>=1){
				$result='<div class="mytable '.$class.'">';
				foreach ($dish as $dish_id) {
					$dish_info=Yii::app()->functions->GetDish($dish_id);									
					$result.='<div class="col">';	
                    $result.='<img class="spicydish-icon" src="'.uploadURL()."/".$dish_info['photo']
                    .'" alt="" title="">';
                    $result.='</div>';	                    
				}
				$result.='</div>';	 
			}		
		}
		return $result;
	}
	
	public static function multipleFields($field_label='',$field_name='',$data='',$required='',$type='')
	{
		?>
		<ul data-uk-tab="{connect:'#tab-content'}" class="uk-tab uk-active">
		    <li class="uk-active" ><a href="#"><?php echo t("English")?></a></li>
		    <?php if ( $fields=Yii::app()->functions->getLanguageField()):?>  
		    <?php foreach ($fields as $f_val): ?>
		    <li class="" ><a href="#"><?php echo $f_val;?></a></li>
		    <?php endforeach;?>
		    <?php endif;?>
		</ul>
		
		<ul class="uk-switcher" id="tab-content">		  	   		  
		  <li>
		   <?php foreach ($field_label as $key=>$field_val):?>
		      <div class="uk-form-row">
				  <label class="uk-form-label"><?php echo t($field_val)?></label>				  
				  <?php echo CHtml::textField("$field_name[$key]",
				  isset($data[$field_name[$key]])?$data[$field_name[$key]]:""
				  ,array(
				  'class'=>'uk-form-width-large',
				  'data-validation'=>$required[$key]==true?"required":''
				  ))?>
			   </div>
		   <?php endforeach;?>
		  </li>
		  		  
		  <?php if (is_array($fields) && count($fields)>=1):?>
          <?php foreach ($fields as $key_f => $f_val): ?>
          <li>
            <?php foreach ($field_label as $key=>$field_val):?>
            <?php 
            $f_name=$field_name[$key]."_trans"."[$key_f]";
            $f_name2=$field_name[$key]."_trans";
            $values=isset($data[$f_name2])?json_decode($data[$f_name2],true):'';               
            ?>            
             <div class="uk-form-row">
			  <label class="uk-form-label"><?php echo t($field_val)?></label>
			  <?php echo CHtml::textField($f_name,
			  array_key_exists($key_f,(array)$values)?$values[$key_f]:''
			  ,array(
			  'class'=>'uk-form-width-large',
			  //'data-validation'=>$required[$key]==true?"required":''
			  ))?>
		   </div>  
		   <?php endforeach;?>
          </li>
          <?php endforeach;?>
          <?php endif;?>
		  
		</ul>
		<?php
	}
	
	public static function AddressByMap()
	{
		?>
		<div class="map-address-wrap">
		<a href="javascript:;" class="map-address">
		<i class="fa fa-map-marker"></i> <?php echo t("Click here to select your address in the map")?>
		</a>
		
		<div class="map-address-wrap-inner">
		<?php 
		echo CHtml::hiddenField('map_address_toogle',1);
		echo CHtml::hiddenField('temporary_address',
		isset($_SESSION['kr_search_address'])?$_SESSION['kr_search_address']:'');
		
		echo CHtml::hiddenField('map_address_lat');
		echo CHtml::hiddenField('map_address_lng');
		?>							
		   <div class="map_address"></div>
		</div> <!--map-address-wrap-inner-->
		
		</div> <!--map-address-wrap-->
		<?php
	}
	
	public static function searchByZipCodeOptions()
	{
		$search_type=getOptionA('admin_zipcode_searchtype');		
		switch ($search_type) {
			case 2:
				self::searchByCityArea($search_type);
				break;
			case 3:				
			    self::searchByAddress($search_type);
				break;			
			default:
				self::searchByZipCode($search_type);
				break;
		}
	}
	
	public static function searchByZipCode($zipcode_searchtype='')
	{
		$home_search_text=Yii::app()->functions->getOptionAdmin('home_search_text');
		if (empty($home_search_text)){
			$home_search_text=Yii::t("default","Find restaurants near you");
		}
		
		$home_search_subtext=Yii::app()->functions->getOptionAdmin('home_search_subtext');
		if (empty($home_search_subtext)){
			$home_search_subtext=Yii::t("default","Order Delivery Food Online From Local Restaurants");
		}
		?>
		<div class="banner-wrap" id="search-by-postcode">
		<div class="search-wrap">  
		  <div data-animation="fadeIn" class="counter animated hiding" data-delay="500" >
			   <div class="search-wrapper rounded2">
			      <div class="inner">
			        <h2><?php echo $home_search_text?></h2>       
			        <p class="uk-text-muted"><?php echo Yii::t("default","Enter your post code")?>:</p> 
			        <div class="search-input-wrap">
			        
			        <form class="forms-search" id="forms-search" action="<?php echo baseUrl()."/store/searchArea"?>">
			          
			          <?php echo CHtml::hiddenField('stype',$zipcode_searchtype)?>
			        
			          <div style="width:85%;" 
		              class="uk-autocomplete uk-form" data-uk-autocomplete="{source:'store/autozipcode',minLength:1}">
			          <input style="height:auto;" type="text" data-validation="required" name="zipcode" id="zipcode" >
			          </div>
			          
			          <button type="submit"><i class="fa fa-search"></i></button>
			        </form>
			          
			        </div>			        
			        <p><?php echo Yii::t("default",$home_search_subtext)?> </p>			        
			      </div>
			   </div>
		   </div> <!--animated-->
		   </div> <!--search-wrap-->
		</div> <!--END header-wrap-->
		<?php
	}
	
	public static function searchByAddress($zipcode_searchtype='')
	{
		$home_search_text=Yii::app()->functions->getOptionAdmin('home_search_text');
		if (empty($home_search_text)){
			$home_search_text=Yii::t("default","Find restaurants near you");
		}
		
		$home_search_subtext=Yii::app()->functions->getOptionAdmin('home_search_subtext');
		if (empty($home_search_subtext)){
			$home_search_subtext=Yii::t("default","Order Delivery Food Online From Local Restaurants");
		}
		?>
		<div class="banner-wrap" id="search-by-postcode">
		<div class="search-wrap">  
		  <div data-animation="fadeIn" class="counter animated hiding" data-delay="500" >
			   <div class="search-wrapper rounded2">
			      <div class="inner">
			        <h2><?php echo $home_search_text?></h2>       
			        <p class="uk-text-muted"><?php echo Yii::t("default","Please enter your address")?>:</p> 
			        <div class="search-input-wrap">
			        
			        <form class="forms-search" id="forms-search" action="<?php echo baseUrl()."/store/searchArea"?>">
			          
			          <?php echo CHtml::hiddenField('stype',$zipcode_searchtype)?>
			        
			          <div style="width:85%;" 
		              class="uk-autocomplete uk-form" data-uk-autocomplete="{source:'store/autopostaddress',minLength:1}">
			          <input style="height:auto;" type="text" data-validation="required" name="address" id="address" >
			          </div>
			          
			          <button type="submit"><i class="fa fa-search"></i></button>
			        </form>
			          
			        </div>			        
			        <p><?php echo Yii::t("default",$home_search_subtext)?> </p>			        
			      </div>
			   </div>
		   </div> <!--animated-->
		   </div> <!--search-wrap-->
		</div> <!--END header-wrap-->
		<?php
	}
	
	public static function searchByCityArea($zipcode_searchtype='')
	{		
		$home_search_text=Yii::app()->functions->getOptionAdmin('home_search_text');
		if (empty($home_search_text)){
			$home_search_text=Yii::t("default","Find restaurants near you");
		}
		
		$home_search_subtext=Yii::app()->functions->getOptionAdmin('home_search_subtext');
		if (empty($home_search_subtext)){
			$home_search_subtext=Yii::t("default","Order Delivery Food Online From Local Restaurants");
		}
		?>
		<div class="banner-wrap" style="padding-bottom:20px;" id="search-by-postcode">
		<div class="search-wrap">  
		  <div data-animation="fadeIn" class="counter animated hiding" data-delay="500" >
			   <div class="search-wrapper rounded2">
			      <div class="inner">
			        <h2><?php echo $home_search_text?></h2>       
			        <p class="uk-text-muted"><?php echo Yii::t("default","Please Enter your post code")?>:</p> 
			        <div class="search-input-wrap search-input-wrap-normal">
			        
			        <form class="forms-search uk-form uk-form-horizontal" id="forms-search" action="<?php echo baseUrl()."/store/searchArea"?>">

			        <?php echo CHtml::hiddenField('stype',$zipcode_searchtype)?>
			        
			        <div class="uk-form-row">
                       <label class="uk-form-label"><?php echo Yii::t("default","City")?></label>
                       <select id="city" name="city" class="s_city" 
		data-validation="length" data-validation-length="min3"
		 data-validation-error-msg="<?php echo t("city is srequired")?>">
                       <?php if ( $res=FunctionsK::getCity()):?>
                       <option value="-1"><?php echo t("Select city...")?></option>
                       <?php foreach ($res as $val):?>
                        <option value="<?php echo $val['city'];?>" 
		                class="<?php echo $val['city'];?>"><?php echo $val['city'];?></option>
                       <?php endforeach;?>
                       <?php endif;?>
                       </select>
			        </div>		        
			        
			        <div class="uk-form-row">
                       <label class="uk-form-label"><?php echo Yii::t("default","Area")?></label>                       
                       <select id="area" name="area" class="s_area" 
		                data-validation="length" data-validation-length="min3" 
		                data-validation-error-msg="<?php echo t("area is required");?>">
                       <option value="-1"><?php echo t("Select area...")?></option>
                       <?php if ( $res=FunctionsK::getArea()):?>
                       <?php foreach ($res as $val):?>
                        <option  value="<?php echo $val['area']?>"
                        class="area-hidden areas <?php echo $val['city'];?>"><?php echo $val['area'];?></option>
                       <?php endforeach;?>
                       <?php endif;?>
                       </select>
			        </div>		        
			        
			        <div class="input-search-wrap">
			        <button type="submit"><i class="fa fa-search"></i></button>
			        </div>
			        
			        </form>
			          
			        </div>			        
			        <p><?php echo Yii::t("default",$home_search_subtext)?> </p>			        
			      </div>
			   </div>
		   </div> <!--animated-->
		   </div> <!--search-wrap-->
		</div> <!--END header-wrap-->
		<?php
	}
	
 public function frontViewContact(){
     
    $website_address=Yii::app()->functions->getOptionAdmin('website_address');
    $website_contact_phone=Yii::app()->functions->getOptionAdmin('website_contact_phone');
    $website_contact_email=Yii::app()->functions->getOptionAdmin('website_contact_email');
    $contact_content=Yii::app()->functions->getOptionAdmin('contact_content');
    $country=Yii::app()->functions->adminCountry();?>
     <div><i class="icon_pin"></i> 
         <?php echo $website_address ." ".$country;?>
        </div>
    <?php
 }
 
 
  public function emailTemplatesEmailSuscription(){
            
           $html =  ' <html>

<body style="width:100%; float:left;  font-family:arial;">

    <div class="main" style="width:900px; margin:0px auto">

        <div style="">
            <img src="'.$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl.'/assets/images/1463638947-logo.png" style="margin:17px 30% 0;"/>
        </div>
        <h1 style="margin:16px 7px 2% 39%">Email Subscription Detail</h1>
      <p>Hello Friend, <p> </br>
      <p>You have successfully subscribe on bhukkas.com</p> </br>
      <p>thank you for your email subscription</p>
      
         <h4 style="margin:5px 0px">- Warm Regards</h4>
        
        <h4 style="margin:5px 0px">Bhukkas Team</h4>
       
    </div>
</body>

</html>';
           
           return $html;
            
        }
        
        public function emailTemplatesadmin(){
            
           $html =  ' <html>

<body style="width:100%; float:left;  font-family:arial;">

    <div class="main" style="width:900px; margin:0px auto">

        <div style="">
            <img src="'.$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl.'/assets/images/1463638947-logo.png" style="margin:17px 30% 0;"/>
        </div>
        <h1 style="margin:16px 7px 2% 39%">Email Subscription Detail</h1>
      <p>Hello Admin, <p> </br>
      <p>'.$data['email_address'].'have subscribe on bhukkas.com</p> </br>
      <p>thank you</p>     
    </div>
</body>

</html>';
           
           return $html;
            
        }
 
 
} /*END CLass*/