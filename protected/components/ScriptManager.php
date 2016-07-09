<?php

class ScriptManager {

    public static function RegisterAllJSFile() {
        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile('//code.jquery.com/jquery-1.10.2.min.js', CClientScript::POS_END);

        $cs->registerScriptFile("//code.jquery.com/ui/1.10.3/jquery-ui.js"
                , CClientScript::POS_END);

        $js_lang = Yii::app()->functions->jsLanguageAdmin();
        $js_lang_validator = Yii::app()->functions->jsLanguageValidator();

        $cs->registerScript(
                'js_lang', 'var js_lang = ' . json_encode($js_lang) . '
		  ', CClientScript::POS_HEAD
        );

        $cs->registerScript(
                'jsLanguageValidator', 'var jsLanguageValidator = ' . json_encode($js_lang_validator) . '
		  ', CClientScript::POS_HEAD
        );

        $cs->registerScript(
                'ajax_url', "var ajax_url ='" . Yii::app()->request->baseUrl . "/admin/ajax' ", CClientScript::POS_HEAD
        );
        

        $cs->registerScript(
                'admin_url', "var admin_url ='" . Yii::app()->request->baseUrl . "/admin' ", CClientScript::POS_HEAD
        );

        $cs->registerScript(
                'sites_url', "var sites_url ='" . Yii::app()->request->baseUrl . "' ", CClientScript::POS_HEAD
        );

        $cs->registerScript(
                'upload_url', "var upload_url ='" . Yii::app()->request->baseUrl . "/upload' ", CClientScript::POS_HEAD
        );

        $cs->registerScript(
                'captcha_site_key', "var captcha_site_key ='" . getOptionA('captcha_site_key') . "' ", CClientScript::POS_HEAD
        );

        $cs->registerScriptFile($baseUrl . "/assets/vendor/DataTables/jquery.dataTables.min.js"
                , CClientScript::POS_END);

        $cs->registerScriptFile($baseUrl . "/assets/vendor/DataTables/fnReloadAjax.js"
                , CClientScript::POS_END);

        $cs->registerScriptFile($baseUrl . "/assets/vendor/JQV/form-validator/jquery.form-validator.min.js"
                , CClientScript::POS_END);

        $cs->registerScriptFile($baseUrl . "/assets/vendor/jquery.ui.timepicker-0.0.8.js"
                , CClientScript::POS_END);

        $cs->registerScriptFile($baseUrl . "/assets/js/uploader.js"
                , CClientScript::POS_END);

        $cs->registerScriptFile($baseUrl . "/assets/vendor/ajaxupload/fileuploader.js"
                , CClientScript::POS_END);

        /* UIKIT */
        $cs->registerScriptFile($baseUrl . "/assets/vendor/uikit/js/uikit.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/vendor/uikit/js/addons/notify.min.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/vendor/uikit/js/addons/sticky.min.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/vendor/uikit/js/addons/sortable.min.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/vendor/uikit/js/addons/autocomplete.min.js"
                , CClientScript::POS_END);

        $cs->registerScriptFile($baseUrl . "/assets/vendor/bar-rating/jquery.barrating.min.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/vendor/jquery.nicescroll.min.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/vendor/iCheck/icheck.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/vendor/chosen/chosen.jquery.min.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile("//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/vendor/jquery.geocomplete.min.js"
                , CClientScript::POS_END);

        if (Yii::app()->functions->getOptionAdmin('fb_flag') == "") {
            $cs->registerScriptFile($baseUrl . "/assets/js/fblogin.js?ver=1"
                    , CClientScript::POS_END);
        }

        $cs->registerScriptFile($baseUrl . "/assets/vendor/jquery.printelement.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/vendor/fancybox/source/jquery.fancybox.js?ver=1"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/vendor/bar-rating/jquery.barrating.min.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/vendor/jquery.appear.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/vendor/flexslider/jquery.flexslider-min.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/vendor/magnific-popup/jquery.magnific-popup.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/vendor/bxslider/jquery.bxslider.min.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/vendor/imagesloaded.pkgd.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/vendor/intel/build/js/intlTelInput.js?ver=2.1.5"
                , CClientScript::POS_END);

        $cs->registerScriptFile($baseUrl . "/assets/js/store.js?ver=1"
                , CClientScript::POS_END);

        $cs->registerScriptFile("//www.google.com/recaptcha/api.js?onload=KMRSCaptchaCallback&render=explicit"
                , CClientScript::POS_END, array(
            'async' => "async"
        ));

   
    }

    public static function registerAllCSSFiles() {
        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile($baseUrl . '/assets/css/store.css?ver=1.0');
        $cs->registerCssFile($baseUrl . '/assets/css/responsive.css?ver=1.0');
        $cs->registerCssFile('//ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/base/jquery-ui.css');
        //$cs->registerCssFile($baseUrl . '/assets/css/responsive.css?ver=1.0');

        $cs->registerCssFile("//fonts.googleapis.com/css?family=Open+Sans|Podkova|Rosario|Abel|PT+Sans|Source+Sans+Pro:400,600,300|Roboto");

        $cs->registerCssFile("//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css");

        $cs->registerCssFile($baseUrl . "/assets/vendor/uikit/css/uikit.almost-flat.min.css");
        $cs->registerCssFile($baseUrl . "/assets/vendor/uikit/css/addons/uikit.addons.min.css");
        $cs->registerCssFile($baseUrl . "/assets/vendor/uikit/css/addons/uikit.gradient.addons.min.css");

        $cs->registerCssFile($baseUrl . "/assets/vendor/colorpick/css/colpick.css");
        $cs->registerCssFile($baseUrl . "/assets/vendor/iCheck/skins/all.css");
        $cs->registerCssFile($baseUrl . "/assets/vendor/chosen/chosen.css");
        $cs->registerCssFile($baseUrl . "/assets/vendor/fancybox/source/jquery.fancybox.css?ver=1");
        $cs->registerCssFile($baseUrl . "/assets/vendor/animate.min.css");
        $cs->registerCssFile($baseUrl . "/assets/vendor/flexslider/flexslider.css");
        $cs->registerCssFile($baseUrl . "/assets/vendor/magnific-popup/magnific-popup.css");
        $cs->registerCssFile($baseUrl . "/assets/vendor/bxslider/jquery.bxslider.css");
        $cs->registerCssFile($baseUrl . "/assets/vendor/intel/build/css/intlTelInput.css");
        $cs->registerCssFile($baseUrl . "/assets/vendor/rupee/rupyaINR.css");
    }

    public static function registerGlobalVariables() {
        echo CHtml::hiddenField('fb_app_id', Yii::app()->functions->getOptionAdmin('fb_app_id'));
        echo CHtml::hiddenField('admin_country_set', Yii::app()->functions->getOptionAdmin('admin_country_set'));
        echo CHtml::hiddenField('google_auto_address', Yii::app()->functions->getOptionAdmin('google_auto_address'));
        echo CHtml::hiddenField('google_default_country', getOptionA('google_default_country'));
        echo CHtml::hiddenField('disabled_share_location', getOptionA('disabled_share_location'));
        $website_date_picker_format = getOptionA('website_date_picker_format');
        if (!empty($website_date_picker_format)) {
            echo CHtml::hiddenField('website_date_picker_format', $website_date_picker_format);
        }
        $website_time_picker_format = yii::app()->functions->getOptionAdmin('website_time_picker_format');
        if (!empty($website_time_picker_format)) {
            echo CHtml::hiddenField('website_time_picker_format', $website_time_picker_format);
        }
        echo CHtml::hiddenField('disabled_cart_sticky', getOptionA('disabled_cart_sticky'));
        echo "\n";
    }

    public static function registerAllFrontCSSFiles() {
        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();

        //front css
        $cs->registerCssFile($baseUrl . "/assets/front/css/bootstrap-select.min.css");
        $cs->registerCssFile($baseUrl . "/assets/front/css/base.css");
        $cs->registerCssFile($baseUrl . "/assets/front/css/font-awesome.min.css");
         $cs->registerCssFile($baseUrl . "/assets/front/css/jquery-ui-1.11.css");
       /*$cs->registerCssFile('//ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/base/jquery-ui.css');*/
        $cs->registerCssFile($baseUrl . "/assets/vendor/colorpick/css/colpick.css");
        $cs->registerCssFile($baseUrl . "/assets/vendor/iCheck/skins/all.css");
        $cs->registerCssFile($baseUrl . "/assets/vendor/chosen/chosen.css");
        $cs->registerCssFile($baseUrl . "/assets/vendor/fancybox/source/jquery.fancybox.css?ver=1");
        $cs->registerCssFile($baseUrl . "/assets/vendor/animate.min.css");
        $cs->registerCssFile($baseUrl . "/assets/vendor/uikit/css/uikit.almost-flat.min.css");
        $cs->registerCssFile($baseUrl . "/assets/vendor/uikit/css/addons/uikit.addons.min.css");
        $cs->registerCssFile($baseUrl . "/assets/vendor/uikit/css/addons/uikit.gradient.addons.min.css");
        $cs->registerCssFile($baseUrl . "/assets/front/css/scroll.css");
        $cs->registerCssFile($baseUrl . "/assets/front/css/rating.css");
    }

    public static function RegisterAllFrontJSFile() {
        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();

        $cs->registerScriptFile($baseUrl . "/assets/front/js/common_scripts_min.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/front/js/functions.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/front/js/validate.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/front/js/bootstrap-select.min.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/front/js/modernizr.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile("https://fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic,300,300italic"
                , CClientScript::POS_END);
       
         $cs->registerScriptFile($baseUrl . "/assets/vendor/rating.min.js"
                , CClientScript::POS_END);
         
        $cs->registerScriptFile($baseUrl . "/assets/front/js/cat_nav_mobile.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/front/js/map.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/front/js/infobox.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/front/js/ion.rangeSlider.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/front/js/jquery.pin.min.js"
                , CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . "/assets/vendor/fancybox/source/jquery.fancybox.js?ver=1"
                , CClientScript::POS_END);
        
         $cs->registerScriptFile($baseUrl . "/assets/front/js/custom-front.js"
                , CClientScript::POS_END);

         $cs->registerScriptFile($baseUrl . "/assets/front/js/scroll.js"
                , CClientScript::POS_END);
         $cs->registerScriptFile($baseUrl . "/assets/vendor/bootbox.min.js"
                , CClientScript::POS_END);
        
         
        
    }
    
    

}

/*END CLASS*/