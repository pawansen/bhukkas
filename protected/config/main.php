<?php
return array(
	'name'=>'Bhukkas Multiple Restaurant',
	
	'defaultController'=>'store',
		
	'import'=>array(
		'application.models.*',
		'application.models.admin.*',
		'application.components.*',
		'application.vendor.*'
	),
	
	'language'=>'default',		
			
	'components'=>array(
		/*'urlManager'=>array(
			'urlFormat'=>'path',			
		),*/
	    'urlManager'=>array(
		    'urlFormat'=>'path',
		    'rules'=>array(
		        '<controller:\w+>/<id:\d+>'=>'<controller>/view',
		        '<controller:\w+>'=>'<controller>/index',
		        '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
		        '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                        array('api/list', 'pattern'=>'api/<model:\w+>', 'verb'=>'GET'),
                        array('api/view', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
                        array('api/update', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),
                        array('api/delete', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
                        array('api/create', 'pattern'=>'api/<model:\w+>', 'verb'=>'POST'),
		    ),
		    'showScriptName'=>false,
		),
				
		'db'=>array(	        
    'class'            => 'CDbConnection' ,
			'connectionString' => 'mysql:host=bhukkasdb.clt9ctjhwqtc.ap-south-1.rds.amazonaws.com;dbname=vsure_restbhukkas',
			'emulatePrepare'   => true,
			'username'         => 'bhukkas_app',
			'password'         => '12bhukkas12',
			'charset'          => 'utf8',
			'tablePrefix'      => 'bk',
	    ),
	    
	    'functions'=> array(
	       'class'=>'Functions'	       
	    ),
	    'validator'=>array(
	       'class'=>'Validator'
	    ),
	    'widgets'=> array(
	       'class'=>'Widgets'
	    ),
             'mail'=> array(
	       'class'=>'mail'
	    ),
	    	    
	    'Smtpmail'=>array(
	        'class'=>'application.extension.smtpmail.PHPMailer',
	        'Host'=>"YOUR HOST",
            'Username'=>'YOUR USERNAME',
            'Password'=>'YOUR PASSWORD',
            'Mailer'=>'smtp',
            'Port'=>587, // change this port according to your mail server
            'SMTPAuth'=>true,   
	    ), 
	    
	    'GoogleApis' => array(
	         'class' => 'application.extension.GoogleApis.GoogleApis',
	         'clientId' => '', 
	         'clientSecret' => '',
	         'redirectUri' => '',
	         'developerKey' => '',
	    ),
            
            'Email' => array(
	         'class' => 'application.extension.smtpmail.Email',
	    ),
            
	),
);

function statusList()
{
	return array(
	 'publish'=>Yii::t("default",'Publish'),
	 'pending'=>Yii::t("default",'Pending for review'),
	 'draft'=>Yii::t("default",'Draft')
	);
}

function clientStatus()
{
	return array(
	  'pending'=>Yii::t("default",'pending for approval'),
	 'active'=>Yii::t("default",'active'),	 
	 'suspended'=>Yii::t("default",'suspended'),
	 'blocked'=>Yii::t("default",'blocked'),
	 'expired'=>Yii::t("default",'expired')
	);
}

function clientCategory()
{
	return array(
	 'restaurants'=>Yii::t("default",'Restaurants'),
	 'bakeries'=>Yii::t("default",'Bakeries'),	 
	 'cafe'=>Yii::t("default",'Cafe'),
	 'sweet'=>Yii::t("default",'Sweet')
	);
}


function clientStatusActive()
{
	return array(
	 'active'=>Yii::t("default",'active'),	 
	);
}

function paymentStatus()
{
	return array(
	 'pending'=>Yii::t("default",'pending'),
	 'paid'=>Yii::t("default",'paid'),
	 'draft'=>Yii::t("default",'Draft')
	);
}

function dump($data=''){
    echo '<pre>';print_r($data);echo '</pre>';
}

