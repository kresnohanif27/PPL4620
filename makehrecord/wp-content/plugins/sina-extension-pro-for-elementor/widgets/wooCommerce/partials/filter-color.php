<div class="sina-pro-wc-profil-item">
	<div class="sina-pro-wc-profil-content">
		<div class="sina-pro-wc-profil-label">
			<?php printf('%s', $item['filter_label']); ?> <span class="<?php echo esc_attr($data['filter_close_icon']); ?> close-action"></span><span class="<?php echo esc_attr($data['filter_open_icon']); ?> open-action"></span>
		</div>
		<div class="sina-pro-wc-profil-content-inner">
			<?php
			$colors = sina_get_term_lists( 'pa_color' );
			foreach ($colors as $key => $color):
				$for = $key.'-'.$id;
				$checked = (isset( $_GET['colors'] ) && in_array($key, $_GET['colors'])) ? 'checked' : '';
				?>
				<div class="sina-pro-wc-profil-field">
					<input id="sina-pro-wc-profil-color-<?php echo esc_attr($for); ?>" type="checkbox" name="colors[<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr($key); ?>" <?php echo esc_attr( $checked ); ?>>
					<label for="sina-pro-wc-profil-color-<?php echo esc_attr($for); ?>"><?php printf('%s', $color); ?></label>
				</div>
				<?php
			endforeach;
			?>
		</div>
	</div>
</div>