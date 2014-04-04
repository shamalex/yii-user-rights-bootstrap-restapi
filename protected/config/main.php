<?php
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
YiiBase::setPathOfAlias('rest', realpath(__DIR__ . '/../extensions/yii-rest-api/library/rest'));
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'sourceLanguage' => 'en',
	'language' => 'ru',
	'theme'=>'blackboot',
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Тестовый сайт',

	// preloading 'log' component
	'preload' => array('restService'),
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.user.models.*',
		'application.modules.user.components.*',
		'application.modules.rights.*',
		'application.modules.rights.models.*',
		'application.modules.rights.components.*',
	),

	'modules'=>array(
		'user',
		'rights',
		
		'gii'=>array(
				'generatorPaths'=>array(
					'bootstrap.gii',
				),
			),
		'user'=>array(
		  'hash' => 'crc32',
		  'sendActivationMail' => false,
		  'loginNotActiv' => false,
		  'activeAfterRegister' => true,
		  'autoLogin' => true,
		  'registrationUrl' => array('/user/registration'),
		  'recoveryUrl' => array('/user/recovery'),
		  'loginUrl' => array('/user/login'),
		  'returnUrl' => array('/tovar/index'),
		  'returnLogoutUrl' => array('/user/login'),
		),
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'temp',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),  

	// application components
	'components'=>array(
		'restService' => array(  
        'class'  => '\rest\Service',  
        'enable' => strpos($_SERVER['REQUEST_URI'], '/api/') !== false, // for example
    ),
		'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class' => 'RWebUser',
		),
		'authManager'=>array(
			'class'=>'RDbAuthManager',
			'defaultRoles' => array('Guest'),
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
		'urlFormat'=>'path',
			 'showScriptName'=>false,
			 'caseSensitive'=>false,
		   'rules'=>array(

				array('api/allelements', 'pattern'=>'api/<model:\w+>', 'verb'=>'GET'),
        array('api/singleelement', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
        // Other controllers
		     '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
			'tablePrefix' => 'tbl_',
		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=users',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
		),
		
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);