<?php

/**
 * Shop Box Grid Widget.
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

class Sina_Ext_Pro_Shop_Box_Grid_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.8.0
	 */
	public function get_name() {
		return 'sina_ext_pro_shop_box_grid';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.8.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Shop Box Grid', 'sina-ext-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.8.0
	 */
	public function get_icon() {
		return 'eicon-gallery-grid';
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
			'sina-ext-pro-widgets',
		];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.8.0
	 * @access protected
	 */
	protected function _register_controls() {
		// Start Product Settings
		// =======================
			Sina_Pro_Woo_Common_Data::get_post_settings($this, true, true, true);
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
		// ======================
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
							'image' => SINA_EXT_PRO_URL .'assets/img/layout/style-1.jpg',
							'width' => '50%',
						],
						'style2' => [
							'title' => esc_html__( 'Style One', 'sina-ext-pro' ),
							'image' => SINA_EXT_PRO_URL .'assets/img/layout/style-2.jpg',
							'width' => '50%',
						],
					],
					'wrap_height' => 100,
					'default' => 'style1',
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
							'thumbnail-style1' => esc_html__( 'Thumbnail', 'sina-ext-pro' ),
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
								'odd_post' => 'thumbnail-style1',
							],
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


			// Even Posts One Start
				$posts_style2 = new Repeater();

				$posts_style2->add_control(
					'even_post',
					[
						'label' => esc_html__( 'Select Item', 'sina-ext-pro' ),
						'type' => Controls_Manager::SELECT,
						'options' => [
							'title' => esc_html__( 'Title', 'sina-ext-pro' ),
							'thumbnail-style1' => esc_html__( 'Thumbnail', 'sina-ext-pro' ),
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
							[
								'even_post' => 'thumbnail-style1',
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
		// ====================

		Sina_Pro_Woo_Common_Data::thumbnail_layout($this);
		Sina_Pro_Woo_Common_Data::box_grid_styles($this);
		Sina_Pro_Woo_Common_Data::thumb_styles($this, true, 220);
		Sina_Pro_Woo_Common_Data::title_styles($this);
		Sina_Pro_Woo_Common_Data::content_styles($this);
		Sina_Pro_Woo_Common_Data::read_more_styles($this);
		Sina_Pro_Woo_Common_Data::price_styles($this);
		Sina_Pro_Woo_Common_Data::cart_styles($this);
		Sina_Pro_Woo_Common_Data::sale_styles($this);
		Sina_Pro_Woo_Common_Data::pagination_styles($this);
	}


	protected function render() {
		$data = $this->get_settings_for_display();

		if ( class_exists( 'WooCommerce' ) ):
			include SINA_EXT_PRO_WOO_PARTIALS.'filter-query.php';
			if ( $posts_query->have_posts() ):
				$i = 0;
				?>
				<div class="sina-pro-wc-shop-box-grid">
					<?php include SINA_EXT_PRO_WOO_PARTIALS.'top-pagination.php'; ?>

					<div class="sina-pro-wc-posts-wrap">
					<?php while ( $posts_query->have_posts() ) : $posts_query->the_post();
						$i++;
						$post_index 	 = (1 == $i % 2) || 'style1' == $data['post_style'] ? 'odd' : 'even';
						$post_id  		 = get_the_ID();
						$product 		 = wc_get_product( $post_id );
						$post_title_link = $post_thumb_link = get_permalink();
						?>
							<div class="sina-pro-wc-col <?php echo esc_attr($data['posts_columns']); ?>">
								<div class="sina-pro-wc-post <?php echo esc_attr($data['box_effects']); ?>">
								<?php
									foreach ($data[$post_index.'_posts_layout'] as $post_item) {
										include SINA_EXT_PRO_WOO_PARTIALS.$post_item[$post_index.'_post'].'.php';
									}
								?>
								</div>
							</div>
						<?php
						endwhile;
						wp_reset_query();
					?>
					</div>

					<?php include SINA_EXT_PRO_WOO_PARTIALS.'bottom-pagination.php'; ?>
				</div><!-- .sina-pro-wc-shop-box-grid -->
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