<?php 
 
// namespace library\Model; 

abstract class Model {

    // define  a table
    protected $table;

    protected $column = '*';

    private $whereClause = '';

    // function for query select
    public function select($param = '*')
    {   
        if($param == '*')
        {
            die(var_dump('function <b> with </b> not have a parameter'));
        }
        

        if(is_array($param))
        {
            foreach($param as $key){
                if($this->column == '*')
                {
                    $this->column = $key;
                }else{
                    $this->column =  $this->column . ', ' . $key;
                }
    
            }
        }else{
            $this->column = $param;
        }
        

        return $this;
    }

    // where clause 
    public function where($data){
        if(is_array($data)){

        }else{
            $this->whereClause = 'WHERE' . $data;
        }

        return $this;
    }   


    public function get()
    {
        $sql = "SELECT " . $this->column . " FORM " . $this->table . ' ' . $this->whereClause;

        return $sql;
    }

    public function create(array $data){
        $col = '';
        $val = '';

        foreach ($data as $key => $value) {
            $col = $col . $key . ', ';
            $val = $val . $value . ', ';
        }

        $query = "INSERT INTO " . $this->table 
                    . ' ('. $col .') VALUES (' .$val .')';

        return $query;

    }

}