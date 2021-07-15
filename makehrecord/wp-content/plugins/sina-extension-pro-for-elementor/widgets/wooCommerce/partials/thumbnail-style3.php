<?php if ( has_post_thumbnail() ): ?>
	<div class="sina-pro-wc-thumb">
		<div class="sina-pro-wc-img sina-bg-cover <?php echo esc_attr( $data['thumb_effects']); ?>"
			style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
		</div>
		<a class="sina-pro-wc-overlay" href="<?php echo esc_url( $post_thumb_link ); ?>"></a>
		<?php
			foreach ($data[$post_index.'_thumb_layout'] as $thumb_item) {
				include SINA_EXT_PRO_WOO_PARTIALS.$thumb_item[$post_index.'_thumb'].'.php';
			}
		?>
		<div class="sina-pro-wc-thumb-inner">
			<?php
				foreach ($data[$post_index.'_posts_layout'] as $post_item) {
					include SINA_EXT_PRO_WOO_PARTIALS.$post_item[$post_index.'_post'].'.php';
				}
			?>
		</div>
	</div>
<?php endif; ?>