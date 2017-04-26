<?php
/*
index.php

Entry point
Define constant and load neccesary php file for the framework

*/


//
// Define all the path constant
//

// Get the relative path and filename of the index.php script
// $_SERVER['DOCUMENT_ROOT'] is the document root dir of current excuting script,
// __FILE__ is full path and file name of the file
$_ScriptPath = str_replace( $_SERVER['DOCUMENT_ROOT'], '', __FILE__ );
define( '_INDEX_SCRIPT_PATH_', $_ScriptPath);
define( '_DOMAIN_', "http://$_SERVER[HTTP_HOST]");

define( '_BASE_dir', $_SERVER['DOCUMENT_ROOT'] . '/' );
define( '_SYSTEM_dir', $_SERVER['DOCUMENT_ROOT'].'/system/' );
define( '_LIB_dir', $_SERVER['DOCUMENT_ROOT'].'/system/lib/' );
define( '_LOG_dir', $_SERVER['DOCUMENT_ROOT'].'/system/log/' );

define( '_MODEL_dir', $_SERVER['DOCUMENT_ROOT'].'/application/model/' );
define( '_VIEW_dir', $_SERVER['DOCUMENT_ROOT'].'/application/view/' );
define( '_CONTROLLER_dir', $_SERVER['DOCUMENT_ROOT'].'/application/controller/' );


define( '_ASSETS_dir', '/application/assets/' );
define( '_STYLESHEET_dir', '/application/assets/css/');
define( '_IMAGE_dir', '/application/assets/image/');
define( '_SCRIPT_dir', '/application/assets/script/');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//
// Require all the framework dependency
//
function require_file($filename) {
    if(file_exists($filename)) {
        require $filename;
    }
    else {
        echo 'Framework Corrupted';
        die();
    }
}
require_file(_SYSTEM_dir.'Config.php');
require_file(_SYSTEM_dir.'Error.php');
require_file(_SYSTEM_dir.'Log.php');
require_file(_SYSTEM_dir.'Loader.php');
require_file(_SYSTEM_dir.'Controller.php');
require_file(_SYSTEM_dir.'Database.php');
require_file(_SYSTEM_dir.'Model.php');


//
// Start the URL Router
//
require_file(_SYSTEM_dir.'URI.php');





