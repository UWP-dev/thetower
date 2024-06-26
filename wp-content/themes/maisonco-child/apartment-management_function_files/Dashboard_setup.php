<?php
// Our custom post type function
function create_tower_post_type() {
    register_post_type( 'the_tower',
        array(
            'labels' => array(
                'name' => __( 'The Tower' ),
                'singular_name' => __( 'Tower Item' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'the-tower'),
            'show_in_rest' => true,
        )
    );

    // Taxonomies
    $taxonomy_labels = array(
        'tower_taxonomies' =>'Tower Taxonomies',
    );

    foreach ($taxonomy_labels as $taxonomy_slug => $taxonomy_label) {
        register_taxonomy(
            $taxonomy_slug,
            'the_tower',
            array(
                'label' => __($taxonomy_label),
                'rewrite' => array('slug' => $taxonomy_slug),
                'hierarchical' => true,
            )
        );
    }
}
// Hook into the admin menu to adjust submenu position
add_action('admin_menu', 'adjust_apartment_submenu_position');

function adjust_apartment_submenu_position() {
    global $submenu;

    // Parent menu slug
    $parent_slug = 'amgt-apartment_system';

    // Slug of the submenu page you want to move
    $submenu_slug = 'amgt-apartment-notice-event';

    // New position (3 in this case)
    $new_position = 1;

    // Retrieve the existing submenu items for the parent menu
    $parent_submenu = isset($submenu[$parent_slug]) ? $submenu[$parent_slug] : array();

    // Find the key of the submenu item you want to move
    $key = array_search($submenu_slug, array_column($parent_submenu, 2));

    // If the submenu item is found
    if ($key !== false) {
        // Remove the submenu item from its current position
        $submenu_item = $parent_submenu[$key];
        unset($parent_submenu[$key]);

        // Insert the submenu item at the new position
        array_splice($parent_submenu, $new_position - 1, 0, array($submenu_item));

        // Update the submenu with the new order
        $submenu[$parent_slug] = $parent_submenu;
    }
}

// Hooking up our function to theme setup
add_action( 'init', 'create_tower_post_type' );


add_action('admin_menu', 'move_notice_event_to_second_position');

function move_notice_event_to_second_position() {
    global $submenu;

    // Assuming 'amgt-apartment_system' is the parent menu slug
    // Find the submenu for 'amgt-apartment_system'
    if (isset($submenu['amgt-apartment_system'])) {
        $submenu_array = $submenu['amgt-apartment_system'];

        // Find the key of 'amgt-notice-event' submenu
        $key = array_search('amgt-notice-event', array_column($submenu_array, 2));

        // If the submenu is found, move it to the second position
        if ($key !== false) {
            $notice_event_submenu = $submenu_array[$key];
            unset($submenu_array[$key]);
            array_splice($submenu_array, 1, 0, array($notice_event_submenu)); // Insert at index 1 (second position)
            $submenu['amgt-apartment_system'] = $submenu_array;
        }
    }
}

// Modify the plugin's code directly
function add_custom_menu_page_to_amgt_apartment_system() {

   // add_submenu_page(
   //      'amgt-apartment_system', // Parent menu slug
   //      'Notice and Event',                     // Page title
   //      'Notice and Event',                     // Menu title
   //      'manage_options',                       // Capability required
   //      'apartment_notice_event',               // Menu slug
   //      'apartment_notice_event_callback',      // Callback function to render the page
   //      1                                       // Priority (adjusted from 5 to 3)
   //  );
     add_submenu_page(
        'amgt-apartment_system',        // Parent menu slug
        'Owner/Tenants Essentials',                        // Page title
        'Owner/Tenants Essentials',                        // Menu title
        'read',                         // Capability required (changed from 'manage_options')
        'amgt-apartment-ownwer_tenant',          // Menu slug
        'render_apartment_ownwer_tenant_page',   // Callback function to render the form
        2                               // Menu position
    );
    add_submenu_page(
        'amgt-apartment_system',        // Parent menu slug
        'Resident Forms',                        // Page title
        'Resident Forms',                        // Menu title
        'read',                         // Capability required (changed from 'manage_options')
        'amgt-apartment-form',          // Menu slug
        'render_apartment_form_page',   // Callback function to render the form
        3                               // Menu position
    );
    add_submenu_page(
        'amgt-apartment_system',        // Parent menu slug
        'Maintenance Services',                        // Page title
        'Maintenance Services',                        // Menu title
        'read',                         // Capability required (changed from 'manage_options')
        'amgt-apartment-maintenance-services',          // Menu slug
        'render_apartment_maintenance_services_page',   // Callback function to render the form
        4                               // Menu position
    );
    add_submenu_page(
        'amgt-apartment_system',        // Parent menu slug
        'Building Operations',                        // Page title
        'Building Operations',                        // Menu title
        'read',                         // Capability required (changed from 'manage_options')
        'amgt-apartment-building-operations',          // Menu slug
        'render_apartment_building_operations_page',   // Callback function to render the form
        4                              // Menu position
    );
 add_submenu_page(
        'amgt-apartment_system',        // Parent menu slug
        'Official Documents',                        // Page title
        'Official Documents',                        // Menu title
        'read',                         // Capability required (changed from 'manage_options')
        'amgt-apartment-official-documents',          // Menu slug
        'render_apartment_official_documents_page',   // Callback function to render the form
        6                              // Menu position
    );
 add_submenu_page(
        'amgt-apartment_system',        // Parent menu slug
        'Board of Directors',                        // Page title
        'Board of Directors',                        // Menu title
        'read',                         // Capability required (changed from 'manage_options')
        'amgt-apartment-board-of-directors',          // Menu slug
        'render_apartment_board_of_directors_page',   // Callback function to render the form
        7                              // Menu position
    );
add_submenu_page(
        'amgt-apartment_system',        // Parent menu slug
        'Announcements',                        // Page title
        'Announcements',                        // Menu title
        'read',                         // Capability required (changed from 'manage_options')
        'amgt-apartment-announcements',          // Menu slug
        'render_apartment_announcements_page',   // Callback function to render the form
        8                              // Menu position
    );
}


add_action('admin_menu', 'add_custom_menu_page_to_amgt_apartment_system');
// Function to add a custom dashboard widget
function add_custom_dashboard_widget() {
    wp_add_dashboard_widget(
        'custom_dashboard_widget',   // Widget ID
        'Resident Forms',                      // Widget title
        'render_custom_dashboard_widget' // Callback function to render the widget
    );
    wp_add_dashboard_widget(
        'custom_dashboard_widget1',   // Widget ID
        'Owner/Tenants Essentials',                      // Widget title
        'render_custom_dashboard_widget1' // Callback function to render the widget
    );
    wp_add_dashboard_widget(
        'custom_dashboard_widget2',   // Widget ID
        'Maintenance Services',                      // Widget title
        'render_custom_dashboard_widget2' // Callback function to render the widget
    );
    wp_add_dashboard_widget(
        'custom_dashboard_widget3',   // Widget ID
        'Buiding Operations',                      // Widget title
        'render_custom_dashboard_widget3 '// Callback function to render the widget
    );
     wp_add_dashboard_widget(
        'custom_dashboard_widget4',   // Widget ID
        'Official Documents',                      // Widget title
        'render_custom_dashboard_widget4 '// Callback function to render the widget
    );
     wp_add_dashboard_widget(
        'custom_dashboard_widget5',   // Widget ID
        'Board of Directors',                      // Widget title
        'render_custom_dashboard_widget5 '// Callback function to render the widget
    );
      wp_add_dashboard_widget(
        'custom_dashboard_widget6',   // Widget ID
        'Announcements',                      // Widget title
        'render_custom_dashboard_widget6 '// Callback function to render the widget
    );
}
add_action('wp_dashboard_setup', 'add_custom_dashboard_widget');

?>