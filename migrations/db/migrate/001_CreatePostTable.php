<?php

class CreatePostTable extends Ruckusing_BaseMigration {

	public function up() {
    $post = $this->create_table('post');
    $post->column('hash', 'string', array('limit' => 32));
    $post->column('content_hash', 'string', array('limit' => 32));
    $post->column('source_id', 'string', array('limit' => 10));
    $post->column('cached_at', 'datetime');
    $post->column('posted_at', 'datetime');
    $post->column('item', 'text');
    $post->finish();
    $this->add_index('post', 'hash', array('unique' => true));
    $this->add_index('post', 'source_id');
    $this->add_index('post', 'posted_at');
	}//up()

	public function down() {
    $this->drop_table('post');
	}//down()
}
?>
