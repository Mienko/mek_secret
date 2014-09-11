	<footer class="entry-footer entry-meta">
		<?php if ( is_sticky() ) : ?>
			<div class="featured"><br>
				<?php _e( 'Featured' , 'mek_secret' ); ?>
			</div>
		<?php endif; // End if sticky ?>
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'mek_secret' ) );
				if ( $categories_list && mek_secret_categorized_blog() ) :
			?>
			<div class="cat-links">
				<?php printf( __( 'Posted in<br>%1$s', 'mek_secret' ), $categories_list ); ?>
			</div>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'mek_secret' ) );
				$tags = get_the_tags();
				if ( $tags_list ) :
			?>
			<div class="tags-links <?php echo 1 < count( $tags ) ? 'plural-tags' : 'single-tag'; ?>">
				<?php printf( __( 'Tagged<br>%1$s', 'mek_secret' ), $tags_list ); ?>
			</div>
			<?php endif; // End if $tags_list ?>

		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( is_single() ) : ?>

			<div class="permalink">
				<?php printf( 
					__( 'Bookmark<br>the <a href="%1$s" rel="bookmark">permalink</a>.', 'mek_secret' ),
					get_permalink()
				); ?>
			</div>

		<?php endif; // End if is_single() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<div class="comments-link <?php echo 1 < get_comments_number() ? 'plural-comments' : ''; ?>"><br><?php comments_popup_link( __( 'Leave a comment', 'mek_secret' ), __( '1 Comment', 'mek_secret' ), __( '% Comments', 'mek_secret' ) ); ?></div>
		<?php endif; ?>

		<?php if ( 'image' == get_post_format() ) : ?>
			<?php get_template_part( 'headermeta' , get_post_format() ); ?>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'mek_secret' ), '<span class="edit-link"><br>', '</span>' ); ?>
	</footer><!-- .entry-footer -->
