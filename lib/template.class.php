<?php
class NeoAllTemplate {
  function fetch($template) {
    ob_start();
    require dirname(__FILE__)."/../templates/$template";
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
  }
}
?>
