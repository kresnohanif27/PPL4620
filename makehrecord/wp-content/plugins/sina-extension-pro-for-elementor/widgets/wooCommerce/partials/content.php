<?php if ('yes' == $data['posts_content']): ?>
	<div class="sina-pro-wc-content">
		<div class="sina-pro-wc-content-text">
			<?php
				if ( 'yes' == $data['posts_excerpt'] && has_excerpt() ):
					echo wp_trim_words( get_the_excerpt(), $data['posts_content_length'] );
				else:
					$content = preg_replace( '/'. get_shortcode_regex() .'/', '', get_the_content() );
					echo wp_kses_post( wp_trim_words( $content, $data['posts_content_length'] ) );
				endif;
			?>
		</div>

		<?php if ('yes' == $data['posts_read_more']): ?>
			<div class="sina-btn-wrapper">
				<a href="<?php the_permalink(); ?>" class="sina-read-more <?php echo esc_attr( $data['read_more_effect'].' '.$data['read_btn_bg_layer_effects'] ); ?>">
					<?php Sina_Common_Data::button_html($data, 'read_more'); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>