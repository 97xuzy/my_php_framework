<?php
/*
Log Library

Log library only works if has access to the log directory

*/


if(!function_exists('log_error')) {

    function log_error($msg, $error_filename = NULL) {

        $time = localtime();
        $filename = _LOG_dir . sprintf('%d-%d-%d.log', $time[5], $time[4], $time[3]);

        // If do not have access
        if(! is_writable($filename))
            return;

        $file = fopen($filename, 'a+');

        // If unable to open file
        if($file == FALSE)
            return;

        $str = sprintf('%d-%d-%d %d:%d:%d Error\t%s\t%s\n', $time[5], $time[4], $time[3],
            $time[2], $time[1], $time[0], $msg);
        fwrite($file, $str);
        fclose($file);

    }
}


if(!function_exists('log_warn')) {

    function log_warn($msg, $error_filename = NULL) {

        $time = localtime();
        $filename = _LOG_dir . sprintf('%d-%d-%d.log', $time[5], $time[4], $time[3]);

        // If do not have access
        if(! is_writable($filename))
            return;

        $file = fopen($filename, 'a+');

        // If unable to open file
        if($file == FALSE)
            return;

        $str = sprintf('%d-%d-%d %d:%d:%d Warn\t%s\t%s\n', $time[5], $time[4], $time[3],
            $time[2], $time[1], $time[0], $error_filename, $msg);
        fwrite($file, $str);
        fclose($file);
    }
}


if(!function_exists('log_event')) {

    function log_event($msg, $error_filename = NULL) {

        $time = localtime();
        $filename = _LOG_dir . sprintf('%d-%d-%d.log', $time[5], $time[4], $time[3]);

        // If do not have access
        if(! is_writable($filename))
            return;

        $file = fopen($filename, 'a+');

        // If unable to open file
        if($file == FALSE)
            return;

        $str = sprintf('%d-%d-%d %d:%d:%d Event\t%s\t%s\n', $time[5], $time[4], $time[3],
            $time[2], $time[1], $time[0], $error_filename, $msg);
        fwrite($file, $str);
        fclose($file);
    }
}
