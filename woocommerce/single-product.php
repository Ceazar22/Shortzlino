<?php
/**
 * WooCommerce single product override.
 *
 * @package Shortzlino
 */

if (! defined('ABSPATH')) {
	require dirname(__DIR__) . '/inc/security.php';
}

get_header('shop');

while (have_posts()) :
	the_post();

	$product = function_exists('wc_get_product') ? wc_get_product(get_the_ID()) : null;

	if (! $product) {
		continue;
	}

	$product_title = get_the_title();
	$image_ids = array();

	if (has_post_thumbnail()) {
		$image_ids[] = get_post_thumbnail_id();
	}

	$image_ids = array_merge($image_ids, $product->get_gallery_image_ids());
	$image_ids = array_values(array_unique(array_filter($image_ids)));
	?>

	<section class="single-product-detail">
		<?php if (function_exists('woocommerce_breadcrumb')) : ?>
			<nav class="shortzlino-breadcrumbs shortzlino-breadcrumbs--product" aria-label="<?php esc_attr_e('Breadcrumb', 'shortzlino'); ?>">
				<?php
				woocommerce_breadcrumb(array(
					'delimiter'   => '<span class="shortzlino-breadcrumbs__separator">/</span>',
					'wrap_before' => '',
					'wrap_after'  => '',
				));
				?>
			</nav>
		<?php endif; ?>

		<div class="single-product-detail__inner">
			<div class="single-product-gallery">
				<?php if (! empty($image_ids)) : ?>
					<?php $main_image_id = $image_ids[0]; ?>
					<div class="single-product-gallery__thumbs" aria-label="<?php esc_attr_e('Product images', 'shortzlino'); ?>">
						<?php foreach ($image_ids as $index => $image_id) : ?>
							<?php
							$large_image = wp_get_attachment_image_src($image_id, 'large');
							$full_image  = wp_get_attachment_image_src($image_id, 'full');
							?>
							<button class="single-product-gallery__thumb<?php echo 0 === $index ? ' is-active' : ''; ?>" type="button" data-large-image="<?php echo esc_url($large_image ? $large_image[0] : ''); ?>" data-full-image="<?php echo esc_url($full_image ? $full_image[0] : ''); ?>" data-image-alt="<?php echo esc_attr($product_title); ?>">
								<?php echo wp_get_attachment_image($image_id, 'thumbnail', false, array('alt' => $product_title)); ?>
							</button>
						<?php endforeach; ?>
					</div>

					<div class="single-product-gallery__main">
						<figure>
							<a class="single-product-gallery__zoom" href="<?php echo esc_url(wp_get_attachment_image_url($main_image_id, 'full')); ?>">
								<?php echo wp_get_attachment_image($main_image_id, 'large', false, array('alt' => $product_title, 'class' => 'single-product-gallery__main-image')); ?>
							</a>
						</figure>
					</div>
				<?php else : ?>
					<div class="single-product-gallery__placeholder"></div>
				<?php endif; ?>
			</div>

			<aside class="single-product-summary">
				<?php woocommerce_output_all_notices(); ?>

				<p class="single-product-summary__eyebrow"><?php esc_html_e('Shortzlino Collection', 'shortzlino'); ?></p>
				<h1><?php echo esc_html($product_title); ?></h1>

				<?php if ($product->get_average_rating()) : ?>
					<div class="single-product-summary__rating">
						<?php echo wp_kses_post(wc_get_rating_html($product->get_average_rating(), $product->get_rating_count())); ?>
						<span><?php echo esc_html($product->get_review_count()); ?> <?php esc_html_e('reviews', 'shortzlino'); ?></span>
					</div>
				<?php endif; ?>

				<div class="single-product-summary__price"><?php echo wp_kses_post($product->get_price_html()); ?></div>

				<?php if (has_excerpt()) : ?>
					<div class="single-product-summary__intro"><?php the_excerpt(); ?></div>
				<?php endif; ?>

				<div class="single-product-summary__cart">
					<?php woocommerce_template_single_add_to_cart(); ?>
				</div>

				<div class="single-product-summary__description">
					<h2><?php esc_html_e('Description', 'shortzlino'); ?></h2>
					<?php the_content(); ?>
				</div>

				<div class="single-product-summary__meta">
					<?php woocommerce_template_single_meta(); ?>
				</div>
			</aside>
		</div>
	</section>

	<?php
endwhile;

get_footer('shop');
