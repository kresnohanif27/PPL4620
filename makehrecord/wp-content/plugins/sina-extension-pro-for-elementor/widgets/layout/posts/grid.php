<?php
	$i = 0;
	$data['columns'] = 'sina-bp-item-'.$data['columns'];
	if ( 'custom' == $data['layout_type'] ) {
		$columns = explode(',', $data['custom_columns']);
	}
	while ( $post_query->have_posts() ) : $post_query->the_post();
		if ( 'custom' == $data['layout_type'] ) {
			$data['columns'] = 'sina-bp-custom-'.$columns[$i];
			$i++;
		}
	?>
	<div class="sina-posts-col <?php echo esc_attr( $data['columns'].' '.$data['effects'] ); ?>">
		<?php include SINA_EXT_PRO_LAYOUT.'/common/grid.php'; ?>
	</div>
<?php endwhile; ?>