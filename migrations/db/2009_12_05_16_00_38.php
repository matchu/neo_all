<?php

class Migration_2009_12_05_16_00_38 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
	  $pdo->query(<<<SQL
CREATE TABLE source (
  id INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(id),
  name VARCHAR(20) NOT NULL,
  UNIQUE INDEX(name),
  feed_url varchar(200) NOT NULL
) ENGINE=INNODB
SQL
    );
		$pdo->query(<<<SQL
CREATE TABLE post (
  id INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(id),
  hash VARCHAR(32) NOT NULL,
  UNIQUE INDEX(hash),
  source_id INT NOT NULL,
  INDEX (source_id),
  FOREIGN KEY (source_id)
    REFERENCES source(id)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=INNODB
SQL
    );
	}

	public function down(PDO &$pdo)
	{
		$pdo->query('DROP TABLE IF EXISTS sources');
		$pdo->query('DROP TABLE IF EXISTS posts');
	}

}

?>
