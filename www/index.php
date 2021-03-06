<?php
require_once '../lib/source.class.php';
require_once '../lib/template.class.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title>NeoAll - because nobody's perfect</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?3.0.0/build/cssreset/reset-min.css&amp;3.0.0/build/cssbase/base-min.css&amp;3.0.0/build/cssfonts/fonts-min.css"> 
    <link rel="stylesheet" type="text/css" href="/assets/jquery.jgrowl.css" />
    <link rel="stylesheet" type="text/css" href="/assets/index.css" />
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
  </head>
  <body>
    <div id="header">
      <h1>NeoAll - because nobody's perfect</h1>
      <ul id="available-sources">
<?php
$template = new NeoAllTemplate('../templates/source_icon.tpl.php');
$template->indent_level = 5;
foreach(Source::all() as $source):
  $template->source = $source;
?>
        <li>
          <?= $template->fetch() ?>
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
      <a id="reload" href="#">
        <img src="/assets/arrow_refresh.png" width="16" height="16" />
        <span>Reload</span>
      </a>
      <div id="posts" class="loading"></div>
      <a id="next-page" href="#">next page &raquo;</a>
    </div>
<?php
$template = new NeoAllTemplate('footer.html');
$template->indent_level = 2;
?>
    <?= $template->fetch(); ?>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/index.js"></script>
  </body>
</html>
