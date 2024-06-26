<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor icon list widget.
 *
 * Elementor widget that displays a bullet list with any chosen icons and texts.
 *
 * @since 1.0.0
 */
class OSF_Widget_Icon_List extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve icon list widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'maisonco-icon-list';
    }

    /**
     * Get widget title.
     *
     * Retrieve icon list widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title() {
        return __('Maisonco Icon List', 'maisonco-core');
    }

    /**
     * Get widget icon.
     *
     * Retrieve icon list widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-bullet-list';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @return array Widget keywords.
     * @since 2.1.0
     * @access public
     *
     */
    public function get_keywords() {
        return ['icon list', 'icon', 'list'];
    }

    /**
     * Register icon list widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_icon',
            [
                'label' => __('Icon List', 'maisonco-core'),
            ]
        );

        $this->add_control(
            'view',
            [
                'label'          => __('Layout', 'maisonco-core'),
                'type'           => Controls_Manager::CHOOSE,
                'default'        => 'traditional',
                'options'        => [
                    'traditional' => [
                        'title' => __('Default', 'maisonco-core'),
                        'icon'  => 'eicon-editor-list-ul',
                    ],
                    'inline'      => [
                        'title' => __('Inline', 'maisonco-core'),
                        'icon'  => 'eicon-ellipsis-h',
                    ],
                ],
                'render_type'    => 'template',
                'classes'        => 'elementor-control-start-end',
                'label_block'    => false,
                'style_transfer' => true,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'text',
            [
                'label'       => __('Text', 'maisonco-core'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __('List Item', 'maisonco-core'),
                'default'     => __('List Item', 'maisonco-core'),
            ]
        );

        $repeater->add_control(
            'selected_icon',
            [
                'label'       => __('Icon', 'maisonco-core'),
                'type'        => Controls_Manager::ICONS,
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
                'fa4compatibility' => 'icon',
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label'       => __('Link', 'maisonco-core'),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => __('https://your-link.com', 'maisonco-core'),
            ]
        );

        $this->add_control(
            'icon_list',
            [
                'label'       => '',
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'text' => __('List Item #1', 'maisonco-core'),
                        'selected_icon' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'text' => __('List Item #2', 'maisonco-core'),
                        'selected_icon' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'text' => __('List Item #3', 'maisonco-core'),
                        'selected_icon' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                    ],
                ],
                'title_field' => '{{{ elementor.helpers.renderIcon( this, selected_icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}} {{{ text }}}',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_icon_list',
            [
                'label' => __('List', 'maisonco-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_list_item',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-icon-list-item',
            ]
        );

        $this->add_control(
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

        $this->add_responsive_control(
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
        $this->add_responsive_control(
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

        $this->add_responsive_control(
            'icon_align',
            [
                'label'        => __('Alignment', 'maisonco-core'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left'   => [
                        'title' => __('Left', 'maisonco-core'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'maisonco-core'),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'maisonco-core'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'elementor%s-align-',
                'separator'    => 'before',
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

        $this->add_responsive_control(
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

        $this->add_responsive_control(
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

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_icon',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-icon-list-icon',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
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

        $this->start_controls_tabs('tabs_icon_style');

        $this->start_controls_tab(
            'tab_icon_normal',
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
                    '{{WRAPPER}} .elementor-icon-list-icon i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_icon_hover',
            [
                'label' => __('Hover', 'maisonco-core'),
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label'     => __('Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-icon i' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'icon_border_color_hover',
            [
                'label'     => __('Border Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-icon' => 'border-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_text_style',
            [
                'label' => __('Text', 'maisonco-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_indent',
            [
                'label'     => __('Text Indent', 'maisonco-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-list-text' => is_rtl() ? 'padding-right: {{SIZE}}{{UNIT}};' : 'padding-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'icon_typography',
                'selector' => '{{WRAPPER}} .elementor-icon-list-item',

            ]
        );

        $this->start_controls_tabs('tabs_text_style');

        $this->start_controls_tab(
            'tab_text_normal',
            [
                'label' => __('Normal', 'maisonco-core'),
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => __('Text Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-list-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_text_hover',
            [
                'label' => __('Hover', 'maisonco-core'),
            ]
        );

        $this->add_control(
            'text_color_hover',
            [
                'label'     => __('Hover', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-text' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

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
        $settings          = $this->get_settings_for_display();
        $fallback_defaults = [
            'fa fa-check',
            'fa fa-times',
            'fa fa-dot-circle-o',
        ];
        $this->add_render_attribute('icon_list', 'class', 'elementor-icon-list-items');
        $this->add_render_attribute('list_item', 'class', 'elementor-icon-list-item');

        if ('inline' === $settings['view']) {
            $this->add_render_attribute('icon_list', 'class', 'elementor-inline-items');
            $this->add_render_attribute('list_item', 'class', 'elementor-inline-item');
        }
        ?>
        <ul <?php echo $this->get_render_attribute_string('icon_list'); ?>>
            <?php
            foreach ($settings['icon_list'] as $index => $item) :
                $repeater_setting_key = $this->get_repeater_setting_key('text', 'icon_list', $index);

                $this->add_render_attribute($repeater_setting_key, 'class', 'elementor-icon-list-text');

                $this->add_inline_editing_attributes($repeater_setting_key);

                $migration_allowed = Icons_Manager::is_migration_allowed();
                ?>
                <li class="elementor-icon-list-item">
                    <?php
                    if (!empty($item['link']['url'])) {
                        $link_key = 'link_' . $index;

                        $this->add_render_attribute($link_key, 'href', $item['link']['url']);

                        if ($item['link']['is_external']) {
                            $this->add_render_attribute($link_key, 'target', '_blank');
                        }

                        if ($item['link']['nofollow']) {
                            $this->add_render_attribute($link_key, 'rel', 'nofollow');
                        }

                        echo '<a ' . $this->get_render_attribute_string($link_key) . '>';
                    }

                    // add old default
                    if (!isset($item['icon']) && !$migration_allowed) {
                        $item['icon'] = isset($fallback_defaults[$index]) ? $fallback_defaults[$index] : 'fa fa-check';
                    }

                    $migrated = isset($item['__fa4_migrated']['selected_icon']);
                    $is_new   = !isset($item['icon']) && $migration_allowed;
                    if (!empty($item['icon']) || (!empty($item['selected_icon']['value']) && $is_new)) :
                        ?>
                        <span class="elementor-icon-list-icon">
							<?php
                            if ($is_new || $migrated) {
                                Icons_Manager::render_icon($item['selected_icon'], ['aria-hidden' => 'true']);
                            } else { ?>
                                <i class="<?php echo esc_attr($item['icon']); ?>" aria-hidden="true"></i>
                            <?php } ?>
						</span>
                    <?php endif; ?>
                    <span <?php echo $this->get_render_attribute_string($repeater_setting_key); ?>><?php echo $item['text']; ?></span>
                    <?php if (!empty($item['link']['url'])) : ?>
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

$widgets_manager->register(new OSF_Widget_Icon_List());