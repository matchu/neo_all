<?php
require_once dirname(__FILE__).'/db.php';
require_once dirname(__FILE__).'/simplepie.inc';

class Post {
  public $item, $source_id, $hash, $source;
  private static $attr_names = array('item', 'source_id', 'hash', 'posted_at');
  
  function __construct($row=null) {
    if($row) {
      foreach(self::$attr_names as $attr_name) {
        $attr =& $row[$attr_name];
        if($attr_name == 'item') $attr = unserialize($attr);
        $this->$attr_name = $attr;
      }
    }
  }
  
  public function save() {
    // TODO: too tired right now - check if content_hash has changed
    // to decide whether or not to write_cache and update cached timestamp
    $db = new NeoAllDb();
    $exec = $db->exec('REPLACE post
      (hash, source_id, posted_at, content_hash, item, cached_at) VALUES('
      .$db->quote($this->hash()).', '
      .$db->quote($this->source_id).', '
      .$db->quote($this->item->get_date('Y-m-d H:i:s')).', '
      .$db->quote($this->content_hash()).', '
      .$db->quote(serialize($this->item)).', '
      .'CURRENT_TIMESTAMP()'
    .')');
    $this->write_cache();
  }
  
  public function write_cache() {
    require_once dirname(__FILE__).'/template.class.php';
    $write_to = dirname(__FILE__).'/../www/' . $this->cache_location();
    $file = fopen($write_to, 'w');
    $body = $this->item->get_content();
    $template = new NeoAllTemplate();
    $template->post = $this;
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
  
  public function unset_feed() {
    // PHP bug requires that we explicitly destruct this item in <PHP5.3
    // or else we get memory leaks
    $this->item->feed->__destruct();
    unset($this->item->feed);
  }
  
  public function get_source() {
    if(!$source) $this->source = new Source($this->source_id);
    return $this->source;
  }
}
?>
