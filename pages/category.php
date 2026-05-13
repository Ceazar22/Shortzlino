<?php
/**
 * Category archive template.
 *
 * @package Shortzlino
 */

if (! defined('ABSPATH')) {
	require dirname(__DIR__) . '/inc/security.php';
}

get_header();

get_template_part('template-parts/components/category-hero', null, array(
	'title'       => single_cat_title('', false),
	'description' => category_description(),
));

$category_term = get_queried_object();
$product_term  = null;

if ($category_term && taxonomy_exists('product_cat')) {
	$product_term = get_term_by('slug', $category_term->slug, 'product_cat');
}

$shortzlino_products = null;

if ($product_term && ! is_wp_error($product_term)) {
	$shortzlino_products = new WP_Query(array(
		'post_type'      => 'product',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'tax_query'      => array(
			array(
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => (int) $product_term->term_id,
			),
		),
	));
}
?>

<section class="category-results">
	<div class="content-band__inner">
		<?php if ($shortzlino_products && $shortzlino_products->have_posts()) : ?>
			<div class="product-grid">
				<?php
				while ($shortzlino_products->have_posts()) :
					$shortzlino_products->the_post();
					get_template_part('template-parts/content/product-card');
				endwhile;
				?>
			</div>

			<?php wp_reset_postdata(); ?>
		<?php elseif (have_posts()) : ?>
			<div class="post-grid">
				<?php
				while (have_posts()) :
					the_post();
					get_template_part('template-parts/content/content-card');
				endwhile;
				?>
			</div>

			<?php get_template_part('template-parts/components/pagination'); ?>
		<?php else : ?>
			<?php get_template_part('template-parts/content/no-results'); ?>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
