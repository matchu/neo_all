<?php
/*
  Available MDB2 options:
  
  * phptype: Database backend used in PHP (i.e. mysql  , pgsql etc.)
  * dbsyntax: Database used with regards to SQL syntax etc.
  * protocol: Communication protocol to use ( i.e. tcp, unix etc.)
  * hostspec: Host specification (hostname[:port])
  * database: Database to use on the DBMS server
  * username: User name for login
  * password: Password for login 
  
  That's right - NeoAll should theoretically work with any database.
*/

$db_config = array(
  'phptype' => 'mysql',
  'hostspec' => 'localhost',
  'database' => 'neo_all',
  'username' => 'neo_all',
  'password' => ''
);
?>
