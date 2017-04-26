<?php

class Home extends MF_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->library('URL');
    }

    public function index() {
        // Homepage for the store
        $this->load->view('home_view');

        $this->load->model('Test');
        $t = new Test_Model();
        echo var_dump($t->test_query());

    }


}
