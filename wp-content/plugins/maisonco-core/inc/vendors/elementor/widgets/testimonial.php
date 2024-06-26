<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Group_Control_Css_Filter;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

class OSF_Elementor_Testimonials extends OSF_Elementor_Carousel_Base {

    /**
     * Get widget name.
     *
     * Retrieve testimonial widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'opal-testimonials';
    }

    /**
     * Get widget title.
     *
     * Retrieve testimonial widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title() {
        return __('Opal Testimonials', 'maisonco-core');
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
        return 'eicon-testimonial';
    }

    public function get_categories() {
        return array('opal-addons');
    }

    /**
     * Register testimonial widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_testimonial',
            [
                'label' => __('Testimonials', 'maisonco-core'),
            ]
        );

        $reapeter = new \Elementor\Repeater();

        $reapeter->add_control('testimonial_title', [
            'label'   => __('Title', 'maisonco-core'),
            'default' => 'Testimonial',
            'type'    => Controls_Manager::TEXT,
        ]);

        $reapeter->add_control('testimonial_content', [
            'label'       => __('Content', 'maisonco-core'),
            'type'        => Controls_Manager::TEXTAREA,
            'default'     => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
            'label_block' => true,
            'rows'        => '10',
        ]);

        $reapeter->add_control('testimonial_image', [
            'label'      => __('Choose Image', 'maisonco-core'),
            'default'    => [
                'url' => Utils::get_placeholder_image_src(),
            ],
            'type'       => Controls_Manager::MEDIA,
            'show_label' => false,
        ]);

        $reapeter->add_control('testimonial_name', [
            'label'   => __('Name', 'maisonco-core'),
            'default' => 'John Doe',
            'type'    => Controls_Manager::TEXT,
        ]);

        $reapeter->add_control('testimonial_job', [
            'label'   => __('Job', 'maisonco-core'),
            'default' => 'Designer',
            'type'    => Controls_Manager::TEXT,
        ]);

        $reapeter->add_control('testimonial_link', [
            'label'       => __('Link to', 'maisonco-core'),
            'placeholder' => __('https://your-link.com', 'maisonco-core'),
            'type'        => Controls_Manager::URL,
        ]);

        $this->add_control(
            'testimonials',
            [
                'label'       => __('Testimonials Item', 'maisonco-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $reapeter->get_controls(),
                'title_field' => '{{{ testimonial_name }}}',
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'testimonial_image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `testimonial_image_size` and `testimonial_image_custom_dimension`.
                'default'   => 'full',
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'testimonial_alignment',
            [
                'label'       => __('Alignment', 'maisonco-core'),
                'type'        => Controls_Manager::CHOOSE,
                'default'     => 'center',
                'options'     => [
                    'left'   => [
                        'title' => __('Left', 'maisonco-core'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'maisonco-core'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'maisonco-core'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'label_block' => false,
                //                'prefix_class' => 'elementor-testimonial-text-align-',
            ]
        );


        $this->add_responsive_control(
            'column',
            [
                'label'   => __('Columns', 'maisonco-core'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 1,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 6 => 6],
            ]
        );

        $this->add_control(
            'testimonial_layout',
            [
                'label'   => __('Layout', 'maisonco-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'layout_1',
                'options' => [
                    'layout_1' => __('Layout 1', 'maisonco-core'),
                    'layout_2' => __('Layout 2', 'maisonco-core'),
                ],
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


        // Wrapper

        $this->start_controls_section(
            'wrapper_style',
            [
                'label' => __('Wrapper', 'maisonco-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_wrapper_style');

        $this->start_controls_tab(
            'tab_wrapper_normal',
            [
                'label' => __('Normal', 'maisonco-core'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'background_wrapper',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}}.elementor-widget-opal-testimonials .elementor-widget-container',
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'wrapper_box_shadow',
                'selector' => '{{WRAPPER}}.elementor-widget-opal-testimonials .elementor-widget-container',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_wrapper_hover',
            [
                'label' => __('Hover', 'maisonco-core'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'background_wrapper_hover',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}}.elementor-widget-opal-testimonials:hover .elementor-widget-container',
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'wrapper_box_shadow_hover',
                'selector' => '{{WRAPPER}}.elementor-widget-opal-testimonials:hover .elementor-widget-container',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label'      => __('Padding', 'maisonco-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}.elementor-widget-opal-testimonials .elementor-widget-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );

        $this->add_control(
            'wrapper_transformation',
            [
                'label'        => __('Hover Animation', 'maisonco-core'),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    'none'      => 'None',
                    'move-up'   => 'Move Up',
                    'move-down' => 'Move Down',
                ],
                'default'      => 'none',
                'prefix_class' => 'testimonial-wrapper-transform-',
                'separator'    => 'before',
            ]
        );

        $this->add_control(
            'wrapper_effect_duration',
            [
                'label'     => __('Effect Duration', 'maisonco-core'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 500,
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 3000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-opal-testimonials .elementor-widget-container' => 'transition: all {{SIZE}}ms',
                ],
            ]
        );

        $this->end_controls_section();


        // Image.
        $this->start_controls_section(
            'section_style_testimonial_image',
            [
                'label' => __('Image', 'maisonco-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_size',
            [
                'label'      => __('Image Size', 'maisonco-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 20,
                        'max' => 200,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-image img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->start_controls_tabs('image_effects');

        $this->start_controls_tab('normal',
            [
                'label' => __('Normal', 'maisonco-core'),
            ]
        );

        $this->add_control(
            'opacity',
            [
                'label'     => __('Opacity', 'maisonco-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-image img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'     => 'css_filters',
                'selector' => '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-image img',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('hover',
            [
                'label' => __('Hover', 'maisonco-core'),
            ]
        );

        $this->add_control(
            'opacity_hover',
            [
                'label'     => __('Opacity', 'maisonco-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-wrapper:hover .elementor-testimonial-image img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'     => 'css_filters_hover',
                'selector' => '{{WRAPPER}} .elementor-testimonial-wrapper:hover .elementor-testimonial-image img',
            ]
        );

        $this->add_control(
            'background_hover_transition',
            [
                'label'     => __('Transition Duration', 'maisonco-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-image img' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );

        $this->add_control(
            'hover_animation',
            [
                'label' => __('Hover Animation', 'maisonco-core'),
                'type'  => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-image img',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label'      => __('Border Radius', 'maisonco-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_padding',
            [
                'label'      => __('Padding', 'maisonco-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => __('Margin', 'maisonco-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-image img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Title
        $this->start_controls_section(
            'section_style_testimonial_title',
            [
                'label' => __('Title', 'maisonco-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __('Text Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .elementor-testimonial-title',
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => __('Padding', 'maisonco-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __('Margin', 'maisonco-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Content
        $this->start_controls_section(
            'section_style_testimonial_style',
            [
                'label' => __('Content', 'maisonco-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_content_color',
            [
                'label'     => __('Text Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .elementor-testimonial-content',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'content_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-testimonial-content',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'content_radius',
            [
                'label'      => __('Border Radius', 'maisonco-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => __('Padding', 'maisonco-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label'      => __('Margin', 'maisonco-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Name.
        $this->start_controls_section(
            'section_style_testimonial_name',
            [
                'label' => __('Name', 'maisonco-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_text_color',
            [
                'label'     => __('Text Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-name, {{WRAPPER}} .elementor-testimonial-name a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'selector' => '{{WRAPPER}} .elementor-testimonial-name',
            ]
        );

        $this->add_responsive_control(
            'name_padding',
            [
                'label'      => __('Padding', 'maisonco-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'name_margin',
            [
                'label'      => __('Margin', 'maisonco-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Job.
        $this->start_controls_section(
            'section_style_testimonial_job',
            [
                'label' => __('Job', 'maisonco-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'job_text_color',
            [
                'label'     => __('Text Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-job' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'job_typography',
                'selector' => '{{WRAPPER}} .elementor-testimonial-job',
            ]
        );

        $this->add_responsive_control(
            'job_padding',
            [
                'label'      => __('Padding', 'maisonco-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-job' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'job_margin',
            [
                'label'      => __('Margin', 'maisonco-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-job' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Dot
        $this->start_controls_section(
            'section_style_testimonial_dot',
            [
                'label'     => __('Dot', 'maisonco-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_carousel' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'backgroud_dot',
            [
                'label'     => __('Background', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-dots .owl-dot' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'backgroud_dot_active',
            [
                'label'     => __('Background Active', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-dots .owl-dot.active' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Arrows
        $this->start_controls_section(
            'section_style_testimonial_arrow',
            [
                'label'     => __('Arrow', 'maisonco-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_carousel' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'nav_style',
            [
                'label'        => __('Style', 'maisonco-core'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'style_1',
                'options'      => [
                    'style_1' => __('Style 1', 'maisonco-core'),
                    'style_2' => __('Style 2', 'maisonco-core'),
                ],
                'prefix_class' => 'testimonial-nav-',
            ]
        );

        $this->add_responsive_control(
            'fontsize_nav',
            [
                'label'      => __('Font Size', 'maisonco-core'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 40,
                    ],
                ],
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-prev:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-next:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );

        $this->add_responsive_control(
            'width_nav',
            [
                'label'      => __('Width', 'maisonco-core'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-prev:before'  => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-next .owl-prev:before' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'nav_style' => 'style_1',
                ],
            ]
        );

        $this->add_responsive_control(
            'width_nav_style_2',
            [
                'label'      => __('Width', 'maisonco-core'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'nav_style' => 'style_2',
                ],
            ]
        );

        $this->add_responsive_control(
            'height_nav',
            [
                'label'      => __('Height', 'maisonco-core'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-prev:before'  => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-next .owl-prev:before' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'nav_style' => 'style_1',
                ],
            ]
        );

        $this->add_responsive_control(
            'height_nav_style_2',
            [
                'label'      => __('Height', 'maisonco-core'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav'                  => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-prev:before' => 'line-height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-next:before' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'nav_style' => 'style_2',
                ],
            ]
        );

        $this->add_responsive_control(
            'nav_style_2_align',
            [
                'label'        => __('Text Alignment', 'maisonco-core'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left'   => [
                        'title' => __('Left', 'maisonco-core'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'maisonco-core'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'maisonco-core'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'prefix_class' => 'testimonial-nav-text-align-',
                'default'      => 'right',
                'condition'    => [
                    'nav_style' => 'style_2',
                ],
            ]
        );

        $this->add_responsive_control(
            'spacing_left_nav_style_2',
            [
                'label'      => __('Spacing Left', 'maisonco-core'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'size' => 0,
                    'unit' => 'px'
                ],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'nav_style'         => 'style_2',
                    'nav_style_2_align' => 'left',
                ],
            ]
        );

        $this->add_responsive_control(
            'spacing_right_nav_style_2',
            [
                'label'      => __('Spacing Right', 'maisonco-core'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'size' => 0,
                    'unit' => 'px'
                ],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'nav_style'         => 'style_2',
                    'nav_style_2_align' => 'right',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_nav',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-prev:before,{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-next:before',
                'separator'   => 'before',
                'condition'   => [
                    'nav_style' => 'style_1',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_nav_style_2',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav ',
                'separator'   => 'before',
                'condition'   => [
                    'nav_style' => 'style_2',
                ],
            ]
        );

        $this->add_control(
            'nav_border_radius',
            [
                'label'      => __('Border Radius', 'maisonco-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-prev:before,{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-next:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'nav_style' => 'style_1',
                ],
            ]
        );

        $this->add_control(
            'nav_style_2_border_radius',
            [
                'label'      => __('Border Radius', 'maisonco-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'nav_style' => 'style_2',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_nav_style_2');

        $this->start_controls_tab(
            'tab_nav_normal_2',
            [
                'label' => __('Normal', 'maisonco-core'),
            ]
        );

        $this->add_control(
            'color_nav',
            [
                'label'     => __('Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-prev:before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-next:before' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'background_nav',
            [
                'label'     => __('Background Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-prev:before' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-next:before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'nav_style' => 'style_1',
                ],
            ]
        );

        $this->add_control(
            'background_nav_style_2',
            [
                'label'     => __('Background Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav ' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'nav_style' => 'style_2',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_nav_hover_2',
            [
                'label' => __('Hover', 'maisonco-core'),
            ]
        );

        $this->add_control(
            'color_nav_hover',
            [
                'label'     => __('Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-prev:hover:before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-next:hover:before' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'background_nav_hover',
            [
                'label'     => __('Background Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-prev:hover:before' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-next:hover:before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'nav_style' => 'style_1',
                ],
            ]
        );

        $this->add_control(
            'background_nav_style_2_hover',
            [
                'label'     => __('Background Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'nav_style' => 'style_2',
                ],
            ]
        );

        $this->add_control(
            'border_nav_hover',
            [
                'label'     => __('Border Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-prev:hover:before' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-next:hover:before' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'nav_style' => 'style_1',
                ],
            ]
        );

        $this->add_control(
            'border_nav_style_2_hover',
            [
                'label'     => __('Border Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'nav_style' => 'style_2',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Add Carousel Control
        $this->add_control_carousel();

    }

    /**
     * Render testimonial widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        if (!empty($settings['testimonials']) && is_array($settings['testimonials'])) {

            $this->add_render_attribute('wrapper', 'class', 'elementor-testimonial-wrapper');
            $this->add_render_attribute('wrapper', 'class', $settings['testimonial_layout']);
            if ($settings['testimonial_alignment']) {
                $this->add_render_attribute('wrapper', 'class', 'elementor-testimonial-text-align-' . $settings['testimonial_alignment']);
            }
            // Row
            $this->add_render_attribute('row', 'class', 'row');
            if ($settings['enable_carousel'] === 'yes') {
                $this->add_render_attribute('row', 'class', 'owl-carousel owl-theme');
                $carousel_settings = $this->get_carousel_settings();
                $this->add_render_attribute('row', 'data-settings', wp_json_encode($carousel_settings));
            }

            $this->add_render_attribute('row', 'data-elementor-columns', $settings['column']);
            if (!empty($settings['column_tablet'])) {
                $this->add_render_attribute('row', 'data-elementor-columns-tablet', $settings['column_tablet']);
            }
            if (!empty($settings['column_mobile'])) {
                $this->add_render_attribute('row', 'data-elementor-columns-mobile', $settings['column_mobile']);
            }

            // Item
            $this->add_render_attribute('item', 'class', 'elementor-testimonial-item');
            $this->add_render_attribute('item', 'class', 'column-item');


            ?>
            <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
                <div <?php echo $this->get_render_attribute_string('row') ?>>
                    <?php foreach ($settings['testimonials'] as $testimonial): ?>
                        <div <?php echo $this->get_render_attribute_string('item'); ?>>
                            <?php if ($settings['testimonial_layout'] == 'layout_1'): ?>
                                <?php $this->render_image($settings, $testimonial); ?>
                                <div class="elementor-testimonial-title"><?php echo $testimonial['testimonial_title']; ?></div>
                                <div class="elementor-testimonial-content">
                                    <?php echo $testimonial['testimonial_content']; ?>
                                </div>
                                <div class="elementor-testimonial-meta-inner">
                                    <div class="elementor-testimonial-details">
                                        <?php
                                        $testimonial_name_html = $testimonial['testimonial_name'];
                                        if (!empty($testimonial['testimonial_link']['url'])) :
                                            $testimonial_name_html = '<a href="' . esc_url($testimonial['testimonial_link']['url']) . '">' . $testimonial_name_html . '</a>';
                                        endif;
                                        ?>
                                        <div class="elementor-testimonial-name"><?php echo $testimonial_name_html; ?></div>
                                        <div class="elementor-testimonial-job"><?php echo $testimonial['testimonial_job']; ?></div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($settings['testimonial_layout'] == 'layout_2'): ?>
                                <div class="elementor-testimonial-meta-inner">
                                    <?php $this->render_image($settings, $testimonial); ?>
                                    <div class="elementor-testimonial-details">
                                        <?php
                                        $testimonial_name_html = $testimonial['testimonial_name'];
                                        if (!empty($testimonial['testimonial_link']['url'])) :
                                            $testimonial_name_html = '<a href="' . esc_url($testimonial['testimonial_link']['url']) . '">' . $testimonial_name_html . '</a>';
                                        endif;
                                        ?>
                                        <div class="elementor-testimonial-name"><?php echo $testimonial_name_html; ?></div>
                                        <div class="elementor-testimonial-job"><?php echo $testimonial['testimonial_job']; ?></div>
                                    </div>
                                </div>
                                <div class="elementor-testimonial-content">
                                    <?php echo $testimonial['testimonial_content']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
        }
    }

    private function render_image($settings, $testimonial) { ?>
        <div class="elementor-testimonial-image">
            <?php
            $testimonial['testimonial_image_size']             = $settings['testimonial_image_size'];
            $testimonial['testimonial_image_custom_dimension'] = $settings['testimonial_image_custom_dimension'];
            if (!empty($testimonial['testimonial_image']['url'])) :
                $image_html = Group_Control_Image_Size::get_attachment_image_html($testimonial, 'testimonial_image');
                echo $image_html;
            endif;
            ?>
        </div>
        <?php
    }

}

$widgets_manager->register(new OSF_Elementor_Testimonials());
