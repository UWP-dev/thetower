<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class OSF_Elementor_Template_Carousel extends \Elementor\Widget_Base {

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
        return 'opal-template_carousel';
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
        return __('Opal Template Carousel', 'maisonco-core');
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

    public function get_script_depends() {
        return ['swiper'];
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
            'section_template_carousel',
            [
                'label' => __('Content', 'maisonco-core'),
            ]
        );

        $templates = Elementor\Plugin::instance()->templates_manager->get_source('local')->get_items();

        $options = [
            '0' => '— ' . __('Select', 'maisonco-core') . ' —',
        ];

        $types = [];

        foreach ($templates as $template) {
            $options[$template['template_id']] = $template['title'] . ' (' . $template['type'] . ')';
            $types[$template['template_id']]   = $template['type'];
        }

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('title', [
            'label'       => __('Title', 'maisonco-core'),
            'type'        => Controls_Manager::TEXT,
            'default'     => __('Title', 'maisonco-core'),
            'label_block' => true,
        ]);

        if (empty($templates)) {

            $this->add_control(
                'no_templates',
                [
                    'label' => false,
                    'type'  => Controls_Manager::RAW_HTML,
                    'raw'   => '<div id="elementor-widget-template-empty-templates">
				<div class="elementor-widget-template-empty-templates-icon"><i class="eicon-nerd"></i></div>
				<div class="elementor-widget-template-empty-templates-title">' . __('You Haven’t Saved Templates Yet.', 'maisonco-core') . '</div>
				<div class="elementor-widget-template-empty-templates-footer">' . __('Want to learn more about Elementor library?', 'maisonco-core') . ' <a class="elementor-widget-template-empty-templates-footer-url" href="https://go.elementor.com/docs-library/" target="_blank">' . __('Click Here', 'maisonco-core') . '</a>
				</div>
				</div>',
                ]
            );

            return;
        }

        $repeater->add_control(
            'template_id',
            [
                'label'       => __('Choose Template', 'maisonco-core'),
                'type'        => Controls_Manager::SELECT,
                'default'     => '0',
                'options'     => $options,
                'types'       => $types,
                'label_block' => 'true',
            ]
        );

        $this->add_control(
            'contents',
            [
                'label'       => __('Content Item', 'maisonco-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        if (!empty($settings['contents']) && is_array($settings['contents'])) {
            $this->add_render_attribute('wrapper', 'class', 'swiper-container home-main-carousel');
            $this->add_render_attribute('wrapper_inner', 'class', 'swiper-wrapper');
            $this->add_render_attribute('item', 'class', 'swiper-slide');
            $caption = [];
            ?>
            <div <?php $this->print_render_attribute_string('wrapper'); ?>>
                <div <?php $this->print_render_attribute_string('wrapper_inner') ?>>
                    <?php foreach ($settings['contents'] as $item): ?>
                        <div <?php $this->print_render_attribute_string('item'); ?>>
                            <?php
                            $caption[] = $item[ 'title' ];
                            $template_id = $item[ 'template_id' ];
                            $template_id = apply_filters( 'wpml_object_id', $template_id, 'elementor_library' );
                            echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $template_id );
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination" data-caption="<?php echo esc_attr(json_encode($caption));?>"></div>
            </div>
            <?php
        }
    }
}

$widgets_manager->register(new OSF_Elementor_Template_Carousel());
