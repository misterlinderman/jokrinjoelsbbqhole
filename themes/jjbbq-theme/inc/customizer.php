<?php
/**
 * WordPress Customizer settings.
 *
 * @package JJBBQ
 */

function jjbbq_customize_register( WP_Customize_Manager $wp_customize ): void {

    // Panel
    $wp_customize->add_panel( 'jjbbq_panel', [
        'title'    => __( "Jorkin' Joel's Settings", 'jjbbq' ),
        'priority' => 30,
    ] );

    // ── Section: Social Media ──
    $wp_customize->add_section( 'jjbbq_social', [
        'title' => __( 'Social Media', 'jjbbq' ),
        'panel' => 'jjbbq_panel',
    ] );

    $wp_customize->add_setting( 'jjbbq_instagram_handle', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'jjbbq_instagram_handle', [
        'label'       => __( 'Instagram Handle (without @)', 'jjbbq' ),
        'section'     => 'jjbbq_social',
        'type'        => 'text',
    ] );

    $wp_customize->add_setting( 'jjbbq_instagram_url', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ] );
    $wp_customize->add_control( 'jjbbq_instagram_url', [
        'label'   => __( 'Instagram URL', 'jjbbq' ),
        'section' => 'jjbbq_social',
        'type'    => 'url',
    ] );

    $wp_customize->add_setting( 'jjbbq_facebook_url', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ] );
    $wp_customize->add_control( 'jjbbq_facebook_url', [
        'label'   => __( 'Facebook URL (optional)', 'jjbbq' ),
        'section' => 'jjbbq_social',
        'type'    => 'url',
    ] );

    // ── Section: Contact Info ──
    $wp_customize->add_section( 'jjbbq_contact', [
        'title' => __( 'Contact Info', 'jjbbq' ),
        'panel' => 'jjbbq_panel',
    ] );

    $wp_customize->add_setting( 'jjbbq_contact_email', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ] );
    $wp_customize->add_control( 'jjbbq_contact_email', [
        'label'   => __( 'Contact Email', 'jjbbq' ),
        'section' => 'jjbbq_contact',
        'type'    => 'email',
    ] );

    $wp_customize->add_setting( 'jjbbq_contact_phone', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'jjbbq_contact_phone', [
        'label'   => __( 'Contact Phone (optional)', 'jjbbq' ),
        'section' => 'jjbbq_contact',
        'type'    => 'text',
    ] );

    // ── Section: Homepage Text ──
    $wp_customize->add_section( 'jjbbq_homepage', [
        'title' => __( 'Homepage Text', 'jjbbq' ),
        'panel' => 'jjbbq_panel',
    ] );

    $wp_customize->add_setting( 'jjbbq_hero_headline', [
        'default'           => 'Pop-Up BBQ. Sell-Out Quality.',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'jjbbq_hero_headline', [
        'label'   => __( 'Hero Headline', 'jjbbq' ),
        'section' => 'jjbbq_homepage',
        'type'    => 'text',
    ] );

    $wp_customize->add_setting( 'jjbbq_hero_subhead', [
        'default'           => 'Smoked in Omaha. Gone before you know it.',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'jjbbq_hero_subhead', [
        'label'   => __( 'Hero Subheadline', 'jjbbq' ),
        'section' => 'jjbbq_homepage',
        'type'    => 'text',
    ] );

    $wp_customize->add_setting( 'jjbbq_catering_cta_text', [
        'default'           => 'Feed Your Crew',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'jjbbq_catering_cta_text', [
        'label'   => __( 'Catering CTA Headline', 'jjbbq' ),
        'section' => 'jjbbq_homepage',
        'type'    => 'text',
    ] );
}
add_action( 'customize_register', 'jjbbq_customize_register' );
