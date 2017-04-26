<?php
class MF_Model {

    protected $db;

    public function __construct() {

        $this->db = new MF_Database();
    }

    protected function connect_db($db_name, $db_profile = NULL) {

        $DB = Database();
        $DB->connect($db_name, $db_profile);
    }

    protected function disconnect_db() {

        $DB->disconnect();
    }




}
