<?php
/**
 * Displays a header image for the current page.
 *
 * @package mek_secret
 */
?>
	<header class="page-header<?php if (get_header_image()) echo " header-image\" style=\"background-image: url('" . get_header_image() . "');\" data-background-height=\"" . get_custom_header()->height . "" ?>">
	</header><!-- .page-header -->
