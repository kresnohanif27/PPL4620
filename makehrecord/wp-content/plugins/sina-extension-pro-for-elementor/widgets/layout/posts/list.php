<?php
	$j = 0;
	$data['columns'] = 'sina-bp-item-'.$data['columns'];
	if ( 'custom' == $data['layout_type'] ) {
		$columns = explode(',', $data['custom_columns']);
	}
	while ( $post_query->have_posts() ) : $post_query->the_post();
		$thumb_float = $data['thumb_right'] ? 'sina-posts-thumb-right' : '';
		if ( 'custom' == $data['layout_type'] ) {
			$data['columns'] = 'sina-bp-custom-'.$columns[$j];
			$j++;
		}
	?>
	<div class="sina-posts-col sina-posts-list <?php echo esc_attr( $data['columns'].' '.$data['effects'].' '.$thumb_float ); ?>">
		<?php include SINA_EXT_PRO_LAYOUT.'/common/list.php'; ?>
	</div>
<?php endwhile; ?>