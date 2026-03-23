<?php
/**
 * Plugin Name: JJBBQ Manager
 * Plugin URI:  https://jorkinjoels.com
 * Description: Data management for Jorkin' Joel's BBQ Hole — Custom Post Types, ACF fields, and admin experience.
 * Version:     1.0.0
 * Author:      Jorkin' Joel's BBQ Hole
 * Author URI:  https://jorkinjoels.com
 * Text Domain: jjbbq
 * Requires PHP: 8.0
 * License:     GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'JJBBQ_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'JJBBQ_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'JJBBQ_VERSION', '1.0.0' );

/**
 * Check for ACF dependency.
 */
function jjbbq_check_acf_dependency(): void {
    if ( ! class_exists( 'ACF' ) ) {
        add_action( 'admin_notices', function (): void {
            echo '<div class="notice notice-error"><p>';
            esc_html_e(
                'JJBBQ Manager requires Advanced Custom Fields to be installed and active.',
                'jjbbq'
            );
            echo '</p></div>';
        } );
    }
}
add_action( 'admin_init', 'jjbbq_check_acf_dependency' );

// Load includes
require_once JJBBQ_PLUGIN_PATH . 'includes/cpt-events.php';
require_once JJBBQ_PLUGIN_PATH . 'includes/cpt-menu-items.php';
require_once JJBBQ_PLUGIN_PATH . 'includes/acf-fields.php';
require_once JJBBQ_PLUGIN_PATH . 'includes/admin-columns.php';
require_once JJBBQ_PLUGIN_PATH . 'includes/helpers.php';
require_once JJBBQ_PLUGIN_PATH . 'includes/site-options.php';
require_once JJBBQ_PLUGIN_PATH . 'includes/admin-menu.php';
require_once JJBBQ_PLUGIN_PATH . 'includes/seed-data.php';
require_once JJBBQ_PLUGIN_PATH . 'includes/catering-form.php';
require_once JJBBQ_PLUGIN_PATH . 'includes/gravity-forms-catering.php';

/**
 * Enqueue admin styles.
 */
function jjbbq_admin_styles(): void {
    wp_enqueue_style(
        'jjbbq-admin',
        JJBBQ_PLUGIN_URL . 'assets/admin.css',
        [],
        JJBBQ_VERSION
    );
}
add_action( 'admin_enqueue_scripts', 'jjbbq_admin_styles' );
