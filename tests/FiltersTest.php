<?php

use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use WP_Mock\Functions;
use function BEAPI\WP_Login_Page\get_login_stylesheet_uri;

class FiltersTest extends \WP_Mock\Tools\TestCase {
	public function setUp(): void {
		WP_Mock::setUp();
	}

	public function tearDown(): void {
		WP_Mock::tearDown();
	}

	public function testDefaultBehaviour() {
		WP_Mock::userFunction( 'get_theme_file_path', [
			'args'            => [ Functions::type( 'string' ) ],
			'return_in_order' => [
				false,
				__DIR__ . '/data/login.css',
			],
		] );

		$file = __DIR__ . '/data/login.css';
		WP_Mock::userFunction( 'get_theme_file_uri', [
			'args'            => [ Functions::type( 'string' ) ],
			'return_in_order' => [
				$file,
			],
		] );

		$this->assertEmpty( get_login_stylesheet_uri() );
	}

	public function testFilterTheme() {
		$file = __DIR__ . '/data/login.css';

		WP_Mock::userFunction( 'get_theme_file_path', [
			'args'            => [ Functions::type( 'string' ) ],
			'return_in_order' => [
				__DIR__ . '/data/login.css',
			],
		] );

		WP_Mock::userFunction( 'get_theme_file_uri', [
			'args'            => [ Functions::type( 'string' ) ],
			'return_in_order' => [
				$file,
			],
		] );

		WP_Mock::onFilter( 'wp_login_page_theme_css' )
		       ->with( '/dist/assets/login.css' )
		       ->reply( '/data/login.css' );

		$this->assertEquals( get_login_stylesheet_uri(), $file );
	}

	public function testFilterThemeDefault() {
		define( 'WP_DEFAULT_THEME', 'wp-login-page-default' );
		$file = WP_CONTENT_URL . '/themes/' . WP_DEFAULT_THEME . '/dist/assets/login.css';

		WP_Mock::userFunction( 'get_theme_file_path', [
			'args'            => [ Functions::type( 'string' ) ],
			'return_in_order' => [
				false,
			],
		] );

		$this->assertEquals( get_login_stylesheet_uri(), $file );
	}

	public function testFilterPlatform() {
		$file = WP_CONTENT_DIR . '/wp-login-page/test.css';

		WP_Mock::userFunction( 'get_theme_file_path', [
			'args'            => [ Functions::type( 'string' ) ],
			'return_in_order' => [
				false,
			],
		] );

		WP_Mock::onFilter( 'wp_login_page_platform_css' )
		       ->with( 'wp-login-page/login.css' )
		       ->reply( '/wp-login-page/test.css' );

		$this->assertEquals( get_login_stylesheet_uri(), WP_CONTENT_URL . '/wp-login-page/test.css' );
	}
}