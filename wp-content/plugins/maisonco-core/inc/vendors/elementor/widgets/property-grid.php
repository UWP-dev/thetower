<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class OSF_Elementor_Property_Grid extends Elementor\Widget_Base {


    public function get_name() {
        return 'opal-property';
    }

    public function get_title() {
        return __('Opal Property', 'maisonco-core');
    }

    /**
     * Get widget icon.
     *
     * Retrieve testimonial widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return array('opal-addons');
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_query',
            [
                'label' => __('Query', 'maisonco-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label'   => __('Posts Per Page', 'maisonco-core'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => __('Order By', 'maisonco-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'post_date',
                'options' => [
                    'post_date'  => __('Date', 'maisonco-core'),
                    'post_title' => __('Title', 'maisonco-core'),
                    'menu_order' => __('Menu Order', 'maisonco-core'),
                    'rand'       => __('Random', 'maisonco-core'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => __('Order', 'maisonco-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc'  => __('ASC', 'maisonco-core'),
                    'desc' => __('DESC', 'maisonco-core'),
                ],
            ]
        );

        $this->add_control(
            'categories',
            [
                'label'    => __('Categories', 'maisonco-core'),
                'type'     => Controls_Manager::SELECT2,
                'options'  => $this->get_post_categories(),
                'multiple' => true,
            ]
        );

        $this->add_control(
            'cat_operator',
            [
                'label'     => __('Category Operator', 'maisonco-core'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'IN',
                'options'   => [
                    'AND'    => __('AND', 'maisonco-core'),
                    'IN'     => __('IN', 'maisonco-core'),
                    'NOT IN' => __('NOT IN', 'maisonco-core'),
                ],
                'condition' => [
                    'categories!' => ''
                ],
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label'   => __('Columns', 'maisonco-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 3,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4],
            ]
        );

        $this->add_responsive_control(
            'gutter',
            [
                'label'      => __('Gutter', 'maisonco-core'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 60,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .column-item' => 'padding-left: calc({{SIZE}}{{UNIT}} / 2); padding-right: calc({{SIZE}}{{UNIT}} / 2); margin-bottom: calc({{SIZE}}{{UNIT}})',
                    '{{WRAPPER}} .row'         => 'margin-left: calc({{SIZE}}{{UNIT}} / -2); margin-right: calc({{SIZE}}{{UNIT}} / -2);',
                ],
            ]
        );

        $this->add_control(
            'style',
            [
                'label'   => __('Style', 'maisonco-core'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''  => __('Default', 'maisonco-core'),
                    '2' => __('Style 2', 'maisonco-core'),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function get_post_categories() {
        $categories = get_terms(array(
                'taxonomy'   => 'osf_property_category',
                'hide_empty' => false,
            )
        );
        $results    = array();
        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                $results[$category->slug] = $category->name;
            }
        }
        return $results;
    }


    public static function get_query_args($settings) {
        $query_args = [
            'post_type'           => 'osf_property',
            'orderby'             => $settings['orderby'],
            'order'               => $settings['order'],
            'ignore_sticky_posts' => 1,
            'post_status'         => 'publish', // Hide drafts/private posts for admins
        ];

        if (!empty($settings['categories'])) {

            if ($settings['cat_operator'] == 'NOT IN') {
                foreach ($settings['categories'] as $category) {
                    $cat = get_term_by('slug', $category, 'osf_property_category');
                    if (!is_wp_error($cat) && is_object($cat)) {
                        $query_args['tax_query'][]
                            = [
                            'taxonomy' => 'osf_property_category',
                            'field'    => 'slug',
                            'terms'    => $cat,
                            'operator' => 'NOT IN'
                        ];
                    }
                }
            } else {
                foreach ($settings['categories'] as $category) {
                    $cat = get_term_by('slug', $category, 'osf_property_category');
                    if (!is_wp_error($cat) && is_object($cat)) {
                        $query_args['tax_query'][]
                            = [
                            'taxonomy' => 'osf_property_category',
                            'field'    => 'slug',
                            'terms'    => $cat,
                        ];
                    }
                }
            }

            if ($settings['cat_operator'] == 'AND') {
                $query_args['tax_query']['relation'] = 'AND';
            }
            if ($settings['cat_operator'] == 'IN') {
                $query_args['tax_query']['relation'] = 'OR';
            }
        }

        $query_args['posts_per_page'] = $settings['posts_per_page'];

        if (is_front_page()) {
            $query_args['paged'] = (get_query_var('page')) ? get_query_var('page') : 1;
        } else {
            $query_args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }

        return $query_args;
    }

    public function query_posts() {
        $query_args = $this->get_query_args($this->get_settings());
        return new WP_Query($query_args);
    }


    protected function render() {
        $settings = $this->get_settings_for_display();

        $query = $this->query_posts();

        if (!$query->found_posts) {
            return;
        }

        $this->add_render_attribute('wrapper', 'class', 'elementor-property-wrapper');
        $this->add_render_attribute('row', 'class', 'row');

        if (!empty($settings['column'])) {
            $this->add_render_attribute('row', 'data-elementor-columns', $settings['column']);
        }

        if (!empty($settings['column_tablet'])) {
            $this->add_render_attribute('row', 'data-elementor-columns-tablet', $settings['column_tablet']);
        }
        if (!empty($settings['column_mobile'])) {
            $this->add_render_attribute('row', 'data-elementor-columns-mobile', $settings['column_mobile']);
        }
        $style = $settings['style'] ? $settings['style'] : '';
        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <div <?php echo $this->get_render_attribute_string('row') ?>>
                <?php

                while ($query->have_posts()) {
                    $query->the_post();
                    get_template_part('template-parts/property/content-property', $style);
                }
                ?>
            </div>
        </div>
        <?php
        wp_reset_postdata();
    }
}

$widgets_manager->register(new OSF_Elementor_Property_Grid());