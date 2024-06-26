<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'opal-boostrap','maisonco-style','maisonco-style','maisonco-opal-icon','maisonco-carousel' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 100 );

function enqueue_admin_scripts() {
    // Enqueue jQuery from the CDN
    // wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.7.0.js', array(), '3.7.0', false);

    // Enqueue DataTables JavaScript from the CDN
    wp_enqueue_script('datatables', 'https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js', array('jquery'), '1.13.7', false);

    // Enqueue DataTables CSS from the CDN
    wp_enqueue_style('datatables-style', 'https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css', array(), '1.13.7', 'all');

    $child_theme_base_url = get_stylesheet_directory_uri();
    wp_register_script('myownscript', $child_theme_base_url . '/my_custom.js', array('jquery'), '1.0', true);
    wp_enqueue_script('myownscript');
    wp_register_style('my_custom_style', $child_theme_base_url . '/my_custom.css', array(), '1.0', 'all');

// Enqueue style
wp_enqueue_style('my_custom_style');
}

add_action('admin_enqueue_scripts', 'enqueue_admin_scripts');



// END ENQUEUE PARENT ACTION


/**
 * Filter password reset request email's body.
 *
 * @param string $message
 * @param string $key
 * @param string $user_login
 * @return string
 */
function wpdocs_retrieve_password_message( $message, $key, $user_login ) {
	$site_name  = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
	$reset_link = network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' );

	// Create new message
	$message = '<p>' . __( 'Hi '. $user_login, 'text_domain' ) . "</p>";
	
	$message .= '<p>' . __( 'This notice confirms that your password was changed on The Towers at Harbor Court Condominium:', 'text_domain' ) . "</p>";
	
	
	$message .= '<p>' . sprintf( __( 'Username: %s', 'text_domain' ), $user_login ) . "</p>";
	$message .= '<p>' . __( 'If this was a mistake, just ignore this email and nothing will happen.', 'text_domain' ) . "</p>";
	$message .= '<p>' . __( 'To reset your password, visit the following address:', 'text_domain' ) . "</p>";
	$message .= '<p><a href="'.$reset_link.'" target="_blank" >' . $reset_link . "<a></p>";
	$message .= '<p>' . __( 'Regards ,', 'text_domain' ) . "</p>";
	$message .= '<p>' . __( 'All at The Towers at Harbor Court Condominium', 'text_domain' ) . "</p>";
	$message .= '<p>' . __( 'https://www.thetowersatharborcourt.com', 'text_domain' ) . "</p>";
	

	return $message;
}

add_filter( 'retrieve_password_message', 'wpdocs_retrieve_password_message', 20, 3 );

$theme_includes = array(
    'apartment-management_function_files/Dashboard_setup.php',
    'apartment-management_function_files/Render_form_page.php',
    'apartment-management_function_files/Render_Owner_tanents_page.php',
    'apartment-management_function_files/Render_maintenance_services_page.php',
    'apartment-management_function_files/Render_building_operations_page.php',
    'apartment-management_function_files/Render_official_documents_page.php',
    'apartment-management_function_files/Render_board_of_directors_page.php',
    'apartment-management_function_files/Render_announcements_page.php',
    'apartment-management_function_files/Shortcode_page.php'
);

foreach ($theme_includes as $file) {
    if (!$filepath = locate_template($file)) {
        trigger_error(sprintf(__('Error locating %s for inclusion', 'maisonco_child'), $file), E_USER_ERROR);
    }

    require_once $filepath;
}

add_filter( 'login_redirect', 'custom_login_redirect', 10, 3 );
function custom_login_redirect( $redirect_to, $request, $user ) {
    
    $redirect_to = site_url() . '/user-dashboard/';
    return $redirect_to;

}

/**
 * Change "Dashboard" link
 */
add_action( 'wp_footer', function(){
    ?>
    <script>
        jQuery('div.change_redirection a:first').attr('href', 'https://www.thetowersatharborcourt.com/user-dashboard/?apartment-dashboard=user');
    </script>
    <?php
} );
