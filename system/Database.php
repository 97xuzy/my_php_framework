<?php
class MF_Database {

    private $DB;
    private $result;
    private $statement;

    public function __construct() {
        $this->DB = NULL;
        $this->result = NULL;
        $this->statement = NULL;
    }

    public function connect($db_name, $db_profile = NULL) {

        //
        // Initalize Connection Profile
        //
        if(! isset(_DB[$db_profile])) {
            $db = _DB['default']['db'] . ':' . 'dbname=' . $db_name . ';host=' . _DB['default']['host'];
            $user = _DB['default']['username'];
            $password =  _DB['default']['password'];

        }
        else {

            $db = _DB[$db_profile]['db'] . ':' . 'dbname=' . _DB_name . ';host=' . _DB[$db_profile]['host'];
            $user = _DB[$db_profile]['username'];
            $password =  _DB[$db_profile]['password'];
        }

        // Attempt Connection
        try {
            $this->DB = new PDO($db, $user, $password);
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            // Display Error Page
            $error = new MF_Error(500);
            $error->display_error();

            // Log Error
            log_error('Database fail to connect');
            exit();
        }
    }

    public function disconnect() {

        $this->result = NULL;
        $this->DB = NULL;
    }

    public function query($sql, $param = NULL) {

        if($this->DB == NULL) {
            return NULL;
        }
        // If the $param is not specified, then use query()
        if($param == NULL) {
            $stmt = $this->DB->query($sql);
            $this->result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $this->result;
        }
        // Otherwise use prepare() and execute()
        elseif(is_array($param)) {
            $this->statement = $this->DB->prepare($sql);
            $this->statement->execute($param);
        }
        else {
            return NULL;
        }
    }





}


