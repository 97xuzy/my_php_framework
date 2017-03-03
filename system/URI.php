<?php
echo var_dump($_GET).'</br>';
echo var_dump($_SERVER);

$_RequestUri = $_SERVER['REQUEST_URI'];

if(isset( $_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI']) )
{
    $_URLPath = $_SERVER['REQUEST_URI'];
}
else if( isset($_SERVER['PATH_INFO']) && !empty($_SERVER['PATH_INFO']) )
{
    $_URLPath = $_SERVER['PATH_INFO'];
}
else if( isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING']) )
{
    $_URLPath = $_SERVER['QUERY_STRING'];
}
// FIX ME!!!
else if(true)
{
    echo var_dump($_GET);
    die();
}
else
{
    die('Page do not exist!');
}

// $_SERVER['DOCUMENT_ROOT'] is the document root dir of current excuting script, __FILE__ is full path and file name of the file
$_AppPath = str_replace( $_SERVER['DOCUMENT_ROOT'], '', __FILE__ );		// D:\workspace\test.php => \test.php

// separate the URL, Ex. www.abc.com/aa/bb/cc => www.abc.com, aa, bb, cc
$_AppPathArr = explode( DIRECTORY_SEPARATOR, $_AppPath );

// Everytime the URL has a slash, the $_URLPath will replace a slash with forward slash '/'
for ( $i = 0; $i < count($_AppPathArr); $i++ )
{
    $p = $_AppPathArr[$i];
    if ($p)
    {
        $_URLPath = preg_replace( '/^\/'.$p.'\//', '/', $_URLPath, 1 );
    }
}
$_URLPath = preg_replace( '/^\//', '', $_URLPath, 1 );

// separate the URL, if there is a post data,
// Ex. /admin/login?username=JohnXu&password=passJoh => /admin/login/username/JohnXu/password/passJoh
$_QueryURL_Arr = preg_split('/[?|= =|&]/', $_URLPath);

for ( $i = 0; $i < (count($_QueryURL_Arr)-1)/2; $i++ )
{
    $_URLPath = preg_replace( '/[?|= =|&]/', '/', $_URLPath, 2 );
}

$_AppPathArr = explode( "/", $_URLPath );
$_AppPathArr_Count = count($_AppPathArr);

$arr_url = array(
    'controller' => 'index.php',
    'method' => 'index',
    'parms' => array()
);

$arr_url['controller'] = $_AppPathArr[0];
$arr_url['method'] = $_AppPathArr[1];

// reDirect to home page (/home/index) if the url is incorrect or incompelete
if( empty($arr_url['controller']) )		// if controller is empty
{
    $arr_url['controller'] = 'home';
    $arr_url['method'] = 'index';
}
// reDirect to home page (/home/index) if the url is incorrect or incompelete
else if( !empty($arr_url['controller']) && empty ($arr_url['method']) )		// if the controller is not empty, but the method is empty
{
    $arr_url['method'] = 'index';
}

// Parameter detect
if ( $_AppPathArr_Count > 2 && $_AppPathArr_Count % 2 != 0 )
{
    die('Parameter Error!');
}
else
{
    for ($i = 2; $i < $_AppPathArr_Count; $i += 2)
    {
        $arr_temp_hash = array(strtolower( $_AppPathArr[$i])=>$_AppPathArr[$i + 1] );
        $arr_url['parms'] = array_merge( $arr_url['parms'], $arr_temp_hash );
    }
}

$module_name = $arr_url['controller'];
$module_file = _CONTROLLER_dir.$module_name.'.php';
$method_name = $arr_url['method'];
$parms = $arr_url['parms'];

//echo '<p>'.$module_file.'</p>';
//echo '<p>'.$method_name.'</p>';

if ( file_exists($module_file) )			// if the controller file exist
{
    //ob_end_clean();
    clearstatcache();
    include ($module_file);

    $obj_module = new $module_name();

    if ( !method_exists($obj_module, $method_name) )		// if the method DO NOT exist
    {
        die("<p>Method does not exist!</p>");
        return ERROR_404;
    }
    else
    {
        if ( is_callable( array($obj_module, $method_name) ) )
        {
            if( !empty($parms) )
            {
                $obj_module -> $method_name($parms);
            }
            else
                $obj_module -> $method_name();
        }
        else
        {
            die("<p>Method can not be called!</p>");
            return ERROR_404;
        }
    }
}
else
{
    die("<p>Module does not exist!</p>");
    return ERROR_404;
}

/*
// 看看是否是从命令行运行的
if (php_sapi_name() == 'cli' or defined('STDIN')){
    $this->_set_uri_string($this->_parse_cli_args());
    return;
}

// 首先尝试 REQUEST_URI 这个适应大部分的情况
if ($uri = $this->_detect_uri()){
    $this->_set_uri_string($uri);
    return;
}

// 看看PATH_INFO变量是否存在？nginx需要配置
// Note: some servers seem to have trouble with getenv() so we'll test it two ways
$path = (isset($_SERVER['PATH_INFO'])) ? $_SERVER['PATH_INFO'] : @getenv('PATH_INFO');
if (trim($path, '/') != '' && $path != "/".SELF){
    $this->_set_uri_string($path);
    return;
}

// 没有PATH_INFO，看看 QUERY_STRING?
$path =  (isset($_SERVER['QUERY_STRING'])) ? $_SERVER['QUERY_STRING'] : @getenv('QUERY_STRING');
if (trim($path, '/') != ''){
    $this->_set_uri_string($path);
    return;
}

//尝试去从 $_GET 获取信息
if (is_array($_GET) && count($_GET) == 1 && trim(key($_GET), '/') != ''){
    $this->_set_uri_string(key($_GET));
    return;
}

// 尽力了，放弃了路由
$this->uri_string = '';
return;

*
