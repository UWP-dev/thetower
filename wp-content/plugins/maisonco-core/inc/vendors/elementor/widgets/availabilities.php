<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor property variation widget.
 *
 * Elementor widget that displays property variation.
 *
 * @since 1.0.0
 */
class OSF_Widget_Availabilities extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve property variation widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'opal-availabilities';
    }

    /**
     * Get widget title.
     *
     * Retrieve property variation widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title() {
        return __('Opal Availabilities', 'maisonco-core');
    }

    public function get_categories() {
        return array('opal-addons');
    }

    public function get_script_depends() {
        return ['magnific-popup', 'scrollbar'];
    }

    public function get_style_depends() {
        return ['magnific-popup', 'scrollbar'];
    }

    /**
     * Get widget property variation.
     *
     * Retrieve property variation widget icon.
     *
     * @return string Widget property variation.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-gallery-grid';
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
        return ['property variation', 'property', 'variation', 'availabilities', 'availability'];
    }

    /**
     * Register property variation widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_availability',
            [
                'label' => __('Availability', 'maisonco-core'),
            ]
        );

        $cf7 = get_posts('post_type="wpcf7_contact_form"&numberposts=-1');

        $contact_forms[''] = __('Please select form', 'maisonco-core');
        if ($cf7) {
            foreach ($cf7 as $cform) {
                $contact_forms[$cform->post_name] = $cform->post_title;
            }
        } else {
            $contact_forms[0] = __('No contact forms found', 'maisonco-core');
        }

        $this->add_control(
            'contact_slug',
            [
                'label'   => __('Select contact form', 'maisonco-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => $contact_forms,
            ]
        );

        $this->add_control(
            'link_download',
            [
                'label' => __('Floorplan Link', 'maisonco-core'),
                'type'  => Controls_Manager::URL,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_availability_header',
            [
                'label' => __('Availability Header', 'maisonco-core'),
            ]
        );
        $this->add_control(
            'header_1',
            [
                'label'   => __('Title 1', 'maisonco-core'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'BEDROOM'
            ]
        );
        $this->add_control(
            'header_2',
            [
                'label'   => __('Title 2', 'maisonco-core'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'BATH'
            ]
        );
        $this->add_control(
            'header_3',
            [
                'label'   => __('Title 3', 'maisonco-core'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'FLR'
            ]
        );
        $this->add_control(
            'header_4',
            [
                'label'   => __('Title 4', 'maisonco-core'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'EXTERIOR <span>SF SM</span>'
            ]
        );
        $this->add_control(
            'header_5',
            [
                'label'   => __('Title 5', 'maisonco-core'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'M<sup>2</sup>'
            ]
        );
        $this->add_control(
            'header_6',
            [
                'label'   => __('Title 6', 'maisonco-core'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'COMMON CHARGES'
            ]
        );
        $this->add_control(
            'header_7',
            [
                'label'   => __('Title 7', 'maisonco-core'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'RE TAX <span>(W. 421-A)</span>'
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_availability_content',
            [
                'label' => __('Property Variation Content', 'maisonco-core'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label'       => __('Name', 'maisonco-core'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __('Name...', 'maisonco-core'),
            ]
        );

        $repeater->add_control(
            'price_status',
            [
                'label'       => __('Price Status', 'maisonco-core'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __('Price Status', 'maisonco-core'),
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'       => __('Value 1', 'maisonco-core'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __('Value...', 'maisonco-core'),
            ]
        );

        $repeater->add_control(
            'title2',
            [
                'label'       => __('Value 2', 'maisonco-core'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __('Value...', 'maisonco-core'),
            ]
        );

        $repeater->add_control(
            'title3',
            [
                'label'       => __('Value 3', 'maisonco-core'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __('Value...', 'maisonco-core'),
            ]
        );

        $repeater->add_control(
            'title4',
            [
                'label'       => __('Value 4', 'maisonco-core'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __('Value...', 'maisonco-core'),
            ]
        );

        $repeater->add_control(
            'title5',
            [
                'label'       => __('Value 5', 'maisonco-core'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __('Value...', 'maisonco-core'),
            ]
        );

        $repeater->add_control(
            'title6',
            [
                'label'       => __('Value 6', 'maisonco-core'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __('Value...', 'maisonco-core'),
            ]
        );

        $repeater->add_control(
            'title7',
            [
                'label'       => __('Value 7', 'maisonco-core'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __('Value...', 'maisonco-core'),
            ]
        );

        $repeater->add_control(
            'preview_image',
            [
                'label'       => __('Image', 'maisonco-core'),
                'type'        => Controls_Manager::MEDIA,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'availability',
            [
                'label'       => '',
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'name'         => __('TOWER PH1512', 'maisonco-core'),
                        'price_status' => __('IN CONTRACT', 'maisonco-core'),
                    ],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );


        $this->end_controls_section();
    }


    public function get_contact_form() {
        $cf7 = get_posts('post_type="wpcf7_contact_form"&numberposts=-1');

        $contact_forms[''] = __('Please select form', 'maisonco-core');
        if ($cf7) {
            foreach ($cf7 as $cform) {
                $contact_forms[$cform->post_name] = $cform->post_title;
            }
        } else {
            $contact_forms[0] = __('No contact forms found', 'maisonco-core');
        }
        return $contact_forms;
    }

    private function get_contact_id($slug) {
        $contact = get_page_by_path($slug, OBJECT, 'wpcf7_contact_form');
        if ($contact) {
            return $contact;
        }

        return false;
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
        $this->add_render_attribute('availability', 'class', 'opal-availabilities');
        $this->add_render_attribute('availability_item', 'class', 'availabilities-item');

        $contact = $this->get_contact_id($settings['contact_slug']);

        if (!empty($settings['link_download']['url'])) {
            $this->add_render_attribute('button-download', 'href', $settings['link_download']['url']);
            $this->add_render_attribute('button-download', 'class', 'button-primary');

            if ($settings['link_download']['is_external']) {
                $this->add_render_attribute('button-download', 'target', '_blank');
            }

            if ($settings['link_download']['nofollow']) {
                $this->add_render_attribute('button-download', 'rel', 'nofollow');
            }
        }

        if ($contact) {
            $this->set_render_attribute('button', 'href', '#opal-contactform-popup-' . esc_attr($this->get_id()));
            $this->add_render_attribute('button', 'data-effect', 'mfp-zoom-in');
            $this->add_render_attribute('button', 'class', 'button-primary contactform-button');
            $this->add_render_attribute('button-wrapper', 'class', 'availabilities-button');
        }

        ?>

        <div <?php echo $this->get_render_attribute_string('availability'); ?>>
            <div class="availability-content">
                <div class="scrollbar-inner">
                    <?php foreach ($settings['availability'] as $index => $item) : ?>
                        <div class="availability-content-item <?php echo $index == 0 ? $index . ' active' : ''; ?>" data-focus=".availability-image-item-<?php echo $index; ?>">
                            <div class="header-availabilities">
                                <div class="header-title"><h5 class="m-0"><?php echo $item['name']; ?></h5></div>
                                <div class="price-status">
                                    <span><?php echo $item['price_status']; ?></span>
                                </div>
                            </div>
                            <div class="content-availabilities">
                                <table class="table">
                                    <thead>
                                    <tr <?php echo $this->get_render_attribute_string('availability_item'); ?>>
                                        <th><?php if (!empty($settings['header_1'])): echo $settings['header_1']; endif; ?></th>
                                        <th><?php if (!empty($settings['header_1'])): echo $settings['header_2']; endif; ?></th>
                                        <th><?php if (!empty($settings['header_1'])): echo $settings['header_3']; endif; ?></th>
                                        <th><?php if (!empty($settings['header_1'])): echo $settings['header_4']; endif; ?></th>
                                        <th><?php if (!empty($settings['header_1'])): echo $settings['header_5']; endif; ?></th>
                                        <th><?php if (!empty($settings['header_1'])): echo $settings['header_6']; endif; ?></th>
                                        <th><?php if (!empty($settings['header_1'])): echo $settings['header_7']; endif; ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr <?php echo $this->get_render_attribute_string('availability_item'); ?>>
                                        <td><?php echo (empty($item['title'])) ? '_' : $item['title']; ?></td>
                                        <td><?php echo (empty($item['title2'])) ? '_' : $item['title2']; ?></td>
                                        <td><?php echo (empty($item['title3'])) ? '_' : $item['title3']; ?></td>
                                        <td><?php echo (empty($item['title4'])) ? '_' : $item['title4']; ?></td>
                                        <td><?php echo (empty($item['title5'])) ? '_' : $item['title5']; ?></td>
                                        <td><?php echo (empty($item['title6'])) ? '_' : $item['title6']; ?></td>
                                        <td><?php echo (empty($item['title7'])) ? '_' : $item['title7']; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a data-elementor-open-lightbox="no" href="<?php echo $item['preview_image']['url']; ?>" class="view-photo button-primary"><?php esc_html_e('View Photo', 'maisonco-core') ?></a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="availability-image">
                <?php foreach ($settings['availability'] as $index => $item) : ?>
                    <div class="availability-image-item availability-image-item-<?php echo $index == 0 ? $index . ' active' : $index; ?>">
                        <?php echo wp_get_attachment_image($item['preview_image']['id'], 'full'); ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="availability-action">
                <?php if ($contact) { ?>
                    <div <?php echo $this->get_render_attribute_string('button-wrapper'); ?>>
                        <a <?php echo $this->get_render_attribute_string('button'); ?>><?php echo esc_html__('Schedule An Appoinment', 'maisonco-core') ?></a>
                    </div>
                <?php } ?>
                <?php if ($settings['link_download']) { ?>
                    <div <?php echo $this->get_render_attribute_string('button-wrapper'); ?>>
                        <a <?php echo $this->get_render_attribute_string('button-download'); ?>><i class="opal-icon-file-download mr-2" aria-hidden="true"></i><?php echo esc_html__('Download Floorplan', 'maisonco-core') ?>
                        </a>
                    </div>
                <?php } ?>

            </div>
        </div>
        <?php
        if ($contact) {
            ?>
            <div id="opal-contactform-popup-<?php echo esc_attr($this->get_id()); ?>" class="mfp-hide contactform-content">
                <div class="heading-form">
                    <div class="form-title"><?php echo esc_html($contact->post_title); ?></div>
                </div>
                <?php echo osf_do_shortcode('contact-form-7', array(
                    'id'    => $contact->ID,
                    'title' => $contact->post_title
                )); ?>
            </div>
            <?php
        }
    }
}

$widgets_manager->register(new OSF_Widget_Availabilities());