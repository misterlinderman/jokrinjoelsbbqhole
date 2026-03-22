<?php
/**
 * Template part: Homepage hero section.
 *
 * @package JJBBQ
 */

$headline = get_theme_mod( 'jjbbq_hero_headline', __( 'Pop-Up BBQ. Sell-Out Quality.', 'jjbbq' ) );
$subhead  = get_theme_mod( 'jjbbq_hero_subhead', __( 'Smoked in Omaha. Gone before you know it.', 'jjbbq' ) );
?>

<section class="hero" aria-label="<?php esc_attr_e( 'Hero', 'jjbbq' ); ?>">
    <div class="container">
        <div class="hero__logo">
            <?php if ( has_custom_logo() ) : ?>
                <?php
                $logo_id = get_theme_mod( 'custom_logo' );
                echo wp_get_attachment_image( $logo_id, 'full', false, [
                    'alt'     => get_bloginfo( 'name' ),
                    'loading' => 'eager',
                ] );
                ?>
            <?php else : ?>
                <h2 class="hero__headline" style="font-size: clamp(2rem, 5vw, 3.5rem);">
                    <?php bloginfo( 'name' ); ?>
                </h2>
            <?php endif; ?>
        </div>

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
</section>
