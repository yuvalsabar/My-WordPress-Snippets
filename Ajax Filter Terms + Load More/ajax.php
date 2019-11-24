<?php
add_action( 'wp_ajax_nopriv_ajax_filter_terms', 'ajax_filter_terms' );
add_action( 'wp_ajax_ajax_filter_terms', 'ajax_filter_terms' );

function ajax_filter_terms() {
	global $hicpo;
	remove_action( 'pre_get_posts', array( $hicpo, 'hicpo_pre_get_posts' ) );

	$taxonomy 		= isset( $_POST['taxonomy'] ) ? sanitize_text_field( $_POST['taxonomy'] ) : '';
    $term_id  		= isset( $_POST['term_id'] ) ? intval( $_POST['term_id'] ) : '';

    $args = array( 
		'post_type' => 'post', 
		'posts_per_page' => 25
	);

	if ( $taxonomy != 'all' ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => $taxonomy,
				'field'    => 'term_id',
				'terms'    => $term_id,
			),
		);
	}

	$query = new WP_Query( $args );

	ob_start(); 

	while ( $query->have_posts() ) :
		$query->the_post();

		get_template_part( 'inc/loop', $args['post_type'] );
	endwhile;


	$results['html'] 		= ob_get_clean();

	if ( $query->max_num_pages > 1 ) {
		// Posts per page is the number of posts to load in each call
		$args['posts_per_page'] = 10;
		$results['load_more_html'] 	= YS::load_more_btn( $args, $args['posts_per_page'], '.row-posts' );
	}

    wp_send_json( $results );
}

add_action( 'wp_ajax_nopriv_ajax_load_more', 'ajax_load_more' );
add_action( 'wp_ajax_ajax_load_more', 'ajax_load_more' );

function ajax_load_more() {
	global $hicpo;
	remove_action( 'pre_get_posts', array( $hicpo, 'hicpo_pre_get_posts' ) );

	$offset                 = isset( $_POST['offset'] ) ? intval( $_POST['offset'] ) : '';
	$args                   = $_POST['args'];
	$args['offset']         = $offset;

	ob_start();

	$query = new WP_Query( $args );

	$total = $query->found_posts;

	while ( $query->have_posts() ) :
		$query->the_post();

		get_template_part( 'inc/loop', $args['post_type'] );

	endwhile;

	wp_reset_query();

	$results = array(
		'html'	   => ob_get_clean(),
		'more'     => $offset + $args['posts_per_page'] < $total ? true : false,
	);

	wp_send_json( $results );
}