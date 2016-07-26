/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {

    $("[rel='tooltip']").tooltip();
    $('.thumbnail').hover(
        function () {
            $(this).find('.caption').slideDown(250); //.fadeIn(250)
        },
        function () {
            $(this).find('.caption').slideUp(250); //.fadeOut(205)
        }
    );
});

$('.selectpicker').selectpicker({
    style: 'btn-default',
    size: 4
});
$(function () {
    'use strict';
    $("#range").ionRangeSlider({
        hide_min_max: true,
        keyboard: true,
        min: 0,
        max: 15,
        from: 0,
        to: 5,
        type: 'double',
        step: 1,
        prefix: "Km ",
        grid: true
    });
    $("#faq_box").pin({
        padding: {
            top: 80,
            bottom: 20
        },
        minWidth: 1000,
        containerSelector: "#container_pin"
    });
    'use strict';
    $('#faq_box a[href*=#]:not([href=#])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top - 120
                }, 1000);
                return false;
            }
        }
    });

});

$.validate({
    language: jsLanguageValidator,
    form: '#frm-modal-login',
    onError: function () {},
    onSuccess: function () {
        form_submit('frm-modal-login');
        return false;
    }
});

$.validate({
    language: jsLanguageValidator,
    form: '#form-signup',
    onError: function () {},
    onSuccess: function () {
        form_submit('form-signup');
        return false;
    }
});

$.validate({
    language: jsLanguageValidator,
    form: '#frm-modal-forgotpass',
    onError: function () {},
    onSuccess: function () {
        form_submit('frm-modal-forgotpass');
        return false;
    }
});

jQuery(document).ready(function () {

    $("#cart_box").pin({
        padding: {
            top: 80,
            bottom: 25
        },
        minWidth: 1100,
        containerSelector: "#container_pin"
    });
    if ($(".mobile_inputs").exists()) {
        if ($("#mobile_country_code").exists()) {
            $(".mobile_inputs").intlTelInput({
                autoPlaceholder: false,
                defaultCountry: $("#mobile_country_code").val(),
                autoHideDialCode: true,
                nationalMode: false,
                autoFormat: false,
                utilsScript: sites_url + "/assets/vendor/intel/lib/libphonenumber/build/utils.js"
            });
        } else {
            $(".mobile_inputs").intlTelInput({
                autoPlaceholder: false,
                autoHideDialCode: true,
                nationalMode: false,
                autoFormat: false,
                utilsScript: sites_url + "/assets/vendor/intel/lib/libphonenumber/build/utils.js"
            });
        }
    }
});









jQuery(document).ready(function () {

    if (!$(".recaptcha").exists()) {
        return;
    }
    if (typeof captcha_site_key === "undefined" || captcha_site_key == null) {
        return;
    }
    if ($("#RecaptchaField1").exists()) {
        dump('RecaptchaField1');
        recaptcha1 = grecaptcha.render('RecaptchaField1', {
            'sitekey': captcha_site_key
        });
    }
    if ($("#RecaptchaField2").exists()) {
        recaptcha2 = grecaptcha.render('RecaptchaField2', {
            'sitekey': captcha_site_key
        });
    }



});

function hiddenForms() {
    $("#forgot_hidden").show();
    $("#login_hidden").hide();
}

function formShow() {
    $("#forgot_hidden").hide();
    $("#login_hidden").show();
}

$(function () {
    /*'use strict';
     $('a[href*=#]:not([href=#])').click(function() {
       if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
         var target = $(this.hash);
         target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
         if (target.length) {
           $('html,body').animate({
             scrollTop: target.offset().top - 70
           }, 1000);
           return false;
         }
       }
     });*/
});




$(document).ready(function () {

    $(window).scroll(function () {
        //if you hard code, then use console
        //.log to determine when you want the 
        //nav bar to stick.  
       // console.log($(window).scrollTop())
        if ($(window).scrollTop() > 280) {
            $('.left-filter').addClass('left-fixed');
            $('.rest-listing').addClass('m-l-25p');
        }
        if ($(window).scrollTop() < 281) {
            $('.left-filter').removeClass('left-fixed');
            $('.rest-listing').removeClass('m-l-25p');
           
        }
    });
});

$(".btn-map").click(function () {
    $('.left-filter').toggleClass('left-fixed');
    $('.rest-listing').toggleClass('m-l-25p');
     
});

//$(".more-filter").click(function () {
//    $('.minium_order_filter').toggleClass('filt-show');
//    $('.left-filter').toggleClass('left-unfixed');
//     $('.rest-listing').toggleClass('m-l-0');
//    $(".filter-text-all").toggle();
//     
//});


/*--

$(document).ready(function () {

    $(window).scroll(function () {
        //if you hard code, then use console
        //.log to determine when you want the 
        //nav bar to stick.  
        console.log($(window).scrollTop())
        if ($(window).scrollTop() > 800) {
            $('.p-fix').addClass('p-fix-2');
            $('.p-fix-1').addClass('col-md-offset-3');
        }
        if ($(window).scrollTop() < 800) {
            $('.p-fix').removeClass('p-fix-2');
            $('.p-fix-1').removeClass('col-md-offset-3');
        }
    });
});

$(document).ready(function () {

    $(window).scroll(function () {
        //if you hard code, then use console
        //.log to determine when you want the 
        //nav bar to stick.  
        console.log($(window).scrollTop())
        if ($(window).scrollTop() > 600) {
            $('.p-fix-3').addClass('p-fix-4');

        }
        if ($(window).scrollTop() < 600) {
            $('.p-fix-3').removeClass('p-fix-4');

        }
    });
});

--*/

$(".show-add-btn").click(function () {
    $(".add-hide").toggleClass("add-show");
    $(".add-btn-text").toggle();

});

$(".show-cusine-btn").click(function () {
    $(".cusine-hide").toggleClass("cusine-show");
    $(".cusine-text").toggle();
});
$(".show-filter").click(function () {
    $('.left-filter').toggleClass('left-unfixed');
     $('.rest-listing').toggleClass('m-l-0');
    $("#cusine_list li:nth-child(n+4)").toggleClass("filter-show");
    $(".filter-text").toggle();
});
$(".btn-map").click(function () {
    $('.left-filter').toggleClass('left-unfixed1');
     $('.rest-listing').toggleClass('m-l-01');
	 $('.left-filter').toggleClass('left-unfixed');
     $('.rest-listing').toggleClass('m-l-0');
  
});
jQuery(document).ready(function () {
$("#input-21f").rating({
starCaptions: function(val) {
if (val < 3) {
return val;
} else {
return 'high';
}
},
starCaptionClasses: function(val) {
if (val < 3) {
return 'label label-danger';
} else {
return 'label label-success';
}
},
hoverOnClear: false
});
$('#rating-input').rating({
min: 0,
max: 5,
step: 1,
size: 'lg',
showClear: false
});
});


