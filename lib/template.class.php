<?php
class NeoAllTemplate {
  public $indent_level, $filename;
  
  public function __construct($filename) {
    $this->filename = $filename;
  }
  
  public function fetch() {
    ob_start();
    include "$this->filename";
    $content = ob_get_contents();
    ob_end_clean();
    if($this->indent_level) {
      $content = preg_replace('/\n(?!$)/', "\n".str_repeat('  ', $this->indent_level), $content);
    }
    return $content;
  }
}
?>
