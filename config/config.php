<?php
	Config::set('site_name', 'Your Site Name');
	
	Config::set('languages', array('en', 'fr'));
	
	// Routes. Route => method prefix
	Config::set('routes', array(
		'defualt' => '', 
		'admin' => 'admin_',
	));
	
	Config::set('default_route', 'defualt');
	Config::set('defualt_language', 'en');
	Config::set('defualt_controller', 'pages');
	Config::set('defualt_action', 'index');
	
	Config::set('db.host', 'localhost');
	Config::set('db.user', 'root');
	Config::set('db.password', '');
	Config::set('db.db_name', 'mvc');
	
	Config::set('salt', 'jd7aj3skd964he73');