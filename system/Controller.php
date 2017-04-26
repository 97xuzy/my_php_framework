<?php
class MF_Controller
{

    protected $data = [];
    protected $load;

    public function __construct() {

        $this->load = new MF_Loader;
    }

    protected function check_param($params, $param_name_array) {
        $flag = TRUE;
        foreach($param_name_array as $param_name) {
            if(! isset($params[$param_name]))
                $flag = FALSE;
        }
        return $flag;
    }


}
