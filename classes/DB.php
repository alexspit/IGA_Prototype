<?php
class DB{
    //_ is a notation for private properties
    //Store an instance of the database or instantiate it
    private static $_instance = null;
    private $_pdo, //Store the PDO object
            $_query, //Last query executed
            $_error = false, //Stores errors incase query fails
            $_results, //Store result set
            $_count = 0; //Count of effected rows
    public $last_inserted_id;
    
   private function __construct() {
       try{
           $this->_pdo = new PDO('mysql:host='. Config::get('mysql/host').';dbname='. Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
           //Force the handler to fire an exception if there is an error connecting to the DB.
          // $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          //$this->_pdo->setAttribute(PDO::ATTR_PERSISTENT, false);
               
           
       }catch(PDOException $e){
           die($e->getMessage());
       }
   }
   
   //Function to avoid reconnecting to the database everytime it is being queried. 
   public static function getInstance(){
       if(!isset(self::$_instance)){
           self::$_instance = new DB();
           
       }
       
       return self::$_instance;
       
   }
   
   //Setting a function to query the database
   //1st Param: sql query string, 2nd Param: Value for prepared statement
   public function query($sql, $parameters = array()){
       $this->_error = false;//Avoid returning an error for a previous query
       if($this->_query = $this->_pdo->prepare($sql)){//Check if the sql statement is prepared correctly
           $x = 1;
           //echo $sql. ' prepared </br>';
           if(count($parameters)){//Checking if array has data
               foreach ($parameters as $param){
              // for ($x=1;$x<=count($parameters);$x++)  {
               //  $this->_query->bindValue($x, $paramaters[$x]);
              // }
              $this->_query->bindValue($x, $param);
              $x++;
              //echo $param.' binded  </br>';
              }
                   
           }
           
           if($this->_query->execute()){
               
               
               $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
               $this->_count = $this->_query->rowCount();
               $this->last_inserted_id = $this->_pdo->lastInsertId();
           }
           else
           {   
               print_r( $this->_query->errorInfo());
               $this->_error = true;
           }
       }
       
       return $this; // Return the current object
       
   }
   
      public function queryAssoc($sql, $parameters = array()){
       $this->_error = false;//Avoid returning an error for a previous query
       if($this->_query = $this->_pdo->prepare($sql)){//Check if the sql statement is prepared correctly
           $x = 1;
           //echo $sql. ' prepared </br>';
           if(count($parameters)){//Checking if array has data
               foreach ($parameters as $param){
              // for ($x=1;$x<=count($parameters);$x++)  {
               //  $this->_query->bindValue($x, $paramaters[$x]);
              // }
              $this->_query->bindValue($x, $param);
              $x++;
              //echo $param.' binded  </br>';
              }
                   
           }
           
           if($this->_query->execute()){
               //echo 'Executed </br>';
               $this->_results = $this->_query->fetchAll(PDO::FETCH_ASSOC);
               $this->_count = $this->_query->rowCount();
               $this->last_inserted_id = $this->_pdo->lastInsertId();
           }
           else
           {   print_r( $this->_query->errorInfo());
               $this->_error = true;
           }
       }
       
       return $this; // Return the current object
       
   }
   
   public function queryClass($sql, $parameters = array(), $class){
       
       
       $this->_error = false;//Avoid returning an error for a previous query
       if($this->_query = $this->_pdo->prepare($sql)){//Check if the sql statement is prepared correctly
           $x = 1;
           //echo $sql. ' prepared </br>';
           if(count($parameters)){//Checking if array has data
               foreach ($parameters as $param){
              // for ($x=1;$x<=count($parameters);$x++)  {
               //  $this->_query->bindValue($x, $paramaters[$x]);
              // }
              $this->_query->bindValue($x, $param);
              $x++;
              //echo $param.' binded  </br>';
              }
                   
           }
           
           if($this->_query->execute()){
               //echo 'Executed </br>';
               $this->_results = $this->_query->fetchAll(PDO::FETCH_CLASS, $class);
               $this->_count = $this->_query->rowCount();
           }
           else
           {   print_r( $this->_query->errorInfo());
               $this->_error = true;
           }
       }
       
       
       return $this->_results; // Return the current object
       
   }
   
   public function action($action, $table, $where = array()){
       if(count($where) === 3){
           $operators = array('=', '>', '<', '>=', '<=');
           
           $field = $where[0];
           $operator = $where[1];
           $value = $where[2];
           
           if(in_array($operator, $operators)){
               $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
               
               if(!$this->query($sql, array($value))->error()){
                   return $this;
               }
           }
       }
       return false;
   }
   
   public function get($table, $where){
       return $this->action('SELECT *', $table, $where);
   }
   
   public function delete($table, $where){
       return $this->action('DELETE', $table, $where);
   }
   
   public function insert($table, $fields = array()){
       if(count($fields)){//Check if we have data in array
           $keys = array_keys($fields);
           $values = '';
           $x = 1;
           
           foreach($fields as $field){//Setting the values
               $values .= '?';//Adding a ? for each field
               if($x < count($fields)){//If not end of array
                   $values .= ', ';//Add a comma seperator between ?s
               }
               $x++;
           }
           
           $sql = "INSERT INTO {$table} (`". implode('`, `',$keys) ."`) VALUES ({$values})";
           //echo $sql;
           $result = $this->query($sql, $fields);
           if(!$result->error()){
               
               
               return $this->last_inserted_id;
           }
           
       }
       return false;
   }
   
     public function update($table, $id, $fields = array()){
       $set = '';
       $x = 1;
       
       foreach ($fields as $name => $value)
       {
           $set .= "{$name} = ?";
           if($x < count($fields)){
               $set .= ', ';
           }
           $x++;
       }
       
           
       $sql = "UPDATE {$table} SET {$set} WHERE user_id={$id}";
        
       if(!$this->query($sql, $fields)->error()){
               return true;
           }
           return false;
   }
   
   
   
 
   
   
   public function error(){//Gets the error
       return $this->_error;
   }
   
    public function count(){//Gets the count of effected rows
       return $this->_count;
   }
   
   public function result(){//Gets the result
       return $this->_results;
   }
   
   public function first() {//Gets only the first result
       return $this->result()[0];
   }
  
  
    
    
}