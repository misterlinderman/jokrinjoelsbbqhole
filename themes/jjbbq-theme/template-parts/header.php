<?php
/**
 * Template part: Site header.
 *
 * @package JJBBQ
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="sr-only" href="#main-content"><?php esc_html_e( 'Skip to content', 'jjbbq' ); ?></a>

<header class="site-header" role="banner">
    <div class="container header-inner">
        <?php if ( has_custom_logo() ) : ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" aria-label="<?php esc_attr_e( 'Home', 'jjbbq' ); ?>">
                <?php
                $logo_id = get_theme_mod( 'custom_logo' );
                echo wp_get_attachment_image( $logo_id, 'full', false, [ 'loading' => 'eager' ] );
                ?>
            </a>
        <?php else : ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo__text">
                <?php bloginfo( 'name' ); ?>
            </a>
        <?php endif; ?>

        <button class="nav-toggle"
                aria-label="<?php esc_attr_e( 'Toggle navigation', 'jjbbq' ); ?>"
                aria-expanded="false"
                aria-controls="site-navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav id="site-navigation" class="site-nav" role="navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'jjbbq' ); ?>">
            <?php
            wp_nav_menu( [
                'theme_location' => 'primary',
                'container'      => false,
                'fallback_cb'    => false,
            ] );
            ?>
        </nav>
    </div>
</header>
