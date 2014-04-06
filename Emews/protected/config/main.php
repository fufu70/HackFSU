<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Xeres',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.controllers.*',
		'ext.giix-components.*',
	),

	'modules'=>array(
			// uncomment the following to enable the Gii tool
			
			'gii'=>array(
				'class'=>'system.gii.GiiModule',
				'password'=>'here',
				'generatorPaths' => array(
				'ext.giix-core', // giix generators
			),
		),
	),
	'defaultController'=>'site',

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// 'urlManager' => array(
		// 	'urlFormat'
		//     'rules' => array(
		//       '' => 'site/add',
		//     ),
		// ),
		// uncomment the following to enable URLs in path-format
		
		
        'urlManager'=>array(
        	'urlFormat'=>'path',
        	'rules'=>array(
                        // REST patterns
                        array('api/list', 'pattern'=>'api/<model:\w+>', 'verb'=>'GET'),
                        array('api/view', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
                        array('api/update', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),  // Update
                        array('api/delete', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
                        array('api/create', 'pattern'=>'api/<model:\w+>', 'verb'=>'POST'), // Create
                        '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
        	),
        ),
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=menagerie',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'fredrichdergrosse',
			'charset' => 'utf8',
		),
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
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
		'hash'=>array('class'=>'PBKDF2Hash'),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']

	'params'=>require(dirname(__FILE__).'/params.php'),
	'controllerMap'=>array(
		'site'=>'application.controllers.SiteController',
		'doorkeeper'=>'application.controllers.DoorKeeperController',
	),
);
