<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package mek_secret
 */

get_header(); ?>

	<header class="page-header<?php if (get_header_image()) echo " header-image\" style=\"background-image: url('" . get_header_image() . "'); height:" . get_custom_header()->height . "px;" ?>">
		<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'mek_secret' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	</header><!-- .page-header -->

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
				?>

			<?php endwhile; ?>

			<?php mek_secret_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
