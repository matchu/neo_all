<?php
function db_query($sql) {
  static $mysqli;
  if(!isset($mysqli)) {
    require_once dirname(__FILE__).'/../config/db_config.php';
    $mysqli = new mysqli($db_config['host'], $db_config['username'],
      $db_config['password'], $db_config['dbname']);
  }
  $args = func_get_args();
  array_shift($args);
  if($args) {
    if(!$statement = $mysqli->prepare($sql)) {
      throw new DbError($mysqli->error);
    }
    foreach($args as $key => $value) {
      call_user_func_array(array($statement, 'bind_param'), $args);
    }
    if(!$statement->execute()) {
      $location = array_shift(debug_backtrace());
      throw new DbError($mysqli->error);
    }
    return $statement;
  } else {
    return $mysqli->query($sql);
  }
}

class DbError extends Exception {}

?>
