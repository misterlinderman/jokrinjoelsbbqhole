<?php
/**
 * Jorkin' Joel's BBQ Hole — Theme Functions
 *
 * @package JJBBQ
 */

define( 'JJBBQ_THEME_VERSION', '1.0.0' );
define( 'JJBBQ_THEME_DIR', get_template_directory() );
define( 'JJBBQ_THEME_URI', get_template_directory_uri() );

require_once JJBBQ_THEME_DIR . '/inc/site-options.php';
require_once JJBBQ_THEME_DIR . '/inc/theme-setup.php';
require_once JJBBQ_THEME_DIR . '/inc/enqueue.php';
require_once JJBBQ_THEME_DIR . '/inc/template-functions.php';
