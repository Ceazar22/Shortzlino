<?php
/**
 * Empty results component.
 *
 * @package Shortzlino
 */

if (! defined('ABSPATH')) {
	exit;
}
?>

<section class="content-band">
	<div class="content-band__inner content-band__inner--narrow empty-state">
		<h1><?php esc_html_e('Nothing found', 'shortzlino'); ?></h1>
		<p><?php esc_html_e('There is no content here yet. Add posts or pages in WordPress to fill this area.', 'shortzlino'); ?></p>
		<?php get_search_form(); ?>
	</div>
</section>
