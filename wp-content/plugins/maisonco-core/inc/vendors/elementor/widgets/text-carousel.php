<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;


class OSF_Elementor_Text_Carousel extends OSF_Elementor_Carousel_Base {

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
        return 'opal-text_carousel';
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
        return __('Opal Text Carousel', 'maisonco-core');
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
        return 'eicon-slider-push';
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
            'section_text_carousel',
            [
                'label' => __('Content', 'maisonco-core'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('title', [
            'label'       => __('Title', 'maisonco-core'),
            'type'        => Controls_Manager::TEXT,
            'default'     => __('Title', 'maisonco-core'),
            'label_block' => true,
        ]);

        $repeater->add_control('subtitle', [
            'label'       => __('Sub Title', 'maisonco-core'),
            'type'        => Controls_Manager::TEXT,
            'default'     => __('Sub Title', 'maisonco-core'),
            'label_block' => true,
        ]);

        $repeater->add_control('content', [
            'label'       => __('Content', 'maisonco-core'),
            'type'        => Controls_Manager::WYSIWYG,
            'default'     => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
            'label_block' => true,
            'rows'        => '10',
        ]);

        $this->add_control(
            'contents',
            [
                'label'       => __('Content Item', 'maisonco-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->add_control(
            'text_alignment',
            [
                'label'     => __('Alignment', 'maisonco-core'),
                'type'      => Controls_Manager::CHOOSE,
                'default'   => 'center',
                'options'   => [
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
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
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

        $this->add_control(
            'subtitle_position',
            [
                'label'   => __('Subtitle Position', 'maisonco-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'after',
                'options' => [
                    'after'  => __('After Title', 'maisonco-core'),
                    'before' => __('Before Title', 'maisonco-core'),
                ],
            ]
        );


        $this->add_responsive_control(
            'column',
            [
                'label'   => __('Columns', 'maisonco-core'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 1,
                'options' => [1 => 1, 2 => 2, 3 => 3],
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

        // Style.
        $this->start_controls_section(
            'section_text_carousel_style',
            [
                'label' => __('Content', 'maisonco-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => __('Text Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .elementor-content',
            ]
        );

        $this->end_controls_section();

        // Title Style.
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
                'label'     => __('Title Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .elementor-heading-title',
            ]
        );

        $this->end_controls_section();

        // SubTitle Style.
        $this->start_controls_section(
            'section_subtitle_style',
            [
                'label' => __('Sub Title', 'maisonco-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label'     => __('Sub Title Color', 'maisonco-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .subtitle',
            ]
        );

        $this->end_controls_section();

        // Carousel Option
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
        if (!empty($settings['contents']) && is_array($settings['contents'])) {

            $this->add_render_attribute('wrapper', 'class', 'elementor-text_carousel-wrapper');

            // Row
            $this->add_render_attribute('row', 'class', 'row');

            if ($settings['enable_carousel'] === 'yes') {
                $this->add_render_attribute('row', 'class', 'owl-carousel owl-theme');
                $carousel_settings = array(
                    'navigation'         => $settings['navigation'],
                    'autoplayHoverPause' => $settings['pause_on_hover'] === 'yes' ? 'true' : 'false',
                    'autoplay'           => $settings['autoplay'] === 'yes' ? 'true' : 'false',
                    'autoplayTimeout'    => $settings['autoplay_speed'],
                    'items'              => !empty($settings['column']) ? $settings['column'] : 1,
                    'items_tablet'       => !empty($settings['column_tablet']) ? $settings['column_tablet'] : 1,
                    'items_mobile'       => !empty($settings['column_mobile']) ? $settings['column_mobile'] : 1,
                    'loop'               => $settings['infinite'] === 'yes' ? 'true' : 'false',

                );
                $this->add_render_attribute('row', 'data-settings', wp_json_encode($carousel_settings));
            }
            // Item
            $this->add_render_attribute('item', 'class', 'elementor-content-item');
            $this->add_render_attribute('item', 'class', 'column-item');

            $this->add_render_attribute('meta', 'class', 'elementor-content-meta');

            $this->add_render_attribute('title', 'class', 'elementor-heading-title');

            $this->add_render_attribute('subtitle', 'class', $settings['subtitle_position']);
            $this->add_render_attribute('subtitle', 'class', 'subtitle');

            ?>
            <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
                <div <?php echo $this->get_render_attribute_string('row') ?>>
                    <?php foreach ($settings['contents'] as $content): ?>
                        <div <?php echo $this->get_render_attribute_string('item'); ?>>
                            <?php printf('<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string('title'), $content['title']); ?>
                            <?php if (!empty($content['subtitle'])): ?>
                                <div <?php echo $this->get_render_attribute_string('subtitle') ?>><?php echo $content['subtitle'] ?></div>
                            <?php endif; ?>
                            <div class="elementor-content">
                                <?php echo $content['content']; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
        }
    }

}

$widgets_manager->register(new OSF_Elementor_Text_Carousel());
