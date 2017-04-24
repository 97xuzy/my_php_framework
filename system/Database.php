<?php
class MF_Database {

    private $DB;
    private $result;

    public function __construct() {
        $this->DB = NULL;
        $this->result = NULL;
    }

    public function connect($db_profile = NULL) {

        if($db_info == NULL || !isset($_DB[$db_profile])) {
            $db = $_DB['default']['db'] . ':' . 'dbname=' . $_DB['default']['dbname'] . ';host=' . $_DB['default']['host'];
            $user = $_DB['default']['username'];
            $password =  $_DB['default']['password'];

        }
        else {

            $db = $_DB[$db_profile]['db'] . ':' . 'dbname=' . $_DB[$db_profile]['dbname'] . ';host=' . $_DB[$db_profile]['host'];
            $user = $_DB[$db_profile]['username'];
            $password =  $_DB[$db_profile]['password'];
        }

        try {
            $this->DB = new PDO($db, $user, $password);
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            MF_Error e(500);
            e->display_error();
            exit();
        }
    }

    public function disconnect() {

        $this->result = NULL;
        $this->DB = NULL;
    }

    public function query($sql) {

        if($DB != NULL) {
            $stmt = $this->DB->query($sql);
            $this->result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return $this->result;
    }








}


