<?php

class MF_Loader {

    public function __construct() {
    }

    public function model($model_name) {

        $path = _MODEL_dir . $model_name . '.php';

        if(file_exists($path)) {
            require $path;
        }
    }

    public function view($view_name, array $var = array() ) {

        $path = _VIEW_dir . $view_name . 'html';

        if(file_exists($path)) {
            extract($var);                              // Extract variable from the array
            ob_end_clean();					            // End Buffer
            ob_start();						            // Start a new buffer

            require $path;                      		// Load view

            ob_end_flush();					            // End Buffer
        }
    }

    public function library($lib_name) {

        $path = _LIB_dir . $lib_name;

        if(file_exists($path)) {
            require $path;
        }
        else {
            echo 'Error: Failed to load library '. $lib_name . '.php';
        }
    }


}
