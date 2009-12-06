<?php
require_once dirname(__FILE__).'/db.php';
require_once dirname(__FILE__).'/simplepie.inc';

class Post {
  public $item, $source_id, $hash;
  private static $attr_names = array('item', 'source_id', 'hash');
  
  function __construct($row=null) {
    if($row) {
      foreach(self::$attr_names as $attr_name) {
        $attr = $row[$attr_name];
        if($attr_name == 'item') $attr = unserialize($attr);
        $this->$attr_name = $attr;
      }
    }
  }
  
  public function save() {
    $db = new NeoAllDb();
    $statement = $db->query('REPLACE post
      (hash, source_id, content_hash, item) VALUES(?, ?, ?, ?)',
      array($this->hash(), $this->source_id, $this->content_hash(),
        serialize($this->item)));
    $this->write_cache();
  }
  
  public function write_cache() {
    require_once dirname(__FILE__).'/template.class.php';
    $write_to = dirname(__FILE__).'/../www/' . $this->cache_location();
    $file = fopen($write_to, 'w');
    $body = $this->item->get_content();
    $template = new NeoAllTemplate();
    $template->item = $this->item;
    $content = $template->fetch('post.tpl.php');
    fwrite($file, $content);
    fclose($file);
  }
  
  private function hash() {
    if(!isset($this->hash)) $this->hash = md5($this->item->get_id());
    return $this->hash;
  }
  
  private function content_hash() {
    $content = $this->item->get_content();
    return md5($content);
  }
  
  private function cache_location() {
    // public path (relative to /www/)
    return "posts/" . $this->hash() . '.html';
  }
  
  public function __destruct() {
    // PHP bug requires that we explicitly destruct this item in <PHP5.3
    // or else we get memory leaks
    $this->item->feed->__destruct();
    unset($this->item);
  }
}
?>
