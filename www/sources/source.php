<?php
foreach(array('source.class', 'post.class', 'db', 'stripslashes') as $lib) {
  require_once dirname(__FILE__)."/../../lib/$lib.php";
}

define('PER_PAGE', 5);

$db = new NeoAllDb();

$directory = $_GET['directory'];
$file = $_GET['file'];

$source_names = explode(',', $directory);
foreach($source_names as &$source_name) {
  if(array_key_exists($source_name, Source::$all_sources)) {
    $source_name = $db->quote($source_name);
  } else {
    header('HTTP/1.1 404 Not Found');
    die(htmlentities("Source $source_name not found"));
  }
}
$source_list = implode(',', $source_names);

$conditions_array = array("source_id IN ($source_list)");

list($mode, $splitting_hash) = explode('_', $file, 2);
if($mode == 'before' || $mode == 'after') {
  $operator = $mode == 'before' ? '<' : '>';
  $quoted_hash = $db->quote($splitting_hash);
  $conditions_array[] = "posted_at $operator
    (SELECT posted_at FROM post WHERE hash = $quoted_hash)";
} elseif($mode != 'top') {
  header('HTTP/1.1 404 Not Found');
  die('404 Not Found');
}

if($mode != 'after') { // we want all newer posts, not just some
  $db->setLimit(PER_PAGE);
}

$conditions = implode(' AND ', $conditions_array);
$posts_query = $db->query("SELECT hash, cached_at FROM post
  WHERE $conditions ORDER BY posted_at DESC $limit");
$posts = array();
while($post_row = $posts_query->fetchRow(MDB2_FETCHMODE_ASSOC)) {
  $post = (object) array();
  $post->hash = $post_row['hash'];
  $post->time = strtotime($post_row['cached_at']);
  $posts[] = $post;
}

$output = json_encode($posts);

$cache_to = "$directory/${_GET[file]}.json";
if($posts && !file_exists($cache_to)) {
  $old = umask(0);
  if(!file_exists($directory)) {
    mkdir($directory, 0777);
  }
  // not caching is bad, but not worth crashing
  if($file = fopen($cache_to, 'w')) {
    fwrite($file, $output);
    fclose($file);
  }
  umask($old);
}

header('Content-type: text/plain');
echo $output;
?>
