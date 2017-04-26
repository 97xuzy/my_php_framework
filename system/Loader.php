<?php

class MF_Loader {

    public function __construct() {
    }

    public static function model($model_name) {

        $path = _MODEL_dir . $model_name . '.php';

        if(file_exists($path)) {
            require_once $path;
        }
    }

    public static function view($view_name, array $var = array() ) {

        // If load more than one view file
        if(is_array($view_name)) {

            ob_end_clean();
            ob_start();

            extract($var);              // Extract variable from the array

            // Load file according to the order in the array
            foreach($view_name as $name) {

                $path = _VIEW_dir . $name . '.php';

                if(file_exists($path)) {

                    require_once $path;
                }
            }
            ob_end_flush();
        }
        // If only a single view file
        else {

            $path = _VIEW_dir . $view_name . '.php';

            if(file_exists($path)) {

                extract($var);                              // Extract variable from the array
                ob_end_clean();					            // End Buffer
                ob_start();						            // Start a new buffer

                require_once $path;                      		// Load view

                ob_end_flush();					            // End Buffer
            }
        }
    }

    public static function library($lib_name) {

        $path = _LIB_dir . $lib_name . '.php';

        if(file_exists($path)) {
            require_once $path;
        }
        else {
            echo 'Error: Failed to load library '. $lib_name . '.php';
            log_error('Failed to load library '. $lib_name . '.php', 'Loader.php');
        }
    }


}
