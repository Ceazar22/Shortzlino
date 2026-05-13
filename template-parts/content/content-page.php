<?php
/**
 * Page content template.
 *
 * @package Shortzlino
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
	<?php
	get_template_part('template-parts/components/page-hero', null, array(
		'title' => get_the_title(),
	));
	get_template_part('template-parts/components/featured-media');
	?>

	<section class="content-band">
		<div class="content-band__inner content-band__inner--narrow entry-content">
			<?php
			the_content();

			wp_link_pages(array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'shortzlino'),
				'after'  => '</div>',
			));
			?>
		</div>
	</section>
</article>

