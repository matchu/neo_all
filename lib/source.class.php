<?php
class Source {

  // List of available feed sources.
  // Add, edit, remove as necessary, but do NOT modify the keys!
  // The keys link posts in DB to their respective source.
  // 
  static $all_sources = array(
    'jn' => array(
      'name' => 'Jellyneo',
      'feed_url' => 'http://www.jellyneo.net/rss.php'
    ),
    'tdn' => array(
      'name' => 'The Daily Neopets',
      'feed_url' => 'http://www.tdnforums.com/index.php?act=rssout&id=2'
    )
  );
  
  public $attrs, $id;
  
  function __construct($id) {
    $this->id = $id;
    $this->attrs =& self::$all_sources[$id];
  }
  
  public function load_posts() {
    require_once dirname(__FILE__).'/post.class.php';
    require_once dirname(__FILE__).'/simplepie.inc';
    $feed = new SimplePie();
    $feed->set_feed_url($this->attrs['feed_url']);
    // We cache ourselves and only call this function so often; no need to
    // cache actual feed content.
    $feed->enable_cache(false);
    $feed->init();
    $feed->handle_content_type();
    $items = $feed->get_items();
    foreach($items as $item) {
      $post = new Post();
      $post->item = $item;
      $post->source_id = $this->id;
      $post->save();
    }
    return count($items);
  }
  
  public static function all() {
    foreach(array_keys(self::$all_sources) as $source_id) {
      $sources[] = new Source($source_id);
    }
    return $sources;
  }
}
?>
