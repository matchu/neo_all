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
  
  Though you can here use any type of database (theoretically), only MySQL
  works with the migrations system. Still, you can adapt the schema found
  in migrations/db/schema.txt to your own database and use that if you are
  so inclined. Or, you can use MySQL.
*/

$db_config = array(
  'phptype' => 'mysql',
  'hostspec' => 'localhost',
  'database' => 'neo_all',
  'username' => 'neo_all',
  'password' => ''
);
?>
