<?php
/**
 * Luxury category hero.
 *
 * @package Shortzlino
 */

if (! defined('ABSPATH')) {
	exit;
}

$title       = $args['title'] ?? get_the_archive_title();
$description = $args['description'] ?? get_the_archive_description();
$image       = $args['image'] ?? '';
$style       = $image ? sprintf("background-image: url('%s');", esc_url_raw($image)) : '';

if (empty($description)) {
	$description = __('Carefully crafted hats made from high-quality materials. A perfect balance of classic design and modern sophistication.', 'shortzlino');
}
?>

<section class="category-hero"<?php echo $style ? ' style="' . esc_attr($style) . '"' : ''; ?>>
	<div class="category-hero__content">
		<span class="ornament-line"></span>
		<p class="home-hero__eyebrow"><?php esc_html_e('Spring / Summer 2025', 'shortzlino'); ?></p>
		<h1><?php echo esc_html(wp_strip_all_tags($title)); ?></h1>
		<div class="category-hero__description">
			<?php echo wp_kses_post(wpautop($description)); ?>
		</div>
	</div>
</section>
