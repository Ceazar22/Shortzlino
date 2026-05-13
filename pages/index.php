<?php
/**
 * Main template.
 *
 * @package Shortzlino
 */

if (! defined('ABSPATH')) {
	require dirname(__DIR__) . '/inc/security.php';
}

get_header();

if (have_posts()) :
	?>
	<section class="content-band">
		<div class="content-band__inner">
			<?php if (is_home() && ! is_front_page()) : ?>
				<?php get_template_part('template-parts/components/page-hero', null, array('title' => single_post_title('', false))); ?>
			<?php endif; ?>

			<div class="post-grid">
				<?php
				while (have_posts()) :
					the_post();
					get_template_part('template-parts/content/content-card');
				endwhile;
				?>
			</div>

			<?php get_template_part('template-parts/components/pagination'); ?>
		</div>
	</section>
	<?php
else :
	get_template_part('template-parts/content/no-results');
endif;

get_footer();
