<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;

add_action( 'elementor/element/icon-list/section_icon_list/before_section_end', function ($element, $args ) {

    $element->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name'        => 'border_list_item',
            'placeholder' => '1px',
            'default'     => '1px',
            'selector'    => '{{WRAPPER}} .elementor-icon-list-item',
        ]
    );

    $element->add_control(
        'list_item_border_radius',
        [
            'label'      => __('Border Radius', 'maisonco-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-icon-list-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $element->add_responsive_control(
        'list_item_padding',
        [
            'label'      => __('Padding', 'maisonco-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-icon-list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'list_item_margin',
        [
            'label'      => __('Margin', 'maisonco-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-icon-list-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

}, 10, 2 );

add_action( 'elementor/element/icon-list/section_icon_style/before_section_end', function ($element, $args ) {

    $element->add_responsive_control(
        'icon_font_size',
        [
            'label'     => __('Font Size', 'maisonco-core'),
            'type'      => Controls_Manager::SLIDER,
            'default'   => [
                'size' => 14,
            ],
            'range'     => [
                'px' => [
                    'min' => 6,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $element->update_control(
        'icon_size',
        [
            'label'     => __('Size', 'maisonco-core'),
            'type'      => Controls_Manager::SLIDER,
            'default'   => [
                'size' => 25,
            ],
            'range'     => [
                'px' => [
                    'min' => 10,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon' => 'min-width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $element->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name'        => 'border_icon',
            'placeholder' => '1px',
            'default'     => '1px',
            'selector'    => '{{WRAPPER}} .elementor-icon-list-icon',
            'separator'   => 'before',
        ]
    );

    $element->add_control(
        'icon_border_radius',
        [
            'label'      => __('Border Radius', 'maisonco-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-icon-list-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $element->start_controls_tabs('tabs_icon_style');

    $element->start_controls_tab(
        'tab_icon_normal',
        [
            'label' => __('Normal', 'maisonco-core'),
        ]
    );

    $element->add_control(
        'icon_border_color',
        [
            'label'     => __('Border Color', 'maisonco-core'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-item .elementor-icon-list-icon' => 'border-color: {{VALUE}};',
            ],
        ]
    );

    $element->end_controls_tab();

    $element->start_controls_tab(
        'tab_icon_hover',
        [
            'label' => __('Hover', 'maisonco-core'),
        ]
    );


    $element->add_control(
        'icon_border_color_hover',
        [
            'label'     => __('Border Color', 'maisonco-core'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-icon' => 'border-color: {{VALUE}};',
            ],
        ]
    );

    $element->end_controls_tab();

    $element->end_controls_tabs();

}, 10, 2 );