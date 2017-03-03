<?php

define( '_MODEL_dir', $_SERVER['DOCUMENT_ROOT'].'/application/model/' );
define( '_VIEW_dir', $_SERVER['DOCUMENT_ROOT'].'/application/view/' );
define( '_CONTROLLER_dir', $_SERVER['DOCUMENT_ROOT'].'/application/controller/' );
define( '_SYSTEM_dir', $_SERVER['DOCUMENT_ROOT'].'/system/' );

define( '_ASSETS_dir', '/application/assets' );
define( '_STYLESHEET_dir', '/application/assets/css');
define( '_IMAGE_dir', '/application/assets/image');
define( '_SCRIPT_dir', '/application/assets/script/');

require _SYSTEM_dir.'Config.php';
require _SYSTEM_dir.'Controller.php';
require _SYSTEM_dir.'View.php';
require _SYSTEM_dir.'Model.php';


error_reporting(0);

require _SYSTEM_dir."URI.php";





