#!/usr/bin/php
<?php
require_once dirname(__FILE__).'/../lib/source.class.php';

foreach(Source::all() as $source) {
  $source_attrs = $source->attrs;
  echo "Loading ${source_attrs[feed_url]}...";
  $count = $source->load_posts();
  echo " $count loaded.\n";
}

Source::clear_cache();
?>
