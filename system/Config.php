<?php
$_CONFIG = array();

//////////////////////////////////////////////////
// 
// Log Setting
//
//////////////////////////////////////////////////
$_CONFIG['enable_log'] = true;
$_CONFIG['error_log'] = true;
$_CONFIG['warn_log'] = true;
$_CONFIG['event_log'] = true;


//////////////////////////////////////////////////
//
// Security Setting
//
//////////////////////////////////////////////////
$_CONFIG['xss_enable'] = true;
$_CONFIG['csrf_enable'] = true;
$_CONFIG['csrf_token_duration'] = 120;

// When session is not enabled, the csrf id will be stored in the database
// When you enable this make sure the corrsponding database and table exist
$_CONFIG['csrf_non_session_enable'] = false;




//////////////////////////////////////////////////
//
// Database Setting
//
//////////////////////////////////////////////////
$_DB = array();
 
// Default Database Profile
$_DB['default'] = array(
    'db' => 'mysql',
    'host' => '127.0.0.1',
    'username' => 'root',
    'password' => ''
);

// Custom Database Profile
/*
$_DB['custom'] = array(
    'db' => 'mysql',
    'dbname' => '',
    'host' => '127.0.0.1',
    'username' => '',
    'password' => ''
);
*/
define('_CONFIG', $_CONFIG);
define('_DB', $_DB);
