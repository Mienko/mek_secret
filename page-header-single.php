<?php
/**
 * Displays a header image for the current page.
 *
 * @package mek_secret
 */
if ( has_post_thumbnail() ) {
	$thumb_id   = get_post_thumbnail_id();
	$image      = wp_get_attachment_image_src( $thumb_id , 'header' );
	$src        = $image[0];
	wp_enqueue_script( 'mek_secret-parallax' );
?>
	<header class="page-header header-image" style="background-image: url('<?php echo $src; ?>');" data-background-height="<?php echo $image[2]; ?>">
	</header><!-- .page-header -->
<?php } ?>
