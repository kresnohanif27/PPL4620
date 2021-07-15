<div class="sina-pro-wc-profil-item">
	<div class="sina-pro-wc-profil-content">
		<div class="sina-pro-wc-profil-label">
			<?php printf('%s', $item['filter_label']); ?> <span class="<?php echo esc_attr($data['filter_close_icon']); ?> close-action"></span><span class="<?php echo esc_attr($data['filter_open_icon']); ?> open-action"></span>
		</div>
		<div class="sina-pro-wc-profil-content-inner">
			<?php
			$orderby = sina_pro_woo_get_orderby();
			foreach ($orderby as $key => $escaped_order):
				$for = $key.'-'.$id;
				$checked = (isset( $_GET['orderby'] ) && $key == $_GET['orderby']) ? 'checked' : '';
				?>
				<div class="sina-pro-wc-profil-field">
					<input id="sina-pro-wc-profil-orderby-<?php echo esc_attr($for); ?>" type="radio" name="orderby" value="<?php echo esc_attr($key); ?>" <?php echo esc_attr( $checked ); ?>>
					<label for="sina-pro-wc-profil-orderby-<?php echo esc_attr($for); ?>"><?php echo $escaped_order ?></label>
				</div>
				<?php
			endforeach;
			?>
		</div>
	</div>
</div>