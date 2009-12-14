<div class="post-header">
  <h2 class="post-title">
    <a href="<?= $this->item->get_link() ?>" target="_blank">
      <?= $this->item->get_title() ?>
    </a>
  </h2>
<?php
$icon_template = new NeoAllTemplate(dirname(__FILE__).'/source_icon.tpl.php');
$icon_template->indent_level = 1;
$icon_template->source = $this->post->get_source();
?>
  <?= $icon_template->fetch() ?>
  <span class="post-time">
    <?= $this->post->time_ago_in_words() ?>
  </span>
</div>
<div class="post-content">
  <?= $this->item->get_content() ?>
</div>
