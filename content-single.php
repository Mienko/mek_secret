<?php
/**
 * @package mek_secret
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
<?php
if ( has_post_thumbnail() ) {
	$thumb_id = get_post_thumbnail_id();
	$image = wp_get_attachment_image( $thumb_id , 'large' );
?>
	<figure class="wp-caption alignnone">
<pre>
<?php print_r( $image ); ?>
</pre>
	</figure>
<?php
}

?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php mek_secret_posted_on( 'dl' ); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'mek_secret' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

<?php get_template_part( 'content-footer' ); ?>

</article><!-- #post-## -->
