<?php
/**
 * Displays a posts featured image.
 *
 *	Used at the top of each post. Do not confuse with the page-header templates.
 *
 * @package mek_secret
 */

// Let's start with (i) the featured image!
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

	} // end if is_single 
} // end if has post thumbnail

