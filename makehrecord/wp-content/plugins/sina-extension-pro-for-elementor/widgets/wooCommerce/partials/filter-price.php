<div class="sina-pro-wc-profil-item">
	<div class="sina-pro-wc-profil-content">
		<div class="sina-pro-wc-profil-label">
			<?php printf('%s', $item['filter_label']); ?> <span class="<?php echo esc_attr($data['filter_close_icon']); ?> close-action"></span><span class="<?php echo esc_attr($data['filter_open_icon']); ?> open-action"></span>
		</div>
		<div class="sina-pro-wc-profil-content-inner">
			<div class="sina-pro-wc-profil-price clearfix">
				<?php
				$min = (isset( $_GET['min_price'] ) && '' != $_GET['min_price']) ? $_GET['min_price'] : 0;
				$max = (isset( $_GET['max_price'] ) && '' != $_GET['max_price']) ? $_GET['max_price'] : 100;
				?>
				<div class="sina-pro-wc-profil-min-price">
					<input id="sina-pro-wc-profil-min-price" type="number" name="min_price" value ="<?php echo esc_attr($min); ?>">
					<label for="sina-pro-wc-profil-min-price"><?php _e( 'Min', 'sina-ext-pro'); ?></label>
				</div>
				<div class="sina-pro-wc-profil-max-price">
					<input id="sina-pro-wc-profil-max-price" type="number" name="max_price" value="<?php echo esc_attr($max); ?>">
					<label for="sina-pro-wc-profil-max-price"><?php _e( 'Max', 'sina-ext-pro'); ?></label>
				</div>
			</div>
		</div>
	</div>
</div>