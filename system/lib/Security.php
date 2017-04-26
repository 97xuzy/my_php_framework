<?php


// Injection
function sql_clean($string) {
    return mysqli_real_escape_string($string);
}

function php_clean($string) {
}

function html_clean($string) {
    return htmlentities($string);
}

function csrf_token_gen() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $alphabet = str_split($alphabet);
    $salt = array_rand($alphabet, 10);

    // If session is enabled
    if (session_status() == PHP_SESSION_ACTIVE) {
        $token = $_SERVER['UNIQUE_ID'];
        $token = uniqid();
        $token .= $salt;
        $token = md5($token);

        // Store the token in the $_SESSION
        $_SESSION['csrf_token'] = $token;
        $_SESSION['csrf_time'] = microtime();
        return $token;
    }
    // Session NOT enabled, store the token in the database
    // db_name:    csrf
    // table:      csrf
    else if($_CONFIG['csrf_non_session_enable'] == true) {
        $token = session_id();
        $token .= $salt;
        $token = md5($token);
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $time = microtime();

        // Store the token
        MF_Database $db;
        $db->connect('csrf');
        $db->query("INSERT INTO 'csrf' (IP,token,time) VALUES ($ip, $token, $time);");
        $db->disconnect();
        return $token;
    }
}

function csrf_token_verify($token) {
    if (session_status() == PHP_SESSION_ACTIVE) {
    }
    else if($_CONFIG['csrf_non_session_enable'] == true) {
    }
}

function csrf_destory() {
    if (session_status() == PHP_SESSION_ACTIVE) {
    }
    else {
    }
}



