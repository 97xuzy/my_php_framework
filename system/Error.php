<?php

// Error Utility
// Author: John Xu

class MF_Error {

    public $error_code;
    public $error_msg;

    public function __construct($error_code=404, $error_msg='') {

        $this->error_code = $error_code;
        $this->error_msg = $error_msg;
    }

    public function display_error() {

        $code = $this->error_code;
        $msg = $this->error_msg;
        $path = _VIEW_dir . 'error/' . $error_code. 'php';

        if(file_exists($path)) {
            ob_end_clean();					            // End Buffer
            ob_start();						            // Start a new buffer

            require $path;                      		// Load view

            ob_end_flush();					            // End Buffer
        }
    }

    public function display_error_view($view_name) {

        $code = $this->error_code;
        $msg = $this->error_msg;
        $path = _VIEW_dir . 'error/' . $view_name. 'php';

        if(file_exists($path)) {
            ob_end_clean();					            // End Buffer
            ob_start();						            // Start a new buffer

            require $path;                      		// Load view

            ob_end_flush();					            // End Buffer
        }
    }




}


