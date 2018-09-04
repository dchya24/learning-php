<?php 
 

namespace Core; 

require('Connection.php');
require('config.php');

use Core\Connection;
use Core\Config;

class Model {

    // define  a table
    protected $table = "";


    public $_mysqli;

    protected $_column = '*';
    protected $_order = 'ORDER BY';

    protected $_whereClause = '';

    private  $_connection;
    private  $_instance; // the single instance

    // private $env;


    /**
     * Get an Instance of the database
     * @return Instance
     */
    public function getInstance(){
        if(!$this->_instance){
            $this->_instance = new self();
        }

        return $this->_instance;
    }

    // construct
    public function __construct(){
        if($this->table == null){
            $className = substr(get_called_class(), strrpos(get_called_class(), '\\') + 1);

            $this->table = strtolower($className . 's');
        }

        $this->_connection = new \mysqli(config('DB_HOST'), config('DB_USER'), 
            config('DB_PASS'), config('DB_NAME'));
	
		// Error handling
		if(mysqli_connect_error()) {
			trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
				 E_USER_ERROR);
		}

    }

    public function all(){
        return $this->_connection->query('SELECT * FROM users')->fetch_all();
    }

    /**
     * func for select column
     */
    public function select($arr){
        $this->_column = "";

        if(is_array($arr)){

            foreach($arr as $key){
                if($key != end($arr)){
                    $this->_column .= $key . ', ';
                }
                else if($key == end($arr)){
                    $this->_column .= $key;
                }    
            }

        }else{
            $this->_column .= $arr;
        }


        return $this;
    }

    public function where($arg){
        return $this;
    }

    public function get(){

        $query = "SELECT {$this->_column} FROM {$this->table}";

        $data = $this->_connection->query($query)->fetch_all();

        return $data;
    }


}