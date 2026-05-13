<?php
/**
 * Reusable section heading.
 *
 * @package Shortzlino
 */

$eyebrow     = $args['eyebrow'] ?? '';
$title       = $args['title'] ?? '';
$description = $args['description'] ?? '';
?>

<div class="section-heading">
	<?php if (! empty($eyebrow)) : ?>
		<p class="section-heading__eyebrow"><?php echo esc_html($eyebrow); ?></p>
	<?php endif; ?>

	<?php if (! empty($title)) : ?>
		<h2><?php echo esc_html($title); ?></h2>
	<?php endif; ?>

	<?php if (! empty($description)) : ?>
		<p class="section-heading__description"><?php echo esc_html($description); ?></p>
	<?php endif; ?>
</div>
