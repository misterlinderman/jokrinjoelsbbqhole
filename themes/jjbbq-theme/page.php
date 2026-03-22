<?php
/**
 * Generic page template.
 *
 * @package JJBBQ
 */

get_header();
?>

<main id="main-content" class="site-main">
    <?php while ( have_posts() ) : the_post(); ?>
        <section class="page-hero section-band section-band--dark">
            <div class="container">
                <h1><?php the_title(); ?></h1>
            </div>
        </section>

        <section class="page-content">
            <div class="container">
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
</main>

<?php
get_footer();
