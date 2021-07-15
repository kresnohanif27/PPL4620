<?php
if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
} else if ( get_query_var('page') ) {
	$paged = get_query_var('page');
} else {
	$paged = 1;
}

$new_offset = (int)$data['posts_offset'] + ( ( $paged - 1 ) * (int)$data['posts_num'] );

$taxos 		= $data[ 'post_type_product' ];
$tax_query 	= [
	'relation' => 'OR',
];

foreach ($taxos as $tax_name) {
	if ( isset($data['post_type_product_'.$tax_name]) && !empty($data['post_type_product_'.$tax_name]) ) {
		$tax_query[] = [
			'taxonomy' => $tax_name,
			'field'    => 'term_id',
			'terms'    => $data['post_type_product_'.$tax_name],
		];
	}
}

$default = [
	'post_type' 		=> 'product',
	'orderby'			=> [ $data['posts_order_by'] => $data['posts_sort'] ],
	'posts_per_page'	=> $data['posts_num'],
	'paged'				=> $paged,
	'offset'			=> $new_offset,
	'has_password'		=> false,
	'post_status'		=> 'publish',
	'post__not_in'		=> get_option( 'sticky_posts' ),
	'tax_query' 		=> $tax_query,
];

if ( isset($_GET['query']) || isset($_GET['sort']) || isset($_GET['orderby']) || isset($_GET['categories']) || isset($_GET['tags']) || isset($_GET['colors']) || isset($_GET['sizes']) || isset($_GET['min_price'], $_GET['max_price']) ) {
	$default['offset'] = ( $paged - 1 ) * (int)$data['posts_num'];

	$new_tax_query['relation'] = 'AND';
	if (!empty($_GET['categories'])) {
		$new_tax_query[] = [
			'taxonomy' => 'product_cat',
			'field' => 'term_id',
			'terms' => $_GET['categories'],
		];
	}
	if (!empty($_GET['tags'])) {
		$new_tax_query[] = [
			'taxonomy' => 'product_tag',
			'field' => 'term_id',
			'terms' => $_GET['tags'],
		];
	}
	if (!empty($_GET['colors'])) {
		$new_tax_query[] = [
			'taxonomy' => 'pa_color',
			'field' => 'term_id',
			'terms' => $_GET['colors'],
		];
	}
	if (!empty($_GET['sizes'])) {
		$new_tax_query[] = [
			'taxonomy' => 'pa_size',
			'field' => 'term_id',
			'terms' => $_GET['sizes'],
		];
	}

	if ($_GET['orderby']) {
		$orderby = sanitize_text_field( $_GET['orderby'] );
		$default['orderby'] = $orderby;
		if( in_array( $orderby, [ '_price', 'total_sales', '_wc_average_rating' ] ) ) {
			$default['meta_key'] = $orderby;
			$default['orderby'] = 'meta_value_num';
		}
	}
	if ($_GET['sort']) {
		$default['order'] = sanitize_text_field( $_GET['sort'] );
	}

	if ('' != $_GET['min_price'] && '' != $_GET['max_price']) {
		$min_price = sanitize_text_field( $_GET['min_price'] );
		$max_price = sanitize_text_field( $_GET['max_price'] );
		$default['relation'] = 'AND';
		$default['meta_query'][] = [
			'key' => '_price',
			'value'	=> [ $min_price, $max_price ],
			'compare' => 'BETWEEN',
			'type' => 'NUMERIC'
		];
	}

	$default['tax_query'] = $new_tax_query;
	if ($_GET['query']) {
		$default['s'] = sanitize_text_field($_GET['query']);
	}
}

$default['tax_query'][] = [
	'taxonomy' => 'product_visibility',
	'field' => 'name',
	'terms' => 'exclude-from-catalog',
	'operator' => 'NOT IN',
];

$posts_query = new WP_Query( $default );