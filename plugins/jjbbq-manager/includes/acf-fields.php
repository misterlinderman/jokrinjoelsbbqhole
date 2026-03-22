<?php
/**
 * Register ACF field groups programmatically.
 *
 * @package JJBBQ
 */

function jjbbq_register_acf_fields(): void {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    // Field Group: Pop-Up Event Details
    acf_add_local_field_group( [
        'key'      => 'group_jjbbq_event',
        'title'    => __( 'Pop-Up Event Details', 'jjbbq' ),
        'fields'   => [
            [
                'key'            => 'field_event_date',
                'label'          => __( 'Event Date', 'jjbbq' ),
                'name'           => 'event_date',
                'type'           => 'date_picker',
                'required'       => 1,
                'display_format' => 'F j, Y',
                'return_format'  => 'Ymd',
                'first_day'      => 0,
            ],
            [
                'key'         => 'field_event_time',
                'label'       => __( 'Event Time', 'jjbbq' ),
                'name'        => 'event_time',
                'type'        => 'text',
                'placeholder' => 'e.g., 11am until sell-out',
            ],
            [
                'key'      => 'field_event_venue',
                'label'    => __( 'Venue', 'jjbbq' ),
                'name'     => 'event_venue',
                'type'     => 'text',
                'required' => 1,
            ],
            [
                'key'   => 'field_event_address',
                'label' => __( 'Address', 'jjbbq' ),
                'name'  => 'event_address',
                'type'  => 'text',
            ],
            [
                'key'           => 'field_event_status',
                'label'         => __( 'Status', 'jjbbq' ),
                'name'          => 'event_status',
                'type'          => 'select',
                'choices'       => [
                    'upcoming' => __( 'Upcoming', 'jjbbq' ),
                    'past'     => __( 'Past', 'jjbbq' ),
                    'sold-out' => __( 'Sold Out', 'jjbbq' ),
                ],
                'default_value' => 'upcoming',
            ],
            [
                'key'          => 'field_event_partner',
                'label'        => __( 'Collaboration Partner', 'jjbbq' ),
                'name'         => 'event_partner',
                'type'         => 'text',
                'instructions' => __( 'Optional — e.g., Julia\'s Tamales', 'jjbbq' ),
            ],
            [
                'key'           => 'field_event_flyer',
                'label'         => __( 'Event Flyer (optional)', 'jjbbq' ),
                'name'          => 'event_flyer',
                'type'          => 'image',
                'return_format' => 'id',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'jjbbq_event',
                ],
            ],
        ],
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
    ] );

    // Field Group: Menu Item Details
    acf_add_local_field_group( [
        'key'      => 'group_jjbbq_menu_item',
        'title'    => __( 'Menu Item Details', 'jjbbq' ),
        'fields'   => [
            [
                'key'     => 'field_menu_category',
                'label'   => __( 'Category', 'jjbbq' ),
                'name'    => 'menu_category',
                'type'    => 'select',
                'choices' => [
                    'core'      => __( 'Core Menu', 'jjbbq' ),
                    'specialty' => __( 'Specialty Items', 'jjbbq' ),
                    'sides'     => __( 'Sides', 'jjbbq' ),
                    'collab'    => __( 'Collaborations', 'jjbbq' ),
                ],
            ],
            [
                'key'         => 'field_menu_price',
                'label'       => __( 'Price', 'jjbbq' ),
                'name'        => 'menu_price',
                'type'        => 'text',
                'placeholder' => 'e.g., $14 or $22–$24',
            ],
            [
                'key'  => 'field_menu_description',
                'label' => __( 'Description', 'jjbbq' ),
                'name' => 'menu_description',
                'type' => 'textarea',
                'rows' => 3,
            ],
            [
                'key'           => 'field_menu_available',
                'label'         => __( 'Availability', 'jjbbq' ),
                'name'          => 'menu_available',
                'type'          => 'true_false',
                'default_value' => 1,
                'message'       => __( 'Show on website menu', 'jjbbq' ),
            ],
            [
                'key'         => 'field_menu_note',
                'label'       => __( 'Note', 'jjbbq' ),
                'name'        => 'menu_note',
                'type'        => 'text',
                'placeholder' => 'e.g., served with 2 sides',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'jjbbq_menu_item',
                ],
            ],
        ],
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
    ] );
}
add_action( 'acf/init', 'jjbbq_register_acf_fields' );
