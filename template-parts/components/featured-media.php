<?php
/**
 * Featured media component.
 *
 * @package Shortzlino
 */

if (! defined('ABSPATH')) {
	exit;
}

if (! has_post_thumbnail()) {
	return;
}
?>

<figure class="featured-media">
	<?php the_post_thumbnail('large'); ?>
</figure>
