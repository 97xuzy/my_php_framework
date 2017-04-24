<?php
/*
 * 
 * 
 * The Routing is derived from the code from the following blog post
 * http://www.cnblogs.com/fredshare/archive/2012/09/17/2688944.html 
 * 
 */
echo var_dump($_SERVER);
echo '<br/>';
echo var_dump($_SESSION);
//
// Try to get the URI
//
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


// Get the relative path and filename of the index.php script
// /var/www/html/index.php => /index.php
$_AppPath = _INDEX_SCRIPT_PATH_;

// Separate the URL, Ex. www.abc.com/aa/bb/cc => www.abc.com, aa, bb, cc
$_AppPathArr = explode( DIRECTORY_SEPARATOR, $_AppPath );
 
// Everytime the URL has a slash, the $_URLPath will replace a slash with forward slash '/'
for ( $i = 0; $i < count($_AppPathArr); $i++ ) {

    $p = $_AppPathArr[$i];
    if ($p) {

        $_URLPath = preg_replace( '/^\/'.$p.'\//', '/', $_URLPath, 1 );
    }
}
// Remove the first slash
$_URLPath = preg_replace( '/^\//', '', $_URLPath, 1 );

// Remove the index.php from URL
if(substr($_URLPath, 0, strlen($_AppPath)) == $_AppPath)
    $_URLPath = substr($_URLPath, strlen($_AppPath));

// Remove the first slash
$_URLPath = preg_replace( '/^\//', '', $_URLPath, 1 );


// Convert the url data to the slash seperated form
// e.g. /admin/login?username=JohnXu&password=passJoh => /admin/login/username/JohnXu/password/passJoh
$_QueryURL_Arr = preg_split('/[?|= =|&]/', $_URLPath);

for ( $i = 0; $i < (count($_QueryURL_Arr)-1)/2; $i++ ) {

    $_URLPath = preg_replace( '/[?|= =|&]/', '/', $_URLPath, 2 );
}

// Get rid of the last slash, e.g. '/a/1/' => '/a/1'
if(substr($_URLPath, -1) == '/') {

	$_URLPath = substr($_URLPath, 0, -1);
}

// Split the URL path into array
$_AppPathArr = explode( "/", $_URLPath );
$_AppPathArr_Count = count($_AppPathArr);

$arr_url = array(
    'controller' => '',
    'method' => '',
    'params' => array()
);

// If the URL is incomplete, then make it /home/index
$arr_url['controller'] = empty($_AppPathArr[0]) ? 'home': $_AppPathArr[0];
$arr_url['method'] = empty($_AppPathArr[1]) ? 'index' : $_AppPathArr[1];


//
// Parameter detect
//

// If there is param in the URL (count > 2), then there the count must be even number, a param to a value
if ( $_AppPathArr_Count > 2 && $_AppPathArr_Count % 2 != 0 )
{
    die('<p>Parameter Error!</p>');
}
else
{
    for ($i = 2; $i < $_AppPathArr_Count; $i += 2)
    {
        $arr_temp_hash = array(strtolower( $_AppPathArr[$i])=>$_AppPathArr[$i + 1] );
        $arr_url['params'] = array_merge( $arr_url['params'], $arr_temp_hash );
    }
}


//
// Routing
// Call the specific method of the specific class
//
$module_name = ucfirst($arr_url['controller']);
$module_file = _CONTROLLER_dir.$module_name.'.php';
$method_name = $arr_url['method'];
$params = $arr_url['params'];
/*
echo 'Module File Path:' . $module_file;
echo '<br/>';
echo 'Module File Name' . $module_name;
echo '</br>';
echo 'Method Name: ' . $method_name;
echo '</br>';
echo 'Params: ' . var_dump($params);
echo '</br>';
*/

if ( file_exists($module_file) )			// if the controller file exist
{
    //ob_end_clean();
    clearstatcache();
    include ($module_file);

    $obj_module = new $module_name();

    // Check if the method exist
    if ( !method_exists($obj_module, $method_name) )
    {
        die("<p>Method does not exist!</p>");
    }
    else
    {
        // Check if the method can be called
        if ( is_callable( array($obj_module, $method_name) ) )
        {
            if( !empty($parms) )
            {
                $obj_module -> $method_name($params);
            }
            else
                $obj_module -> $method_name();
        }
        else
        {
            die("<p>Method can not be called!</p>");
        }
    }
}
else
{
    die("<p>Module does not exist!</p>");
}


