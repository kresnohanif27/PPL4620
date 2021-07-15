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
		$cats_lists = get_the_category( get_the_ID() );
		$lists_cats = [];
		foreach ($cats_lists as $cat_list) {
			$lists_cats[] = 'sina-'.str_replace(' ', '-', $cat_list->name);
		}
		$lists_cats = implode(' ', $lists_cats);
	?>
	<div class="sina-posts-col <?php echo esc_attr( $data['columns'].' '.$data['effects'].' '.$lists_cats ); ?>">
		<?php include SINA_EXT_PRO_LAYOUT.'/common/grid.php'; ?>
	</div>
<?php endwhile; ?>