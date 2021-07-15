<div class="sina-posts clearfix <?php echo esc_attr( $data['bg_layer_effects'] ); ?>">
	<div class="sina-bg-thumb sina-bg-cover"
		<?php if ( has_post_thumbnail() ): ?>
			style="background-image: url(<?php the_post_thumbnail_url(); ?>);"
		<?php else: ?>
			style="background-image: url(<?php echo esc_url( SINA_EXT_URL .'assets/img/featured-img.jpg' ); ?>);"
		<?php endif; ?>>
		<div class="sina-overlay">
			<a href="<?php the_permalink(); ?>"></a>
		</div>
	</div>
	<div class="sina-posts-content">
		<div class="sina-posts-inner-content">
			<?php if ( 'before' == $data['grid_cats_position'] ): ?>
				<div class="sina-posts-cats">
					<span>
						<i class="<?php echo esc_attr( $data['grid_cats_icon'] ); ?>"></i>
					</span>
					<?php echo get_the_category_list( ' | ' ); ?>
				</div>
			<?php endif; ?>
			<h2 class="sina-posts-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>
			<?php if ( 'after' == $data['grid_cats_position'] ): ?>
				<div class="sina-posts-cats">
					<span>
						<i class="<?php echo esc_attr( $data['grid_cats_icon'] ); ?>"></i>
					</span>
					<?php echo get_the_category_list( ' | ' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( 'yes' == $data['posts_text']): ?>
				<div class="sina-posts-text">
					<?php
						if ( 'yes' == $data['posts_excerpt'] && has_excerpt() ):
							$excerpt = preg_replace( '/'. get_shortcode_regex() .'/', '', get_the_excerpt() );
							echo wp_kses_post( wp_trim_words( $excerpt, $txt_len ) );
						else:
							$content = preg_replace( '/'. get_shortcode_regex() .'/', '', get_the_content() );
							echo wp_kses_post( wp_trim_words( $content, $txt_len ) );
						endif;
					?>
				</div>
			<?php endif; ?>

			<?php if ( $data['read_more_text'] ): ?>
				<div class="sina-btn-wrapper">
					<a href="<?php the_permalink(); ?>" class="sina-read-more <?php echo esc_attr( $data['read_more_effect'].' '.$data['read_btn_bg_layer_effects'] ); ?>">
						<?php Sina_Common_Data::button_html($data, 'read_more'); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>
		<?php if ( 'yes' == $data['posts_meta'] ): ?>
			<div class="sina-posts-meta">
				<?php if ( 'yes' == $data['posts_avatar'] ): ?>
					<?php echo get_avatar( get_the_author_meta( "ID" ), $data['grid_avatar_size']['size']); ?>
				<?php else: ?>
					<?php _e('by', 'sina'); ?>
				<?php endif; ?>
				<?php the_author_posts_link(); ?>
				|
				<?php printf( '%s', get_the_date() ); ?>
			</div>
		<?php endif; ?>
	</div>
</div>