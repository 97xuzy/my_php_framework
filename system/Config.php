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
$_SECURITY['xss_enable'] = true;
$_SECURITY['csrf_enable'] = true;




//////////////////////////////////////////////////
//
// Database Setting
//
//////////////////////////////////////////////////
$_DB = array();
 
// Default Database Profile
$_DB['default'] = array(
    'db' => 'mysql',
    'dbname' => 'quotes',
    'host' => '127.0.0.1',
    'username' => 'root',
    'password' => 'ThisRot'
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
