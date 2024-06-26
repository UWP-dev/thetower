<?php
//Accordion
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;

add_action( 'elementor/element/accordion/section_title_style/before_section_end', function ($element, $args ) {
    $element->remove_control('border_width');
    $element->remove_control('border_color');

    $element->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name'        => 'border_accordion_item',
            'placeholder' => '1px',
            'default'     => '1px',
            'selector'    => '{{WRAPPER}} .elementor-accordion .elementor-accordion-item',
            'separator'   => 'before',
        ]
    );

},10,2);

add_action( 'elementor/element/accordion/section_toggle_style_content/before_section_end', function ($element, $args ) {

    $element->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name'        => 'border_accordion_content',
            'placeholder' => '1px',
            'default'     => '1px',
            'selector'    => '{{WRAPPER}} .elementor-accordion .elementor-tab-content',
            'separator'   => 'before',
        ]
    );

},10,2);
