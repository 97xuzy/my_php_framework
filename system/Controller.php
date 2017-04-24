<?php
class MF_Controller
{

    protected $data = [];
    protected $loader;

    public function __construct() {
        $this->loader =& MF_Loader();
    }


}
