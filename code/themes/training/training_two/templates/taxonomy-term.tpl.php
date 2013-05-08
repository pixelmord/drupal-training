<?php

/**
 * @file
 * Snowcrash Base theme implementation to display a term.
 *
 * Available variables:
 * see modules/taxonomy/taxonomy-term.tpl.php
 *
 * @see template_preprocess()
 * @see template_preprocess_taxonomy_term()
 * @see template_process()
 */
?>
<div id="taxonomy-term-<?php print $term->tid; ?>" class="<?php print $classes; ?>">

  <?php if (!$page): ?>
    <h2><a href="<?php print $term_url; ?>"><?php print $term_name; ?></a></h2>
  <?php endif; ?>

  <?php print render($content); ?>

</div>
