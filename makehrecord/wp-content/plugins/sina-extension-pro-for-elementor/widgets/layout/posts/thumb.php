<?php
	$j = $k = 0;
	$custom_items = ('' != $data['custom_items']) ? explode(',', $data['custom_items']) : [];
	$data['columns'] = 'sina-bp-item-'.$data['columns'];
	if ( 'custom' == $data['layout_type'] ) {
		$columns = explode(',', $data['custom_columns']);
	}
	while ( $post_query->have_posts() ) : $post_query->the_post();
		$k++;
		if ( 'custom' == $data['layout_type'] ) {
			$data['columns'] = 'sina-bp-custom-'.$columns[$j];
			$j++;
		}
		$custom_height = in_array($k, $custom_items) ? 'sina-custom-height' : '';
	?>
	<div class="sina-posts-col <?php echo esc_attr( $data['columns'].' '.$custom_height ); ?>">
		<?php include SINA_EXT_PRO_LAYOUT.'/common/thumb.php'; ?>
	</div>
<?php endwhile; ?>