<?php if ( 'yes' == $data['posts_pagination'] && ('top' == $data['pagination_position'] || 'both' == $data['pagination_position']) ): ?>
	<div class="sina-pro-wc-pagination sina-pro-wc-top-pagination">
		<?php
		$paginate = paginate_links( [
			'total'		=> $posts_query->max_num_pages,
			'current'	=> $paged,
			'prev_next'	=> false,
			'mid_size'	=> 1,
		] );
		echo str_replace('span', 'a', $paginate);
		?>
	</div>
<?php endif; ?>