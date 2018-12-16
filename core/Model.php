<?php 
 
namespace Core; 


use Core\Connection;

abstract class Model {

    // define  a table
    protected $table = "";

    protected $fillable = [];
    public $_mysqli;

    /**
     * define a primary key
     */
    protected $primaryKey = 'id';

    protected $_column = '*';
    protected $_order = 'ORDER BY';

    protected $_whereClause = '';

    private  $_connection;
    private  $_instance; // the single instance
    private $_query = "SELECT *";

    private $_operator = ['.', "=", "=>", "=<", "<", ">", "LIKE", "not like"];


    /**
     * Construct
     * define a table
     */
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

    /**
     * get all data form table
     * return array
     */
    public function all(){
        return $this->_connection->query("SELECT * FROM {$this->table}")->fetch_all();
    }

    /**
     * func for select column
     * need param
     * @param array 
     * except (['id', 'name'])
     * or
     * @param string except ('name')
     */
    public function select($arr = '*'){
        $this->_column = "";

        if(is_array($arr)){

            foreach($arr as $key){
                if($key != end($arr)){
                    $this->_column .= $key . ', ';
                    $this->_query .= $key . ', ';
                }
                else if($key == end($arr)){
                    $this->_column .= $key;
                    $this->_query .= $key;
                }    
            }

        }else{
            $this->_column .= $arr;
            $this->_query .= $arr;

        }



        return $this;
    }

    public function where(array $arg){
        if($this->_whereClause == ""){
            $this->makeWhere($arg, "WHERE");
        }else{
            $this->makeWhere($arg, " AND");
        }

        return $this;
    }

    private function  makeWhere(array $arg, string $string) {
        if(count($arg) > 2){
            if(!empty(array_search($arg[1], $this->_operator)) ){
                if($arg[1] == "LIKE"){
                    $this->_whereClause .= "$string {$arg[0]} {$arg[1]} '%{$arg[2]}%'";                    
                }else{
                    $this->_whereClause .= "$string {$arg[0]} {$arg[1]} '{$arg[2]}'";
                }
            }   
        }else{
            $this->_whereClause .= "WHERE {$arg[0]} = '{$arg[1]}'";
        }
    }

    /**
     * get data
     */
    public function get(){

        $this->_query = "$this->_query FROM $this->table $this->_whereClause";

        $data = $this->_connection->query($this->_query);

        return mysqli_fetch_assoc($data);
    }

    public function first(){

        $this->_query = "$this->_query FROM $this->table $this->_whereClause limit 1";

        $data = $this->_connection->query($this->_query);

        return mysqli_fetch_assoc($data);
    }


    public function find($param){
        $query = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} ".'='. " '$param' LIMIT 1";

        $data = $this->_connection->query($query);

        return mysqli_fetch_assoc($data);
    }

    public function insert(array $array){
        $column = "";
        $value = "";
        foreach($array as $key => $val) {
            if(end($array) != $val) {
                $column .= "$key,";
                $value.= "'$val',";
            }else {
                $column .= "$key";
                $value .= "'$val'";
            }
        }

        $query = "INSERT INTO $this->table($column) values($value)";
        $sql = $this->_connection->query($query);
        
        return $sql;
    }

    public function destroy($param){
        $query = "DELETE FROM {$this->table} WHERE {$this->primaryKey} ".'='. " '$param'";

        $data = $this->_connection->query($query);

        return $data;
    }

}