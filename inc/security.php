<?php
/**
 * Theme security helpers.
 *
 * @package Shortzlino
 */

if (! defined('ABSPATH')) {
	if (! headers_sent()) {
		header('Location: /', true, 302);
	}
	exit;
}

remove_action('wp_head', 'wp_generator');

function shortzlino_disable_author_enumeration() {
	if (is_admin() || ! isset($_GET['author'])) {
		return;
	}

	wp_safe_redirect(home_url('/'), 301);
	exit;
}
add_action('template_redirect', 'shortzlino_disable_author_enumeration');

