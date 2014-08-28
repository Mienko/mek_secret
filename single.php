<?php
/**
 * The Template for displaying all single posts.
 *
 * @package mek_secret
 */

get_template_part( 'header' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>

	<?php
	if ( has_post_thumbnail() ) {
		$thumb_id   = get_post_thumbnail_id();
		$image      = wp_get_attachment_image_src( $thumb_id , 'large' );
		$src        = $image[0];
		wp_enqueue_script( 'mek_secret-parallax' );
	?>
	<header class="page-header header-image" style="background-image: url('<?php echo $src; ?>');">
	</header>
	<?php } ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php get_template_part( 'content', 'single' ); ?>

			<?php mek_secret_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php endwhile; // end of the loop. ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
