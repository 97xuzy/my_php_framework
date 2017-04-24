<?php
class MF_Model
{
    protected $db;

    public function __construct() {
        $this->db = NULL;        
    }

    protected function connect_db($db_profile = NULL) {

        $DB = Database();
        $DB->connect($db_profile);
    }

    protected function disconnect_db() {

        $DB->disconnect();
    }




}
