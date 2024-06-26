<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if (!osf_is_mailchimp_activated()) {
    return;
}

use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;

class OSF_Elementor_Mailchimp extends Elementor\Widget_Base {

	public function get_name() {
		return 'opal-mailchmip';
	}

	public function get_title() {
		return __( 'MailChimp Sign-Up Form', 'maisonco-core' );
	}

	public function get_categories() {
		return array( 'opal-addons' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	public function get_script_depends() {
		return [ 'magnific-popup' ];
	}

	public function get_style_depends() {
		return [ 'magnific-popup' ];
	}


	protected function register_controls() {
		$this->start_controls_section(
			'mailchmip',
			[
				'label' => __( 'General', 'maisonco-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'hide_text',
			[
				'label'        => __( 'Hide Text', 'maisonco-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_off'    => __( 'Off', 'maisonco-core' ),
				'label_on'     => __( 'On', 'maisonco-core' ),
				'default'      => '',
				'return_value' => 'none',
				'selectors'    => [
					'{{WRAPPER}} .mc4wp-form-fields span' => 'display: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'hide_icon',
			[
				'label'        => __( 'Hide Icon', 'maisonco-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_off'    => __( 'Off', 'maisonco-core' ),
				'label_on'     => __( 'On', 'maisonco-core' ),
				'default'      => '',
				'return_value' => 'none',
				'selectors'    => [
					'{{WRAPPER}} .mc4wp-form-fields i' => 'display: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'spacing_icon',
			[
				'label'     => __( 'Icon Spacing', 'maisonco-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields i' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'setting_mailchmip',
			[
				'label' => __( 'Setting', 'maisonco-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'setting_block',
			[
				'label'     => __( 'Style Block', 'maisonco-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Off', 'maisonco-core' ),
				'label_on'  => __( 'On', 'maisonco-core' ),
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields ' => 'display: flex; flex-direction: column;',
				],
			]
		);

		$this->add_responsive_control(
			'setting_align',
			[
				'label'     => __( 'Alignment', 'maisonco-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => __( 'Left', 'maisonco-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'     => [
						'title' => __( 'Center', 'maisonco-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end'   => [
						'title' => __( 'Right', 'maisonco-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => '',
				'condition' => [
					'setting_block' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields' => 'align-items: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'width_input',
			[
				'label'      => __( 'Input Size', 'maisonco-core' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .mc4wp-form-fields input[type="email"]' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'width_button',
			[
				'label'      => __( 'Buton Size', 'maisonco-core' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .mc4wp-form-fields button[type="submit"]' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//INPUT
		$this->start_controls_section(
			'mailchip_style_input',
			[
				'label' => __( 'Input', 'maisonco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'input_bacground',
			[
				'label'     => __( 'Background Color', 'maisonco-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields input[type="email"]' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_color',
			[
				'label'     => __( 'Color', 'maisonco-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields input[type="email"]' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'placeholder_color',
			[
				'label'     => __( 'Placeholder Color', 'maisonco-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields ::-webkit-input-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .mc4wp-form-fields ::-moz-placeholder'          => 'color: {{VALUE}};',
					'{{WRAPPER}} .mc4wp-form-fields ::-ms-input-placeholder'     => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'align_input',
			[
				'label'     => __( 'Alignment', 'maisonco-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'maisonco-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'maisonco-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'maisonco-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields input[type="email"]' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(

			Group_Control_Border::get_type(),
			[
				'name'        => 'border_input',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .mc4wp-form-fields input[type="email"]',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'input_border_radius',
			[
				'label'      => __( 'Border Radius', 'maisonco-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .mc4wp-form-fields input[type="email"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'input_padding',
			[
				'label'      => __( 'Padding', 'maisonco-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .mc4wp-form-fields input[type="email"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'input_margin',
			[
				'label'      => __( 'Margin', 'maisonco-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .mc4wp-form-fields input[type="email"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//Button
		$this->start_controls_section(
			'mailchip_style_button',
			[
				'label' => __( 'Button', 'maisonco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'button_type',
            [
                'label' => __( 'Type', 'maisonco-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __( 'Primary', 'maisonco-core' ),
                    'secondary' => __( 'Secondary', 'maisonco-core' ),
                ],
                'prefix_class' => 'elementor-button-',
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'selector' => '{{WRAPPER}} .mc4wp-form-fields button[type="submit"]',
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'maisonco-core' ),
			]
		);

		$this->add_control(
			'button_bacground',
			[
				'label'     => __( 'Background Color', 'maisonco-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields button[type="submit"]' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_color',
			[
				'label'     => __( 'Color', 'maisonco-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields button[type="submit"]' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'maisonco-core' ),
			]
		);

		$this->add_control(
			'button_bacground_hover',
			[
				'label'     => __( 'Background Color', 'maisonco-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields button[type="submit"]:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_color_hover',
			[
				'label'     => __( 'Color', 'maisonco-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields button[type="submit"]:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_hover',
			[
				'label'     => __( 'Border Color', 'maisonco-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields button[type="submit"]:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_focus',
			[
				'label' => __( 'Focus', 'maisonco-core' ),
			]
		);

		$this->add_control(
			'button_bacground_focus',
			[
				'label'     => __( 'Background Color', 'maisonco-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields button[type="submit"]:forcus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_color_focus',
			[
				'label'     => __( 'Button Color', 'maisonco-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields button[type="submit"]:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_focus',
			[
				'label'     => __( 'Border Color', 'maisonco-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields button[type="submit"]:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'border_button',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .mc4wp-form-fields button[type="submit"]',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'      => __( 'Border Radius', 'maisonco-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .mc4wp-form-fields button[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => __( 'Padding', 'maisonco-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .mc4wp-form-fields button[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_margin',
			[
				'label'      => __( 'Margin', 'maisonco-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .mc4wp-form-fields button[type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		echo '<div class="form-style">';
		mc4wp_show_form();
		echo '</div>';
	}
}
$widgets_manager->register(new OSF_Elementor_Mailchimp());