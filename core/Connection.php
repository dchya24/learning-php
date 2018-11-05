<?php 
    
namespace Core; 

// $DB = new \mysqli(config('DB_HOST').':'.config('DB_PORT'), config('DB_USER'), 
// config('DB_PASS'), config('DB_NAME'));

class Connection
{
    
    private $_connection;
    /*
    * Get Instance of the Database
    @return Instance
    */

    public static function getInstance(){
        if(!self::$_instance){
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    // construct
    public function __construct()
    {
        $conf = parse_ini_file(__DIR__ . '/../.config');

        $this->_connection = new \mysqli(config('DB_HOST').':'.config('DB_PORT'), config('DB_USER'), 
        config('DB_PASS'), config('DB_NAME'));

        // error handling
        if(mysqli_connect_error()){
            trigger_error("Failed to connect to MYSQL : " . mysqli_connect_error(), E_USER_ERROR);
        }
    }

    private function __clone() { }

    public static function querySelect($string){
        $inst = new self();
        $query = $inst->_connection->query($string);

        return $query;
    }

    public static function queryInsert($string){
        $inst = new self();
        $query = $inst->_connection->query($string);

        return $query;
    }
}

?>