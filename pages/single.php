<?php
/**
 * Single post template.
 *
 * @package Shortzlino
 */

if (! defined('ABSPATH')) {
	require dirname(__DIR__) . '/inc/security.php';
}

get_header();

while (have_posts()) :
	the_post();
	get_template_part('template-parts/content/content-single');

	the_post_navigation(array(
		'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous', 'shortzlino') . '</span><span class="nav-title">%title</span>',
		'next_text' => '<span class="nav-subtitle">' . esc_html__('Next', 'shortzlino') . '</span><span class="nav-title">%title</span>',
	));

	if (comments_open() || get_comments_number()) :
		comments_template();
	endif;
endwhile;

get_footer();
