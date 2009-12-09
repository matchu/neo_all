<?php
require_once '../lib/source.class.php';
require_once '../lib/template.class.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title>NeoAll - because nobody's perfect</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?3.0.0/build/cssreset/reset-min.css&3.0.0/build/cssbase/base-min.css&3.0.0/build/cssfonts/fonts-min.css"> 
    <link rel="stylesheet" type="text/css" href="/assets/jquery.jgrowl.css" />
    <link rel="stylesheet" type="text/css" href="/assets/index.css" />
  </head>
  <body>
    <div id="header">
      <h1>NeoAll - because nobody's perfect</h1>
      <ul id="available-sources">
      <?php
      $template = new NeoAllTemplate();
      foreach(Source::all() as $source):
        ?>
        <li>
          <?php
          $template->source = $source;
          $template->output('source_icon.tpl.php');
          ?>
        </li>
        <?php
      endforeach;
      ?>
      </ul>
      <span>&#8592; toggle sources</span>
    </div>
    <noscript class="error">
      NeoAll uses Javascript. Could you turn yours on, please?
    </noscript>
    <div id="container">
      <div id="posts" class="loading"></div>
      <a id="next-page" href="#">next page &raquo;</a>
    </div>
    <?php include('footer.html'); ?>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/index.js"></script>
  </body>
</html>
