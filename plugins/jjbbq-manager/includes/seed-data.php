<?php
/**
 * Seed data for initial site setup.
 *
 * @package JJBBQ
 */

/**
 * Render the seed data admin page (JJBBQ → Sample Data).
 */
function jjbbq_seed_page_render(): void {
    $seeded = get_option( 'jjbbq_seeded', false );
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'JJBBQ Sample Data', 'jjbbq' ); ?></h1>

        <?php if ( $seeded ) : ?>
            <div class="notice notice-success">
                <p><?php esc_html_e( 'Seed data has already been loaded.', 'jjbbq' ); ?></p>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <?php wp_nonce_field( 'jjbbq_seed_action', 'jjbbq_seed_nonce' ); ?>
            <p><?php esc_html_e( 'Click the button below to load sample events and menu items.', 'jjbbq' ); ?></p>
            <p>
                <input type="submit"
                       name="jjbbq_seed"
                       class="button button-primary"
                       value="<?php esc_attr_e( 'Load Seed Data', 'jjbbq' ); ?>"
                       <?php echo $seeded ? 'disabled' : ''; ?>>
            </p>
        </form>
    </div>
    <?php
}

/**
 * Handle the seed data form submission.
 */
function jjbbq_handle_seed_action(): void {
    if ( ! isset( $_POST['jjbbq_seed'] ) ) {
        return;
    }
    if ( ! check_admin_referer( 'jjbbq_seed_action', 'jjbbq_seed_nonce' ) ) {
        return;
    }
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    jjbbq_seed_data();

    add_action( 'admin_notices', function (): void {
        echo '<div class="notice notice-success is-dismissible"><p>';
        esc_html_e( 'Seed data loaded successfully!', 'jjbbq' );
        echo '</p></div>';
    } );
}
add_action( 'admin_init', 'jjbbq_handle_seed_action' );

/**
 * Create seed data — events and menu items.
 */
function jjbbq_seed_data(): void {
    if ( get_option( 'jjbbq_seeded' ) ) {
        return;
    }

    $events = [
        [
            'title'   => 'Dirty Birds — December 2024',
            'date'    => '20241223',
            'venue'   => 'Dirty Birds',
            'address' => '1722 St. Mary\'s Ave, Omaha',
            'status'  => 'past',
            'time'    => '',
            'partner' => '',
        ],
        [
            'title'   => 'Dirty Birds — July 2025',
            'date'    => '20250707',
            'venue'   => 'Dirty Birds',
            'address' => '1722 St. Marys Ave, Omaha',
            'status'  => 'past',
            'time'    => '',
            'partner' => '',
        ],
        [
            'title'   => 'Jukes Ale Works — August 2025',
            'date'    => '20250825',
            'venue'   => 'Jukes Ale Works',
            'address' => '20560 Elkhorn Dr, Elkhorn NE',
            'status'  => 'past',
            'time'    => '',
            'partner' => '',
        ],
        [
            'title'   => 'Jukes Ale Works — September 2025',
            'date'    => '20250929',
            'venue'   => 'Jukes Ale Works',
            'address' => '20560 Elkhorn Dr, Elkhorn NE',
            'status'  => 'past',
            'time'    => '',
            'partner' => '',
        ],
        [
            'title'   => 'Barry O\'s Tavern — November 2025',
            'date'    => '20251116',
            'venue'   => 'Barry O\'s Tavern',
            'address' => '',
            'status'  => 'past',
            'time'    => '',
            'partner' => '',
        ],
        [
            'title'   => 'Jukes Ale Works — March 2026',
            'date'    => '20260324',
            'venue'   => 'Jukes Ale Works',
            'address' => '20560 Elkhorn Dr, Elkhorn NE',
            'status'  => 'upcoming',
            'time'    => '11am until sell-out',
            'partner' => '',
        ],
    ];

    foreach ( $events as $event ) {
        $post_id = wp_insert_post( [
            'post_type'   => 'jjbbq_event',
            'post_title'  => $event['title'],
            'post_status' => 'publish',
        ] );

        if ( ! is_wp_error( $post_id ) ) {
            update_field( 'event_date', $event['date'], $post_id );
            update_field( 'event_venue', $event['venue'], $post_id );
            update_field( 'event_address', $event['address'], $post_id );
            update_field( 'event_status', $event['status'], $post_id );
            update_field( 'event_time', $event['time'], $post_id );
            update_field( 'event_partner', $event['partner'], $post_id );
        }
    }

    $menu_items = [
        [ 'title' => 'Sliced Brisket Plate',      'cat' => 'core',      'price' => '$22–$24', 'desc' => '',                                                          'note' => '' ],
        [ 'title' => 'Pork Ribs — Full Rack',      'cat' => 'core',      'price' => '$28',     'desc' => '',                                                          'note' => '' ],
        [ 'title' => 'Pork Ribs — Half Rack',      'cat' => 'core',      'price' => '$17–$18', 'desc' => '',                                                          'note' => '' ],
        [ 'title' => 'Pulled Pork Sandwich',        'cat' => 'core',      'price' => '$14',     'desc' => '',                                                          'note' => '' ],
        [ 'title' => 'Smoked Chicken Thigh (2 pc)', 'cat' => 'core',      'price' => '$15',     'desc' => '',                                                          'note' => '' ],
        [ 'title' => 'Brisket Blanket Rolls',       'cat' => 'core',      'price' => '$8',      'desc' => '',                                                          'note' => 'no sides' ],
        [ 'title' => 'Brisket Sandwich',             'cat' => 'specialty', 'price' => '',        'desc' => 'Sliced brisket, provolone, 2 onion rings, BBQ sauce',       'note' => '' ],
        [ 'title' => 'The Old Man',                  'cat' => 'specialty', 'price' => '',        'desc' => 'Deli pork, horsey sauce, onion jam, swiss, chicharrones',   'note' => '' ],
        [ 'title' => 'Pork Belly Cheesesteak',      'cat' => 'specialty', 'price' => '',        'desc' => 'Onion, green pepper, fried jalapeños, white american cheese','note' => '' ],
        [ 'title' => 'Peach Habanero Slaw',         'cat' => 'sides',     'price' => '',        'desc' => '',                                                          'note' => '' ],
        [ 'title' => 'Smoked Pork Potato Salad',    'cat' => 'sides',     'price' => '',        'desc' => '',                                                          'note' => '' ],
        [ 'title' => 'Deviled Egg',                  'cat' => 'sides',     'price' => '',        'desc' => '',                                                          'note' => '' ],
    ];

    foreach ( $menu_items as $item ) {
        $post_id = wp_insert_post( [
            'post_type'   => 'jjbbq_menu_item',
            'post_title'  => $item['title'],
            'post_status' => 'publish',
        ] );

        if ( ! is_wp_error( $post_id ) ) {
            update_field( 'menu_category', $item['cat'], $post_id );
            update_field( 'menu_price', $item['price'], $post_id );
            update_field( 'menu_description', $item['desc'], $post_id );
            update_field( 'menu_available', 1, $post_id );
            update_field( 'menu_note', $item['note'], $post_id );
        }
    }

    update_option( 'jjbbq_seeded', true );
}
