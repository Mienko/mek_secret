<?php
/**
 * Displays a header image for the current page.
 * 
 * On archive pages, this section may also include the page title and a description.
 *
 * @package mek_secret
 */
?>
	<header class="page-header<?php if ( !is_paged() && get_header_image() ) echo( " header-image\" style=\"background-image: url('" . get_header_image() . "');\" data-background-height=\"" . get_custom_header()->height ); ?>">
		<h1 class="page-title">
			<?php
				if ( is_category() ) :
					single_cat_title();

				elseif ( is_tag() ) :
					single_tag_title();

				elseif ( is_author() ) :
					printf( __( 'Author: %s', 'mek_secret' ), '<span class="vcard">' . get_the_author() . '</span>' );

				elseif ( is_day() ) :
					printf( __( 'Day: %s', 'mek_secret' ), '<span>' . get_the_date() . '</span>' );

				elseif ( is_month() ) :
					printf( __( 'Month: %s', 'mek_secret' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'mek_secret' ) ) . '</span>' );

				elseif ( is_year() ) :
					printf( __( 'Year: %s', 'mek_secret' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'mek_secret' ) ) . '</span>' );

				elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
					_e( 'Asides', 'mek_secret' );

				elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
					_e( 'Galleries', 'mek_secret');

				elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
					_e( 'Images', 'mek_secret');

				elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
					_e( 'Videos', 'mek_secret' );

				elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
					_e( 'Quotes', 'mek_secret' );

				elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
					_e( 'Links', 'mek_secret' );

				elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
					_e( 'Statuses', 'mek_secret' );

				elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
					_e( 'Audios', 'mek_secret' );

				elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
					_e( 'Chats', 'mek_secret' );

				else :
					_e( 'Archives', 'mek_secret' );

				endif;
			?>
		</h1>
		<?php
			// Show an optional term description.
			$term_description = term_description();
			if ( ! empty( $term_description ) ) :
				printf( '<div class="taxonomy-description">%s</div>', $term_description );
			endif;
		?>
	</header><!-- .page-header -->

