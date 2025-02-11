<?php
namespace Elementor;
use WP_Query;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Th_Products extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'th-products';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Products', 'autopart' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-products';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'th-category' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'hello-world' ];
	}

	public function get_button_styles($key='button', $class="btn-class") {

		$this->add_control(
			$key.'_text', 
			[
				'label' => esc_html__( 'Text', 'autopart' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'label_block' => true,
			]
		);

		$this->add_responsive_control(
			$key.'_align',
			[
				'label' => esc_html__( 'Alignment', 'autopart' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'autopart' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'autopart' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'autopart' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class.'-wrap' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => $key.'_typography',
				'selector' => '{{WRAPPER}} .'.$class,
			]
		);

		$this->add_control(
			$key.'_icon',
			[
				'label' => esc_html__( 'Icon', 'autopart' ),
				'type' => Controls_Manager::ICONS,
			]
		);

		$this->add_responsive_control(
			$key.'_size_icon',
			[
				'label' => esc_html__( 'Size icon', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$class.' i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			$key.'_icon_pos',
			[
				'label' => esc_html__( 'Icon position', 'autopart' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'after-icon',
				'options' => [
					'after-text'   => esc_html__( 'After text', 'autopart' ),
					'before-text'  => esc_html__( 'Before text', 'autopart' ),
				],
				'condition' => [
					$key.'_text!' => '',
					$key.'_icon[value]!' => '',
				]
			]
		);

		$this->add_responsive_control(
			$key.'_spacing',
			[
				'label' => esc_html__( 'Space', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class.'-wrap' => 'margin-top: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			$key.'_icon_spacing_left',
			[
				'label' => esc_html__( 'Icon Space left', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class.' i' => 'margin-left: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			$key.'_icon_spacing_right',
			[
				'label' => esc_html__( 'Icon Space right', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class.' i' => 'margin-right: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->start_controls_tabs( $key.'_effects' );

		$this->start_controls_tab( $key.'_normal',
			[
				'label' => esc_html__( 'Normal', 'autopart' ),
			]
		);

		$this->add_control(
			$key.'_color',
			[
				'label' => esc_html__( 'Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => $key.'_background',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .'.$class,
			]
		);

		$this->add_responsive_control(
			$key.'_padding',
			[
				'label' => esc_html__( 'Padding', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => $key.'_shadow',
				'selector' => '{{WRAPPER}} .'.$class,
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( $key.'_hover',
			[
				'label' => esc_html__( 'Hover', 'autopart' ),
			]
		);

		$this->add_control(
			$key.'_color_hover',
			[
				'label' => esc_html__( 'Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$class.':hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => $key.'_background_hover',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .'.$class.':hover',
			]
		);

		$this->add_responsive_control(
			$key.'_padding_hover',
			[
				'label' => esc_html__( 'Padding', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .'.$class.':hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => $key.'_shadow_hover',
				'selector' => '{{WRAPPER}} .'.$class.':hover',
			]
		);

		$this->add_control(
			$key.'_hover_transition',
			[
				'label' => esc_html__( 'Transition Duration', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
	}
	
	public function get_text_styles($key='text', $class="text-class") {
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => $key.'_typography',
				'selector' => '{{WRAPPER}} .'.$class,
			]
		);

		$this->start_controls_tabs( $key.'_effects' );

		$this->start_controls_tab( $key.'_normal',
			[
				'label' => esc_html__( 'Normal', 'autopart' ),
			]
		);

		$this->add_control(
			$key.'_color',
			[
				'label' => esc_html__( 'Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => $key.'_shadow',
				'selector' => '{{WRAPPER}} .'.$class,
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( $key.'_hover',
			[
				'label' => esc_html__( 'Hover', 'autopart' ),
			]
		);

		$this->add_control(
			$key.'_color_hover',
			[
				'label' => esc_html__( 'Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$class.':hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => $key.'_shadow_hover',
				'selector' => '{{WRAPPER}} .'.$class.':hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
	}
	public function get_thumb_styles($key='thumb', $class="thumb-image") {
		$this->start_controls_tabs( $key.'_effects' );

		$this->start_controls_tab( 'normal',
			[
				'label' => esc_html__( 'Normal', 'autopart' ),
			]
		);

		$this->add_control(
			$key.'_opacity',
			[
				'label' => esc_html__( 'Opacity', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class.' img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => $key.'_css_filters',
				'selector' => '{{WRAPPER}} .'.$class.' img',
			]
		);

		$this->add_control(
			$key.'_overlay',
			[
				'label' => esc_html__( 'Overlay', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$class.' .product-thumb-link:before' => 'background-color: {{VALUE}}; opacity: 1; visibility: visible;',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => esc_html__( 'Hover', 'autopart' ),
			]
		);

		$this->add_control(
			$key.'_opacity_hover',
			[
				'label' => esc_html__( 'Opacity', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class.':hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => $key.'_css_filters_hover',
				'selector' => '{{WRAPPER}} .'.$class.':hover img',
			]
		);

		$this->add_control(
			$key.'_overlay_hover',
			[
				'label' => esc_html__( 'Overlay', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$class.':hover .product-thumb-link:before' => 'background-color: {{VALUE}}; opacity: 1; visibility: visible;',
				],
			]
		);

		$this->add_control(
			$key.'_background_hover_transition',
			[
				'label' => esc_html__( 'Transition Duration', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class.' img' => 'transition-duration: {{SIZE}}s',
					'{{WRAPPER}} .'.$class.' .product-thumb-link::after' => 'transition-duration: {{SIZE}}s',
					'{{WRAPPER}} .'.$class.' .product-thumb-link' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->add_control(
			$key.'_hover_animation',
			[
				'label' 	=> esc_html__( 'Hover Animation', 'autopart' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'elth-post-grid',
				'options'   => [
					''					=> esc_html__( 'None', 'autopart' ),
					'zoom-thumb'		=> esc_html__( 'Zoom', 'autopart' ),
					'rotate-thumb'		=> esc_html__( 'Rotate', 'autopart' ),
					'zoomout-thumb'		=> esc_html__( 'Zoom Out', 'autopart'),
					'translate-thumb'	=> esc_html__( 'Translate', 'autopart'),
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
	}

	public function get_slider_settings() {
		$this->start_controls_section(
			'section_slider',
			[
				'label' => esc_html__( 'Slider', 'autopart' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'display' => 'elth-product-slider',
				]
			]
		);

		$this->add_responsive_control(
			'slider_items',
			[
				'label' => esc_html__( 'Items', 'autopart' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'slider_auto' => '',
				]
			]
		);

		$this->add_responsive_control(
			'slider_space',
			[
				'label' => esc_html__( 'Space(px)', 'autopart' ),
				'description'	=> esc_html__( 'For example: 20', 'autopart' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 200,
				'step' => 1,
				'default' => 0
			]
		);

		$this->add_control(
			'slider_column',
			[
				'label' => esc_html__( 'Columns', 'autopart' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 1,
			]
		);

		$this->add_control(
			'slider_speed',
			[
				'label' => esc_html__( 'Speed(ms)', 'autopart' ),
				'description'	=> esc_html__( 'For example: 3000 or 5000', 'autopart' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 3000,
				'max' => 10000,
				'step' => 100,
			]
		);		

		$this->add_control(
			'slider_auto',
			[
				'label' => esc_html__( 'Auto width', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'slider_center',
			[
				'label' => esc_html__( 'Center', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'slider_loop',
			[
				'label' => esc_html__( 'Loop', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'slider_navigation',
			[
				'label' => esc_html__( 'Navigation', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'autopart' ),
				'label_off' => esc_html__( 'Hide', 'autopart' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'slider_pagination',
			[
				'label' => esc_html__( 'Pagination', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'autopart' ),
				'label_off' => esc_html__( 'Hide', 'autopart' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();
	}

	public function get_box_image($key='box-key',$class="box-class") {
		$this->add_responsive_control(
			$key.'_padding',
			[
				'label' => esc_html__( 'Padding', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
        );

        $this->add_responsive_control(
			$key.'_margin',
			[
				'label' => esc_html__( 'Margin', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => $key.'_border',
				'selectors' => [
					'{{WRAPPER}} .'.$class.' .product-thumb-link',
					'{{WRAPPER}} .'.$class.' .product-thumb-link::before',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			$key.'_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .'.$class.' .product-thumb-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => $key.'_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .'.$class.' .product-thumb-link',
			]
		);
	}

	public function get_box_settings($key='box-key',$class="box-class") {

		$this->add_responsive_control(
			$key.'_padding_wrap',
			[
				'label' => esc_html__( 'Padding Column', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} .list-col-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

		$this->add_responsive_control(
			$key.'_padding',
			[
				'label' => esc_html__( 'Padding', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			$key.'_margin',
			[
				'label' => esc_html__( 'Margin', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => $key.'_background',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .'.$class,
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => $key.'_border',
                'label' => esc_html__( 'Border', 'autopart' ),
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .'.$class,
			]
        );

        $this->add_responsive_control(
			$key.'_radius',
			[
				'label' => esc_html__( 'Border Radius', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => $key.'_shadow',
				'selector' => '{{WRAPPER}} .'.$class,
			]
		);
	}

	public function get_box_settings2($key='box-key',$class="box-class") {

		$this->add_responsive_control(
			$key.'_padding_wrap',
			[
				'label' => esc_html__( 'Padding wrap', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} .elth-products-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			$key.'_margin_wrap',
			[
				'label' => esc_html__( 'Margin wrap', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} .elth-products-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

		$this->add_responsive_control(
			$key.'_padding',
			[
				'label' => esc_html__( 'Padding inner', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} .list-product-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			$key.'_margin',
			[
				'label' => esc_html__( 'Margin inner', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} .list-product-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => $key.'_background',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .'.$class,
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => $key.'_border',
                'label' => esc_html__( 'Border', 'autopart' ),
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .'.$class,
			]
        );

        $this->add_responsive_control(
			$key.'_radius',
			[
				'label' => esc_html__( 'Border Radius', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => $key.'_shadow',
				'selector' => '{{WRAPPER}} .'.$class,
			]
		);
	}

	public function get_slider_styles() {
		$this->start_controls_section(
			'section_style_slider_nav',
			[
				'label' => esc_html__( 'Slider Navigation', 'autopart' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'display' => 'elth-product-slider',
					'slider_navigation' => 'yes',
				]
			]
		);

		$this->add_control(
			'slider_nav_style',
			[
				'label' 	=> esc_html__( 'Navigation style', 'autopart' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'Style 1 - default', 'autopart' ),
					'slider-nav-group-top'		=> esc_html__( 'Group top', 'autopart' ),
				],
			]
		);

		$this->add_control(
			'navigation_on_hover',
			[
				'label' => esc_html__( 'Display on hover', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_responsive_control(
			'width_slider_nav',
			[
				'label' => esc_html__( 'Width', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height_slider_nav',
			[
				'label' => esc_html__( 'Height', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .swiper-button-nav i' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding_slider_nav',
			[
				'label' => esc_html__( 'Padding', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_slider_nav',
			[
				'label' => esc_html__( 'Margin', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'slider_nav_effects' );

		$this->start_controls_tab( 'slider_nav_normal',
			[
				'label' => esc_html__( 'Normal', 'autopart' ),
			]
		);		

		$this->add_control(
			'nav_color',
			[
				'label' => esc_html__( 'Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_slider_nav',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .swiper-button-nav',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_slider_nav',
				'selector' => '{{WRAPPER}} .swiper-button-nav',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_slider_nav',
				'selector' => '{{WRAPPER}} .swiper-button-nav',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_radius_slider_nav',
			[
				'label' => esc_html__( 'Border Radius', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'slider_nav_hover',
			[
				'label' => esc_html__( 'Hover', 'autopart' ),
			]
		);

		$this->add_control(
			'nav_color_hover',
			[
				'label' => esc_html__( 'Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav:hover i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_slider_nav_hover',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .swiper-button-nav:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_slider_nav_hover',
				'selector' => '{{WRAPPER}} .swiper-button-nav:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_slider_nav_hover',
				'selector' => '{{WRAPPER}} .swiper-button-nav:hover',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_radius_slider_nav_hover',
			[
				'label' => esc_html__( 'Border Radius', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();	

		$this->add_control(
			'separator_slider_nav',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_control(
			'slider_icon_next',
			[
				'label' => esc_html__( 'Icon next', 'autopart' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'la la-angle-right',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'slider_icon_prev',
			[
				'label' => esc_html__( 'Icon prev', 'autopart' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'la la-angle-left',
					'library' => 'solid',
				],
			]
		);

		$this->add_responsive_control(
			'slider_icon_size',
			[
				'label' => esc_html__( 'Size icon', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slider_nav_space',
			[
				'label' => esc_html__( 'Space', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .slider-nav-group-top ~ .swiper-button-next' => 'right: 0;',
					'{{WRAPPER}} .slider-nav-group-top ~ .swiper-button-prev' => 'left: auto;',
					'{{WRAPPER}} .slider-nav-group-top ~ .swiper-button-prev' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slider_nav_top',
			[
				'label' => esc_html__( 'Space top', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slider-nav-group-top ~ .swiper-button-next' => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .slider-nav-group-top ~ .swiper-button-prev' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'slider_nav_style' => 'slider-nav-group-top',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_slider_pag',
			[
				'label' => esc_html__( 'Slider Pagination', 'autopart' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'display' => 'elth-product-slider',
					'slider_pagination' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'width_slider_pag',
			[
				'label' => esc_html__( 'Width', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination span' => 'width: {{SIZE}}{{UNIT}};',
				], 
			]
		);

		$this->add_responsive_control(
			'height_slider_pag',
			[
				'label' => esc_html__( 'Height', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination span' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'separator_bg_normal',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_control(
			'background_pag_heading',
			[
				'label' => esc_html__( 'Normal', 'autopart' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'none',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_slider_pag',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .swiper-pagination span',
			]
		);

		$this->add_control(
			'opacity_pag',
			[
				'label' => esc_html__( 'Opacity', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination span' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_control(
			'separator_bg_active',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_control(
			'background_pag_heading_active',
			[
				'label' => esc_html__( 'Active', 'autopart' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'none',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_slider_pag_active',
				'label' => esc_html__( 'Background', 'autopart' ),
				'description'	=> esc_html__( 'Active status', 'autopart' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .swiper-pagination span.swiper-pagination-bullet-active',
			]
		);

		$this->add_control(
			'opacity_pag_active',
			[
				'label' => esc_html__( 'Opacity', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination span.swiper-pagination-bullet-active' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_control(
			'separator_shadow',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_slider_pag',
				'selector' => '{{WRAPPER}} .swiper-pagination span',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_slider_pag',
				'selector' => '{{WRAPPER}} .swiper-pagination span',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_radius_slider_pag',
			[
				'label' => esc_html__( 'Border Radius', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slider_pag_space',
			[
				'label' => esc_html__( 'Space', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		// BEGIN TAB_CONTENT
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Layout', 'autopart' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'display',
			[
				'label' 	=> esc_html__( 'Display type (Layout)', 'autopart' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'elth-product-grid',
				'options'   => [
					'elth-product-grid'		=> esc_html__( 'Grid', 'autopart' ),
					'elth-product-slider'		=> esc_html__( 'Slider', 'autopart' ),
				],
			]
		);

		$this->add_control(
			'item_style',
			[
				'label' 	=> esc_html__( 'Item style', 'autopart' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style1',
				'options'   => [
					''		=> esc_html__( 'Style 1 - default', 'autopart' ),
					'style2'		=> esc_html__( 'Style 2', 'autopart' ),
					'style3'		=> esc_html__( 'Style 3', 'autopart' ),
					'style4'		=> esc_html__( 'Style 4', 'autopart' ),
					'style5'		=> esc_html__( 'Style 5', 'autopart' ),
					'style6'		=> esc_html__( 'Style 6', 'autopart' ),
					'style7'		=> esc_html__( 'Style 7 (table)', 'autopart' ),
					'style8'		=> esc_html__( 'Style 8', 'autopart' ),
					'style9'		=> esc_html__( 'Style 9', 'autopart' ),
					'style10'		=> esc_html__( 'Style 10', 'autopart' ),
					'style11'		=> esc_html__( 'Style 11', 'autopart' ),
				],
			]
		);

		$this->add_control(
			'display_tab',
			[
				'label' => esc_html__( 'Display tab', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'item_thumbnail',
			[
				'label' => esc_html__( 'Thumbnail', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'item_title',
			[
				'label' => esc_html__( 'Title', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'item_quickview',
			[
				'label' => esc_html__( 'Quick View', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'item_label',
			[
				'label' => esc_html__( 'Label', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'item_price',
			[
				'label' => esc_html__( 'Price', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'item_rate',
			[
				'label' => esc_html__( 'Rate', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'item_button',
			[
				'label' => esc_html__( 'Button', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_posts',
			[
				'label' => esc_html__( 'Query', 'autopart' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'number',
			[
				'label' => esc_html__( 'Number', 'autopart' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 1000,
				'step' => 1,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' 	=> esc_html__( 'Order by', 'autopart' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'None', 'autopart' ),
					'ID'		=> esc_html__( 'ID', 'autopart' ),
					'author'	=> esc_html__( 'Author', 'autopart' ),
					'title'		=> esc_html__( 'Title', 'autopart' ),
					'name'		=> esc_html__( 'Name', 'autopart' ),
					'date'		=> esc_html__( 'Date', 'autopart' ),
					'modified'		=> esc_html__( 'Last Modified Date', 'autopart' ),
					'parent'		=> esc_html__( 'Parent', 'autopart' ),
					'post_views'	=> esc_html__( 'Post views', 'autopart' ),
					'rand'		=> esc_html__( 'Random', 'autopart' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' 	=> esc_html__( 'Order', 'autopart' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'DESC',
				'options'   => [
					'DESC'		=> esc_html__( 'DESC', 'autopart' ),
					'ASC'		=> esc_html__( 'ASC', 'autopart' ),
				],
			]
		);

		$this->add_control(
			'product_type',
			[
				'label' 	=> esc_html__( 'Product type', 'autopart' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					'' 				=> esc_html__('Default','autopart'),
                    'trending' 		=> esc_html__('Trending','autopart'),
                    'featured' 		=> esc_html__('Featured Products','autopart'),
                    'bestsell' 		=> esc_html__('Best Sellers','autopart'),
                    'onsale' 		=> esc_html__('On Sale','autopart'),
                    'toprate' 		=> esc_html__('Top rate','autopart'),
                    'mostview' 		=> esc_html__('Most view','autopart'),
                    'menu_order' 	=> esc_html__('Menu order','autopart'),
				],
			]
		);

		$this->add_control(
			'paged',
			[
				'label' 	=> esc_html__( 'Paged', 'autopart' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'Default (1)', 'autopart' ),
					'2'		=> esc_html__( '2', 'autopart' ),
					'3'		=> esc_html__( '3', 'autopart' ),
					'4'		=> esc_html__( '4', 'autopart' ),
					'5'		=> esc_html__( '5', 'autopart' ),
					'6'		=> esc_html__( '6', 'autopart' ),
					'7'		=> esc_html__( '7', 'autopart' ),
					'8'		=> esc_html__( '8', 'autopart' ),
				],
			]
		);

		$this->add_control(
			'custom_ids', 
			[
				'label' => esc_html__( 'Show by IDs', 'autopart' ),
				'description' => esc_html__( 'Enter IDs list. The values separated by ",". Example 11,12', 'autopart' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '11,12', 'autopart' ),
			]
		);

		$this->add_control(
			'cats', 
			[
				'label' => esc_html__( 'Categories', 'autopart' ),
				'description' => esc_html__( 'Enter slug categories. The values separated by ",". Example cat-1,cat-2. Default will show all categories', 'autopart' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'cat-1,cat-2', 'autopart' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_grid',
			[
				'label' => esc_html__( 'Grid', 'autopart' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'display' => 'elth-product-grid',
				]
			]
		);

		$this->add_responsive_control(
			'column',
			[
				'label' => esc_html__( 'Column', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 8,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 3,
				],
			]
		);

		$this->add_control(
			'grid_type',
			[
				'label' 	=> esc_html__( 'Grid type', 'autopart' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''				=> esc_html__( 'Default', 'autopart' ),
					'grid-masonry'	=> esc_html__( 'Masonry', 'autopart' ),
				],
			]
		);

		$this->add_control(
			'pagination',
			[
				'label' 	=> esc_html__( 'Grid pagination', 'autopart' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''				=> esc_html__( 'None', 'autopart' ),
					'pagination'	=> esc_html__( 'Pagination', 'autopart' ),
					'load-more'		=> esc_html__( 'Load more', 'autopart' ),
				],
			]
		);

		$this->end_controls_section();

		$this->get_slider_settings();

		$this->start_controls_section(
			'section_filter',
			[
				'label' => esc_html__( 'Filter', 'autopart' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'filter_show',
			[
				'label' => esc_html__( 'Status', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'filter_style',
			[
				'label' 	=> esc_html__( 'Style', 'autopart' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''					=> esc_html__( 'Style 1', 'autopart' ),
					'filter-col'		=> esc_html__( 'Style 2', 'autopart' ),
					'filter-col filter-col-list'	=> esc_html__( 'Style 3', 'autopart' ),
				],
				'condition' => [
					'filter_show' => 'yes',
				]
			]
		);

		$this->add_control(
			'filter_column',
			[
				'label' 	=> esc_html__( 'Column', 'autopart' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'filter-4-col',
				'options'   => [
					'filter-2-col'				=> esc_html__( '2 Column', 'autopart' ),
					'filter-3-col'				=> esc_html__( '3 Column', 'autopart' ),
					'filter-4-col'				=> esc_html__( '4 Column', 'autopart' ),
				],
				'condition' => [
					'filter_show' => 'yes',
					'filter_style' => ['filter-col','filter-col filter-col-list'],
				]
			]
		);

		$this->add_control(
			'filter_cats', 
			[
				'label' => esc_html__( 'Categories', 'autopart' ),
				'description' => esc_html__( 'Enter slug categories. The values separated by ",". Example cat-1,cat-2', 'autopart' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'cat-1,cat-2', 'autopart' ),
				'condition' => [
					'filter_show' => 'yes',
				]
			]
		);

		$this->add_control(
			'filter_price',
			[
				'label' => esc_html__( 'Price', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'filter_show' => 'yes',
				]
			]
		);

		$this->add_control(
			'filter_attr', 
			[
				'label' => esc_html__( 'Attributes', 'autopart' ),
				'description' => esc_html__( 'Enter slug attributes. The values separated by ",". Example attribute-1,attribute-2', 'autopart' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'cat-1,cat-2', 'autopart' ),
				'condition' => [
					'filter_show' => 'yes',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tab',
			[
				'label' => esc_html__( 'Tab', 'autopart' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'display_tab' => 'yes',
				]
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title', [
				'label' => esc_html__( 'Title', 'autopart' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Tab Title' , 'autopart' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'autopart' ),
				'type' => Controls_Manager::ICONS,
			]
		);

		$repeater->add_control(
			'icon_pos',
			[
				'label' => esc_html__( 'Icon position', 'autopart' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'after-icon',
				'options' => [
					'after-text'   => esc_html__( 'After text', 'autopart' ),
					'before-text'  => esc_html__( 'Before text', 'autopart' ),
				],
			]
		);

		$repeater->add_control(
			'number',
			[
				'label' => esc_html__( 'Number', 'autopart' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 1000,
				'step' => 1,
			]
		);

		$repeater->add_control(
			'orderby',
			[
				'label' 	=> esc_html__( 'Order by', 'autopart' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'None', 'autopart' ),
					'ID'		=> esc_html__( 'ID', 'autopart' ),
					'author'	=> esc_html__( 'Author', 'autopart' ),
					'title'		=> esc_html__( 'Title', 'autopart' ),
					'name'		=> esc_html__( 'Name', 'autopart' ),
					'date'		=> esc_html__( 'Date', 'autopart' ),
					'modified'		=> esc_html__( 'Last Modified Date', 'autopart' ),
					'parent'		=> esc_html__( 'Parent', 'autopart' ),
					'post_views'		=> esc_html__( 'Post views', 'autopart' ),
				],
			]
		);

		$repeater->add_control(
			'order',
			[
				'label' 	=> esc_html__( 'Order', 'autopart' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'DESC',
				'options'   => [
					'DESC'		=> esc_html__( 'DESC', 'autopart' ),
					'ASC'		=> esc_html__( 'ASC', 'autopart' ),
				],
			]
		);

		$repeater->add_control(
			'product_type',
			[
				'label' 	=> esc_html__( 'Product type', 'autopart' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'DESC',
				'options'   => [
					'' 				=> esc_html__('Default','autopart'),
                    'trending' 		=> esc_html__('Trending','autopart'),
                    'featured' 		=> esc_html__('Featured Products','autopart'),
                    'bestsell' 		=> esc_html__('Best Sellers','autopart'),
                    'onsale' 		=> esc_html__('On Sale','autopart'),
                    'toprate' 		=> esc_html__('Top rate','autopart'),
                    'mostview' 		=> esc_html__('Most view','autopart'),
                    'menu_order' 	=> esc_html__('Menu order','autopart'),
				],
			]
		);

		$repeater->add_control(
			'custom_ids', 
			[
				'label' => esc_html__( 'Show by IDs', 'autopart' ),
				'description' => esc_html__( 'Enter IDs list. The values separated by ",". Example 11,12', 'autopart' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '11,12', 'autopart' ),
			]
		);

		$repeater->add_control(
			'cats', 
			[
				'label' => esc_html__( 'Categories', 'autopart' ),
				'description' => esc_html__( 'Enter slug categories. The values separated by ",". Example cat-1,cat-2. Default will show all categories', 'autopart' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'cat-1,cat-2', 'autopart' ),
			]
		);

		$this->add_control(
			'tabs',
			[
				'label' => esc_html__( 'Add tab', 'autopart' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();
		// END TAB_CONTENT

		// BEGIN TAB_STYLE

		$this->start_controls_section(
			'section_style_item',
			[
				'label' => esc_html__( 'Item', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'item_width',
			[
				'label' => esc_html__( 'Width', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' , 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 0.01,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .product-slider-view .item-product' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .product-grid-view .list-col-item' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->get_box_settings('item','item-product');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_item_hover',
			[
				'label' => esc_html__( 'Item hover', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_box_settings('item_hover','item-product:hover');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_box_wrap',
			[
				'label' => esc_html__( 'Box wrap', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_box_settings2('item_wrap','elth-products-wrap');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_thumbnail',
			[
				'label' => esc_html__( 'Thumbnail', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'thumb_width',
			[
				'label' => esc_html__( 'Width', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' , 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 0.01,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .product-thumb' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'item_style' => ['style7','style10'],
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'large',
				'separator' => 'none',
			]
		);

		$this->get_thumb_styles('thumbnail','product-thumb');

		$this->get_box_image('thumbnail','product-thumb');

		$this->end_controls_section();

		$this->get_slider_styles();

		$this->start_controls_section(
			'section_style_slider_box',
			[
				'label' => esc_html__( 'Slider box', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'display' => 'elth-product-slider',
				]
			]
		);

		$this->get_box_settings('slider_box','swiper-container');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_info',
			[
				'label' => esc_html__( 'Info', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'info_align',
			[
				'label' => esc_html__( 'Alignment', 'autopart' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'autopart' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'autopart' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'autopart' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'autopart' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .product-info' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->get_box_settings('info','product-info');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__( 'Title', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_text_styles('title','product-info .product-title a');

		$this->add_responsive_control(
			'title_space',
			[
				'label' => esc_html__( 'Space', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .product-info .product-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_price',
			[
				'label' => esc_html__( 'Price', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'price_regular',
			[
				'label' => esc_html__( 'Regular', 'autopart' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'none',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'regular_typography',
				'selectors' => [
					'{{WRAPPER}} .product-price > span',
					'{{WRAPPER}} .product-price ins > span',
				]
			]
		);

		$this->add_control(
			'regular_color',
			[
				'label' => esc_html__( 'Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-price > span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .product-price ins > span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'price_sale',
			[
				'label' => esc_html__( 'Sale', 'autopart' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sale_typography',
				'selectors' => [
					'{{WRAPPER}} .product-price > del',
				]
			]
		);

		$this->add_control(
			'sale_color',
			[
				'label' => esc_html__( 'Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-price > del' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'separator_price',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_responsive_control(
			'price_space',
			[
				'label' => esc_html__( 'Space', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .product-info .product-price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button',
			[
				'label' => esc_html__( 'Button', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'item_button' => 'yes',
				]
			]
		);

		$this->get_button_styles('button','addcart-link');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_tab',
			[
				'label' => esc_html__( 'Tab', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);   

		$this->add_responsive_control(
			'tab_align',
			[
				'label' => esc_html__( 'Alignment', 'autopart' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'autopart' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'autopart' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'autopart' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'tab_item_width',
			[
				'label' => esc_html__( 'Item width', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tab_item_height',
			[
				'label' => esc_html__( 'Item height', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_typography',
				'selector' => '{{WRAPPER}} .nav-tabs > li > a',
			]
		);

		$this->add_responsive_control(
			'tab_size_icon',
			[
				'label' => esc_html__( 'Size icon', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tab_spacing',
			[
				'label' => esc_html__( 'Space', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .product-tab-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'tab_icon_spacing_left',
			[
				'label' => esc_html__( 'Icon Space left', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a i' => 'margin-left: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'tab_icon_spacing_right',
			[
				'label' => esc_html__( 'Icon Space right', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a i' => 'margin-right: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->start_controls_tabs( 'tab_effects' );

		$this->start_controls_tab( 'tab_normal',
			[
				'label' => esc_html__( 'Normal', 'autopart' ),
			]
		);

		$this->add_control(
			'tab_color',
			[
				'label' => esc_html__( 'Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'tab_background',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .nav-tabs > li > a',
			]
		);

		$this->add_responsive_control(
			'tab_padding',
			[
				'label' => esc_html__( 'Padding', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);	

		$this->add_responsive_control(
			'tab_margin',
			[
				'label' => esc_html__( 'Margin', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);	

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tab_border',
                'label' => esc_html__( 'Border', 'autopart' ),
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .nav-tabs > li > a',
			]
        );

        $this->add_responsive_control(
			'tab_radius',
			[
				'label' => esc_html__( 'Border Radius', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_shadow',
				'selector' => '{{WRAPPER}} .nav-tabs > li > a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_hover',
			[
				'label' => esc_html__( 'Hover', 'autopart' ),
			]
		);

		$this->add_control(
			'tab_color_hover',
			[
				'label' => esc_html__( 'Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a:hover' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'tab_background_hover',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .nav-tabs > li > a:hover',
			]
		);

		$this->add_responsive_control(
			'tab_padding_hover',
			[
				'label' => esc_html__( 'Padding', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tab_margin_hover',
			[
				'label' => esc_html__( 'Margin', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tab_border_hover',
                'label' => esc_html__( 'Border', 'autopart' ),
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .nav-tabs > li > a:hover',
			]
        );

        $this->add_responsive_control(
			'tab_radius_hover',
			[
				'label' => esc_html__( 'Border Radius', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_shadow_hover',
				'selector' => '{{WRAPPER}} .nav-tabs > li > a:hover',
			]
		);

		$this->add_control(
			'tab_hover_transition',
			[
				'label' => esc_html__( 'Transition Duration', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_active',
			[
				'label' => esc_html__( 'Active', 'autopart' ),
			]
		);

		$this->add_control(
			'tab_color_active',
			[
				'label' => esc_html__( 'Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li.active > a' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'tab_background_active',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .nav-tabs > li.active > a',
			]
		);

		$this->add_responsive_control(
			'tab_padding_active',
			[
				'label' => esc_html__( 'Padding', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
					'{{WRAPPER}} .nav-tabs > li.active > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tab_margin_active',
			[
				'label' => esc_html__( 'Margin', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
					'{{WRAPPER}} .nav-tabs > li.active > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tab_border_active',
                'label' => esc_html__( 'Border', 'autopart' ),
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .nav-tabs > li.active > a',
			]
        );

        $this->add_responsive_control(
			'tab_radius_active',
			[
				'label' => esc_html__( 'Border Radius', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li.active > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_shadow_active',
				'selector' => '{{WRAPPER}} .nav-tabs > li.active > a',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_load_more',
			[
				'label' => esc_html__( 'Load more button', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'pagination' => 'load-more',
				]
			]
		);

		$this->add_responsive_control(
			'loadmore_spacing',
			[
				'label' => esc_html__( 'Space', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .btn-loadmore' => 'margin-top: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_item_last_child',
			[
				'label' => esc_html__( 'Item last child', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_box_settings('item_last_child','list-col-item:last-child .item-product');

		$this->end_controls_section();

		// END TAB_STYLE
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings();
		$slider_items_tablet = $slider_items_mobile = $slider_items_laptop = $slider_items_tablet_extra = $slider_column = $slider_space_tablet = $slider_space_mobile = $slider_space_laptop = $slider_space_tablet_extra = $column_tablet = $column_mobile = $column_laptop = $column_tablet_extra = '';
		extract($settings);
		$view = str_replace('elth-product-', '', $display);
        if(!empty($css_class)) $el_class .= ' '.$css_class;
        $filter_show = '';
        $el_class = 'product-'.$view.'-view '.$grid_type.' filter-'.$filter_show;

		if(isset($column['size'])) $column = $column['size'];
		if(isset($column_tablet['size'])) $column_tablet = $column_tablet['size'];
		if(isset($column_mobile['size'])) $column_mobile = $column_mobile['size'];
		if(isset($column_laptop['size'])) $column_laptop = $column_laptop['size'];
		if(isset($column_tablet_extra['size'])) $column_tablet_extra = $column_tablet_extra['size'];

		$this->add_render_attribute( 'elth-wrapper', 'class', 'elth-products-wrap js-content-wrap wrap-box '.$el_class );
		$this->add_render_attribute( 'elth-inner', 'class', 'js-content-main list-product-wrap row');
		$this->add_render_attribute( 'elth-item-grid', 'class', 'list-col-item list-'.esc_attr($column).'-item list-'.esc_attr($column_tablet).'-item-tablet list-'.esc_attr($column_laptop).'-item-laptop list-'.esc_attr($column_tablet_extra).'-item-tablet-extra list-'.esc_attr($column_mobile).'-item-mobile');
		$this->add_render_attribute( 'elth-item', 'class', 'item-product-wrap product');
		if ( $view == 'slider' ) {
			$this->add_render_attribute( 'elth-wrapper', 'class', 'elth-swiper-slider swiper-container navigation-hover-'.$navigation_on_hover.' '.$slider_nav_style );
			$this->add_render_attribute( 'elth-wrapper', 'data-items', $slider_items );
			$this->add_render_attribute( 'elth-wrapper', 'data-items-tablet', $slider_items_tablet);
			$this->add_render_attribute( 'elth-wrapper', 'data-items-mobile', $slider_items_mobile );
			$this->add_render_attribute( 'elth-wrapper', 'data-items-laptop', $slider_items_laptop );
			$this->add_render_attribute( 'elth-wrapper', 'data-items-extra_tablet', $slider_items_tablet_extra);
			$this->add_render_attribute( 'elth-wrapper', 'data-space', $slider_space );
			$this->add_render_attribute( 'elth-wrapper', 'data-space-tablet', $slider_space_tablet );
			$this->add_render_attribute( 'elth-wrapper', 'data-space-mobile', $slider_space_mobile );
			$this->add_render_attribute( 'elth-wrapper', 'data-space-laptop', $slider_space_laptop );
			$this->add_render_attribute( 'elth-wrapper', 'data-space-extra_tablet', $slider_space_tablet_extra);
			$this->add_render_attribute( 'elth-wrapper', 'data-column', $slider_column );
			$this->add_render_attribute( 'elth-wrapper', 'data-auto', $slider_auto );
			$this->add_render_attribute( 'elth-wrapper', 'data-center', $slider_center );
			$this->add_render_attribute( 'elth-wrapper', 'data-loop', $slider_loop );
			$this->add_render_attribute( 'elth-wrapper', 'data-speed', $slider_speed );
			$this->add_render_attribute( 'elth-wrapper', 'data-navigation', $slider_navigation );
			$this->add_render_attribute( 'elth-wrapper', 'data-pagination', $slider_pagination );
			$this->add_render_attribute( 'elth-inner', 'class', 'swiper-wrapper' );
			$this->add_render_attribute( 'elth-item', 'class', 'swiper-slide' );
		}
		else{
			$this->add_render_attribute( 'elth-wrapper', 'data-column', $column );
			$this->add_render_attribute( 'elth-wrapper', 'data-column-tablet', $column_tablet );
			$this->add_render_attribute( 'elth-wrapper', 'data-column-mobile', $column_mobile );
		}
        if(empty($paged)) $paged = 1;
        $paged = (get_query_var('paged') && $view != 'slider') ? get_query_var('paged') : $paged;
        $args = array(
            'post_type'         => 'product',
            'posts_per_page'    => $number,
            'orderby'           => $orderby,
            'order'             => $order,
            'paged'             => $paged,
            );
        if($product_type == 'trending'){
            $args['meta_query'][] = array(
                    'key'     => 'trending_product',
                    'value'   => '1',
                    'compare' => '=',
                );
        }
        if($product_type == 'toprate'){
            $args['meta_key'] = '_wc_average_rating';
            $args['orderby'] = 'meta_value_num';
            $args['meta_query'] = WC()->query->get_meta_query();
            $args['tax_query'][] = WC()->query->get_tax_query();
        }
        if($product_type == 'mostview'){
            $args['meta_key'] = 'post_views';
            $args['orderby'] = 'meta_value_num';
        }
        if($product_type == 'menu_order'){
            $args['meta_key'] = 'menu_order';
            $args['orderby'] = 'meta_value_num';
        }
        if($product_type == 'bestsell'){
            $args['meta_key'] = 'total_sales';
            $args['orderby'] = 'meta_value_num';
        }
        if($product_type=='onsale'){
            $args['meta_query']['relation']= 'OR';
            $args['meta_query'][]=array(
                'key'   => '_sale_price',
                'value' => 0,
                'compare' => '>',                
                'type'          => 'numeric'
            );
            $args['meta_query'][]=array(
                'key'   => '_min_variation_sale_price',
                'value' => 0,
                'compare' => '>',                
                'type'          => 'numeric'
            );
        }
        if($product_type == 'featured'){
            $args['tax_query'][] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
                'operator' => 'IN',
            );
        }
        if(!empty($cats)) {
            $custom_list = explode(",",$cats);
            $args['tax_query'][]=array(
                'taxonomy'=>'product_cat',
                'field'=>'slug',
                'terms'=> $custom_list
            );
        }
        if(!empty($custom_ids)){
            $args['post__in'] = explode(',', $custom_ids);
        }
        $args['tax_query'][] = array(
            'taxonomy' => 'product_visibility',
            'field'    => 'name',
            'terms'    => 'exclude-from-catalog',
            'operator' => 'NOT IN',
        );
        $product_query = new WP_Query($args);
        $count = 1;
        $count_query = $product_query->post_count;
        $max_page = $product_query->max_num_pages;
        $size = $thumbnail_size;
        if($size == 'custom' && isset($thumbnail_custom_dimension)) $size = array($thumbnail_custom_dimension['width'],$thumbnail_custom_dimension['height']);        
        $item_wrap = $this->get_render_attribute_string( 'elth-item-grid' );
        $item_inner = $this->get_render_attribute_string( 'elth-item' );
        $attr = array(
            'el_class'      => $el_class,
            'product_query' => $product_query,
            'count'         => $count,
            'count_query'   => $count_query,
            'max_page'      => $max_page,
            'args'          => $args,
            'column'        => $column,
            'slider_column '=> (int) $slider_column,
            'view'       	=> $view,
            'settings'      => $settings,
            'size'      	=> $size,
            'item_wrap'		=> $item_wrap,
            'item_inner'	=> $item_inner,
            'wdata'			=> $this,
        );
        if($display_tab == 'yes' && is_array($tabs) && count($tabs) >=1){
        	$tab_title_html = $tab_content_html = '';
        	foreach ($tabs as $key => $tab) {
        		extract($tab);
        		if($key == 0) $active = 'active';
        		else $active = '';
        		$args = array(
		            'post_type'         => 'product',
		            'posts_per_page'    => $number,
		            'orderby'           => $orderby,
		            'order'             => $order,
		            'paged'             => $paged,
		            );
		        if($product_type == 'trending'){
		            $args['meta_query'][] = array(
		                    'key'     => 'trending_product',
		                    'value'   => '1',
		                    'compare' => '=',
		                );
		        }
		        if($product_type == 'toprate'){
		            $args['meta_key'] = '_wc_average_rating';
		            $args['orderby'] = 'meta_value_num';
		            $args['meta_query'] = WC()->query->get_meta_query();
		            $args['tax_query'][] = WC()->query->get_tax_query();
		        }
		        if($product_type == 'mostview'){
		            $args['meta_key'] = 'post_views';
		            $args['orderby'] = 'meta_value_num';
		        }
		        if($product_type == 'menu_order'){
		            $args['meta_key'] = 'menu_order';
		            $args['orderby'] = 'meta_value_num';
		        }
		        if($product_type == 'bestsell'){
		            $args['meta_key'] = 'total_sales';
		            $args['orderby'] = 'meta_value_num';
		        }
		        if($product_type=='onsale'){
		            $args['meta_query']['relation']= 'OR';
		            $args['meta_query'][]=array(
		                'key'   => '_sale_price',
		                'value' => 0,
		                'compare' => '>',                
		                'type'          => 'numeric'
		            );
		            $args['meta_query'][]=array(
		                'key'   => '_min_variation_sale_price',
		                'value' => 0,
		                'compare' => '>',                
		                'type'          => 'numeric'
		            );
		        }
		        if($product_type == 'featured'){
		            $args['tax_query'][] = array(
		                'taxonomy' => 'product_visibility',
		                'field'    => 'name',
		                'terms'    => 'featured',
		                'operator' => 'IN',
		            );
		        }
		        if(!empty($cats)) {
		            $custom_list = explode(",",$cats);
		            $args['tax_query'][]=array(
		                'taxonomy'=>'product_cat',
		                'field'=>'slug',
		                'terms'=> $custom_list
		            );
		        }
		        if(!empty($custom_ids)){
		            $args['post__in'] = explode(',', $custom_ids);
		        }
		        $args['tax_query'][] = array(
		            'taxonomy' => 'product_visibility',
		            'field'    => 'name',
		            'terms'    => 'exclude-from-catalog',
		            'operator' => 'NOT IN',
		        );
		        $attr['args'] = $args;
		        $product_query = new WP_Query($args);
		        $count = 1;
		        $count_query = $product_query->post_count;
		        $max_page = $product_query->max_num_pages;
		        $attr['product_query'] = $product_query;
		        $attr['count'] = $count;
		        $attr['count_query'] = $count_query;
		        $attr['max_page'] = $max_page;
		        $_id = $_id.uniqid();
        		$tab_title_html .= 	'<li class="tab-item-wrap '.$active.'">
        								<a href="#'.$_id.'" data-target="#'.$_id.'" data-toggle="tab" aria-expanded="false">';
        		if($icon_pos != 'after-text' && $icon['value']) $tab_title_html .= '<i class="'.$icon['value'].'"></i>';
        		$tab_title_html .=		$title;
        		if($icon_pos == 'after-text' && $icon['value']) $tab_title_html .= '<i class="'.$icon['value'].'"></i>';
        		$tab_title_html .=		'</a>
        							</li>';
        		$tab_content_html .= '<div id="'.$_id.'" class="tab-pane '.$active.'">';
        		$tab_content_html .= th_get_template_widget('products/'.$view,$item_style,$attr,false);
        		$tab_content_html .= '</div>';        		
        	}
        	echo 	'<div class="product-tab-wrap">
        				<div class="product-tab-title">
							<ul class="list-none nav nav-tabs" role="tablist">
								'.$tab_title_html.'
							</ul>
						</div>
						<div class="product-tab-content">
							<div class="tab-content">
								'.$tab_content_html.'
							</div>
						</div>
					</div>';
        }
        else th_get_template_widget('products/'.$view,$item_style,$attr,true);
        wp_reset_postdata();
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template() {
		
	}
}