<?php
/*
URL Utility library

All kinds of url helper utility
*/

if(! function_exists('base_url')) {

    function base_url($path) {
        return _DOMAIN_ . _BASE_dir . $path;
    }

}


if(! function_exists('site_url')) {

    function site_url($path) {
        return _BASE_dir . $path;
    }

}


if(! function_exists('css_url')) {

    function css_url($filename) {
        return _DOMAIN_ . _STYLESHEET_dir . $filename;
    }

}


if(! function_exists('script_url')) {

    function script_url($filename) {
        return _DOMAIN_ . _SCRIPT_dir . $filename;
    }

}


if(! function_exists('redirect')) {

    function redirect($url) {

        // Clean and End the existing output buffer, and start a new one
        ob_end_clean();
        ob_start();

        echo "<meta http-equiv=\"refresh\" content=\"0; URL='$url'\" />";

        // Output the buffer
        ob_end_flush();
    }

}


