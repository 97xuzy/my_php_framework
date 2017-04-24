<?php


if(!function_exists('log_error')) {

    function log_error($msg) {

        $time = localtime();
        $filename = __LOG_dir . sprintf('%d-%d-%d.log', $time[5], $time[4], $time[3]);

        $file = fopen($filename, 'a+');
        $str = sprintf('%d-%d-%d %d:%d:%d    %s\n', $time[5], $time[4], $time[3],
            $time[2], $time[1], $time[0], $msg);
        fwrite($file, $str);
        fclose($file);

    }
}


if(!function_exists('log_warn')) {

    function log_warn($msg) {

        $time = localtime();
        $filename = __LOG_dir . sprintf('%d-%d-%d.log', $time[5], $time[4], $time[3]);

        $file = fopen($filename, 'a+');
        $str = sprintf('%d-%d-%d %d:%d:%d    %s\n', $time[5], $time[4], $time[3],
            $time[2], $time[1], $time[0], $msg);
        fwrite($file, $str);
        fclose($file);
    }
}


if(!function_exists('log_event')) {

    function log_event($msg) {

        $time = localtime();
        $filename = __LOG_dir . sprintf('%d-%d-%d.log', $time[5], $time[4], $time[3]);

        $file = fopen($filename, 'a+');
        $str = sprintf('%d-%d-%d %d:%d:%d    %s\n', $time[5], $time[4], $time[3],
            $time[2], $time[1], $time[0], $msg);
        fwrite($file, $str);
        fclose($file);
    }
}
