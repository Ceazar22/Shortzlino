<?php
/**
 * Theme security helpers.
 *
 * @package Shortzlino
 */

if (! defined('ABSPATH')) {
	exit;
}

remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');

add_filter('xmlrpc_enabled', '__return_false');
add_filter('pings_open', '__return_false', 20, 2);

function shortzlino_security_headers($headers) {
	if (is_admin()) {
		return $headers;
	}

	$headers['X-Content-Type-Options'] = 'nosniff';
	$headers['X-Frame-Options']        = 'SAMEORIGIN';
	$headers['Referrer-Policy']        = 'strict-origin-when-cross-origin';
	$headers['Permissions-Policy']     = 'camera=(), microphone=(), geolocation=()';

	return $headers;
}
add_filter('wp_headers', 'shortzlino_security_headers');

function shortzlino_disable_xmlrpc_pingbacks($methods) {
	unset($methods['pingback.ping'], $methods['pingback.extensions.getPingbacks']);

	return $methods;
}
add_filter('xmlrpc_methods', 'shortzlino_disable_xmlrpc_pingbacks');

function shortzlino_disable_author_enumeration() {
	if (is_admin() || wp_doing_ajax()) {
		return;
	}

	if (! is_author() && ! isset($_GET['author'])) {
		return;
	}

	wp_safe_redirect(home_url('/'), 301);
	exit;
}
add_action('template_redirect', 'shortzlino_disable_author_enumeration');

function shortzlino_restrict_rest_user_listing($result, $server, $request) {
	if (null !== $result || ! class_exists('WP_REST_Request') || ! $request instanceof WP_REST_Request) {
		return $result;
	}

	if (0 !== strpos($request->get_route(), '/wp/v2/users')) {
		return $result;
	}

	if (current_user_can('list_users')) {
		return $result;
	}

	return new WP_Error(
		'rest_forbidden',
		__('User listing is restricted.', 'shortzlino'),
		array('status' => rest_authorization_required_code())
	);
}
add_filter('rest_pre_dispatch', 'shortzlino_restrict_rest_user_listing', 10, 3);

function shortzlino_generic_login_errors() {
	return __('Invalid login details.', 'shortzlino');
}
add_filter('login_errors', 'shortzlino_generic_login_errors');
