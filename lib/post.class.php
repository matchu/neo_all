<?php
require_once dirname(__FILE__).'/db.php';
class Post {
  public $item, $source_id, $hash;
  
  public function save() {
    $statement = db_query('REPLACE post
      (hash, source_id, content_hash) VALUES(?, ?, ?)', 'sss', $this->hash(),
      $this->source_id, $this->content_hash());
    $this->write_cache();
  }
  
  private function hash() {
    if(!isset($this->hash)) $this->hash = md5($this->item->get_id());
    return $this->hash;
  }
  
  private function content_hash() {
    $content = $this->item->get_content();
    return md5($content);
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
