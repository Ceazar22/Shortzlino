<?php
/**
 * Shortzlino theme setup.
 *
 * @package Shortzlino
 */

if (! defined('ABSPATH')) {
	exit;
}

if (! defined('SHORTZLINO_VERSION')) {
	define('SHORTZLINO_VERSION', '0.1.0');
}

require get_template_directory() . '/inc/security.php';
require get_template_directory() . '/inc/page-loader.php';
require get_template_directory() . '/inc/redirects.php';

if (! function_exists('shortzlino_setup')) {
	function shortzlino_setup() {
		load_theme_textdomain('shortzlino', get_template_directory() . '/languages');

		add_theme_support('automatic-feed-links');
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		add_theme_support('custom-logo', array(
			'height'      => 80,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		));
		add_theme_support('html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		));
		add_theme_support('align-wide');
		add_theme_support('responsive-embeds');
		add_theme_support('editor-styles');
		add_theme_support('woocommerce');

		add_editor_style('assets/css/main.css');

		register_nav_menus(array(
			'primary' => __('Primary Menu', 'shortzlino'),
			'footer'  => __('Footer Menu', 'shortzlino'),
		));
	}
}
add_action('after_setup_theme', 'shortzlino_setup');

function shortzlino_content_width() {
	$GLOBALS['content_width'] = apply_filters('shortzlino_content_width', 1120);
}
add_action('after_setup_theme', 'shortzlino_content_width', 0);

function shortzlino_widgets_init() {
	register_sidebar(array(
		'name'          => __('Footer Widgets', 'shortzlino'),
		'id'            => 'footer-widgets',
		'description'   => __('Add footer widgets here.', 'shortzlino'),
		'before_widget' => '<section id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="footer-widget__title">',
		'after_title'   => '</h2>',
	));
}
add_action('widgets_init', 'shortzlino_widgets_init');

function shortzlino_scripts() {
	wp_enqueue_style(
		'shortzlino-main',
		get_template_directory_uri() . '/assets/css/main.css',
		array(),
		SHORTZLINO_VERSION
	);

	wp_enqueue_script(
		'shortzlino-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		SHORTZLINO_VERSION,
		true
	);
}
add_action('wp_enqueue_scripts', 'shortzlino_scripts');

function shortzlino_excerpt_more() {
	return '&hellip;';
}
add_filter('excerpt_more', 'shortzlino_excerpt_more');

function shortzlino_posted_on() {
	printf(
		'<time class="entry-meta__date" datetime="%1$s">%2$s</time>',
		esc_attr(get_the_date(DATE_W3C)),
		esc_html(get_the_date())
	);
}
