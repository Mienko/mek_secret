<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package mek_secret
 */

if ( ! function_exists( 'mek_secret_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function mek_secret_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'mek_secret' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'mek_secret' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'mek_secret' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'mek_secret_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function mek_secret_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'mek_secret' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'mek_secret' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     'mek_secret' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'mek_secret_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function mek_secret_posted_on( $type = 'inline' ) {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'Published %s', 'post date', 'mek_secret' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( 'by %s', 'post author', 'mek_secret' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	switch ( $type ) {
	case 'dl':
		// We will override the basic elements in order to build the definition list correctly
		$posted_on = '<dt class="posted-on">' . __( 'Published', 'mek_secret' ) . '</dt>';
		$posted_on .= '<dd class="published-date"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></dd>';

		$byline = '<dt class="byline">' . __( 'Author', 'mek_secret' ) . '</dt>';
		$byline .= '<dd class="author vcard">';
		$byline .= '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">';
		$byline .= esc_html( get_the_author() );
		$byline .= '</a></dd>';

		echo '<dl>' . $posted_on . $byline . '</dl>';
		break;

	case 'span':
	case 'inline':
	case 'default':
		echo '<span class="posted-on">' . $posted_on . '</span> <span class="byline">' . $byline . '</span>';
		break;
	}

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function mek_secret_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'mek_secret_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'mek_secret_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so mek_secret_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so mek_secret_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in mek_secret_categorized_blog.
 */
function mek_secret_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'mek_secret_categories' );
}
add_action( 'edit_category', 'mek_secret_category_transient_flusher' );
add_action( 'save_post',     'mek_secret_category_transient_flusher' );

/**
 * Make titles into URLs, but not on single posts.
 */
function mek_secret_the_title() {
	if ( is_single() ) {
		the_title( '<h1 class="entry-title">', '</h1>' ); 
	} else {
		the_title(
			sprintf(
				'<h1 class="entry-title"><a href="%s" rel="bookmark">',
				esc_url( get_permalink() )
			),
			'</a></h1>'
		);
	}
}
