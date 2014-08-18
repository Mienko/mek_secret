<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package mek_secret
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function mek_secret_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'mek_secret_jetpack_setup' );
