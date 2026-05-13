<?php
/**
 * 404 template.
 *
 * @package Shortzlino
 */

if (! defined('ABSPATH')) {
	require dirname(__DIR__) . '/inc/security.php';
}

get_header();
?>

<section class="content-band">
	<div class="content-band__inner content-band__inner--narrow">
		<?php
		get_template_part('template-parts/components/page-hero', null, array(
			'title'       => __('Page not found', 'shortzlino'),
			'description' => __('The page you requested could not be found. Try searching or return to the homepage.', 'shortzlino'),
		));
		?>

		<?php get_search_form(); ?>
	</div>
</section>

<?php
get_footer();
