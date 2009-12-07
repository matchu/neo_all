<?php

class Migration_2009_12_06_21_19_03 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->query(<<<SQL
ALTER TABLE post
  ADD COLUMN cached_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
SQL
    );
	}

	public function down(PDO &$pdo)
	{
		$pdo->query(<<<SQL
ALTER TABLE post
  DROP COLUMN cached_at
SQL
    );
	}

}

?>
