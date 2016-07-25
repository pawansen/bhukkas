
<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="<?php echo Yii::app()->request->baseUrl;?>/assets/front/img/sub_header_cart.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
            <h1>About us</h1>
            <p></p>
            <p></p>
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
            <li><a href="<?php echo Yii::app()->createUrl('store'); ?>">Home</a></li>
            <li><a href="<?php echo Yii::app()->createUrl('store/about'); ?>">About Us</a></li>
        </ul>
    </div>
</div>
<!-- Position -->

<!-- Content ================================================== -->
<div class="container margin_60_35">
    <div class="row">
        <div class="col-md-12">
        
            <h2 class="nomargin_top"><?php if(isset($cmsData['title']) && !empty($cmsData['title'])){
              echo "Some Words About Us";  
            } ?></h2>
         
            <div class="content full" id="content">
                <div class="container" style="min-height:500px;">
                    <br>
                    <br>
                    <div class="page">
                        <div class="row">

                            <div class="col-md-12 col-sm-12 ">

                      <p> <?php if(isset($cmsData['description']) && !empty($cmsData['description'])){
              echo $cmsData['description'];  
            } ?> </p>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End row -->
    <hr class="more_margin">
    <div class="main_title">
        <h2 class="nomargin_top">Quick food quality feautures</h2>
        <p>
            Cum doctus civibus efficiantur in imperdiet deterruisset.
        </p>
    </div>
    <div class="row">
        <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
            <div class="feature">
                <i class="icon_building"></i>
                <h3><span>+ 1000</span> Restaurants</h3>
                <p>
                    Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                </p>
            </div>
        </div>
        <div class="col-md-6 wow fadeIn" data-wow-delay="0.2s">
            <div class="feature">
                <i class="icon_documents_alt"></i>
                <h3><span>+1000</span> Food Menu</h3>
                <p>
                    Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                </p>
            </div>
        </div>
    </div>
    <!-- End row -->
    <div class="row">
        <div class="col-md-6 wow fadeIn" data-wow-delay="0.3s">
            <div class="feature">
                <i class="icon_bag_alt"></i>
                <h3><span>Delivery</span> or Takeaway</h3>
                <p>
                    Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                </p>
            </div>
        </div>
        <div class="col-md-6 wow fadeIn" data-wow-delay="0.4s">
            <div class="feature">
                <i class="icon_mobile"></i>
                <h3><span>Mobile</span> Support</h3>
                <p>
                    Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                </p>
            </div>
        </div>
    </div>
    <!-- End row -->
    <div class="row">
        <div class="col-md-6 wow fadeIn" data-wow-delay="0.5s">
            <div class="feature">
                <i class="icon_wallet"></i>
                <h3><span>Cash</span> Payment</h3>
                <p>
                    Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                </p>
            </div>
        </div>
        <div class="col-md-6 wow fadeIn" data-wow-delay="0.6s">
            <div class="feature">
                <i class="icon_creditcard"></i>
                <h3><span>Secure card</span> Payment</h3>
                <p>
                    Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                </p>
            </div>
        </div>
    </div>
    <!-- End row -->
</div>
<!-- End container -->

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 nopadding features-intro-img">
            <div class="features-bg">
                <div class="features-img">
                </div>
            </div>
        </div>
        <div class="col-md-6 nopadding">
            <div class="features-content">
                <h3>"Ex vero mediocrem"</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a lorem quis neque interdum consequat ut sed sem. Duis quis tempor nunc. Interdum et malesuada fames ac ante ipsum primis in faucibus.
                </p>
                <p>
                    Per ea erant aeque corpora, an agam tibique nec. At recusabo expetendis vim. Tractatos principes mel te, dolor solet viderer usu ad.
                </p>
            </div>
        </div>
    </div>
</div>
<!-- End container-fluid  -->
<!-- End Content =============================================== -->