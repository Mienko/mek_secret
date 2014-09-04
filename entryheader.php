<?php
/**
 * This is the entry header.
 *
 * The entry header is included from content.php, and goes at the top of each
 * article. There are 3 main parts of the header:
 *   (i) A featured image section or it's caption,
 *  (ii) the entry-title and
 * (iii) some entry meta.
 *
 * @package mek_secret
 */
?>
	<header class="entry-header">
<?php

// Let's start with the (i) featured image!
if ( has_post_thumbnail() ) {

	if ( ! is_single() ) {

		$image    = wp_get_attachment_image_src( get_post_thumbnail_id() , 'large' );
		$src      = $image[0];
		echo( '<div class="featured-image" style="' . "background-image: url('$src');" . '"></div>' );

	} else {
		// On the single page, output the featured image's title and description
		// The image itself is included outside this scope as a .page-header
		// That means we can skip the image itself, and concentrate on creating a caption instead
		$attachment = get_post( get_post_thumbnail_id() );

		if ( $attachment->post_title || $attachment->post_excerpt ) {

			echo( '<div class="featured-image-caption">' );

			// First the caption title
			if ( $attachment->post_title ) {
				echo '<strong>' . $attachment->post_title;
				if ( $attachment->post_excerpt ) {
					echo ':';
				}
				echo( '</strong>' );
			}

			// Now the caption
			if ( $attachment->post_excerpt ) {
				echo $attachment->post_excerpt;
			}
			echo( '</div><!-- .featured-image-caption -->' );

		} // end if there is a caption

	} // end if is_single 
} // end if has post thumbnail

// We're done witht the featured image,
// let's move on to the (ii) title
mek_secret_the_title();

// (iii) Let's display some meta-data
// (but not for pages and custom post types)
if ( 'post' == get_post_type() ) :
?>
		<div class="entry-meta">
			<?php mek_secret_posted_on( 'dl' ); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>

	</header><!-- .entry-header -->
