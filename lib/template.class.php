<?php
class NeoAllTemplate {
  public function fetch($template) {
    ob_start();
    $this->output($template);
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
  }
  
  public function output($template) {
    require dirname(__FILE__)."/../templates/$template";
  }
}
?>
