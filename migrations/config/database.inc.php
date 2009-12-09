<?php

/*

// If you end up needing the multiple environments, you can configure this
// manually. Otherwise, we'll just rip your previous db_config.

$ruckusing_db_config = array(
	
  'development' => array(
     'type'      => 'mysql',
     'host'      => 'localhost',
     'port'      => 3306,
     'database'  => 'php_migrator',
     'user'      => 'root',
     'password'  => ''
  ),

	'test' 					=> array(
			'type' 			=> 'mysql',
			'host' 			=> 'localhost',
			'port'			=> 3306,
			'database' 	=> 'php_migrator_test',
			'user' 			=> 'root',
			'password' 	=> ''
	),
	'production' 		=> array(
			'type' 			=> 'mysql',
			'host' 			=> 'localhost',
			'port'			=> 0,
			'database' 	=> 'prod_php_migrator',
			'user' 			=> 'root',
			'password' 	=> ''
	)
	
);

*/

require_once dirname(__FILE__).'/../../config/db_config.php';

$ruckusing_db_config = array(
  'development' => array(
    'type' => $db_config['phptype'],
    'database' => $db_config['database'],
    'user' => $db_config['username'],
    'password' => $db_config['password']
  )
);

list($ruckusing_db_config['development']['host'],
  $ruckusing_db_config['development']['port']) = explode(':', $db_config['hostspec']);

?>
