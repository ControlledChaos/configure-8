<?php
/**
 * Theme configuration
 *
 * @package    BS Bludit
 * @subpackage Templates
 * @category   Utility
 * @since      1.0.0
 */

// Stop if accessed directly.
if ( ! defined( 'BLUDIT' ) ) {
	die( $L->get( 'direct-access' ) );
}

/**
 * Configuration constant
 *
 * @since 1.0.0
 * @var   array
 */
if ( ! defined( 'THEME_CONFIG' ) ) {
	define(
		'THEME_CONFIG',
		[
			'parent' => false,
			'debug'  => false,
			'head'   => [

				/**
				 * Favicon (bookmark icon)
				 *
				 * No Bludit constants and no
				 * directory, only the file name
				 * and extension (e.g. favicon.png ).
				 *
				 * Place the icon in the Bludit
				 * root directory or in this theme's
				 * `assets/images` directory and the
				 * theme will find it.
				 *
				 * The theme looks first in the root
				 * directory so a file there will override
				 * a file in `assets/images`.
				 */
				'favicon'  => 'favicon.gif',
				'keywords' => []
			],
			'toolbar'     => [
				'display' => true
			],
			'header' => [
				'title'       => true,
				'description' => true
			],
			'main_nav'    => [
				'max_items' => 6,
				'blog'      => true,
				'home'      => true,
				'search'    => true
			],
			'media' => [
				/**
				 * No Bludit constants, only dir/file,
				 * unless this file is placed in the
				 * root directory, in which case the
				 * domain constants are necessary.
				 */
				'cover_image' => 'assets/images/cover.jpg',
			],

			// Posts loops.
			'posts' => [

				// Options: `list` & `grid`.
				'loop' => 'list',

				// Options: `prev_next` & `numerical`.
				'paged'     => 'numerical',
				'byline'    => true,
				'post_date' => true,
				'read_time' => true
			],
			'aside'       => [
				'no_sidebar'     => false,
				'sidebar_bottom' => false,
				'search_widget'  => true
			],
			'footer' => [
				'copyright_line' => true,
				'copyright_date' => true,

				// Use `%year%` in language files for current year.
				'copyright_text' => ''
			],

			// Value of the scheme type is the scheme directory.
			'schemes' => [
				'color'      => '',
				'typography' => ''
			]
		]
	);
}

// Set debug mode.
if ( THEME_CONFIG['debug'] ) {
	define( 'DEBUG_MODE', true );
	ini_set( 'display_errors', 1 );
}