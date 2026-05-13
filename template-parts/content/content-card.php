<?php
/**
 * Post card component.
 *
 * @package Shortzlino
 */

if (! defined('ABSPATH')) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
	<a class="post-card__media" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
		<?php if (has_post_thumbnail()) : ?>
			<?php the_post_thumbnail('medium_large'); ?>
		<?php else : ?>
			<span class="post-card__placeholder"></span>
		<?php endif; ?>
	</a>

	<div class="post-card__body">
		<div class="entry-meta">
			<?php shortzlino_posted_on(); ?>
		</div>

		<h2 class="post-card__title">
			<a href="<?php the_permalink(); ?>"><?php echo esc_html(get_the_title()); ?></a>
		</h2>

		<div class="post-card__excerpt">
			<?php the_excerpt(); ?>
		</div>
	</div>
</article>
