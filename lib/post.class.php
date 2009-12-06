<?php
require_once dirname(__FILE__).'/db.php';
class Post {
  public $item, $source_id, $hash;
  
  public function save_if_not_yet_saved() {
    $statement = db_query('INSERT IGNORE INTO post (hash, source_id)
      VALUES(?, ?)', 'ss', $this->hash(), $this->source_id);
    if(!file_exists($this->cache_location())) {
      $this->write_cache();
    }
  }
  
  private function hash() {
    if(!isset($this->hash)) $this->hash = md5($this->item->get_id());
    return $this->hash;
  }
  
  private function write_cache() {
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
  
  private function cache_location() {
    // public path (relative to /www/)
    return "posts/" . $this->hash() . '.html';
  }
}
?>
