<?php $source_name = $this->post->get_source()->attrs['name'] ?>
<h2>
  <a href="<?= $this->item->get_link() ?>">
    <?= $this->item->get_title() ?>
  </a>
  <a href="<?= $this->item->feed->get_link() ?>">
    <img class="post-source-favicon"
      src="<?= $this->item->feed->get_favicon() ?>"
      alt="<?= $source_name ?>" title="<?= $source_name ?>" />
  </a>
</h2>
<div class="post-content">
  <?= $this->item->get_content() ?>
</div>
