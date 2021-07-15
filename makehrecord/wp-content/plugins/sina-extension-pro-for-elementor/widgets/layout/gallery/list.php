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
		$cats_lists = get_the_category( get_the_ID() );
		$lists_cats = [];
		foreach ($cats_lists as $cat_list) {
			$lists_cats[] = 'sina-'.str_replace(' ', '-', $cat_list->name);
		}
		$lists_cats = implode(' ', $lists_cats);
	?>
	<div class="sina-posts-col sina-posts-list <?php echo esc_attr( $data['columns'].' '.$data['effects'].' '.$thumb_float.' '.$lists_cats ); ?>">
		<?php include SINA_EXT_PRO_LAYOUT.'/common/list.php'; ?>
	</div>
<?php endwhile; ?>