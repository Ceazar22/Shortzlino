<?php
/**
 * Page template.
 *
 * @package Shortzlino
 */

if (! defined('ABSPATH')) {
	require dirname(__DIR__) . '/inc/security.php';
}

get_header();

while (have_posts()) :
	the_post();
	get_template_part('template-parts/content/content-page');
endwhile;

get_footer();
