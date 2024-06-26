<?php

namespace Elementor;
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!defined('WPINC')) {
    exit;
}

class OSF_Elementor_Panorama_View extends Widget_Base {

    public function get_name() {
        return 'opal-panorama';
    }

    public function get_title() {
        return __('Opal IPanorama 360', 'maisonco-core');
    }

    public function get_categories() {
        return array('opal-addons');
    }

    public function get_keywords() {
        return ['view 360', '360', 'panorama'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'panorama_setting',
            [
                'label' => __('Layout', 'maisonco-core'),
            ]
        );

        $this->add_control(
            'slug',
            [
                'label'       => __('Ipanorama', 'maisonco-core'),
                'type'        => Controls_Manager::SELECT,
                'options'     => $this->get_form_ids(),
                'description' => __('Enter a comma-separated list of form IDs. If empty, all published forms are displayed.', 'maisonco-core'),
            ]
        );

        $this->add_control(
            'custome_size',
            [
                'label'     => __('Custome Size', 'maisonco-core'),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => 'Hide',
                'label_off' => 'Show',
                'default'   => 'no',
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label'      => __('Width', 'maisonco-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'condition'  => [
                    'custome_size' => 'yes'
                ]
            ]
        );
        $this->add_responsive_control(
            'height',
            [
                'label'      => __('Height', 'maisonco-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'condition'  => [
                    'custome_size' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['slug'])) {
            return;
        }

        $atts = [
            'slug' => $settings['slug'],
        ];
        if ($settings['custome_size'] == 'yes') {
            $atts['width'] = join(array_reverse($settings['width']));
            $atts['height'] = join(array_reverse($settings['height']));
        }
        $code = '';
        foreach ($atts as $key => $value) {
            $code .= $key . '="' . (empty($value) ? 'false' : $value) . '" ';
        }

        echo do_shortcode('[ipanorama ' . $code . ' ]');

    }

    private function get_form_ids() {
        $args = array(
            'post_type'      => 'ipnrm_item',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
        );
        $panorama_ids = array();
        $panoramas = get_posts($args);
        foreach ($panoramas as $panorama) {
            $panorama_title = empty($panorama->post_title) ? sprintf(__('Untitled (#%s)', 'maisonco-core'), $panorama->post_name) : $panorama->post_title;
            $panorama_ids[$panorama->post_name] = $panorama_title;
        }
        return $panorama_ids;
    }
}

$widgets_manager->register(new OSF_Elementor_Panorama_View());