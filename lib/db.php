<?php
require_once 'MDB2.php';

function neoAllDb() {
  static $dbh;
  if(!$dbh) {
    require_once dirname(__FILE__).'/../config/db_config.php';
    $dbh = MDB2::connect($db_config);
  }
  return $dbh;
}

?>
