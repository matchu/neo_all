<h2 class="post-title">
  <a href="<?= $this->item->get_link() ?>" target="_blank">
    <?= $this->item->get_title() ?>
  </a>
  <?php
    $icon_template = new NeoAllTemplate();
    $icon_template->source = $this->post->get_source();
    $icon_template->output('source_icon.tpl.php');
  ?>
</h2>
<div class="post-content">
  <?= $this->item->get_content() ?>
</div>
