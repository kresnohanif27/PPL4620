<?php if ($data['posts_author']): ?>
	<div class="sina-pro-wc-cart">
		<a href="<?php echo get_permalink( $post_id ); ?>" data-quantity="1" data-product_id="<?php echo $post_id; ?>" >
			<i class="<?php echo esc_attr( $data['cart_icon'] ); ?>"></i>
		</a>
	</div>
<?php endif; ?>