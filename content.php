<?php
/**
 * @package mek_secret
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php get_template_part( 'entryheader' , get_post_format() ); ?>

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'mek_secret' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'mek_secret' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

<?php get_template_part( 'entryfooter' , get_post_format() ); ?>

</article><!-- #post-## -->
