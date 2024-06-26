<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


class OSF_Widget_Apartment_Info extends Widget_Base {


    public function get_name() {
        return 'apartment-info';
    }

    public function get_title() {
        return __( 'Opal Apartment Info', 'maisonco-core' );
    }

    public function get_icon() {
        return 'eicon-bullet-list';
    }

    public function get_categories()
    {
        return array('opal-addons');
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_apartment_list',
            [
                'label' => __( 'Field Info List', 'maisonco-core' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'separation_characters',
            [
                'label' => __( 'Separation', 'maisonco-core' ),
                'type' => Controls_Manager::SWITCHER
            ]
        );

        $repeater->add_control(
            'title_name',
            [
                'label' => __( 'Name', 'maisonco-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __( 'Enter Name...', 'maisonco-core' ),
            ]
        );

        $repeater->add_control(
            'field_value',
            [
                'label' => __( 'Value', 'maisonco-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __( 'Enter Value ...', 'maisonco-core' ),
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => __( 'Link', 'maisonco-core' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => __( 'https://your-link.com', 'maisonco-core' ),
            ]
        );

        $this->add_control(
            'title_list',
            [
                'label' => '',
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title_name' => __( 'FLOOR NO', 'maisonco-core' ),
                    ],
                    [
                        'title_name' => __( 'ROOMS', 'maisonco-core' ),
                    ],
                    [
                        'title_name' => __( 'TOTAL AREA, SQ.M.', 'maisonco-core' ),
                    ],
                    [
                        'title_name' => __( 'PARKING', 'maisonco-core' ),
                    ],
                    [
                        'title_name' => __( 'PRICE', 'maisonco-core' ),
                    ],
                ],
                'title_field' => '{{{ title_name }}} : {{{ field_value }}}',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_apartment',
            [
                'label' => __( 'List', 'maisonco-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_list_item',
                'selector'    => '{{WRAPPER}} .elementor-apartment-list-item',
            ]
        );

        $this->add_control(
            'list_item_border_radius',
            [
                'label'      => __( 'Border Radius', 'maisonco-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-apartment-list-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'list_item_padding',
            [
                'label'      => __( 'Padding', 'maisonco-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-apartment-list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'list_item_margin',
            [
                'label'      => __( 'Margin', 'maisonco-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-apartment-list-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_number_style',
            [
                'label' => __( 'Number', 'maisonco-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'number_color',
            [
                'label' => __( 'Color', 'maisonco-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .character_item' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'number_background',
            [
                'label' => __( 'Background', 'maisonco-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .character_item' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __( 'Title', 'maisonco-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .elementor-title-list',

            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'maisonco-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-title-list' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_value_style',
            [
                'label' => __( 'Value', 'maisonco-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'value_typography',
                'selector' => '{{WRAPPER}} .elementor-value-list',

            ]
        );

        $this->add_control(
            'value_color',
            [
                'label' => __( 'Value Color', 'maisonco-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-value-list' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render icon list widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'apartment_list', 'class', 'elementor-apartment-list-items' );
        $this->add_render_attribute( 'apartment_item', 'class', 'elementor-apartment-list-item' );

        ?>
        <ul <?php echo $this->get_render_attribute_string('apartment_list')?>>
            <?php
            foreach ( $settings['title_list'] as $index => $item ) :

                $repeater_setting_key = $this->get_repeater_setting_key( 'field_value', 'title_list', $index );

                $this->add_render_attribute( $repeater_setting_key, 'class', 'elementor-value-list' );

                $this->add_inline_editing_attributes( $repeater_setting_key );

                $this->add_render_attribute( 'apartment_title', 'class', 'elementor-title-list' );

                ?>
                <li <?php echo $this->get_render_attribute_string('apartment_item'); ?> >
                    <?php
                    if ( ! empty( $item['link']['url'] ) ) {
                        $link_key = 'link_' . $index;

                        $this->add_render_attribute( $link_key, 'href', $item['link']['url'] );

                        if ( $item['link']['is_external'] ) {
                            $this->add_render_attribute( $link_key, 'target', '_blank' );
                        }

                        if ( $item['link']['nofollow'] ) {
                            $this->add_render_attribute( $link_key, 'rel', 'nofollow' );
                        }

                        echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
                    }

                    if ($item['separation_characters']){
                        $character = str_split($item['title_name']);
                        ?>
                        <ul class="list_character">
                            <?php
                            foreach ($character as $value){
                                if ($value !== " "){
                                    ?>
                                    <li class="character_item"><?php echo $value;?></li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                        <?php
                    }else {
                        ?>
                        <span <?php echo $this->get_render_attribute_string('apartment_title'); ?>><?php echo $item['title_name']; ?></span>
                        <?php
                    }
                        ?>
                    <?php if ( ! empty( $item['field_value'] ) ) :
                        ?>
                        <span <?php echo $this->get_render_attribute_string($repeater_setting_key);?>><?php echo $item['field_value']; ?></span>
                    <?php endif; ?>
                    <?php if ( ! empty( $item['link']['url'] ) ) : ?>
                        </a>
                    <?php endif; ?>
                </li>
            <?php
            endforeach;
            ?>
        </ul>
        <?php
    }
}

$widgets_manager->register(new OSF_Widget_Apartment_Info());