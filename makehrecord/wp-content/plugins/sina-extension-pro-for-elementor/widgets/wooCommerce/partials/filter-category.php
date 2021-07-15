<div class="sina-pro-wc-profil-item">
	<div class="sina-pro-wc-profil-content">
		<div class="sina-pro-wc-profil-label">
			<?php printf('%s', $item['filter_label']); ?> <span class="<?php echo esc_attr($data['filter_close_icon']); ?> close-action"></span><span class="<?php echo esc_attr($data['filter_open_icon']); ?> open-action"></span>
		</div>
		<div class="sina-pro-wc-profil-content-inner">
			<?php
			$cats = sina_get_term_lists( 'product_cat' );
			foreach ($cats as $key => $cat):
				$for = $key.'-'.$id;
				$checked = (isset( $_GET['categories'] ) && in_array($key, $_GET['categories'])) ? 'checked' : '';
				?>
				<div class="sina-pro-wc-profil-field">
					<input id="sina-pro-wc-profil-cat-<?php echo esc_attr($for); ?>" type="checkbox" name="categories[<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr($key); ?>" <?php echo esc_attr( $checked ); ?>>
					<label for="sina-pro-wc-profil-cat-<?php echo esc_attr($for); ?>"><?php printf('%s', $cat); ?></label>
				</div>
				<?php
			endforeach;
			?>
		</div>
	</div>
</div>