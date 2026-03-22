<?php
/**
 * Homepage template.
 *
 * @package JJBBQ
 */

get_header();
?>

<main id="main-content" class="site-main">

    <?php get_template_part( 'template-parts/hero' ); ?>

    <?php get_template_part( 'template-parts/next-popup' ); ?>

    <?php get_template_part( 'template-parts/about-strip' ); ?>

    <?php get_template_part( 'template-parts/menu-section' ); ?>

    <?php get_template_part( 'template-parts/catering-cta' ); ?>

    <?php get_template_part( 'template-parts/past-events' ); ?>

</main>

<?php
get_footer();
