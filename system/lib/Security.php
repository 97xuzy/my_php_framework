<?php


// Injection
public function sql_clean($string) {
}

public function php_clean($string) {
}

public function js_clean($string) {
    return htmlentities($string);
}

public function csrf_token_gen() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $alphabet = str_split($alphabet);
    $token = array_rand($alphabet, 50);
    return $token;
}

public function csrf_token_verify($token) {
}



