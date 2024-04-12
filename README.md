# WP Login Page

## Introduction

This mu-plugin allows you enqueue style on login page.
The plugin will look for styles into :
- dist/assets/login.css of the child theme
- dist/assets/login.css of the parent theme
- WP_DEFAULT_THEME/dist/assets/login.css
- WP_CONTENT_DIR/wp-login-page/login.css

## Requirements
- WordPress > 4.7
- PHP > 5.6

## Installation
### From composer
```shell script
composer require beapi/wp-login-page
```

### From files
Just download the `wp-login-page.php` into your mu-plugins directory.

## Changelog

### 2.0.2
* Use login_init hook instead of init

### 2.0.1
* Update dev dependencies
* Update the composer/installers constraint

### 2.0
* BREAKING CHANGES : Change path to default theme file path `dist/assets/login.css` to `dist/login.css`

### 1.0.1
* Fix platform URL construction
* Add test on empty final file

### 1.0.0
* First release

## Filters

### wp_login_page_theme_css
Allows you to change the theme filepath.
If you need to change the filepath to `theme/my_theme/assets/my-custom-login.css`
```php
<?php
add_filter( 'wp_login_page_theme_css', function() {
    return 'assets/my-custom-login.css' );
});
```

### wp_login_page_platform_css
Allows you to change the platform global filepath.
If you need to change the filepath to `wp-content/customs/my-custom-login.css`
```php
<?php
add_filter( 'wp_login_page_platform_css', function() {
    return 'customs/my-custom-login.css';
});
```

## Customize the logo
Example of CSS for cutomizing the logo : 
```css
body.login h1 a {
  display: block;
  width: 100%;
  background-image: url(wapuu.png);
  background-repeat: no-repeat;
  background-position: center center;
  background-size: 103px;
}
```

## Contribute
Launch the local machine with lando:
- `lando start`
- `lando setup`
- Open you browser at https://wp-login-page.lndo.site/wp-login.php
