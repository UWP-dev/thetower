<?php

namespace Elementor;

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor heading widget.
 *
 * Elementor widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class  OSF_Elementor_Heading extends Widget_Heading {

    public function get_title() {
        return __('Opal Heading', 'maisonco-core');
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_title',
            [
                'label' => __('Title', 'maisonco-core'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __('Title', 'maisonco-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your title', 'maisonco-core'),
                'default'     => __('Add Your Heading Text Here', 'maisonco-core'),
            ]
        );

        $this->add_control(
            'link',
            [
                'label'     => __('Link', 'maisonco-core'),
                'type'      => Controls_Manager::URL,
                'dynamic'   => [
                    'active' => true,
                ],
                'default'   => [
                    'url' => '',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'size',
            [
                'label'   => __('Size', 'maisonco-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => __('Default', 'maisonco-core'),
                    'small'   => __('Small', 'maisonco-core'),
                    'medium'  => __('Medium', 'maisonco-core'),
                    'large'   => __('Large', 'maisonco-core'),
                    'xl'      => __('XL', 'maisonco-core'),
                    'xxl'     => __('XXL', 'maisonco-core'),
                ],
            ]
        );

        $this->add_control(
            'header_size',
            [
                'label'   => __('HTML Tag', 'maisonco-core'),
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
                'default' => 'h2',
            ]
        );

		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__( 'Alignment', 'maisonco-core' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'maisonco-core' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'maisonco-core' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'maisonco-core' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'maisonco-core' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
                'prefix_class' => 'elementor-heading%s__align-',
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
            'section_title_style',
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
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-heading .elementor-heading-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'selector' => '{{WRAPPER}} .elementor-heading-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'text_stroke',
                'selector' => '{{WRAPPER}} .elementor-heading-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'text_shadow',
                'selector' => '{{WRAPPER}} .elementor-heading-title',
            ]
        );

        $this->add_control(
            'blend_mode',
            [
                'label'     => __('Blend Mode', 'maisonco-core'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    ''            => __('Normal', 'maisonco-core'),
                    'multiply'    => 'Multiply',
                    'screen'      => 'Screen',
                    'overlay'     => 'Overlay',
                    'darken'      => 'Darken',
                    'lighten'     => 'Lighten',
                    'color-dodge' => 'Color Dodge',
                    'saturation'  => 'Saturation',
                    'color'       => 'Color',
                    'difference'  => 'Difference',
                    'exclusion'   => 'Exclusion',
                    'hue'         => 'Hue',
                    'luminosity'  => 'Luminosity',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => 'mix-blend-mode: {{VALUE}}',
                ],
                'separator' => 'none',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon_style',
            [
                'label' => __('Icon', 'maisonco-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'show_icon_before',
            [
                'label' => __('Show Before', 'maisonco-core'),
                'type'  => Controls_Manager::SWITCHER,
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'selected_icon_before',
            [
                'label' => esc_html__( 'Icon', 'maisonco-core' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'opal-icon-decor',
                    'library' => 'opal-custom',
                ],
                'condition' => [
                    'show_icon_before' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'icon_before_color',
            [
                'label'     => __('Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .icon_before' => 'color: {{VALUE}};',
                ],
                'global' => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
                'condition' => [
                    'show_icon_before' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'spacing_icon_before',
            [
                'label'     => __( 'Spacing', 'maisonco-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .icon_before' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_icon_before' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'size_icon_before',
            [
                'label'     => __( 'Size', 'maisonco-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .icon_before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_icon_before' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_icon_after',
            [
                'label' => __('Show After', 'maisonco-core'),
                'type'  => Controls_Manager::SWITCHER,
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'selected_icon_after',
            [
                'label' => esc_html__( 'Icon', 'maisonco-core' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'opal-icon-decor',
                    'library' => 'opal-custom',
                ],
                'condition' => [
                    'show_icon_after' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'icon_after_color',
            [
                'label'     => __('Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .icon_after' => 'color: {{VALUE}};',
                ],
                'global' => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
                'condition' => [
                    'show_icon_after' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'spacing_icon_after',
            [
                'label'     => __( 'Spacing', 'maisonco-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .icon_before' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_icon_after' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'size_icon_after',
            [
                'label'     => __( 'Size', 'maisonco-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .icon_after' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_icon_after' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render heading widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['title'])) {
            return;
        }

        $this->add_render_attribute('title', 'class', 'elementor-heading-title');

        if (!empty($settings['size'])) {
            $this->add_render_attribute('title', 'class', 'elementor-size-' . $settings['size']);
        }

        $this->add_inline_editing_attributes('title');

        $title = $settings['title'];

        if (!empty($settings['link']['url'])) {
            $this->add_render_attribute('url', 'href', $settings['link']['url']);

            if ($settings['link']['is_external']) {
                $this->add_render_attribute('url', 'target', '_blank');
            }

            if (!empty($settings['link']['nofollow'])) {
                $this->add_render_attribute('url', 'rel', 'nofollow');
            }

            $title = sprintf('<a %1$s>%2$s</a>', $this->get_render_attribute_string('url'), $title);
        }

        $has_icon_before = !empty($settings['choose_icon_before']);
        if ($has_icon_before) {
            $this->add_render_attribute('icon_before', 'class', ['icon_before',$settings['choose_icon_before']]);
            $this->add_render_attribute('icon_before', 'aria-hidden', 'true');
        }
        if ( ! $has_icon_before && ! empty( $settings['selected_icon_before']['value'] ) ) {
            $has_icon_before = true;
        }

        $migrated_before = isset( $settings['__fa4_migrated']['selected_icon_before'] );
        $is_new_before = ! isset( $settings['choose_icon_before'] ) && Icons_Manager::is_migration_allowed();

        $title_html = '';

        if($has_icon_before) {
            ob_start();
            if ( $is_new_before || $migrated_before ) {
                Icons_Manager::render_icon( $settings['selected_icon_before'], [ 'aria-hidden' => 'true' ,'class'=>'icon_before'] );
            } elseif ( ! empty( $settings['choose_icon_before'] ) ) {
                ?><i <?php $this->print_render_attribute_string( 'icon_before' ); ?>></i><?php
            }
            $title_html = ob_get_clean();
        }

        $title_html .= sprintf('<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string('title'), $title);

        $has_icon_after = !empty($settings['choose_icon_after']);
        if ($has_icon_after) {
            $this->add_render_attribute('icon_after', 'class', ['icon_after',$settings['choose_icon_after']]);
            $this->add_render_attribute('icon_after', 'aria-hidden', 'true');
        }
        if ( ! $has_icon_after && ! empty( $settings['selected_icon_after']['value'] ) ) {
            $has_icon_after = true;
        }

        $migrated_after = isset( $settings['__fa4_migrated']['selected_icon_after'] );
        $is_new__fa4_migrated = ! isset( $settings['choose_icon_after'] ) && Icons_Manager::is_migration_allowed();

        if($has_icon_after) {
            ob_start();
            if ( $is_new__fa4_migrated || $migrated_after ) {
                Icons_Manager::render_icon( $settings['selected_icon_after'], [ 'aria-hidden' => 'true' ,'class'=>'icon_after'] );
            } elseif ( ! empty( $settings['choose_icon_before'] ) ) {
                ?><i <?php $this->print_render_attribute_string( 'icon_after' ); ?>></i><?php
            }
            $title_html .= ob_get_clean();
        }

        echo $title_html;
    }

    /**
     * Render heading widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function content_template() {

    }
}

$widgets_manager->register(new OSF_Elementor_Heading());