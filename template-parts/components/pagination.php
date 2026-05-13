<?php
/**
 * Pagination component.
 *
 * @package Shortzlino
 */

if (! defined('ABSPATH')) {
	exit;
}

$pagination = get_the_posts_pagination(array(
	'mid_size'  => 1,
	'prev_text' => __('Previous', 'shortzlino'),
	'next_text' => __('Next', 'shortzlino'),
));

if ($pagination) {
	echo '<div class="pagination-wrap">' . wp_kses_post($pagination) . '</div>';
}
