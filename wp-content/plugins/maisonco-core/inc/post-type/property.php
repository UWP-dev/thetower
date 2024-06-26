<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class OSF_Custom_Post_Type_Property extends OSF_Custom_Post_Type_Abstract {
    public $post_type = 'osf_property';
    public $taxonomy = 'osf_property_category';
    static $instance;

    public static function getInstance() {
        if (!isset(self::$instance) && !(self::$instance instanceof OSF_Custom_Post_Type_Property)) {
            self::$instance = new OSF_Custom_Post_Type_Property();
        }

        return self::$instance;
    }

    public function create_post_type() {

        $labels = array(
            'name'               => __('Apartments', 'maisonco-core'),
            'singular_name'      => __('Apartment', 'maisonco-core'),
            'add_new'            => __('Add Apartment', 'maisonco-core'),
            'add_new_item'       => __('Add New Apartment', 'maisonco-core'),
            'edit_item'          => __('Edit Apartment', 'maisonco-core'),
            'new_item'           => __('New Apartment', 'maisonco-core'),
            'all_items'          => __('All Apartments', 'maisonco-core'),
            'view_item'          => __('View Apartment', 'maisonco-core'),
            'search_items'       => __('Search Apartments', 'maisonco-core'),
            'not_found'          => __('No Apartment found', 'maisonco-core'),
            'not_found_in_trash' => __('No Apartment found in Trash', 'maisonco-core'),
            'menu_name'          => __('Apartments', 'maisonco-core'),
        );

        $labels = apply_filters('osf_postype_property_labels', $labels);
        $slug_field = osf_get_option('property_settings', 'slug_property', 'apartment');
        $slug = isset($slug_field) ? $slug_field : "apartment";
        register_post_type($this->post_type,
            array(
                'labels'        => $labels,
                'supports'      => array('title', 'editor', 'excerpt', 'thumbnail'),
                'public'        => true,
                'has_archive'   => true,
                'rewrite'       => array('slug' => apply_filters('osf_custom_post_type_propery_slug', $slug)),
                'menu_position' => 5,
                'categories'    => array(),
            )
        );
    }


    /**
     * @return void
     */
    public function create_taxonomy() {
        $labels = array(
            'name'              => __('Categories', "maisonco-core"),
            'singular_name'     => __('Category', "maisonco-core"),
            'search_items'      => __('Search Category', "maisonco-core"),
            'all_items'         => __('All Categories', "maisonco-core"),
            'parent_item'       => __('Parent Category', "maisonco-core"),
            'parent_item_colon' => __('Parent Category:', "maisonco-core"),
            'edit_item'         => __('Edit Category', "maisonco-core"),
            'update_item'       => __('Update Category', "maisonco-core"),
            'add_new_item'      => __('Add New Category', "maisonco-core"),
            'new_item_name'     => __('New Category Name', "maisonco-core"),
            'menu_name'         => __('Categories', "maisonco-core"),
        );
        $slug_cat_field = osf_get_option('property_settings', 'slug_category_property', 'category-apartment');
        $slug_cat = isset($slug_cat_field) ? $slug_cat_field : "category-apartment";
        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'show_in_nav_menus' => false,
            'rewrite'           => array('slug' => apply_filters('osf_custom_post_type_propery_cat_slug', $slug_cat))
        );
        // Now register the taxonomy
        register_taxonomy($this->taxonomy, array($this->post_type), $args);
    }

    /**
     *
     */


    public static function getPropertyQuery($args = array()) {
        $default = array(
            'post_type' => 'osf_property',
        );

        $args = array_merge($default, $args);

        return new WP_Query($args);
    }

    public static function getPropertyId($post_id = 0) {
        $post_ids = array();
        $array = array(
            'post__not_in' => array($post_id),
        );
        $sevices = self::getPropertyQuery($array);
        while ($sevices->have_posts()) {
            $sevices->the_post();
            $post_ids[] = get_the_ID();
        }
        wp_reset_postdata();

        return $post_ids;
    }

    public static function get_property_by_term_id($term_id, $per_page = -1) {
        wp_reset_query();
        $args = array();
        if ($term_id == 0 || empty($term_id)) {
            $args = array(
                'posts_per_page' => $per_page,
                'post_type'      => "osf_property",
            );
        } else {
            $args = array(
                'posts_per_page' => $per_page,
                'post_type'      => "osf_property",
                'tax_query'      => array(
                    array(
                        'taxonomy' => "osf_property_category",
                        'field'    => 'term_id',
                        'terms'    => $term_id,
                        'operator' => 'IN'
                    )
                )
            );
        }

        return new WP_Query($args);
    }

    public static function get_property($per_page = -1) {
        wp_reset_query();
        $args = array(
            'posts_per_page' => $per_page,
            'post_type'      => "osf_property",
        );

        return new WP_Query($args);
    }

    /**
     *
     * @param $post is name post type
     * @param taxonomy  is name taxonomy
     */
    public static function get_the_term_filter_name($post, $taxonomy_name) {
        $terms = wp_get_post_terms($post->ID, $taxonomy_name, array("fields" => "names"));

        return $terms;
    }

    /**
     * Get All Categories
     *
     * @param $args
     */
    public static function getCategorypropertys($per_page = 0) {
        $args = array(
            'hide_empty' => false,
            'orderby'    => 'name',
            'order'      => 'ASC',
            'number'     => $per_page,
        );
        $terms = get_terms('osf_property_category', $args);

        return $terms;
    }

    /**
     * @param $term_id is term_id in taxonomy
     * @param $post_id is id post type
     */
    public static function check_active_category_by_post_id($term_id, $post_id) {
        $termid = array();
        $terms = wp_get_post_terms($post_id, 'osf_property_category');
        foreach ($terms as $term) {
            $termid[] = $term->term_id;
        }
        if (in_array($term_id, $termid)) {
            return true;
        }

        return false;
    }

    public function widgets_init() {
        register_sidebar(array(
            'name'          => esc_html__('Property Sidebar', 'maisonco-core'),
            'id'            => 'sidebar-property',
            'description'   => esc_html__('Add widgets here to appear in your Property.', 'maisonco-core'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ));
    }

    public function set_sidebar($name) {
        if (is_singular('osf_property') && is_active_sidebar('sidebar-property')) {
            $name = 'sidebar-property';
        }
        return $name;
    }

    public function body_class($classes) {
        if (is_post_type_archive($this->post_type) || is_tax($this->taxonomy)) {
            if (in_array('opal-content-layout-2cr', $classes)) {
                $key = array_search('opal-content-layout-2cr', $classes);
                $classes[$key] = 'opal-content-layout-1c';
            }
        }
        if (is_singular($this->post_type) && is_active_sidebar('sidebar-property')) {
            $classes[] = 'opal-content-layout-2cr';
        }

        return $classes;
    }

    public function create_meta_box() {
        $prefix = 'osf_';
        $cmb2 = new_cmb2_box(array(
            'id'           => $prefix . 'apartment_setting',
            'title'        => __('Apartment', 'maisonco-core'),
            'object_types' => array('osf_property'),
        ));

        $cmb2->add_field(array(
            'name' => __('Gallery','maisonco-core'),
            'id'   => $prefix . 'apartment_gallery',
            'type' => 'file_list',
        ));

        $cmb2->add_field( array(
            'name' => __( 'Bedrooms', 'maisonco-core' ),
            'id'   => $prefix . 'bedrooms',
            'type' => 'text',
        ) );

        $cmb2->add_field( array(
            'name' => __( 'Bathroom', 'maisonco-core' ),
            'id'   => $prefix . 'bathroom',
            'type' => 'text',
        ) );

        $cmb2->add_field( array(
            'name' => __( 'Floor', 'maisonco-core' ),
            'id'   => $prefix . 'floor',
            'type' => 'text',
        ) );

    }

}// end class
OSF_Custom_Post_Type_Property::getInstance();

function get_archive_property_posts($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('osf_property')) {
        $query->set('posts_per_page', '12');
    }
}

add_action('pre_get_posts', 'get_archive_property_posts');