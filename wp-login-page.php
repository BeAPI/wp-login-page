<?php
/**
 * Plugin Name:       WP Login page
 * Plugin URI:        https://github.com/BeAPI/wp-login-page
 * Description:       Customize the login page with CSS/images
 * Version:           2.0.1
 * Requires PHP:      5.6
 * Author:            Be API
 * Author URI:        https://beapi.fr
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

namespace BEAPI\WP_Login_Page;

// Standard plugin security, keep this line in place.
defined( 'ABSPATH' ) || die();

/**
 * Enqueue the style for the login page.
 *
 * @author Nicolas JUEN
 *
 * @return void
 */
function enqueue_asset() {
	wp_enqueue_style( 'wp-login-page-css' );
}

add_action( 'init', __NAMESPACE__ . '\\register_asset' );
/**
 * Register the style for the login page.
 *
 * @author Nicolas JUEN
 *
 * @return void
 */
function register_asset() {
	$style = get_login_stylesheet_uri();
	if ( empty( $style ) ) {
		return;
	}
	add_action( 'login_head', __NAMESPACE__ . '\\enqueue_asset' );
	wp_register_style( 'wp-login-page-css', $style, [ 'login' ], '2.0.0' );
}

/**
 * Returns the available file in order :
 * - Theme
 * - Platform
 * - Default plugin file
 *
 * @return string
 * @author Nicolas JUEN
 */
function get_login_stylesheet_uri() {
	/**
	 * First the child/parent file.
	 */
	$filename = apply_filters( 'wp_login_page_theme_css', '/dist/login.css' );
	$file     = \get_theme_file_path( $filename );

	if ( file_exists( $file ) ) {
		return \get_theme_file_uri( $filename );
	}

	/**
	* Check the default theme if defined
	*/
	if ( defined( 'WP_DEFAULT_THEME' ) && ! empty( WP_DEFAULT_THEME ) ) {
		$file = WP_CONTENT_DIR . '/themes/' . WP_DEFAULT_THEME . $filename;
		if ( file_exists( $file ) ) {
			return WP_CONTENT_URL . '/themes/' . WP_DEFAULT_THEME . $filename;
		}
	}

	/**
	 * The platform CSS if available into WP_CONTENT folder.
	 */
	$platform_filename = \apply_filters( 'wp_login_page_platform_css', 'wp-login-page/login.css' );

	if ( file_exists( WP_CONTENT_DIR . '/' . $platform_filename ) ) {
		return \esc_url( WP_CONTENT_URL . '/' . $platform_filename );
	}

	/**
	 * Default behaviour no CSS.
	 */
	return '';
}
