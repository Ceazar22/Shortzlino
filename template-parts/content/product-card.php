<?php
/**
 * Product card component.
 *
 * @package Shortzlino
 */

$product = function_exists('wc_get_product') ? wc_get_product(get_the_ID()) : null;
?>

<article id="product-<?php the_ID(); ?>" <?php post_class('product-card'); ?>>
	<a class="product-card__media" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
		<?php if (has_post_thumbnail()) : ?>
			<?php the_post_thumbnail('medium_large'); ?>
		<?php else : ?>
			<span class="product-card__placeholder"></span>
		<?php endif; ?>
	</a>

	<div class="product-card__body">
		<h2 class="product-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>

		<?php if ($product) : ?>
			<div class="product-card__price"><?php echo wp_kses_post($product->get_price_html()); ?></div>
		<?php elseif (has_excerpt()) : ?>
			<div class="product-card__excerpt"><?php the_excerpt(); ?></div>
		<?php endif; ?>

		<a class="product-card__button" href="<?php the_permalink(); ?>"><?php esc_html_e('View Product', 'shortzlino'); ?></a>
	</div>
</article>
