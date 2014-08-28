<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package mek_secret
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'mek_secret' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'mek_secret' ), '<span class="wp">WordPress</span>' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'mek_secret' ), 'Secret', '<a href="' . esc_url( 'http://mienko.no/' ) . '" rel="designer">Mienko</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
