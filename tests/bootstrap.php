<?php

// First we need to load the composer autoloader so we can use WP Mock
require_once __DIR__ . '/../vendor/autoload.php';

define( 'WPMU_PLUGIN_URL', 'https://test.test/wp-content/mu-plugins' );
define( 'WP_CONTENT_URL', 'https://test.test/wp-content' );
define( 'WP_CONTENT_DIR', __DIR__.'/data' );

// Now call the bootstrap method of WP Mock
WP_Mock::bootstrap();

/**
 * Now we include any plugin files that we need to be able to run the tests. This
 * should be files that define the functions and classes you're going to test.
 */
require_once __DIR__ . '/../wp-login-page.php';
