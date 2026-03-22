<?php
/**
 * Custom admin list columns for CPTs.
 *
 * @package JJBBQ
 */

// ── Event Columns ──

function jjbbq_event_columns( array $columns ): array {
    $new = [];
    foreach ( $columns as $key => $label ) {
        $new[ $key ] = $label;
        if ( $key === 'title' ) {
            $new['event_date']   = __( 'Date', 'jjbbq' );
            $new['event_venue']  = __( 'Venue', 'jjbbq' );
            $new['event_status'] = __( 'Status', 'jjbbq' );
        }
    }
    unset( $new['date'] );
    return $new;
}
add_filter( 'manage_jjbbq_event_posts_columns', 'jjbbq_event_columns' );

function jjbbq_event_column_content( string $column, int $post_id ): void {
    switch ( $column ) {
        case 'event_date':
            $raw = get_field( 'event_date', $post_id );
            echo $raw ? esc_html( date_i18n( 'M j, Y', strtotime( $raw ) ) ) : '—';
            break;
        case 'event_venue':
            echo esc_html( get_field( 'event_venue', $post_id ) ?: '—' );
            break;
        case 'event_status':
            $status = get_field( 'event_status', $post_id ) ?: 'upcoming';
            $labels = [
                'upcoming' => __( 'Upcoming', 'jjbbq' ),
                'past'     => __( 'Past', 'jjbbq' ),
                'sold-out' => __( 'Sold Out', 'jjbbq' ),
            ];
            $class = 'jjbbq-status jjbbq-status--' . $status;
            echo '<span class="' . esc_attr( $class ) . '">' . esc_html( $labels[ $status ] ?? $status ) . '</span>';
            break;
    }
}
add_action( 'manage_jjbbq_event_posts_custom_column', 'jjbbq_event_column_content', 10, 2 );

function jjbbq_event_sortable_columns( array $columns ): array {
    $columns['event_date'] = 'event_date';
    return $columns;
}
add_filter( 'manage_edit-jjbbq_event_sortable_columns', 'jjbbq_event_sortable_columns' );

function jjbbq_event_orderby( WP_Query $query ): void {
    if ( ! is_admin() || ! $query->is_main_query() ) {
        return;
    }
    if ( $query->get( 'orderby' ) === 'event_date' ) {
        $query->set( 'meta_key', 'event_date' );
        $query->set( 'orderby', 'meta_value' );
    }
}
add_action( 'pre_get_posts', 'jjbbq_event_orderby' );

// ── Menu Item Columns ──

function jjbbq_menu_item_columns( array $columns ): array {
    $new = [];
    foreach ( $columns as $key => $label ) {
        $new[ $key ] = $label;
        if ( $key === 'title' ) {
            $new['menu_category']  = __( 'Category', 'jjbbq' );
            $new['menu_price']     = __( 'Price', 'jjbbq' );
            $new['menu_available'] = __( 'Visible', 'jjbbq' );
        }
    }
    unset( $new['date'] );
    return $new;
}
add_filter( 'manage_jjbbq_menu_item_posts_columns', 'jjbbq_menu_item_columns' );

function jjbbq_menu_item_column_content( string $column, int $post_id ): void {
    switch ( $column ) {
        case 'menu_category':
            $cat    = get_field( 'menu_category', $post_id ) ?: '';
            $labels = [
                'core'      => __( 'Core Menu', 'jjbbq' ),
                'specialty' => __( 'Specialty Items', 'jjbbq' ),
                'sides'     => __( 'Sides', 'jjbbq' ),
                'collab'    => __( 'Collaborations', 'jjbbq' ),
            ];
            echo esc_html( $labels[ $cat ] ?? $cat );
            break;
        case 'menu_price':
            echo esc_html( get_field( 'menu_price', $post_id ) ?: '—' );
            break;
        case 'menu_available':
            $available = get_field( 'menu_available', $post_id );
            echo $available ? '<span class="dashicons dashicons-yes-alt" style="color: green;"></span>' : '<span class="dashicons dashicons-dismiss" style="color: #999;"></span>';
            break;
    }
}
add_action( 'manage_jjbbq_menu_item_posts_custom_column', 'jjbbq_menu_item_column_content', 10, 2 );
