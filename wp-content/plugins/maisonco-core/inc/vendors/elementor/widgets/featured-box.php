<?php

namespace Elementor;
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor featured box widget.
 *
 * Elementor widget that displays an image, a headline and a text.
 *
 * @since 1.0.0
 */
class OSF_Widget_Featured_Box extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve featured box widget name.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'featured-box';
    }

    /**
     * Get widget title.
     *
     * Retrieve featured box widget title.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Featured Box', 'maisonco-core');
    }

    /**
     * Get widget icon.
     *
     * Retrieve featured box widget icon.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-image-box';
    }

    public function get_categories() {
        return ['opal-addons'];
    }

    /**
     * Register featured box widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_icon',
            [
                'label' => __('Featured Box', 'maisonco-core'),
            ]
        );

        $this->add_control(
            'selected_icon',
            [
                'label' => esc_html__( 'Icon', 'maisonco-core' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
            ]
        );
;

        $this->add_control(
            'title_text',
            [
                'label'       => __('Title', 'maisonco-core'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => __('This is the heading', 'maisonco-core'),
                'placeholder' => __('Enter your title', 'maisonco-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label'       => __('Description', 'maisonco-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => __('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'maisonco-core'),
                'placeholder' => __('Enter your description', 'maisonco-core'),
                'separator'   => 'none',
                'rows'        => 10,
            ]
        );

        $this->add_control(
            'link',
            [
                'label'       => __('Link to', 'maisonco-core'),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __('https://your-link.com', 'maisonco-core'),
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'title_size',
            [
                'label'   => __('Title HTML Tag', 'maisonco-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'h1'   => 'H1',
                    'h2'   => 'H2',
                    'h3'   => 'H3',
                    'h4'   => 'H4',
                    'h5'   => 'H5',
                    'h6'   => 'H6',
                    'div'  => 'div',
                    'span' => 'span',
                    'p'    => 'p',
                ],
                'default' => 'h3',
            ]
        );

        $this->add_control(
            'view',
            [
                'label'   => __('View', 'maisonco-core'),
                'type'    => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_wrapper',
            [
                'label' => __('Wrapper', 'maisonco-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_wrapper_style' );

        $this->start_controls_tab(
            'tab_wrapper_normal',
            [
                'label' => __( 'Normal', 'maisonco-core' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_wrapper',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .elementor-featured-box-wrapper',
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wrapper_box_shadow',
                'selector' => '{{WRAPPER}} .elementor-featured-box-wrapper',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_wrapper_hover',
            [
                'label' => __( 'Hover', 'maisonco-core' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_wrapper_hover',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .elementor-featured-box-wrapper:hover',
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wrapper_box_shadow_hover',
                'selector' => '{{WRAPPER}} .elementor-featured-box-wrapper:hover',
            ]
        );

        $this->add_control(
            'wrapper_transformation',
            [
                'label' => __( 'Hover Animation', 'maisonco-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => 'None',
                    'move-up' => 'Move Up',
                    'move-down' => 'Move Down',
                ],
                'default' => 'none',
                'prefix_class' => 'featured-box-wrapper-transform-',
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label'      => __( 'Padding', 'maisonco-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'height_wrapper',
            [
                'label'     => __( 'Height', 'maisonco-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_icon',
            [
                'label' => __('Icon', 'maisonco-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_responsive_control(
            'size_icon',
            [
                'label'     => __( 'Size', 'maisonco-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-top i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'spacing_icon',
            [
                'label'     => __( 'Spacing', 'maisonco-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-top i' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'height_icon',
            [
                'label'     => __( 'Height', 'maisonco-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-icon' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_view_icon_style');

        $this->start_controls_tab(
            'view_icon_button_normal',
            [
                'label' => __('Normal', 'maisonco-core'),
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label'     => __('Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-top i' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'view_icon_button_hover',
            [
                'label' => __('Hover', 'maisonco-core'),
            ]
        );
        $this->add_control(
            'icon_color_hover',
            [
                'label'     => __('Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper:hover .elementor-featured-box-top i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_content',
            [
                'label' => __('Content', 'maisonco-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_title',
            [
                'label'     => __('Title', 'maisonco-core'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .elementor-featured-box-title',
            ]
        );

        $this->add_responsive_control(
            'spacing_title',
            [
                'label'     => __( 'Spacing', 'maisonco-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-top' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->start_controls_tabs('tabs_view_title_style');

        $this->start_controls_tab(
            'view_title_button_normal',
            [
                'label' => __('Normal', 'maisonco-core'),
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => __('Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-title' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'view_title_button_hover',
            [
                'label' => __('Hover', 'maisonco-core'),
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label'     => __('Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper:hover .elementor-featured-box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'heading_description',
            [
                'label'     => __('Description', 'maisonco-core'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typography',
                'selector' => '{{WRAPPER}} .elementor-featured-box-description',
            ]
        );

        $this->start_controls_tabs('tabs_view_description_style');

        $this->start_controls_tab(
            'view_description_button_normal',
            [
                'label' => __('Normal', 'maisonco-core'),
            ]
        );
        $this->add_control(
            'description_color',
            [
                'label'     => __('Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'view_description_button_hover',
            [
                'label' => __('Hover', 'maisonco-core'),
            ]
        );
        $this->add_control(
            'description_color_hover',
            [
                'label'     => __('Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper:hover .elementor-featured-box-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('wrapper', 'class', 'elementor-featured-box-wrapper');

        $html = '<div '.$this->get_render_attribute_string("wrapper").'>';

        if ( ! empty( $settings['link']['url'] ) ) {
            $this->add_link_attributes( 'link', $settings['link'] );
        }

        //icon

        $html .= '<div class="elementor-featured-box-top">';
        $has_icon = ! empty( $settings['icon'] );
        if ( ! $has_icon && ! empty( $settings['selected_icon']['value'] ) ) {
            $has_icon = true;
        }
        if ( $has_icon  ) {
            $migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
            $is_new = ! isset( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

            $html .= '<div class="elementor-featured-box-icon">';

            if ( $is_new || $migrated ) {
                ob_start();
                Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']);
                $html .= ob_get_clean();
            } elseif ( ! empty( $settings['icon'] ) ) {
                $html .= '<i class="'.$settings['icon'].'" aria-hidden="true" ></i>';
            }


            $html .= '</div>';
        }

        if ( ! empty( $settings['title_text'] ) ) {
            $this->add_render_attribute( 'title_text', 'class', 'elementor-featured-box-title' );

            $title_html = $settings['title_text'];

            if ( ! empty( $settings['link']['url'] ) ) {
                $title_html = '<a ' . $this->get_render_attribute_string( 'link' ) . '>' . $title_html . '</a>';
            }

            $html .= sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['title_size'], $this->get_render_attribute_string( 'title_text' ), $title_html );
        }

        $html .= '</div>';

        //end icon


        $html .= '<div class="elementor-featured-box-bottom">';

        if ( ! empty( $settings['description_text'] ) ) {
            $this->add_render_attribute( 'description_text', 'class', 'elementor-featured-box-description' );

            $html .= sprintf( '<p %1$s>%2$s</p>', $this->get_render_attribute_string( 'description_text' ), $settings['description_text'] );
        }

        $html .= '</div>';

        $html .= '</div>';

        echo $html;
    }
}

$widgets_manager->register(new OSF_Widget_Featured_Box());
