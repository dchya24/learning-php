<?php 
    
namespace Core; 

date_default_timezone_set('Asia/Jakarta');

class Connection
{
    

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

        $this->__connection = new \mysqli($conf['DB_HOST'], $conf['DB_USER'], 
                            $conf['DB_PASS'], $conf['DB_NAME']);

        // error handling
        if(mysqli_connect_error()){
            trigger_error("Failed to connect to MYSQL : " . mysqli_connect_error(), E_USER_ERROR);
        }
    }

    private function __clone() { }

    public function getConnection(){
        return $this->_connection;
    }   
}

?>