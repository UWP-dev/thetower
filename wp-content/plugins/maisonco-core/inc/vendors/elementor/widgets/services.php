<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

class OSF_Elementor_Services extends Elementor\Widget_Base
{

    public function get_name()
    {
        return 'opal-services';
    }

    public function get_title()
    {
        return __('Opal Services', 'maisonco-core');
    }

    public function get_categories()
    {
        return array('opal-addons');
    }

    public function get_icon()
    {
        return 'eicon-gallery-grid';
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Services', 'maisonco-core' ),
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'label' => __( 'Choose Image', 'maisonco-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'show_label' => false,
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'bg_image', // Actually its `image_size`
                'label' => __( 'Image Resolution', 'maisonco-core' ),
                'default' => 'large',
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'service_style',
            [
                'label' => __('Style', 'maisonco-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style1' => 'Style 1',
                    'style2' => 'Style 2',
                    'style3' => 'Style 3',
                ],
                'default' => 'style2'
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'maisonco-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'This is the heading', 'maisonco-core' ),
                'placeholder' => __( 'Enter your title', 'maisonco-core' ),
                'label_block' => true,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'maisonco-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'maisonco-core' ),
                'placeholder' => __( 'Enter your description', 'maisonco-core' ),
                'separator' => 'none',
                'rows' => 5,
            ]
        );

        $this->add_control(
            'button',
            [
                'label' => __( 'Button Text', 'maisonco-core' ),
                'type' => Controls_Manager::TEXT,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __( 'Link', 'maisonco-core' ),
                'type' => Controls_Manager::URL,
                'default'   => [
                        'url'   => '#'
                ],
                'placeholder' => __( 'https://your-link.com', 'maisonco-core' ),

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
                    '{{WRAPPER}} .elementor-service-wrapper' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'wrapper_style',
            [
                'label' => __( 'Wrapper', 'maisonco-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_image_hover_style');

        $this->start_controls_tab(
            'tab_image_hover_style_normal',
            [
                'label' => __('Normal', 'maisonco-core'),
            ]
        );

        $this->add_control(
            'image_opacity',
            [
                'label'     => __('Image Opacity', 'maisonco-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-service-image img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_control(
            'image_background',
            [
                'label'     => __('Background', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-service-image' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .elementor-service-image:before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_image_hover_style_hover',
            [
                'label' => __('Hover', 'maisonco-core'),
            ]
        );

        $this->add_control(
            'image_opacity_hover',
            [
                'label'     => __('Image Opacity', 'maisonco-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-service-wrapper:hover .elementor-service-image img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_control(
            'image_background_hover',
            [
                'label'     => __('Background', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-service-wrapper:hover .elementor-service-image' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .elementor-service-wrapper:hover .elementor-service-image:before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'service_wrapper_padding',
            [
                'label' => __( 'Padding', 'maisonco-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-service-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_style',
            [
                'label' => __( 'Content', 'maisonco-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_style_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'maisonco-core' ),
                'separator' => 'before',
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'maisonco-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-service-heading' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .elementor-service-heading',
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_control(
            'service_style_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Description', 'maisonco-core' ),
                'separator' => 'before',
                'condition' => [
                    'description!' => '',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Color', 'maisonco-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-service-description' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'description!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .elementor-service-description',
                'condition' => [
                    'description!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => __( 'Spacing', 'maisonco-core' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-service-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'description!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'description_margin',
            [
                'label' => __( 'Margin', 'maisonco-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-service-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'service_button_style',
            [
                'label' => __( 'Button', 'maisonco-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'button!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_size',
            [
                'label' => __( 'Size', 'maisonco-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    ''      => __('Default','maisonco-core'),
                    'xs' => __( 'Extra Small', 'maisonco-core' ),
                    'sm' => __( 'Small', 'maisonco-core' ),
                    'md' => __( 'Medium', 'maisonco-core' ),
                    'lg' => __( 'Large', 'maisonco-core' ),
                    'xl' => __( 'Extra Large', 'maisonco-core' ),
                ],
            ]
        );
        $this->add_control(
            'button_type',
            [
                'label' => __( 'Type', 'maisonco-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'dft',
                'options' => [
                    'dft'   => __('Default', 'maisonco-core'),
                    'primary' => __( 'Primary', 'maisonco-core' ),
                    'secondary' => __( 'Secondary', 'maisonco-core' ),
                ],
                'prefix_class' => 'elementor-button-',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __( 'Typography', 'maisonco-core' ),
                'selector' => '{{WRAPPER}} .elementor-service__button',
            ]
        );

        $this->start_controls_tabs( 'button_tabs' );

        $this->start_controls_tab( 'button_normal',
            [
                'label' => __( 'Normal', 'maisonco-core' ),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Text Color', 'maisonco-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-service__button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => __( 'Background Color', 'maisonco-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-service__button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label' => __( 'Border Color', 'maisonco-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-service__button' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button-hover',
            [
                'label' => __( 'Hover', 'maisonco-core' ),
            ]
        );

        $this->add_control(
            'button_hover_text_color',
            [
                'label' => __( 'Text Color', 'maisonco-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-service__button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_background_color',
            [
                'label' => __( 'Background Color', 'maisonco-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-service__button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __( 'Border Color', 'maisonco-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-service__button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'button_border_width',
            [
                'label' => __( 'Border Width', 'maisonco-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-service__button' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_border_style',
            [
                'label' => __( 'Border Style', 'maisonco-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => __( 'None', 'maisonco-core' ),
                    'solid' => __( 'Solid', 'maisonco-core' ),
                    'dashed' => __( 'Dashed', 'maisonco-core' ),
                    'dotted' => __( 'Dotted', 'maisonco-core' ),
                    'double' => __( 'Double', 'maisonco-core' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-service__button' => 'border-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', 'maisonco-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-service__button' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'maisonco-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-service__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings();

        $this->add_render_attribute('wrapper','class','elementor-service-wrapper service-'.esc_attr($settings['service_style']));

        $this->add_render_attribute( 'button', 'class', [
            'elementor-service__button',
            'elementor-button',
            'elementor-size-' . $settings['button_size'],
        ] );

        $link_url = empty( $settings['link']['url'] ) ? false : $settings['link']['url'];
        if (!empty($link_url)){
            $this->add_render_attribute( 'button', 'href', $link_url );
        }

        if (!empty($settings['bg_image']['url'])) {
            $image_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'bg_image', 'bg_image');
        }
        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper')?>>
            <div class="elementor-service-image">
                <?php echo $image_html;?>
            </div>
            <div class="elementor-service-content">
                <h4 class="elementor-service-heading"><?php echo esc_html($settings['title']);?></h4>
                <div class="elementor-service-content-inner">
                    <span class="elementor-service-description">
                        <?php echo esc_html($settings['description']);?>
                    </span>

                    <?php if ( ! empty( $settings['button'] ) ) : ?>
                        <a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
                            <?php echo $settings['button']; ?>
                        </a>
                <?php endif; ?>
                </div>
            </div>
        </div>
    <?php
    }
}

$widgets_manager->register(new OSF_Elementor_Services());
