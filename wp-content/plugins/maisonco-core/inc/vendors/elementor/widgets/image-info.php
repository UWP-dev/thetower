<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

class OSF_Elementor_Image_Info extends OSF_Elementor_Carousel_Base {

    /**
     * Get widget name.
     *
     * Retrieve image info widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'opal-image-info';
    }

    /**
     * Get widget title.
     *
     * Retrieve image info widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title() {
        return __('Opal Image Info', 'maisonco-core');
    }

    /**
     * Get widget icon.
     *
     * Retrieve image info widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-image-rollover';
    }

    public function get_categories() {
        return array('opal-addons');
    }

    /**
     * Register image info widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_image_info',
            [
                'label' => __('Image Info', 'maisonco-core'),
            ]
        );

        $reapeter = new \Elementor\Repeater();

        $reapeter->add_control('image_info_title', [
            'label'   => __('Title', 'maisonco-core'),
            'default' => '',
            'type'    => Controls_Manager::TEXT,
        ]);

        $reapeter->add_control('image_info_content', [
            'label'       => __('Content', 'maisonco-core'),
            'type'        => Controls_Manager::TEXTAREA,
            'default'     => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
            'label_block' => true,
            'rows'        => '10',
        ]);

        $reapeter->add_control('image_info_image', [
            'label'      => __('Choose Image', 'maisonco-core'),
            'default'    => [
                'url' => Utils::get_placeholder_image_src(),
            ],
            'type'       => Controls_Manager::MEDIA,
            'show_label' => false,
        ]);


        $reapeter->add_control('image_info_link', [
            'label'       => __('Link to', 'maisonco-core'),
            'placeholder' => __('https://your-link.com', 'maisonco-core'),
            'type'        => Controls_Manager::URL,
        ]);

        $this->add_control(
            'image_info',
            [
                'label'       => __('Image Info Item', 'maisonco-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $reapeter->get_controls(),
                'title_field' => '{{{ image_info_title }}}',
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image_info_image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_info_image_size` and `image_info_image_custom_dimension`.
                'default'   => 'full',
                'separator' => 'none',
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

        $this->add_control(
            'layer_gradient_image',
            [
                'label'        => esc_html__('Hidden Layer Gradient Image', 'maisonco-core'),
                'type'         => Controls_Manager::SWITCHER,
                'selectors' => [
                        '{{WRAPPER}}.layer-gradient-image-yes .elementor-image-info-inner-wrapper' => 'background-image: none; background-image: none; background-image: none;',
                ],
                'prefix_class' => 'layer-gradient-image-'
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label' => __( 'Height', 'maisonco-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', 'vh' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-info-image, {{WRAPPER}} .elementor-image-info-image img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover; width: 100%;',
                    '{{WRAPPER}} .elementor-image-info-inner-wrapper' => 'min-height: {{SIZE}}{{UNIT}}',
                ],
                'separator' => 'before',
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
                'selector' => '{{WRAPPER}}.elementor-widget-opal-image-info .elementor-widget-container',
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'wrapper_box_shadow',
                'selector' => '{{WRAPPER}}.elementor-widget-opal-image-info .elementor-widget-container',
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
                'selector' => '{{WRAPPER}}.elementor-widget-opal-image-info:hover .elementor-widget-container',
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'wrapper_box_shadow_hover',
                'selector' => '{{WRAPPER}}.elementor-widget-opal-image-info:hover .elementor-widget-container',
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
                    '{{WRAPPER}}.elementor-widget-opal-image-info .elementor-image-info-inner-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );

        $this->end_controls_section();


        // Box
        $this->start_controls_section(
            'section_style_image_info_box',
            [
                'label' => __('Box', 'maisonco-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label' => __( 'Width', 'maisonco-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-info-inner' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'alignment',
            [
                'label' => __( 'Alignment', 'maisonco-core' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'maisonco-core' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'maisonco-core' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'maisonco-core' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-info-inner' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'vertical_position',
            [
                'label' => __( 'Vertical Position', 'maisonco-core' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Top', 'maisonco-core' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => __( 'Middle', 'maisonco-core' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => __( 'Bottom', 'maisonco-core' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-info-inner-wrapper' => 'align-content: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'horizontal_align',
            [
                'label'     => esc_html__('Horizontal Align', 'maisonco-core'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'maisonco-core'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center'     => [
                        'title' => esc_html__('Center', 'maisonco-core'),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'flex-end'   => [
                        'title' => esc_html__('Right', 'maisonco-core'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'   => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-info-inner-wrapper' => 'justify-content: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => __( 'Padding', 'maisonco-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-info-inner-wrapper .elementor-image-info-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->end_controls_section();

        // Title
        $this->start_controls_section(
            'section_style_image_info_title',
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
                    '{{WRAPPER}} .elementor-image-info-title, {{WRAPPER}} .elementor-image-info-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .elementor-image-info-title',
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => __('Padding', 'maisonco-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-image-info-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .elementor-image-info-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Content
        $this->start_controls_section(
            'section_style_image_info_style',
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
                    '{{WRAPPER}} .elementor-image-info-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .elementor-image-info-content',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'content_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-image-info-content',
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => __('Padding', 'maisonco-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-image-info-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .elementor-image-info-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Dot
        $this->start_controls_section(
            'section_style_image_info_dot',
            [
                'label'     => __('Dot', 'maisonco-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_carousel' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'dot_style',
            [
                'label'        => __('Style', 'maisonco-core'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'style_1',
                'options'      => [
                    'style_1' => __('Style 1', 'maisonco-core'),
                    'style_2' => __('Style 2', 'maisonco-core'),
                ],
                'prefix_class' => 'image-info-dot-',
            ]
        );

        $this->add_responsive_control(
            'Alignment_text',
            [
                'label'     => esc_html__('Alignment text', 'maisonco-core'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__('Left', 'maisonco-core'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'maisonco-core'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'maisonco-core'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-dots' => 'text-align: {{VALUE}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'dots_padding',
            [
                'label'      => __('Padding', 'maisonco-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-dots' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            'section_style_image_info_arrow',
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
                'prefix_class' => 'image-info-nav-',
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
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-next:before' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav'                  => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-prev:before' => 'line-height: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-next:before' => 'line-height: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-prev:before' => 'line-height: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-next:before' => 'line-height: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
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
                'prefix_class' => 'image-info-nav-text-align-',
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

        $this->add_control(
            'next_heading',
            [
                'label' => esc_html__('Next button', 'maisonco-core'),
                'type'  => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'next_vertical_value',
            [
                'label'       => esc_html__('Next Vertical', 'maisonco-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-next' => 'top: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'next_horizontal_value',
            [
                'label'       => esc_html__('Next Horizontal', 'maisonco-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => -45,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-next' => 'right: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'prev_heading',
            [
                'label'     => esc_html__('Prev button', 'maisonco-core'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );


        $this->add_responsive_control(
            'prev_vertical_value',
            [
                'label'       => esc_html__('Prev Vertical', 'maisonco-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-prev' => 'top: {{SIZE}}{{UNIT}};',
                ]
            ]
        );


        $this->add_responsive_control(
            'prev_horizontal_value',
            [
                'label'       => esc_html__('Prev Horizontal', 'maisonco-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => -45,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav .owl-prev' => 'left: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        // Add Carousel Control
        $this->add_control_carousel();

    }

    /**
     * Render image info widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        if (!empty($settings['image_info']) && is_array($settings['image_info'])) {

            $this->add_render_attribute('wrapper', 'class', 'elementor-image-info-wrapper');

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
            $this->add_render_attribute('item', 'class', 'elementor-image-info-item');


            ?>
            <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
                <div <?php echo $this->get_render_attribute_string('row') ?>>
                    <?php foreach ($settings['image_info'] as $image_info): ?>
                    <div class="column-item">
                        <div <?php echo $this->get_render_attribute_string('item'); ?>>
                            <?php $this->render_image($settings, $image_info); ?>
                            <div class="elementor-image-info-inner-wrapper">
                                <div class="elementor-image-info-inner">
                                    <?php
                                    $image_info_title_html = $image_info['image_info_title'];
                                    if (!empty($image_info['image_info_link']['url'])) :
                                        $image_info_title_html = '<a href="' . esc_url($image_info['image_info_link']['url']) . '">' . $image_info_title_html . '</a>';
                                    endif;
                                    ?>
                                    <div class="elementor-image-info-title">
                                        <?php echo $image_info_title_html; ?>
                                    </div>
                                    <div class="elementor-image-info-content">
                                        <?php echo $image_info['image_info_content']; ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
        }
    }

    private function render_image($settings, $image_info) { ?>
        <div class="elementor-image-info-image">
            <?php
            $image_info['image_info_image_size']             = $settings['image_info_image_size'];
            $image_info['image_info_image_custom_dimension'] = $settings['image_info_image_custom_dimension'];
            if (!empty($image_info['image_info_image']['url'])) :
                $image_html = Group_Control_Image_Size::get_attachment_image_html($image_info, 'image_info_image');
                echo $image_html;
            endif;
            ?>
        </div>
        <?php
    }

}

$widgets_manager->register(new OSF_Elementor_Image_Info());
