<?php
/**
 * Plugin Name:       WP Login page
 * Plugin URI:        https://github.com/BeAPI/wp-login-page
 * Description:       Customize the login page with CSS/images
 * Version:           1.0.0
 * Requires PHP:      5.6
 * Author:            Be API
 * Author URI:        https://beapi.fr
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

namespace BEAPI\WP_Login_Page;

// Standard plugin security, keep this line in place.
defined( 'ABSPATH' ) || die();

add_action( 'login_head', __NAMESPACE__ . '\\enqueue_asset' );
/**
 * Enqueue the style for the login page.
 *
 * @author Nicolas JUEN
 */
function enqueue_asset() {
	wp_enqueue_style( 'wp-login-page-css' );
}

add_action( 'init', __NAMESPACE__ . '\\register_asset' );
/**
 * Register the style for the login page.
 *
 * @author Nicolas JUEN
 */
function register_asset() {
	wp_register_style( 'wp-login-page-css', get_login_stylesheet_uri(), [ 'login' ], '1.0.0' );
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
	$filename = apply_filters( 'wp_login_page_theme_css', '/dist/assets/login.css' );
	$file     = \get_theme_file_path( $filename );

	if ( file_exists( $file ) ) {
		return \get_theme_file_uri( $filename );
	}

	/**
	 * The platform CSS if available into WP_CONTENT folder.
	 */
	$platform_filename = \apply_filters( 'wp_login_page_platform_css', 'wp-login-page/login.css' );

	if ( file_exists( WP_CONTENT_DIR . '/' . $platform_filename ) ) {
		return \esc_url( WP_CONTENT_URL . $platform_filename );
	}

	/**
	 * Default behaviour returns the plugin login css file.
	 */
	return esc_url( \apply_filters( 'wp_login_page_default_css', WPMU_PLUGIN_URL . '/wp-login-page/assets/login.css' ) );
}
