<?php
/**
 * Plugin uninstall cleanup.
 *
 * @package JJBBQ
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

delete_option( 'jjbbq_seeded' );
