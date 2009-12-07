#!/usr/bin/php
<?php
// NOTE: the caching of posts happens automatically on first being loaded
// into the database. This script should only be run when the post template
// is modified, to globally make those changes.

require_once dirname(__FILE__).'/../lib/post.class.php';
require_once dirname(__FILE__).'/../lib/source.class.php';
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
  $post->unset_feed();
  unset($row, $post);
}

$db->query('UPDATE post SET cached_at = CURRENT_TIMESTAMP()');

// source cache uses cached_at timestamp, which is now updated
Source::clear_cache();
?>
