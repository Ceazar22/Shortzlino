<?php
/**
 * Page file loader.
 *
 * Keeps WordPress-required root templates as thin wrappers while storing
 * editable page markup in /pages.
 *
 * @package Shortzlino
 */

if (! defined('ABSPATH')) {
	require __DIR__ . '/security.php';
}

function shortzlino_load_page($page) {
	$page = sanitize_key($page);
	$path = get_template_directory() . '/pages/' . $page . '.php';

	if (! is_readable($path)) {
		status_header(404);
		$path = get_template_directory() . '/pages/404.php';
	}

	require $path;
}

