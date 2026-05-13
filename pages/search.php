<?php
/**
 * Search template.
 *
 * @package Shortzlino
 */

if (! defined('ABSPATH')) {
	require dirname(__DIR__) . '/inc/security.php';
}

get_header();
?>

<section class="content-band">
	<div class="content-band__inner">
		<?php
		get_template_part('template-parts/components/page-hero', null, array(
			'title' => sprintf(
				/* translators: %s: search query. */
				__('Search results for: %s', 'shortzlino'),
				'<span>' . get_search_query() . '</span>'
			),
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
