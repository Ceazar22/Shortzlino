<?php
/**
 * WooCommerce product category archive template.
 *
 * @package Shortzlino
 */

if (! defined('ABSPATH')) {
	require dirname(__DIR__) . '/inc/security.php';
}

get_header();

$term = get_queried_object();
$thumbnail_id = isset($term->term_id) ? (int) get_term_meta($term->term_id, 'thumbnail_id', true) : 0;
$hero_image   = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'full') : '';
$has_products = isset($term->count) && 0 < (int) $term->count;
$child_categories = isset($term->term_id) ? get_terms(array(
	'taxonomy'   => 'product_cat',
	'hide_empty' => false,
	'parent'     => (int) $term->term_id,
	'orderby'   => 'term_id',
	'order'     => 'ASC',
)) : array();

if (is_wp_error($child_categories)) {
	$child_categories = array();
}

$product_sort = isset($_GET['product_sort']) ? sanitize_key(wp_unslash($_GET['product_sort'])) : 'latest';
$product_search = isset($_GET['product_search']) ? sanitize_text_field(wp_unslash($_GET['product_search'])) : '';
$product_order_options = array(
	'latest'     => __('Latest', 'shortzlino'),
	'name_asc'   => __('Name: A to Z', 'shortzlino'),
	'name_desc'  => __('Name: Z to A', 'shortzlino'),
	'price_asc'  => __('Price: Low to High', 'shortzlino'),
	'price_desc' => __('Price: High to Low', 'shortzlino'),
);

if (! array_key_exists($product_sort, $product_order_options)) {
	$product_sort = 'latest';
}

$product_query_args = array(
	'post_type'      => 'product',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
	'tax_query'      => array(
		array(
			'taxonomy' => 'product_cat',
			'field'    => 'term_id',
			'terms'    => isset($term->term_id) ? (int) $term->term_id : 0,
		),
	),
);

if ($product_search) {
	$product_query_args['s'] = $product_search;
}

switch ($product_sort) {
	case 'name_asc':
		$product_query_args['orderby'] = 'title';
		$product_query_args['order']   = 'ASC';
		break;
	case 'name_desc':
		$product_query_args['orderby'] = 'title';
		$product_query_args['order']   = 'DESC';
		break;
	case 'price_asc':
		$product_query_args['meta_key'] = '_price';
		$product_query_args['orderby']  = 'meta_value_num';
		$product_query_args['order']    = 'ASC';
		break;
	case 'price_desc':
		$product_query_args['meta_key'] = '_price';
		$product_query_args['orderby']  = 'meta_value_num';
		$product_query_args['order']    = 'DESC';
		break;
	default:
		$product_query_args['orderby'] = 'date';
		$product_query_args['order']   = 'DESC';
		break;
}

if (function_exists('woocommerce_breadcrumb')) {
	?>
	<nav class="shortzlino-breadcrumbs" aria-label="<?php esc_attr_e('Breadcrumb', 'shortzlino'); ?>">
		<?php
		woocommerce_breadcrumb(array(
			'delimiter'   => '<span class="shortzlino-breadcrumbs__separator">/</span>',
			'wrap_before' => '',
			'wrap_after'  => '',
		));
		?>
	</nav>
	<?php
}

get_template_part('template-parts/components/category-hero', null, array(
	'title'       => isset($term->name) ? $term->name : get_the_archive_title(),
	'description' => term_description(),
	'image'       => $hero_image,
));

$shortzlino_products = empty($child_categories) ? new WP_Query($product_query_args) : null;
?>

<section class="category-results">
	<div class="content-band__inner">
		<?php if (! empty($child_categories)) : ?>
			<div class="category-showcase">
				<?php foreach ($child_categories as $child_category) : ?>
					<?php
					$child_thumbnail_id = (int) get_term_meta($child_category->term_id, 'thumbnail_id', true);
					$child_link         = get_term_link($child_category);

					if (is_wp_error($child_link)) {
						$child_link = home_url('/shop/');
					}
					?>
					<article class="category-showcase__item">
						<a class="category-showcase__image" href="<?php echo esc_url($child_link); ?>">
							<?php if ($child_thumbnail_id) : ?>
								<?php echo wp_get_attachment_image($child_thumbnail_id, 'large', false, array('alt' => $child_category->name)); ?>
							<?php else : ?>
								<span class="category-showcase__placeholder"></span>
							<?php endif; ?>
						</a>
						<div class="category-showcase__content">
							<span class="category-showcase__line"></span>
							<p class="category-showcase__eyebrow"><?php esc_html_e('Timeless Beauty', 'shortzlino'); ?></p>
							<h2><?php echo esc_html($child_category->name); ?></h2>
							<?php if ($child_category->description) : ?>
								<p><?php echo esc_html($child_category->description); ?></p>
							<?php endif; ?>
							<a class="category-showcase__link" href="<?php echo esc_url($child_link); ?>"><?php esc_html_e('View Collection', 'shortzlino'); ?> <span aria-hidden="true">-&gt;</span></a>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		<?php elseif ($has_products) : ?>
			<form class="product-filter" method="get">
				<label class="product-filter__search">
					<span><?php esc_html_e('Search products', 'shortzlino'); ?></span>
					<input type="search" name="product_search" value="<?php echo esc_attr($product_search); ?>" placeholder="<?php esc_attr_e('Search this category', 'shortzlino'); ?>">
				</label>
				<label class="product-filter__sort">
					<span><?php esc_html_e('Sort by', 'shortzlino'); ?></span>
					<select name="product_sort">
						<?php foreach ($product_order_options as $value => $label) : ?>
							<option value="<?php echo esc_attr($value); ?>" <?php selected($product_sort, $value); ?>><?php echo esc_html($label); ?></option>
						<?php endforeach; ?>
					</select>
				</label>
				<button type="submit"><?php esc_html_e('Filter', 'shortzlino'); ?></button>
			</form>
		<?php endif; ?>

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
		<?php elseif (empty($child_categories)) : ?>
			<div class="category-empty">
				<?php if ($has_products) : ?>
					<h2><?php esc_html_e('No matching products', 'shortzlino'); ?></h2>
					<p><?php esc_html_e('Try adjusting the search or sort options to see more pieces from this collection.', 'shortzlino'); ?></p>
				<?php else : ?>
					<h2><?php esc_html_e('No products yet', 'shortzlino'); ?></h2>
					<p><?php esc_html_e('We are still working on this collection. Please check back soon for new Shortzlino pieces.', 'shortzlino'); ?></p>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
