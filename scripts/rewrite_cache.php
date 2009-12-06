#!/usr/bin/php
<?php
require_once dirname(__FILE__).'/../lib/post.class.php';
require_once dirname(__FILE__).'/../lib/db.php';

$db = new NeoAllDb();
$total_rows = $db->query('SELECT count(*) FROM post')->fetch();
$total_rows = $total_rows[0];

$statement = $db->query('SELECT * FROM post');
for($row_count = 0;$row = $statement->fetch();$row_count++) {
  $post = new Post($row);
  $percent = floor($row_count / $total_rows * 100);
  echo "($percent%) Writing post $post->hash...";
  $post->write_cache();
  echo "done.\n";
  unset($row, $post);
}
?>
