<?php

?>
<div class="container-inline">
  <?php if (empty($variables['form']['#block']->subject)): ?>
    <h2 class="element-invisible"><?php print t('Search form'); ?></h2>
  <?php endif; ?>
  <?php print $search['search_block_form']; ?>
  <?php print $search['hidden']; ?>
</div>
