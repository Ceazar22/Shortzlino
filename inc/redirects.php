<?php
/**
 * Page redirect rules.
 *
 * Add redirects in shortzlino_page_redirect_rules() as needed.
 *
 * @package Shortzlino
 */

if (! defined('ABSPATH')) {
	require __DIR__ . '/security.php';
}

function shortzlino_page_redirect_rules() {
	$redirects = array(
		// 'old-page-slug' => '/new-page/',
	);

	return apply_filters('shortzlino_page_redirect_rules', $redirects);
}

function shortzlino_handle_page_redirects() {
	if (is_admin() || wp_doing_ajax()) {
		return;
	}

	foreach (shortzlino_page_redirect_rules() as $from => $to) {
		if (! is_page($from)) {
			continue;
		}

		wp_safe_redirect(home_url($to), 301);
		exit;
	}
}
add_action('template_redirect', 'shortzlino_handle_page_redirects', 1);
