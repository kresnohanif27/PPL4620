<?php if ( 'yes' == $data['posts_title']):
	$post_title = wp_trim_words( get_the_title(), $data['posts_title_length'], '...' );
	?>
	<h3 class="sina-pro-wc-title">
		<a href="<?php echo esc_url( $post_title_link ); ?>">
			<?php printf('%s', $post_title); ?>
		</a>
	</h3>
<?php endif ?>