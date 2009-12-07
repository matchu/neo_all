<?php

class Migration_2009_12_05_16_00_38 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->query(<<<SQL
CREATE TABLE post (
  id INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(id),
  hash VARCHAR(32) NOT NULL,
  UNIQUE INDEX(hash),
  source_id VARCHAR(10) NOT NULL,
  INDEX (source_id),
  post_time DATETIME NOT NULL,
  INDEX (post_time),
  content_hash VARCHAR(32) NOT NULL
)
SQL
    );
	}

	public function down(PDO &$pdo)
	{
		$pdo->query('DROP TABLE IF EXISTS post');
	}

}

?>
