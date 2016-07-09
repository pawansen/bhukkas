<!--  SubHeader 
<section class="parallax-window" id="home" data-parallax="scroll" data-image-src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/sub_header_home.jpg" data-natural-width="1400" data-natural-height="550">
    <div id="subheader">
        <div id="sub_content">

            <div class="row">

                <?php 
                        if ( Yii::app()->controller->action->id =="index"){
                        if (getOptionA('home_search_mode')!="postcode"){
                         if ( getOptionA('enabled_advance_search') =="yes"){
                            Widgets::searchAdvanced();
                         } else Widgets::searchFrontApi();

                        } else {
                         Widgets::searchByZipCodeOptions();
                        }
                       }
                  ?>
                
            </div>
            
            <section class="clearfix ">
            <h1>See what people are ordering in Indore</h1>
            <ul class="list-inline text-center">
                <li><a href="#">Biryaani</a></li>
                <li><a href="#">korma</a></li>
                <li><a href="#">Tangri Kabab</a></li>
                <li><a href="#">Chicken Chilli</a></li>
                <li><a href="#">Daal Chawal</a></li>
                <li><a href="#">Noodels</a></li>
                <br>
                <li><a href="#">Veg Biryani</a></li>
                <li><a href="#">Butter Khichdi</a></li>
                <li><a href="#">Daal Makhni</a></li>
            </ul>
            </section>
        
        </div>
    </div>
</section>
 End SubHeader 
     start section  
<section class="white_bg ad-bg clearfix">
    <div class="container">
        <section class="row">
            <aside class="col-md-3 m-t-xs-10 col-sm-6">
            <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/1.png" class="img-responsive" alt="">
            </aside>
            <aside class="col-md-3 m-t-xs-10 col-sm-6">
            <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/2.png" class="img-responsive" alt="">
            </aside>
            <aside class="col-md-3 m-t-xs-10 col-sm-6">
            <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/3.png" class="img-responsive" alt="">
            </aside>
            <aside class="col-md-3 m-t-xs-10 col-sm-6">
            <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/4.png" class="img-responsive" alt="">
            </aside>
        </section>
    </div>
</section>
 end section     
  strat section 

<section class="white_bg pop-bg">
    <div class="container">
        <section class="row">
         <aside class="col-md-5 main_title">

            <h2 class="nomargin_top">Popular Restaurents in Indore </h2>
            <p>A cureted list of resturents in indore</p> 
         </aside>
         <aside class="col-md-7">
             <article class="clearfix">
                <figcaption class="col-md-3 col-sm-3">
                    <aside class="pop-hotel">
                       <div class="thumbnail">
                            <div class="caption">
                                <h4>Sayaji</h4>
                            </div>
                            <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/sayaji.png" alt="" class="img-responsive">
                        </div>
                    </aside>
                </figcaption>

                
                <figcaption class="col-md-3 col-sm-3">
                     <aside class="pop-hotel">
                       <div class="thumbnail">
                            <div class="caption">
                                <h4>Vrindavan</h4>
                            </div>
                            <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/vrindavan.png" alt="" class="img-responsive">
                        </div>
                        </aside>
                </figcaption>



                <figcaption class="col-md-3 col-sm-3">

                     <aside class="pop-hotel">
                       <div class="thumbnail">
                            <div class="caption">
                                <h4>Guru Kripa</h4>
                            </div>
                            <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/gurukripa.png" alt="" class="img-responsive">
                        </div>
                    </aside>
                </figcaption>


                <figcaption class="col-md-3 col-sm-3">
                     <aside class="pop-hotel">
                           <div class="thumbnail">
                                <div class="caption">
                                    <h4>Madni Darbar</h4>
                                </div>
                                <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/madni.png" alt="" class="img-responsive">
                            </div>
                     </aside>
                </figcaption>
                

                
             </article>


             <article class="clearfix">
                

                 <figcaption class="col-md-3 col-sm-3">

                     <aside class="pop-hotel">
                           <div class="thumbnail">
                                <div class="caption">
                                    <h4>Nafees</h4>
                                </div>
                                <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/nafees.png" alt="" class="img-responsive">
                            </div>
                     </aside>
                </figcaption>



                 <figcaption class="col-md-3 col-sm-3">

                     <aside class="pop-hotel">
                           <div class="thumbnail">
                                <div class="caption">
                                    <h4>Vrindavan</h4>
                                </div>
                                <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/vrindavan2.png" alt="" class="img-responsive">
                            </div>
                    </aside>
                </figcaption>


                 <figcaption class="col-md-3 col-sm-3">

                     <aside class="pop-hotel">
                           <div class="thumbnail">
                                <div class="caption">
                                    <h4>kareems</h4>
                                </div>
                                <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/kareems.png" alt="" class="img-responsive">
                            </div>
                    </aside>
                </figcaption>


                 <figcaption class="col-md-3 col-sm-3">

                     <aside class="pop-hotel">
                           <div class="thumbnail">
                                <div class="caption">
                                    <h4>More</h4>
                                </div>
                                <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/Hotel8.png" alt="" class="img-responsive">
                            </div>
                    </aside>
                </figcaption>

                

               
             </article>
         </aside>
        </section>
    </div>
</section>
 end section 
 start section  
<section class="white_bg">
    <div class="container margin_60">
        <aside class="main_title">
            <h2 class="nomargin_top">Popular Cusines in Indore </h2>
            <p>A Curated Collections Of Cusine</p>
        </aside>

        <aside class="clearfix">
            
             <article class="col-md-2 col-sm-4">
                 <aside class="pop-dish">
                        <div class="thumbnail">
                        <div class="caption">
                            <h4>Pizza</h4>
                        </div>
                        <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/pizza.png" alt="" class="img-responsive">
                        </div>
                </aside>
             </article>

            <article class="col-md-2 col-sm-4">
                 <aside class="pop-dish">
                    <div class="thumbnail">
                    <div class="caption">
                        <h4>Chinese</h4>
                       </div>
                    <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/chinese.png" alt="" class="img-responsive">
                    </div>
                </aside>
             </article>


              <article class="col-md-2 col-sm-4">

                 <aside class="pop-dish">
                        <div class="thumbnail">
                        <div class="caption">
                            <h4>Nafees</h4>
                           </div>
                        <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/Non-veg.png" alt="" class="img-responsive">
                        </div>
                 </aside>
             </article>

             
 
              <article class="col-md-2 col-sm-4">
                     <aside class="pop-dish">
                        <div class="thumbnail">
                        <div class="caption">
                            <h4>Sushi</h4>
                           </div>
                        <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/Sushi.png" alt="" class="img-responsive">
                        </div>
                     </aside>
             </article>


             <article class="col-md-2 col-sm-4">
                     <aside class="pop-dish">
                        <div class="thumbnail">
                        <div class="caption">
                            <h4>Thai</h4>
                           </div>
                        <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/thai.png" alt="" class="img-responsive">
                        </div>
                    </aside>
             </article>


             <article class="col-md-2 col-sm-4">
                     <aside class="pop-dish">
                        <div class="thumbnail">
                        <div class="caption">
                            <h4>Veg</h4>
                           </div>
                        <img src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/ad/Veg.png" alt="" class="img-responsive">
                        </div>
                    </aside>
             </article>

        </aside>

    </div>
</section>
 end section    
 start section        
<section class="high_light">
    <div class="container">
        <h3>Choose from over 2,000 Restaurants</h3>
        <p>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</p>
        <a href="list_page.html">View all Restaurants</a>
    </div>
</section>
 End section -->