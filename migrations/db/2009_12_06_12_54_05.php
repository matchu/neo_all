<?php

class Migration_2009_12_06_12_54_05 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->query(<<<SQL
ALTER TABLE post
  ADD COLUMN item LONGTEXT NOT NULL
SQL
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->query(<<<SQL
ALTER TABLE post
  DROP COLUMN item
SQL
		);
	}

}

?>
