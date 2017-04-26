<?php

class Test_Model extends MF_Model {

    public function __construct() {

        parent::__construct();
        $this->db->connect('Store');
    }

    public function __destruct() {

        $this->db->disconnect();
    }

    public function test_query() {

        $sql = 'SHOW DATABASES';
        $result = $this->db->query($sql);

        return $result;
    }



}




