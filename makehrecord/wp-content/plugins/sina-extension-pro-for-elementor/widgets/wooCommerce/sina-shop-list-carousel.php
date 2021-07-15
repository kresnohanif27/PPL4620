<?php

/**
 * Shop List Carousel Widget.
 *
 * @since 1.8.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Ext_Pro_Shop_List_Carousel_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 1.8.0
	 */
	public function get_name() {
		return 'sina_ext_pro_shop_list_carousel';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.8.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Shop List Carousel', 'sina-ext-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.8.0
	 */
	public function get_icon() {
		return 'eicon-posts-carousel';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.8.0
	 */
	public function get_categories() {
		return [ 'sina-ext-pro-woocommerce' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.8.0
	 */
	public function get_keywords() {
		return [ 'sina shop', 'sina product', 'woocommerce shop', 'woocommerce product' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 1.8.0
	 */
	public function get_style_depends() {
		return [
			'owl-carousel',
			'sina-ext-pro-widgets',
		];
	}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve the list of scripts the widget belongs to.
	 *
	 * @since 1.8.0
	 */
	public function get_script_depends() {
		return [
			'jquery-owl',
			'sina-ext-pro-widgets',
		];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.8.0
	 */
	protected function _register_controls() {
		// Start Product Settings
		// =======================
			Sina_Pro_Woo_Common_Data::get_post_settings($this, false, true, false, 4, false);
		// End Product Settings
		// =====================


		// Start Purchase Button Content
		// ===============================
		$this->start_controls_section(
			'read_more_content',
			[
				'label' => esc_html__( 'Purchase Button', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'posts_read_more!' => '',
				],
			]
		);
		Sina_Common_Data::button_content( $this, '.sina-read-more', 'Purchase Now', 'read_more', false);

		$this->end_controls_section();
		// End Purchase Button Content
		// =============================


		// Start Product Layout
		// ====================
			$this->start_controls_section(
				'posts_layout',
				[
					'label' => esc_html__( 'Product Layout', 'sina-ext-pro' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

			$this->add_control(
				'post_style',
				[
					'label' => esc_html__('Select Layout', 'sina-ext-pro'),
					'type' => Sina_Controls_Manager::SINACHOOSE,
					'options' => [
						'style1' => [
							'title' => esc_html__( 'Style One', 'sina-ext-pro' ),
							'image' => SINA_EXT_PRO_URL .'assets/img/layout/style-3.jpg',
							'width' => '50%',
						],
						'style2' => [
							'title' => esc_html__( 'Style One', 'sina-ext-pro' ),
							'image' => SINA_EXT_PRO_URL .'assets/img/layout/style-4.jpg',
							'width' => '50%',
						],
					],
					'wrap_height' => 100,
					'default' => 'style1',
				]
			);
			$this->add_control(
				'odd_thumb_position',
				[
					'label'   => esc_html__( 'Post / Odd Post Thumb Position', 'sina-ext-pro' ),
					'type'    => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'sina-ext-pro' ),
							'icon' => 'eicon-h-align-left',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'sina-ext-pro' ),
							'icon' => 'eicon-h-align-right',
						],
					],
					'default' => 'left',
					'toggle' => false,
				]
			);

			// Odd Posts One Start
				$posts_style1 = new Repeater();

				$posts_style1->add_control(
					'odd_post',
					[
						'label' => esc_html__( 'Select Item', 'sina-ext-pro' ),
						'type' => Controls_Manager::SELECT,
						'options' => [
							'title' => esc_html__( 'Title', 'sina-ext-pro' ),
							'content' => esc_html__( 'Content', 'sina-ext-pro' ),
							'price' => esc_html__( 'Price', 'sina-ext-pro' ),
							'cart' => esc_html__( 'Cart', 'sina-ext-pro' ),
							'cart-and-price' => esc_html__( 'Cart and Price', 'sina-ext-pro' ),
						],
					]
				);

				$this->add_control(
					'odd_posts_layout',
					[
						'label' => esc_html__('Post / Odd Post Layout', 'sina-ext-pro'),
						'type' => Controls_Manager::REPEATER,
						'fields' => $posts_style1->get_controls(),
						'default' => [
							[
								'odd_post' => 'title',
							],
							[
								'odd_post' => 'content',
							],
						],
						'title_field' => '{{{odd_post.replace(/-|style1/gi, " ")}}}',
					]
				);
			// Odd Posts One End


			$this->add_control(
				'even_thumb_position',
				[
					'label'   => esc_html__( 'Even Post Thumb Position', 'sina-ext-pro' ),
					'type'    => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'sina-ext-pro' ),
							'icon' => 'eicon-h-align-left',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'sina-ext-pro' ),
							'icon' => 'eicon-h-align-right',
						],
					],
					'condition' => [
						'post_style' => 'style2',
					],
					'default' => 'right',
					'toggle' => false,
				]
			);

			// Even Posts One Start
				$posts_style2 = new Repeater();

				$posts_style2->add_control(
					'even_post',
					[
						'label' => esc_html__( 'Select Item', 'sina-ext-pro' ),
						'type' => Controls_Manager::SELECT,
						'options' => [
							'title' => esc_html__( 'Title', 'sina-ext-pro' ),
							'content' => esc_html__( 'Content', 'sina-ext-pro' ),
							'price' => esc_html__( 'Price', 'sina-ext-pro' ),
							'cart' => esc_html__( 'Cart', 'sina-ext-pro' ),
							'cart-and-price' => esc_html__( 'Cart and Price', 'sina-ext-pro' ),
						],
					]
				);

				$this->add_control(
					'even_posts_layout',
					[
						'label' => esc_html__('Even Post Layout', 'sina-ext-pro'),
						'type' => Controls_Manager::REPEATER,
						'fields' => $posts_style2->get_controls(),
						'default' => [
							[
								'even_post' => 'title',
							],
							[
								'even_post' => 'content',
							],
						],
						'condition' => [
							'post_style' => 'style2',
						],
						'title_field' => '{{{even_post.replace(/-|style1/gi, " ")}}}',
					]
				);
			// Even Posts One End

			$this->end_controls_section();
		// End Product Layout
		// ==================

		Sina_Pro_Woo_Common_Data::thumbnail_layout($this);

		// Start Carousel Setting
		// ========================
		$this->start_controls_section(
			'carousel_content',
			[
				'label' => esc_html__( 'Carousel Settings', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		Sina_Pro_Woo_Common_Data::carousel_settings($this);

		$this->end_controls_section();
		// End Carousel Settings
		// ======================


		Sina_Pro_Woo_Common_Data::box_grid_styles($this);
		Sina_Pro_Woo_Common_Data::thumb_styles($this, false, 250, 50);
		Sina_Pro_Woo_Common_Data::title_styles($this);
		Sina_Pro_Woo_Common_Data::content_styles($this);
		Sina_Pro_Woo_Common_Data::read_more_styles($this);
		Sina_Pro_Woo_Common_Data::price_styles($this);
		Sina_Pro_Woo_Common_Data::cart_styles($this);
		Sina_Pro_Woo_Common_Data::sale_styles($this);
		Sina_Pro_Woo_Common_Data::nav_styles($this, '.sina-pro-wc-shop-list-carousel');
		Sina_Pro_Woo_Common_Data::dots_styles($this, '.sina-pro-wc-shop-list-carousel');
	}


	protected function render() {
		$data = $this->get_settings_for_display();

		if ( class_exists( 'WooCommerce' ) ):
			if ( get_query_var('paged') ) {
				$paged = get_query_var('paged');
			} else if ( get_query_var('page') ) {
				$paged = get_query_var('page');
			} else {
				$paged = 1;
			}

			$new_offset = (int)$data['posts_offset'] + ( ( $paged - 1 ) * (int)$data['posts_num'] );
			$taxos 		= $data[ 'post_type_product' ];
			$tax_query 	= [
				'relation' => 'OR',
			];

			foreach ($taxos as $tax_name) {
				if ( isset($data['post_type_product_'.$tax_name]) && !empty($data['post_type_product_'.$tax_name]) ) {
					$tax_query[] = [
						'taxonomy' => $tax_name,
						'field'    => 'term_id',
						'terms'    => $data['post_type_product_'.$tax_name],
					];
				}
			}
			$default = [
				'post_type' 		=> 'product',
				'orderby'			=> [ $data['posts_order_by'] => $data['posts_sort'] ],
				'posts_per_page'	=> $data['posts_num'],
				'paged'				=> $paged,
				'offset'			=> $new_offset,
				'has_password'		=> false,
				'post_status'		=> 'publish',
				'post__not_in'		=> get_option( 'sticky_posts' ),
				'tax_query' 		=> $tax_query,
			];

			$posts_query = new WP_Query( $default );

			if ( $posts_query->have_posts() ):
				$i = 0;
				?>
				<div class="sina-pro-wc-shop-list-carousel owl-carousel <?php echo esc_attr( $data['dots_position'] ); ?>"
				data-item-lg="<?php echo esc_attr( $data['show_item'] ); ?>"
				data-item-md="<?php echo esc_attr( $data['show_item_tablet'] ); ?>"
				data-item-sm="<?php echo esc_attr( $data['show_item_mobile'] ); ?>"
				data-autoplay="<?php echo esc_attr( $data['autoplay'] ); ?>"
				data-pause="<?php echo esc_attr( $data['pause'] ); ?>"
				data-center="<?php echo esc_attr( $data['center'] ); ?>"
				data-slide-anim="none"
				data-slide-anim-out="none"
				data-nav="<?php echo esc_attr( $data['nav'] ); ?>"
				data-dots="<?php echo esc_attr( $data['dots'] ); ?>"
				data-mouse-drag="<?php echo esc_attr( $data['mouse_drag'] ); ?>"
				data-touch-drag="<?php echo esc_attr( $data['touch_drag'] ); ?>"
				data-loop="<?php echo esc_attr( $data['loop'] ); ?>"
				data-speed="<?php echo esc_attr( $data['speed'] ); ?>"
				data-delay="<?php echo esc_attr( $data['delay'] ); ?>">
					<?php while ( $posts_query->have_posts() ) : $posts_query->the_post();
						$i++;
						$post_index 	 = (1 == $i % 2) || 'style1' == $data['post_style'] ? 'odd' : 'even';
						$post_id  		 = get_the_ID();
						$product 		 = wc_get_product( $post_id );
						$post_title_link = $post_thumb_link = get_permalink();
						?>
							<div class="sina-pro-wc-col">
								<div class="sina-pro-wc-post <?php echo esc_attr($data['box_effects']); ?>">
								<?php
									if ( 'left' == $data[$post_index.'_thumb_position']) {
										include SINA_EXT_PRO_WOO_PARTIALS.'thumbnail-style2.php';
									}
								?>
								<div class="sina-pro-wc-thumb-<?php echo esc_attr($data[$post_index.'_thumb_position']); ?>">
									<?php
										foreach ($data[$post_index.'_posts_layout'] as $post_item) {
											include SINA_EXT_PRO_WOO_PARTIALS.$post_item[$post_index.'_post'].'.php';
										}
									?>
								</div>
								<?php
									if ( 'right' == $data[$post_index.'_thumb_position']) {
										include SINA_EXT_PRO_WOO_PARTIALS.'thumbnail-style2.php';
									}
								?>
								</div>
							</div>
						<?php
						endwhile;
						wp_reset_query();
					?>
				</div><!-- .sina-pro-wc-shop-list-carousel -->
				<?php
			else:
				printf('<h3>%s</h3>', esc_html__('No Product Found!', 'sina-ext-pro') );
			endif;
		else:
			printf('<h3>%s</h3>', esc_html__('Please install and activate the WooCommerce plugin to use this feature!', 'sina-ext-pro') );
		endif;
	}


	protected function _content_template() {

	}
}
