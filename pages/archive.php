<?php
/**
 * Archive template.
 *
 * @package Shortzlino
 */

if (! defined('ABSPATH')) {
	require dirname(__DIR__) . '/inc/security.php';
}

get_header();

$archive_term = get_queried_object();
$hero_image   = '';

if ($archive_term && isset($archive_term->term_id)) {
	$thumbnail_id = (int) get_term_meta($archive_term->term_id, 'thumbnail_id', true);

	if (! $thumbnail_id && isset($archive_term->slug) && taxonomy_exists('product_cat')) {
		$product_term = get_term_by('slug', $archive_term->slug, 'product_cat');
		$thumbnail_id = ($product_term && ! is_wp_error($product_term)) ? (int) get_term_meta($product_term->term_id, 'thumbnail_id', true) : 0;
	}

	$hero_image = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'full') : '';
}
?>

<section class="content-band">
	<div class="content-band__inner">
		<?php
		get_template_part('template-parts/components/page-hero', null, array(
			'title'       => get_the_archive_title(),
			'description' => get_the_archive_description(),
			'image'       => $hero_image,
		));

		if (have_posts()) :
			?>
			<div class="post-grid">
				<?php
				while (have_posts()) :
					the_post();
					get_template_part('template-parts/content/content-card');
				endwhile;
				?>
			</div>
			<?php
			get_template_part('template-parts/components/pagination');
		else :
			get_template_part('template-parts/content/no-results');
		endif;
		?>
	</div>
</section>

<?php
get_footer();
