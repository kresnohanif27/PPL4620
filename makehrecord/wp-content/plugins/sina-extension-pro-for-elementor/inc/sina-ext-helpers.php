<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sina_pro_woo_get_taxos( $post_type ) {
	$taxos = get_object_taxonomies($post_type);
	$new_taxos = [];

	foreach ($taxos as $tax) {
		$new_taxos[$tax] = ucwords( str_replace('_', ' ', $tax) );
	}
	return $new_taxos;
}

function sina_pro_woo_get_orderby() {
	$options = [
        'none'      			=> esc_html__( 'None', 'sina-ext-pro' ),
        'ID'        			=> esc_html__( 'ID', 'sina-ext-pro' ),
        'title'     			=> esc_html__( 'Title', 'sina-ext-pro' ),
        'name'      			=> esc_html__( 'Name', 'sina-ext-pro' ),
        'date'      			=> esc_html__( 'Date', 'sina-ext-pro' ),
        'rand'      			=> esc_html__( 'Random', 'sina-ext-pro' ),
        '_price' 				=> esc_html__( 'Price', 'sina-ext-pro' ),
        'total_sales' 			=> esc_html__( 'Top Seller', 'sina-ext-pro' ),
        '_wc_average_rating'    => esc_html__( 'Top Rated', 'sina-ext-pro' ),
        'comment_count' 		=> esc_html__( 'Most Reviewed', 'sina-ext-pro' ),
        'menu_order'      		=> esc_html__( 'Menu Order', 'sina-ext-pro' ),
    ];

    return $options;
}