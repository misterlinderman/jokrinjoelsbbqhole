<?php
/**
 * Template part: Homepage hero section.
 *
 * @package JJBBQ
 */

$headline = get_theme_mod( 'jjbbq_hero_headline', __( 'Pop-Up BBQ. Sell-Out Quality.', 'jjbbq' ) );
$subhead  = get_theme_mod( 'jjbbq_hero_subhead', __( 'Smoked in Omaha. Gone before you know it.', 'jjbbq' ) );
$logo_url = get_theme_file_uri( 'reference-images/logo-primary.png' );
?>

<section class="hero" aria-label="<?php esc_attr_e( 'Hero', 'jjbbq' ); ?>">
    <div class="container">
        <div class="hero__content">
            <img
                class="hero__logo"
                src="<?php echo esc_url( $logo_url ); ?>"
                alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
                width="320"
                height="320"
                loading="eager"
                decoding="async"
            />

            <h1 class="hero__headline"><?php echo esc_html( $headline ); ?></h1>
            <p class="hero__subhead"><?php echo esc_html( $subhead ); ?></p>

            <div class="hero__actions">
                <a href="#find-the-truck" class="btn-secondary">
                    <?php esc_html_e( 'Find the Truck', 'jjbbq' ); ?>
                </a>
                <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="btn-primary">
                    <?php esc_html_e( 'See the Menu', 'jjbbq' ); ?>
                </a>
            </div>
        </div>
    </div>
</section>
