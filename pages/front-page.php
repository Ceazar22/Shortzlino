<?php
/**
 * Front page template.
 *
 * @package Shortzlino
 */

if (! defined('ABSPATH')) {
	require dirname(__DIR__) . '/inc/security.php';
}

get_header();

$collection_terms = array();

if (taxonomy_exists('product_cat')) {
	$collection_terms = get_terms(array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => false,
		'parent'     => 0,
		'orderby'   => 'term_id',
		'order'     => 'ASC',
	));

	if (is_wp_error($collection_terms)) {
		$collection_terms = array();
	}
}

$craft_stats = array(
	array(
		'value' => '100%',
		'label' => __('Pure Wool Felt', 'shortzlino'),
		'text'  => __('Only the finest Australian merino wool, carefully selected for its superior quality and texture.', 'shortzlino'),
	),
	array(
		'value' => '48h',
		'label' => __('Handcrafted Process', 'shortzlino'),
		'text'  => __('Each hat requires two full days of meticulous handwork by our master artisans.', 'shortzlino'),
	),
	array(
		'value' => '1924',
		'label' => __('Heritage Since', 'shortzlino'),
		'text'  => __('A century of tradition, combining time-honored techniques with contemporary design.', 'shortzlino'),
	),
);

$material_details = array(
	array('title' => __('Pure Wool Felt', 'shortzlino'), 'text' => __('Premium merino texture', 'shortzlino')),
	array('title' => __('Hand Shaped', 'shortzlino'), 'text' => __('Set with steam finishing', 'shortzlino')),
	array('title' => __('Italian Grosgrain', 'shortzlino'), 'text' => __('Tailor-grade ribbon', 'shortzlino')),
	array('title' => __('Stitched By Hand', 'shortzlino'), 'text' => __('Hand-sewn precision', 'shortzlino')),
);
?>

<section class="home-hero home-hero--timeless">
	<div class="home-hero__content">
		<span class="ornament-line"></span>
		<p class="home-hero__eyebrow"><?php esc_html_e('Spring / Summer 2025', 'shortzlino'); ?></p>
		<h1><?php esc_html_e('Timeless Elegance', 'shortzlino'); ?></h1>
		<p><?php esc_html_e('Handcrafted luxury hats made from the finest pure wool felt. Where Italian tradition meets contemporary design.', 'shortzlino'); ?></p>
		<a class="luxury-button" href="#collections"><?php esc_html_e('Explore Collection', 'shortzlino'); ?></a>
	</div>
</section>

<section id="collections" class="collections-section" aria-labelledby="collections-title">
	<div class="collections-section__inner">
		<div class="luxury-heading">
			<span class="ornament-line"></span>
			<h2 id="collections-title"><?php esc_html_e('Collections', 'shortzlino'); ?></h2>
			<p><?php esc_html_e('Discover our curated selection', 'shortzlino'); ?></p>
		</div>

		<div class="collection-grid">
			<?php foreach ($collection_terms as $term) : ?>
				<?php
				if ('uncategorized' === $term->slug) {
					continue;
				}

				$thumbnail_id = (int) get_term_meta($term->term_id, 'thumbnail_id', true);
				$term_link    = get_term_link($term);

				if (is_wp_error($term_link)) {
					$term_link = home_url('/shop/');
				}
				?>
				<article class="collection-card">
					<?php if ($thumbnail_id) : ?>
						<a class="collection-card__image" href="<?php echo esc_url($term_link); ?>">
							<?php echo wp_get_attachment_image($thumbnail_id, 'large', false, array('alt' => $term->name)); ?>
						</a>
					<?php endif; ?>
					<h3><?php echo esc_html($term->name); ?></h3>
					<?php if ($term->description) : ?>
						<p><?php echo esc_html($term->description); ?></p>
					<?php endif; ?>
					<a class="collection-card__link" href="<?php echo esc_url($term_link); ?>"><?php esc_html_e('View Collection', 'shortzlino'); ?> <span aria-hidden="true">-&gt;</span></a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="craft-section" aria-labelledby="craft-title">
	<div class="craft-section__inner">
		<div class="luxury-heading luxury-heading--dark">
			<h2 id="craft-title"><?php esc_html_e('The Art of Craftsmanship', 'shortzlino'); ?></h2>
			<p><?php esc_html_e('Every Shortzlino hat is a masterpiece of Italian craftsmanship, from selecting the finest wool felt to the final hand-stitched detail.', 'shortzlino'); ?></p>
		</div>

		<div class="craft-stats">
			<?php foreach ($craft_stats as $stat) : ?>
				<div class="craft-stat">
					<strong><?php echo esc_html($stat['value']); ?></strong>
					<span><?php echo esc_html($stat['label']); ?></span>
					<p><?php echo esc_html($stat['text']); ?></p>
				</div>
			<?php endforeach; ?>
		</div>

		<figure class="craft-image">
			<img src="<?php echo esc_url(get_template_directory_uri() . '/components/images/art.jpg'); ?>" alt="<?php esc_attr_e('Premium hatmaking materials and details', 'shortzlino'); ?>">
		</figure>

		<div class="material-details">
			<?php foreach ($material_details as $detail) : ?>
				<div>
					<h3><?php echo esc_html($detail['title']); ?></h3>
					<p><?php echo esc_html($detail['text']); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="editorial-cta editorial-cta--distinction">
	<div class="editorial-cta__content">
		<span class="ornament-line"></span>
		<p class="home-hero__eyebrow"><?php esc_html_e('Shortzlino Collection', 'shortzlino'); ?></p>
		<h2><?php esc_html_e('Crafted for Distinction', 'shortzlino'); ?></h2>
		<p><?php esc_html_e('Every piece tells a story of Italian artistry and uncompromising quality. Handcrafted from pure wool felt in the heart of Tuscany.', 'shortzlino'); ?></p>
		<a class="luxury-button" href="#collections"><?php esc_html_e('Explore Collection', 'shortzlino'); ?></a>
	</div>
</section>


<?php
get_footer();
