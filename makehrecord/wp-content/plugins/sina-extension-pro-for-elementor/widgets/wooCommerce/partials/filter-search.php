<div class="sina-pro-wc-profil-search">
	<?php $query = (isset( $_GET['query'] ) && $_GET['query']) ? $_GET['query'] : ''; ?>
	<input type="search" name="query" placeholder="<?php printf('%s', $item['filter_label']); ?>" value="<?php echo esc_attr( $query ); ?>">
	<button class="sina-button">
		<i class="<?php echo esc_attr($data['filter_search_icon']); ?>"></i>
	</button>
</div>