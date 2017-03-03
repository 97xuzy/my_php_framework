<?php

// Error Utility Function
// Author: John Xu

class Error
{
    public $error_code;

    public Error()
    {
    }

    public Error($error_code)
    {
        $this->error_code = $error_code;
    }

    public function display_error()
    {
        // If display detail error info
        if(isset($config['SHOW_DETAIL_ERROR']))
        {
        }
        else
        {
            echo "Error, the link you access is unavailable";
        }
    }




}


