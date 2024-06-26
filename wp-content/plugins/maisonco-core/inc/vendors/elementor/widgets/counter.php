<?php

namespace Elementor;

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor counter widget.
 *
 * Elementor widget that displays stats and numbers in an escalating manner.
 *
 * @since 1.0.0
 */
class OSF_Elementor_Counter extends Widget_Counter {

    /**
     * Get widget name.
     *
     * Retrieve counter widget name.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'counter';
    }

    /**
     * Get widget title.
     *
     * Retrieve counter widget title.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Counter', 'maisonco-core');
    }

    /**
     * Get widget icon.
     *
     * Retrieve counter widget icon.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-counter';
    }

    /**
     * Retrieve the list of scripts the counter widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since  1.3.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return ['jquery-numerator'];
    }

    /**
     * Register counter widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_counter',
            [
                'label' => __('Counter', 'maisonco-core'),
            ]
        );

        $this->add_control(
            'starting_number',
            [
                'label'   => __('Starting Number', 'maisonco-core'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 0,
            ]
        );

        $this->add_control(
            'ending_number',
            [
                'label'   => __('Ending Number', 'maisonco-core'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 100,
            ]
        );

        $this->add_control(
            'prefix',
            [
                'label'       => __('Number Prefix', 'maisonco-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'placeholder' => 1,
            ]
        );

        $this->add_control(
            'suffix',
            [
                'label'       => __('Number Suffix', 'maisonco-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'placeholder' => __('Plus', 'maisonco-core'),
            ]
        );

        $this->add_control(
            'show_icon',
            [
                'label'     => __('Show Icon', 'maisonco-core'),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => __('Show', 'maisonco-core'),
                'label_off' => __('Hide', 'maisonco-core'),
            ]
        );

        $this->add_control(
            'icon_select',
            [
                'label'     => __('Icon select', 'maisonco-core'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'use_icon',
                'options'   => [
                    'use_icon'  => __('Use Icon', 'maisonco-core'),
                    'use_image' => __('Use Image', 'maisonco-core'),
                ],
                'condition' => [
                    'show_icon' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'image',
            [
                'label'     => __('Choose Image', 'maisonco-core'),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'icon_select' => 'use_image',
                    'show_icon'   => 'yes',
                ],
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label'      => __(' Size', 'maisonco-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 20,
                        'max' => 200,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-counter .elementor-icon-counter img, {{WRAPPER}} .elementor-counter .elementor-icon-counter svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'icon_select' => 'use_image',
                    'show_icon'   => 'yes',
                ],
            ]
        );

        $this->add_control(
            'selected_icon',
            [
                'label' => esc_html__( 'Icon', 'maisonco-core' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fa fa-star',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'icon_select' => 'use_icon',
                    'show_icon'   => 'yes',
                ],
            ]
        );

        $this->add_control(
            'duration',
            [
                'label'   => __('Animation Duration', 'maisonco-core'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 2000,
                'min'     => 100,
                'step'    => 100,
            ]
        );

        $this->add_control(
            'thousand_separator',
            [
                'label'     => __('Thousand Separator', 'maisonco-core'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_on'  => __('Show', 'maisonco-core'),
                'label_off' => __('Hide', 'maisonco-core'),
            ]
        );

        $this->add_control(
            'thousand_separator_char',
            [
                'label'     => __('Separator', 'maisonco-core'),
                'type'      => Controls_Manager::SELECT,
                'condition' => [
                    'thousand_separator' => 'yes',
                ],
                'options'   => [
                    ''  => 'Default',
                    '.' => 'Dot',
                    ' ' => 'Space',
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __('Title', 'maisonco-core'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __('Cool Number', 'maisonco-core'),
                'placeholder' => __('Cool Number', 'maisonco-core'),
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label'       => __('Sub Title', 'maisonco-core'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __('Sub Title', 'maisonco-core'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label'       => __('Description', 'maisonco-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => __('Description...', 'maisonco-core'),
            ]
        );

        $this->add_control(
            'position',
            [
                'label'        => __('Alignment', 'maisonco-core'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left' => [
                        'title' => __('Left', 'maisonco-core'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'     => [
                        'title' => __('Center', 'maisonco-core'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => __('Right', 'maisonco-core'),
                        'icon'  => 'eicon-text-align-right',
                    ]
                ],
                'toggle'       => false,
                'prefix_class' => 'elementor-position-',
                'default'      => 'center',
                'selectors'    => [
                    '{{WRAPPER}} .elementor-counter' => 'text-align: {{VALUE}}',
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


        //wrapper
        $this->start_controls_section(

            'section_wrapper',
            [
                'label' => __('Wrapper', 'maisonco-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'wrapper_animation',
            [
                'label'     => __('Show animation line bottom', 'maisonco-core'),
                'type'      => Controls_Manager::SWITCHER,
                'label_off' => __('Off', 'maisonco-core'),
                'label_on'  => __('On', 'maisonco-core'),
                'selectors'  => [
                    '{{WRAPPER}} .elementor-counter:before' => 'content: "" ',
                    '{{WRAPPER}} .elementor-counter:after' => 'content: "" ',
                ],
            ]
        );

        $this->add_responsive_control(
            'height_line',
            [
                'label'      => __( 'Height Line', 'maisonco-core' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-counter:before' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-counter:after' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'wrapper_animation!' => '',
                ]
            ]
        );

        $this->add_control(
            'line_color',
            [
                'label' => __( 'Line Color', 'maisonco-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter:before' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'wrapper_animation!' => '',
                ]
            ]
        );

        $this->add_control(
            'line_color_hover',
            [
                'label' => __( 'Line Color Hover', 'maisonco-core' ),
                'type' => Controls_Manager::COLOR,
                'global' => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter:after' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'wrapper_animation!' => '',
                ]
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label'      => __( 'Padding', 'maisonco-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        //number
        $this->start_controls_section(

            'section_number',
            [
                'label' => __('Number', 'maisonco-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'number_color',
            [
                'label'     => __('Text Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter-number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography_number',
                'selector' => '{{WRAPPER}} .elementor-counter-number',
            ]
        );

        $this->add_responsive_control(
            'spacing_number_wrapper',
            [
                'label'      => __( 'Spacing', 'maisonco-core' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-counter-number-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //number prefix
        $this->start_controls_section(

            'section_number_prefix',
            [
                'label' => __('Number Prefix', 'maisonco-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'number_prefix_color',
            [
                'label'     => __('Text Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter-number-prefix' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography_number_prefix',
                'selector' => '{{WRAPPER}} .elementor-counter-number-prefix',
            ]
        );

        $this->add_responsive_control(
            'spacing_number_prefix',
            [
                'label'      => __( 'Spacing', 'maisonco-core' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-counter-number-prefix' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //number suffix
        $this->start_controls_section(

            'section_number_suffix',
            [
                'label' => __('Number Suffix', 'maisonco-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'number_suffix_color',
            [
                'label'     => __('Text Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter-number-suffix' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography_number_suffix',
                'selector' => '{{WRAPPER}} .elementor-counter-number-suffix',
            ]
        );

        $this->add_responsive_control(
            'spacing_number_suffix',
            [
                'label'      => __( 'Spacing', 'maisonco-core' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-counter-number-suffix' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //title
        $this->start_controls_section(
            'section_title',
            [
                'label'     => __('Title', 'maisonco-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'title!' => '',
                ]
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __('Text Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography_title',
                'selector' => '{{WRAPPER}} .elementor-counter-title',
            ]
        );

        $this->add_responsive_control(
            'spacing_title',
            [
                'label'      => __( 'Spacing', 'maisonco-core' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-counter-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //sub title
        $this->start_controls_section(
            'section_sub_title',
            [
                'label'     => __('Sub Title', 'maisonco-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'sub_title!' => '',
                ]
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label'     => __('Text Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter-sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography_sub_title',
                'selector' => '{{WRAPPER}} .elementor-counter-sub-title',
            ]
        );

        $this->add_responsive_control(
            'spacing_sub_title',
            [
                'label'      => __( 'Spacing', 'maisonco-core' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-counter-sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //description
        $this->start_controls_section(
            'section_description',
            [
                'label'     => __('Description', 'maisonco-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'description!' => '',
                ]
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => __('Text Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography_description',
                'selector' => '{{WRAPPER}} .elementor-counter-description',
            ]
        );

        $this->end_controls_section();

        //icon
        $this->start_controls_section(
            'section_icon',
            [
                'label'     => __('Icon', 'maisonco-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'icon_select' => 'use_icon',
                    'show_icon'   => 'yes',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => __('Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-counter'     => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'      => __( 'Size', 'maisonco-core' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-icon-counter' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'spacing_icon_counter',
            [
                'label'      => __( 'Spacing', 'maisonco-core' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-icon-counter i' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //image
        $this->start_controls_section(
            'section_image',
            [
                'label'     => __('Image & SVG', 'maisonco-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'icon_select' => 'use_image',
                    'show_icon'   => 'yes',
                ],
            ]
        );

        $this->add_control(
            'svg_color',
            [
                'label'     => __('Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-counter svg'     => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'spacing_image_counter',
            [
                'label'      => __( 'Spacing', 'maisonco-core' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-icon-counter img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-icon-counter svg' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render counter widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function content_template() {
        return;
    }

    /**
     * Render counter widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('counter', [
            'class'         => 'elementor-counter-number',
            'data-duration' => $settings['duration'],
            'data-to-value' => $settings['ending_number'],
        ]);

        if (!empty($settings['thousand_separator'])) {
            $delimiter = empty($settings['thousand_separator_char']) ? ',' : $settings['thousand_separator_char'];
            $this->add_render_attribute('counter', 'data-delimiter', $delimiter);
        }
        ?>
        <div class="elementor-counter">
            <?php $this->get_image_icon(); ?>
            <div class="elementor-counter-wrapper">
                <div class="elementor-counter-number-wrapper">
                    <span class="elementor-counter-number-prefix"><?php echo $settings['prefix']; ?></span>
                    <span <?php echo $this->get_render_attribute_string('counter'); ?>><?php echo $settings['starting_number']; ?></span>
                    <span class="elementor-counter-number-suffix"><?php echo $settings['suffix']; ?></span>
                </div>

                <div class="elementor-counter-title-wrap">
                    <?php if ($settings['title']) : ?>
                        <div class="elementor-counter-title"><?php echo $settings['title']; ?></div>
                    <?php endif; ?>
                    <?php if ($settings['sub_title']) : ?>
                        <div class="elementor-counter-sub-title"><?php echo $settings['sub_title']; ?></div>
                    <?php endif; ?>
                    <?php if ($settings['description']) : ?>
                        <div class="elementor-counter-description"><?php echo $settings['description']; ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }

    private function get_image_icon() {
        $settings = $this->get_settings_for_display();

        $has_icon = !empty($settings['icon']);

        if ($has_icon) {
            $this->add_render_attribute('icon', 'class', $settings['icon']);
            $this->add_render_attribute('icon', 'aria-hidden', 'true');
        }

        if ( ! $has_icon && ! empty( $settings['selected_icon']['value'] ) ) {
            $has_icon = true;
        }

        $migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
        $is_new = ! isset( $settings['icon'] ) && Icons_Manager::is_migration_allowed();


        if ('yes' === $settings['show_icon']):
            ?>
            <div class="elementor-icon-counter">
                <?php if ('use_image' === $settings['icon_select'] && !empty($settings['image']['url'])) :
                    $image_url = '';
                    $image_html = Group_Control_Image_Size::get_attachment_image_html($settings, '', 'image');
                    $image_url = $settings['image']['url'];
                    $path_parts = pathinfo($image_url);
                    if ($path_parts['extension'] === 'svg') {
                        $image = $this->get_settings_for_display('image');
                        $pathSvg = get_attached_file($image['id']);
                        $image_html = osf_get_icon_svg($pathSvg);
                    }
                    echo $image_html;
                    ?>
                <?php elseif ('use_icon' === $settings['icon_select'] && $has_icon) :
                    if ( $is_new || $migrated ) {
                        Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                    } elseif ( ! empty( $settings['icon'] ) ) {
                        ?><i <?php $this->print_render_attribute_string( 'icon' ); ?>></i><?php
                    }
                    ?>

                <?php endif; ?>
            </div>
        <?php
        endif;
    }
}
$widgets_manager->register(new OSF_Elementor_Counter());
