<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Th_Icon extends Widget_Base {

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
		return 'th-icon';
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
		return esc_html__( 'Icon Box', 'autopart' );
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
		return 'eicon-favorite';
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

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */

	public function get_button_styles($key='button', $class="btn-class") {

		$this->add_control(
			$key.'_text', 
			[
				'label' => esc_html__( 'Text', 'autopart' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Read more' , 'autopart' ),
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
				'default' => 'after-text',
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

	public function get_title_styles($key='text', $class="text-class") {
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
					'{{WRAPPER}} .icon-default-wrap.style8:before' => 'background: {{VALUE}};',
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

	public function get_box_settings($key='box-key',$class="box-class",$condition=[]) {
		$this->add_responsive_control(
			$key.'_padding',
			[
				'label' => esc_html__( 'Padding', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => $condition
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
				'condition' => $condition
			]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => $key.'_background',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .'.$class,
				'condition' => $condition
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => $key.'_border',
                'label' => esc_html__( 'Border', 'autopart' ),
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .'.$class,
				'condition' => $condition
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
				'condition' => $condition
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => $key.'_shadow',
				'selector' => '{{WRAPPER}} .'.$class,
				'condition' => $condition
			]
		);
	}

	protected function register_controls() {
		$this->start_controls_section(
            'icon_box',
            [
                'label' => esc_html__( 'Icon Box', 'autopart' ),
            ]
        );

        $this->add_control(
            'icon_type', [
                'label'       => esc_html__( 'Icon Type', 'autopart' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'icon' => [
                        'title' => esc_html__( 'Icon', 'autopart' ),
                        'icon'  => 'la la-paint-brush',
                    ],
                    'image' => [
                        'title' => esc_html__( 'Image', 'autopart' ),
                        'icon'  => 'la la-image',
                    ],
                ],
                'default'       => 'icon',
            ]
        );

        $this->add_control(
			'icon_style',
			[
				'label' => esc_html__( 'Style', 'autopart' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''   => esc_html__( 'Default', 'autopart' ),
				],
			]
		);

        $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'autopart' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'las la-user',
                    'library' => 'solid',
                ],
                'condition' => [
                    'icon_type' => 'icon',
                ]
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Choose Image', 'autopart' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'icon_type' => 'image',
                ]
            ]
        );
        $this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'large',
				'separator' => 'none',
				'condition' => [
                    'icon_type' => 'image',
                ]
			]
		);

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'autopart' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'This is the heading', 'autopart' ),
                'placeholder' => esc_html__( 'Enter your title', 'autopart' ),
                'label_block' => true,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label' => esc_html__( 'Content', 'autopart' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'Click edit  to change this text.', 'autopart' ),
                'placeholder' => esc_html__( 'Enter your description', 'autopart' ),
                'separator' => 'none',
                'rows' => 10,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'icon_url',
            [
                'label' 	=>esc_html__( 'URL', 'autopart' ),
                'type' 		=> Controls_Manager::URL,
                'placeholder' =>esc_url('http://your-link.com'),
                'default' 	=> [
                    'url' 			=> '#',
                    'is_external' 	=> true,
					'nofollow' 		=> true,
                ],
                'dynamic' 	=> [
                    'active' 	=> true,
                ],
            ]
        );

        $this->add_control(
			'check_button',
			[
				'label' => esc_html__( 'Button', 'autopart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'autopart' ),
				'label_off' => esc_html__( 'Off', 'autopart' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
            'icon_position',
            [
                'label' => esc_html__( 'Icon position', 'autopart' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'autopart' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'autopart' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'top' => [
                        'title' => esc_html__( 'Top', 'autopart' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__( 'Bottom', 'autopart' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => '',
                'toggle' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'section_social',
			[
				'label' => esc_html__( 'Socials', 'autopart' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'check_social',
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
			'social_style',
			[
				'label' 	=> esc_html__( 'Style', 'autopart' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'Default', 'autopart' ),
					'style1'		=> esc_html__( 'Style1', 'autopart' ),
				],
				'condition' => [
					'check_social' => 'yes',
				]
			]
		);
		
		$repeater_social = new Repeater();
		$repeater_social->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'autopart' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'las la-user',
					'library' => 'solid',
				],
			]
		);
		$repeater_social->add_control(
			'text', 
			[
				'label' => esc_html__( 'Title', 'autopart' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Enter title' , 'autopart' ),
				'label_block' => true,
			]
		);
		$repeater_social->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'autopart' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'autopart' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
				],
			]
		);
		$repeater_social->start_controls_tabs( 'social_item_effects' );
		$repeater_social->start_controls_tab( 'social_item_normal',
			[
				'label' => esc_html__( 'Normal', 'autopart' ),
			]
		);
		$repeater_social->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elth-list-social li {{CURRENT_ITEM}} i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elth-list-social.style1 li {{CURRENT_ITEM}}' => 'border-color: {{VALUE}};',
				],
			]
		);
		$repeater_social->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_background',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .elth-list-social li {{CURRENT_ITEM}}',
			]
		);
		$repeater_social->end_controls_tab();

		$repeater_social->start_controls_tab( 'social_item_hover',
			[
				'label' => esc_html__( 'Hover', 'autopart' ),
			]
		);
		$repeater_social->add_control(
			'icon_color_hover',
			[
				'label' => esc_html__( 'Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elth-list-social li {{CURRENT_ITEM}}:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elth-list-social.style1 li {{CURRENT_ITEM}}:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$repeater_social->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_background_hover',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .elth-list-social li {{CURRENT_ITEM}}:hover',
			]
		);
		$repeater_social->end_controls_tab();
		$repeater_social->end_controls_tabs();

		$this->add_control(
			'list_social',
			[
				'label' => esc_html__( 'Add socials', 'autopart' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater_social->get_controls(),
				'title_field' => '{{{ text }}}',
				'condition' => [
					'check_social' => 'yes',
				]
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Icon/Image', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'size_icon',
			[
				'label' => esc_html__( 'Icon Size', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-wrap i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
                    'icon_type' => 'icon',
                ]
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-wrap i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .icon-default-wrap.style1:hover' => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .icon-default-wrap.style1 .readmore:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .icon-default-wrap.style3 .icon-wrap' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .icon-default-wrap.style3' => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .icon-default-wrap.style4 .icon-wrap a .number' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .icon-default-wrap.style4 .info-wrap h3 a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .icon-default-wrap.style5 .icon-wrap a .number' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .icon-default-wrap.style10 .icon-wrap a .number' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .icon-default-wrap.style7 .adv-thumb-link:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .icon-default-wrap.style7:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .icon-default-wrap.style7:before' => 'background-color: {{VALUE}};',
				],
				'condition' => [
                    'icon_type' => 'icon',
                ]
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label' => esc_html__( 'Color hover', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-wrap i:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .icon-default-wrap.style3 .icon-wrap i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .icon-default-wrap.style9:hover .info-wrap > i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .icon-default-wrap.style4 .icon-wrap a:hover .number' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .icon-default-wrap.style5 .icon-wrap a:hover .number' => 'background-color: {{VALUE}};',
				],
				'condition' => [
                    'icon_type' => 'icon',
                ]
			]
		);

		$this->add_responsive_control(
			'width_icon',
			[
				'label' => esc_html__( 'Width', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-wrap' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);	

		$this->add_responsive_control(
			'height_icon',
			[
				'label' => esc_html__( 'Height', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-wrap' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'align',
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
					'{{WRAPPER}} .icon-wrap' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->get_box_settings('icon','icon-wrap',['icon_type' => 'icon']);

		$this->start_controls_tabs( 'image_effects' );

		$this->start_controls_tab( 'normal',
			[
				'label' => esc_html__( 'Normal', 'autopart' ),
				'condition' => [
                    'icon_type' => 'image',
                ]
			]
		);

		$this->add_control(
			'opacity',
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
					'{{WRAPPER}} .icon-wrap img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .icon-wrap img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => esc_html__( 'Hover', 'autopart' ),
				'condition' => [
                    'icon_type' => 'image',
                ]
			]
		);

		$this->add_control(
			'opacity_hover',
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
					'{{WRAPPER}} .icon-wrap img:hover' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .icon-wrap img:hover',
			]
		);

		$this->add_control(
			'background_hover_transition',
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
					'{{WRAPPER}} .icon-wrap img' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' 	=> esc_html__( 'Animation', 'autopart' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''							=> esc_html__( 'None', 'autopart' ),
	                'zoom-image' 				=> esc_html__("Zoom",'autopart'),
	                'fade-out-in' 				=> esc_html__("Fade out-in",'autopart'),
	                'zoom-image fade-out-in' 	=> esc_html__("Zoom Fade out-in",'autopart'),
	                'fade-in-out' 				=> esc_html__("Fade in-out",'autopart'),
	                'zoom-rotate' 				=> esc_html__("Zoom rotate",'autopart'),
	                'zoom-rotate fade-out-in' 	=> esc_html__("Zoom rotate Fade out-in",'autopart'),
	                'overlay-image' 			=> esc_html__("Overlay",'autopart'),
	                'overlay-image zoom-image' 	=> esc_html__("Overlay Zoom",'autopart'),
	                'zoom-image line-scale' 	=> esc_html__("Zoom image line",'autopart'),
	                'gray-image' 				=> esc_html__("Gray image",'autopart'),
	                'gray-image line-scale' 	=> esc_html__("Gray image line",'autopart'),
	                'pull-curtain' 				=> esc_html__("Pull curtain",'autopart'),
	                'pull-curtain gray-image' 	=> esc_html__("Pull curtain gray image",'autopart'),
	                'pull-curtain zoom-image' 	=> esc_html__("Pull curtain zoom image",'autopart'),
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
			'section_style_info',
			[
				'label' => esc_html__( 'Info box', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'info_icon',
			[
				'label' => esc_html__( 'Width', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .info-wrap' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'align_info',
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
					'{{WRAPPER}} .info-wrap' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->get_box_settings('infobox','info-wrap');

		$this->add_responsive_control(
			'info_space',
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
					'{{WRAPPER}} .info-wrap .info-des' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__( 'Title', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_title_styles('title','info-wrap h3 a');

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
					'{{WRAPPER}} .info-wrap h3' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_des',
			[
				'label' => esc_html__( 'Description', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_text_styles('des','info-des p');

		$this->add_responsive_control(
			'des_space',
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
					'{{WRAPPER}} .info-wrap .info-des > p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'check_button' => 'yes',
				]
			]
		);

		$this->get_button_styles('button','readmore');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_number',
			[
				'label' => esc_html__( 'Number', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_title_styles('number','number');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_box',
			[
				'label' => esc_html__( 'Box', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_box_settings('box','icon-default-wrap');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_box_hover',
			[
				'label' => esc_html__( 'Box hover', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_box_settings('box_hover','icon-default-wrap:hover');

		$this->add_control(
			'box_hover_transition',
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
					'{{WRAPPER}} .icon-default-wrap' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->add_control(
			'box_hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'autopart' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_social',
			[
				'label' => esc_html__( 'Social', 'autopart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'check_social' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'social_size',
			[
				'label' => esc_html__( 'Size', 'autopart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elth-list-social li a i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'social_effects' );

		$this->start_controls_tab( 'social_normal',
			[
				'label' => esc_html__( 'Normal', 'autopart' ),
			]
		);

		$this->add_control(
			'social_color',
			[
				'label' => esc_html__( 'Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elth-list-social li a i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'social_padding',
			[
				'label' => esc_html__( 'Padding', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .elth-list-social li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'social_margin',
			[
				'label' => esc_html__( 'Margin', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .elth-list-social li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'social_border',
				'selector' => '{{WRAPPER}} .elth-list-social li a',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'social_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'autopart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elth-list-social li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'social_opacity',
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
					'{{WRAPPER}} .elth-list-social li a' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'social_shadow',
				'selector' => '{{WRAPPER}} .elth-list-social li a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'social_hover',
			[
				'label' => esc_html__( 'Hover', 'autopart' ),
			]
		);

		$this->add_control(
			'social_color_hover',
			[
				'label' => esc_html__( 'Color', 'autopart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elth-list-social li a:hover i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'social_background_hover',
				'label' => esc_html__( 'Background', 'autopart' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .elth-list-social li a:hover',
			]
		);

		$this->add_control(
			'social_opacity_hover',
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
					'{{WRAPPER}} .elth-list-social li a:hover' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_control(
			'social_hover_transition',
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
					'{{WRAPPER}} .elth-list-social li a' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->add_control(
			'social_hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'autopart' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'social_padding_wrap',
			[
				'label' => esc_html__( 'Wrap Padding', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .elth-list-social' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'social_margin_wrap',
			[
				'label' => esc_html__( 'Wrap Margin', 'autopart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .elth-list-social' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
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
		$this->add_render_attribute( 'icon-wrap', 'class', 'icon-default-wrap icon-'.$settings['icon_position'] .' '.$settings['icon_style'].' elementor-animation-'.$settings['box_hover_animation'].' active-'.$settings['set_active'] );
		$attr = array(
			'wdata'		=> $this,
			'settings'	=> $settings,
		);
		echo th_get_template_widget('icon/icon',$settings['icon_style'],$attr);
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