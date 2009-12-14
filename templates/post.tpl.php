<div class="post-header">
  <h2 class="post-title">
    <a href="<?= $this->item->get_link() ?>" target="_blank">
      <?= $this->item->get_title() ?>
    </a>
  </h2>
  <?php
    $icon_template = new NeoAllTemplate();
    $icon_template->source = $this->post->get_source();
    $icon_template->output('source_icon.tpl.php');
  ?>
  <span class="post-time">
    <?= $this->post->time_ago_in_words() ?>
  </span>
</div>
<div class="post-content">
  <?= $this->item->get_content() ?>
</div>
