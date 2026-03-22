<?php
/**
 * Template Name: Menu
 *
 * Full menu page with tabbed categories.
 *
 * @package JJBBQ
 */

get_header();

$categories = [
    'core'      => __( 'Core Menu', 'jjbbq' ),
    'specialty' => __( 'Specialty Items', 'jjbbq' ),
    'sides'     => __( 'Sides', 'jjbbq' ),
    'collab'    => __( 'Collaborations', 'jjbbq' ),
];
?>

<main id="main-content" class="site-main">

    <section class="section-band section-band--red">
        <div class="container" style="text-align: center;">
            <h1><?php esc_html_e( 'The Menu', 'jjbbq' ); ?></h1>
        </div>
    </section>

    <section class="menu-page">
        <div class="container">

            <div class="menu-tabs" role="tablist">
                <?php $first = true; ?>
                <?php foreach ( $categories as $slug => $label ) : ?>
                    <button class="menu-tab<?php echo $first ? ' is-active' : ''; ?>"
                            role="tab"
                            data-tab="menu-<?php echo esc_attr( $slug ); ?>"
                            aria-selected="<?php echo $first ? 'true' : 'false'; ?>"
                            aria-controls="menu-<?php echo esc_attr( $slug ); ?>">
                        <?php echo esc_html( $label ); ?>
                    </button>
                    <?php $first = false; ?>
                <?php endforeach; ?>
            </div>

            <?php $first = true; ?>
            <?php foreach ( $categories as $slug => $label ) : ?>
                <?php $items = function_exists( 'jjbbq_get_menu_items' ) ? jjbbq_get_menu_items( $slug ) : null; ?>

                <div id="menu-<?php echo esc_attr( $slug ); ?>"
                     class="menu-tab-content<?php echo $first ? ' is-active' : ''; ?>"
                     role="tabpanel">

                    <?php if ( $items && $items->have_posts() ) : ?>
                        <div class="grid-3">
                            <?php while ( $items->have_posts() ) : $items->the_post(); ?>
                                <?php
                                $price = get_field( 'menu_price' ) ?: '';
                                $desc  = get_field( 'menu_description' ) ?: '';
                                $note  = get_field( 'menu_note' ) ?: '';
                                ?>
                                <div class="menu-item-card">
                                    <div class="menu-item-card__header">
                                        <span class="menu-item-card__name"><?php the_title(); ?></span>
                                        <?php if ( $price ) : ?>
                                            <span class="menu-item-card__price"><?php echo esc_html( $price ); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ( $desc ) : ?>
                                        <p class="menu-item-card__desc"><?php echo esc_html( $desc ); ?></p>
                                    <?php endif; ?>
                                    <?php if ( $note ) : ?>
                                        <p class="menu-item-card__note"><?php echo esc_html( $note ); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                        <?php wp_reset_postdata(); ?>
                    <?php else : ?>
                        <p style="text-align: center; padding: var(--space-xl) 0; color: #666;">
                            <?php esc_html_e( 'No items in this category right now.', 'jjbbq' ); ?>
                        </p>
                    <?php endif; ?>
                </div>
                <?php $first = false; ?>
            <?php endforeach; ?>

            <p class="menu-note">
                <?php esc_html_e( 'Menu varies by event. Follow us on Instagram for event-specific menus.', 'jjbbq' ); ?>
            </p>

        </div>
    </section>

</main>

<?php
get_footer();
