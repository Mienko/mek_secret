<?php
/**
 * This is the meta-data displayed in the header of each post.
 *
 * @package mek_secret
 */
// Don't display some meta-data for pages and custom post types
if ( 'post' == get_post_type() ) :
?>
		<div class="entry-meta">
			<?php mek_secret_posted_on( 'dl' ); ?>
		</div><!-- .entry-meta -->

<?php endif;
