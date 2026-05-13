<?php
/**
 * Comments template.
 *
 * @package Shortzlino
 */

if (! defined('ABSPATH')) {
	exit;
}

if (post_password_required()) {
	return;
}
?>

<section id="comments" class="comments-area content-band">
	<div class="content-band__inner content-band__inner--narrow">
		<?php if (have_comments()) : ?>
			<h2 class="comments-title">
				<?php
				printf(
					esc_html(_nx('%1$s comment', '%1$s comments', get_comments_number(), 'comments title', 'shortzlino')),
					esc_html(number_format_i18n(get_comments_number()))
				);
				?>
			</h2>

			<ol class="comment-list">
				<?php
				wp_list_comments(array(
					'style'      => 'ol',
					'short_ping' => true,
				));
				?>
			</ol>

			<?php the_comments_navigation(); ?>
		<?php endif; ?>

		<?php comment_form(); ?>
	</div>
</section>
