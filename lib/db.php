<?php

require_once dirname(__FILE__).'/../config/db_config.php';
require_once 'MDB2.php';

class NeoAllDb {
  public function __construct() {
    $this->dbh =& MDB2::singleton($db_config);
    if (PEAR::isError($this->dbh)) {
      throw new NeoAllDbError($this->dbh->getMessage());
    }
  }
  
  public function query() {
    $args = func_get_args();
    return $this->generic_call('query', $args);
  }
  
  public function exec() {
    $args = func_get_args();
    return $this->generic_call('exec', $args);
  }
  
  public function quote($str) {
    return $this->dbh->quote($str);
  }
  
  private function generic_call($method, $args) {
    $res = call_user_func_array(array($this->dbh, $method), $args);
    if (PEAR::isError($res)) {
      throw new NeoAllDbError($res->getMessage());
    }
    return $res;
  }
}

class NeoAllDbError extends Exception {}

?>
