<?php
/**
 * Reusable page hero.
 *
 * @package Shortzlino
 */

$title       = $args['title'] ?? get_the_title();
$description = $args['description'] ?? '';
$modifier    = $args['modifier'] ?? '';
$image       = $args['image'] ?? '';

if (! $image && is_tax('product_cat')) {
	$term = get_queried_object();

	if ($term && isset($term->term_id)) {
		$thumbnail_id = (int) get_term_meta($term->term_id, 'thumbnail_id', true);
		$image        = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'full') : '';
	}
}

$classes     = trim('page-hero ' . $modifier . ($image ? ' page-hero--image' : ''));
$style       = $image ? sprintf(' style="background-image: url(%s);"', esc_url($image)) : '';
?>

<section class="<?php echo esc_attr($classes); ?>"<?php echo $style; ?>>
	<div class="page-hero__content">
		<?php if (! empty($title)) : ?>
			<h1 class="page-hero__title"><?php echo wp_kses_post($title); ?></h1>
		<?php endif; ?>

		<?php if (! empty($description)) : ?>
			<div class="page-hero__description"><?php echo wp_kses_post(wpautop($description)); ?></div>
		<?php endif; ?>
	</div>
</section>
