<?php
/**
 * Luxury category hero.
 *
 * @package Shortzlino
 */

$title       = $args['title'] ?? get_the_archive_title();
$description = $args['description'] ?? get_the_archive_description();
$image       = $args['image'] ?? '';
$style       = $image ? sprintf(' style="background-image: url(%s);"', esc_url($image)) : '';

if (empty($description)) {
	$description = __('Carefully crafted hats made from high-quality materials. A perfect balance of classic design and modern sophistication.', 'shortzlino');
}
?>

<section class="category-hero"<?php echo $style; ?>>
	<div class="category-hero__content">
		<span class="ornament-line"></span>
		<p class="home-hero__eyebrow"><?php esc_html_e('Spring / Summer 2025', 'shortzlino'); ?></p>
		<h1><?php echo wp_kses_post($title); ?></h1>
		<div class="category-hero__description">
			<?php echo wp_kses_post(wpautop($description)); ?>
		</div>
	</div>
</section>
