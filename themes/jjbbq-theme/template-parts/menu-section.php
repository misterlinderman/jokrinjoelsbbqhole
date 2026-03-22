<?php
/**
 * Template part: Homepage menu preview.
 *
 * @package JJBBQ
 */

$menu_query = function_exists( 'jjbbq_get_menu_items' ) ? jjbbq_get_menu_items( 'core' ) : null;
?>

<section class="menu-preview" aria-label="<?php esc_attr_e( 'Menu Preview', 'jjbbq' ); ?>">
    <div class="container">
        <h2><?php esc_html_e( "What's on the Truck", 'jjbbq' ); ?></h2>

        <?php if ( $menu_query && $menu_query->have_posts() ) : ?>
            <div class="grid-3">
                <?php
                $count = 0;
                while ( $menu_query->have_posts() && $count < 6 ) :
                    $menu_query->the_post();
                    $count++;
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
            <p style="text-align: center;"><?php esc_html_e( 'Menu coming soon.', 'jjbbq' ); ?></p>
        <?php endif; ?>

        <div class="menu-preview__cta">
            <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="btn-primary">
                <?php esc_html_e( 'Full Menu', 'jjbbq' ); ?>
            </a>
        </div>
    </div>
</section>
