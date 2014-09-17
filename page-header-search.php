<?php
/**
 * Displays a header image for the current page.
 * 
 * On search pages, this section also includes the page title and the search query.
 *
 * @package mek_secret
 */
?>
	<header class="page-header<?php if (get_header_image()) echo " header-image\" style=\"background-image: url('" . get_header_image() . "');" ?>">
		<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'mek_secret' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	</header><!-- .page-header -->
