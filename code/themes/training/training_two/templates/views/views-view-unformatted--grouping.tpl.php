<?php
/**
 * @file views-view-unformatted--grouping.tpl.php
 * Snowcrash Base simple view template to display a list of grouped rows with a wrapper.
 *
 * @ingroup views_templates
 */
?>
<div class="row-group">

	<?php if (!empty($title)): ?>
	  <h3><?php print $title; ?></h3>
	<?php endif; ?>

	<?php foreach ($rows as $id => $row): ?>
	  <div class="<?php print $classes_array[$id]; ?>">
	    <?php print $row; ?>
	  </div>
	<?php endforeach; ?>

</div>
