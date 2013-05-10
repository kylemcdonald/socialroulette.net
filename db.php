<?php  
  session_name('awesomeo');
  session_start();
    
  class DB {
    
    private static $pdo;
        
    public static function query ($stmt, $fetchMode = '') {
      try {
        return self::$pdo->query($stmt, $fetchMode);
      
      } catch(PDOException $e) {
          
      //  echo $e->getMessage();
      
      }
    }
    
    public static function exec ($stmt) {
      try {
        return self::$pdo->exec($stmt);
      
      } catch(PDOException $e) {
          
      //  echo $e->getMessage();
      
      }
    }
    
    public static function lastInsertId () {
      try {
        return self::$pdo->lastInsertId();
      
      } catch(PDOException $e) {
          
      //  echo $e->getMessage();
      
      }
    }
    
    public static function prepare ($stmt) {
      try {
        return self::$pdo->prepare($stmt);
      
      } catch(PDOException $e) {
          
      //  echo $e->getMessage();
      
      }
    }
    
    
    
    private function __construct() {}
    
    
    public static function connect() {
      $options = array(
            PDO::ATTR_PERSISTENT => true, 
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
          );
      
      try {
        self::$pdo = new PDO("mysql:host=".Config::db_host.";dbname=".Config::db_name, Config::db_user, Config::db_pass, $options);
        /*** echo a message saying we have connected ***/
      } catch(PDOException $e) {
        
        //echo $e->getMessage();
      }
    }
      
    // Prevent users to clone the instance
    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }  
  }
  
  DB::connect();