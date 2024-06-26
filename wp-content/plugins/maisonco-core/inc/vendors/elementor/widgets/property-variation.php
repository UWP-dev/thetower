<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor property variation widget.
 *
 * Elementor widget that displays property variation.
 *
 * @since 1.0.0
 */
class OSF_Widget_Property_Variation extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve property variation widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'opal-property-variation';
    }

    /**
     * Get widget title.
     *
     * Retrieve property variation widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Opal Property Variation', 'maisonco-core' );
    }

    public function get_categories() {
        return array('opal-addons');
    }

    public function get_script_depends() {
        return [ 'magnific-popup' ];
    }

    public function get_style_depends(){
        return ['magnific-popup'];
    }

    /**
     * Get widget property variation.
     *
     * Retrieve property variation widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget property variation.
     */
    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return [ 'property variation', 'property', 'variation' ];
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
            'section_property_variation',
            [
                'label' => __( 'Property Variation', 'maisonco-core' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => __( 'Title', 'maisonco-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __( 'Title', 'maisonco-core' ),
                'default' => __( 'Title', 'maisonco-core' ),
            ]
        );

        $repeater->add_control(
            'title2',
            [
                'label' => __( 'Title 2', 'maisonco-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __( 'Title 2', 'maisonco-core' ),
                'default' => __( 'Title 2', 'maisonco-core' ),
            ]
        );

        $repeater->add_control(
            'title3',
            [
                'label' => __( 'Title 3', 'maisonco-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __( 'Title 3', 'maisonco-core' ),
                'default' => __( 'Title 3', 'maisonco-core' ),
            ]
        );

        $repeater->add_control(
            'title4',
            [
                'label' => __( 'Title 4', 'maisonco-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __( 'Title 4', 'maisonco-core' ),
                'default' => __( 'Title 4 ', 'maisonco-core' ),
            ]
        );

        $repeater->add_control(
            'title5',
            [
                'label' => __( 'Title 5', 'maisonco-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __( 'Title 5', 'maisonco-core' ),
                'default' => __( 'Title 5 ', 'maisonco-core' ),
            ]
        );

        $repeater->add_control(
            'title6',
            [
                'label' => __( 'Title 6', 'maisonco-core' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
                'placeholder' => __( 'Title 6', 'maisonco-core' ),
            ]
        );

        $this->add_control(
            'property_variation',
            [
                'label' => '',
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => __( 'TOWER PH1512', 'maisonco-core' ),
                        'title2' => __( '-', 'maisonco-core' ),
                        'title3' => __( '-', 'maisonco-core' ),
                        'title4' => __( '-', 'maisonco-core' ),
                        'title5' => __( '-', 'maisonco-core' ),
                        'title6' => __( '-', 'maisonco-core' ),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_wrapper_style',
            [
                'label' => __( 'Wrapper', 'maisonco-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
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

        $this->add_render_attribute( 'property_variation', 'class', 'opal-property-variation' );
        $this->add_render_attribute( 'property_variation_item', 'class', 'property-variation-item' );

        $this->add_render_attribute( 'button', 'class', 'button-primary' );
        $this->add_render_attribute( 'button', 'class', 'property_variation_button' );
        $this->add_render_attribute( 'button', 'role', 'button' );

        ?>
        <div <?php echo $this->get_render_attribute_string( 'property_variation' ); ?>>

            <table class="table">
                <thead>
                <tr <?php echo $this->get_render_attribute_string( 'property_variation_item' ); ?>>
                    <th> <?php echo esc_html__('RESIDENCE', 'maisonco-core')?></th>
                    <th> <?php echo esc_html__('BED/BATH', 'maisonco-core')?></th>
                    <th> <?php echo esc_html__('SQ. FT.', 'maisonco-core')?></th>
                    <th> <?php echo esc_html__('SALE PRICE', 'maisonco-core')?></th>
                    <th> <?php echo esc_html__('RENT PRICE', 'maisonco-core')?></th>
                    <th> <?php echo esc_html__('FLOOR PLAN', 'maisonco-core')?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ( $settings['property_variation'] as $index => $item ) : ?>
                    <tr <?php echo $this->get_render_attribute_string( 'property_variation_item' ); ?>>
                        <td><span><?php if(!empty($item['title'])): echo $item['title']; endif; ?></span></td>
                        <td><?php if(!empty($item['title2'])): echo $item['title2']; endif; ?></td>
                        <td><?php if(!empty($item['title3'])): echo $item['title3']; endif; ?></td>
                        <td><?php if(!empty($item['title4'])): echo $item['title4']; endif; ?></td>
                        <td><?php if(!empty($item['title5'])): echo $item['title5']; endif; ?></td>
                        <td>
                            <a data-elementor-open-lightbox="no" href="<?php echo $item['title6']['url']; ?>" <?php echo $this->get_render_attribute_string( 'button' ); ?>><?php esc_html_e('View Now', 'maisonco-core') ?></a>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>

        <?php
    }
}

$widgets_manager->register(new OSF_Widget_Property_Variation());