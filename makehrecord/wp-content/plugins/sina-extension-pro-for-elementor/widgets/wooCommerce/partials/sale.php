<?php if ($data['posts_date']): ?>
	<?php if ('outofstock' == $product->get_stock_status()): ?>
		<div class="sina-pro-wc-sale">
			<?php printf( '%s', $data['posts_date'] ); ?>
		</div>
	<?php else: ?>
		<div class="sina-pro-wc-blank"></div>
	<?php endif ?>
<?php endif; ?>