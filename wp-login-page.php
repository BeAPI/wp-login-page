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
 * Text Domain:       wp-login-page
 * Domain Path:
 */

namespace BEAPI\WP_Login_Page;

// Standard plugin security, keep this line in place.
defined( 'ABSPATH' ) || die();


add_action( 'login_head', __NAMESPACE__ . '\\enqueue_asset' );
function enqueue_asset() {
	wp_enqueue_style( 'wp-login-page-css' );
}

add_action( 'wp', __NAMESPACE__ . '\\register_asset' );
function register_asset() {
	wp_register_style( 'wp-login-page-css', get_stylesheet_uri(), [ 'login' ], '1.0.0' );
}

function get_stylesheet_uri() {
	$file = get_theme_file_uri( '/dist/assets/login.css' );
	if ( ! empty( $file ) ) {
		return $file;
	}

	$platform_filename = apply_filters( 'wp-login-page-platform-css', 'wp-login-page/login.css' );

	if ( is_file( WP_CONTENT_DIR . '/' . $platform_filename ) ) {
		return WP_CONTENT_URL . '/' . $platform_filename;
	}

	return WPMU_PLUGIN_URL . '/wp-login-page/assets/login.css';
}
