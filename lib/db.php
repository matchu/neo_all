<?php
class NeoAllDb {
  static $pdo;
  
  public function __construct() {
    if(!isset(self::$pdo)) {
      require_once dirname(__FILE__).'/../config/db_config.php';
      self::$pdo = new PDO("mysql:host=${db_config[host]};dbname=${db_config[dbname]}",
        $db_config['username'],
        $db_config['password']);
    }
  }
  
  public function query($sql, $args=null) {
    if($args) {
      $statement = $this->prepare($sql);
      $statement->execute($args);
    } else {
      if(!$statement = self::$pdo->query($sql)) {
        throw new NeoAllDbError(self::$pdo);
      }
    }
    return $statement;
  }
  
  public function prepare() {
    $args = func_get_args();
    $statement = new NeoAllDbStatement(self::$pdo);
    $statement->init($args);
    return $statement;
  }
  
  public function quote($str) {
    return self::$pdo->quote($str);
  }
}

class NeoAllDbStatement {
  private $pdo, $statement;
  
  public function __construct($pdo) {
    $this->pdo = $pdo;
  }
  
  public function init($args) {
    $this->statement = call_user_func_array(array($this->pdo, 'prepare'), $args);
    if(!$this->statement) {
      throw $this->db_error();
    }
    return true;
  }
  
  public function execute() {
    $args = func_get_args();
    if(!call_user_func_array(array($this->statement, 'execute'), $args)) {
      throw $this->db_error();
    }
    return true;
  }
  
  public function __call($name, $arguments) {
    return call_user_func_array(array($this->statement, $name), $arguments);
  }
  
  private function db_error() {
    return new NeoAllDbError($this);
  }
}

class NeoAllDbError extends Exception {
  function __construct($pdo) {
    $errorInfo = $pdo->errorInfo();
    parent::__construct($errorInfo[2]);
  }
}

?>
