<?php
/**
 * WooCommerce product archive override.
 *
 * @package Shortzlino
 */

if (! defined('ABSPATH')) {
	require dirname(__DIR__) . '/inc/security.php';
}

if (is_tax('product_cat')) {
	get_template_part('pages/taxonomy-product_cat');
	return;
}

get_header('shop');
?>

<main id="primary" class="site-main">
	<?php woocommerce_content(); ?>
</main>

<?php
get_footer('shop');
