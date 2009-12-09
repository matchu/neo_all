<?php

class AlterPostsItemLength extends Ruckusing_BaseMigration {

	public function up() {
	  // can't seem to assign text a length, doing raw SQL instead
    $this->execute('ALTER TABLE post MODIFY COLUMN item LONGTEXT');
	}//up()

	public function down() {
    $this->change_column('post', 'item', 'text');
	}//down()
}
?>
