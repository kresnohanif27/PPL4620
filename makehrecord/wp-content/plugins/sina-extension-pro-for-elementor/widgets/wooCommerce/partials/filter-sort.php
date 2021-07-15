<div class="sina-pro-wc-profil-item">
	<div class="sina-pro-wc-profil-content">
		<div class="sina-pro-wc-profil-label">
			<?php printf('%s', $item['filter_label']); ?> <span class="<?php echo esc_attr($data['filter_close_icon']); ?> close-action"></span><span class="<?php echo esc_attr($data['filter_open_icon']); ?> open-action"></span>
		</div>
		<div class="sina-pro-wc-profil-content-inner">
			<?php
			$sorts = [
				'ASC'  => esc_html__( 'ASC', 'sina-ext-pro' ),
				'DESC' => esc_html__( 'DESC', 'sina-ext-pro' )
			];
			foreach ($sorts as $key => $sort):
				$for = $key.'-'.$id;
				$checked = (isset( $_GET['sort'] ) && $key == $_GET['sort']) ? 'checked' : '';
				?>
				<div class="sina-pro-wc-profil-field">
					<input id="sina-pro-wc-profil-sort-<?php echo esc_attr($for); ?>" type="radio" name="sort" value="<?php echo esc_attr($key); ?>" <?php echo esc_attr( $checked ); ?>>
					<label for="sina-pro-wc-profil-sort-<?php echo esc_attr($for); ?>"><?php printf('%s', $sort); ?></label>
				</div>
				<?php
			endforeach;
			?>
		</div>
	</div>
</div>