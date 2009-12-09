<?php

class AlterPostsCachedAt extends Ruckusing_BaseMigration {

	public function up() {
    $this->execute('ALTER TABLE post MODIFY COLUMN cached_at TIMESTAMP
      DEFAULT CURRENT_TIMESTAMP'); // default won't accept current_timestamp
	}//up()

	public function down() {
    $this->change_column('post', 'cached_at', 'datetime');
	}//down()
}
?>
