<?php
/**
 * This is the entry header.
 *
 * @package mek_secret
 */
?>
	<header class="entry-header">
<?php

get_template_part( 'featuredimage' , get_post_format() );

mek_secret_the_title();

get_template_part( 'headermeta' , get_post_format() );

?>
	</header><!-- .entry-header -->
