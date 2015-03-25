<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Vive
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function vive_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'vive_jetpack_setup' );
