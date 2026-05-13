<?php
/**
 * Single post content template.
 *
 * @package Shortzlino
 */

if (! defined('ABSPATH')) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-content'); ?>>
	<?php
	get_template_part('template-parts/components/page-hero', null, array(
		'title' => get_the_title(),
	));
	get_template_part('template-parts/components/featured-media');
	?>

	<section class="content-band">
		<div class="content-band__inner content-band__inner--narrow">
			<div class="entry-meta entry-meta--single">
				<?php shortzlino_posted_on(); ?>
			</div>

			<div class="entry-content">
				<?php
				the_content();

				wp_link_pages(array(
					'before' => '<div class="page-links">' . esc_html__('Pages:', 'shortzlino'),
					'after'  => '</div>',
				));
				?>
			</div>
		</div>
	</section>
</article>
