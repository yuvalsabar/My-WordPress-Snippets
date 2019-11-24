<?php
/**
 * Ajax load more
 */
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

add_action( 'wp_ajax_nopriv_ajax_tag_filter', 'ajax_tag_filter' );
add_action( 'wp_ajax_ajax_tag_filter', 'ajax_tag_filter' );

/**
 * Ajax filter terms
 */
function ajax_filter_terms() {
	global $hicpo;
	remove_action( 'pre_get_posts', array( $hicpo, 'hicpo_pre_get_posts' ) );

    $post_type 		= isset( $_POST['post_type'] ) ? sanitize_text_field( $_POST['post_type'] ) : '';
    $posts_per_page = isset( $_POST['posts_per_page'] ) ? intval( $_POST['posts_per_page'] ) : '';
    $offset  		= isset( $_POST['offset'] ) ? intval( $_POST['offset'] ) : '';
	$taxonomy 		= isset( $_POST['taxonomy'] ) ? sanitize_text_field( $_POST['taxonomy'] ) : '';
    $term_id  		= isset( $_POST['term_id'] ) ? intval( $_POST['term_id'] ) : '';

    $args = array( 
		'post_type' 	 => $post_type, 
		'posts_per_page' => $posts_per_page
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

		get_template_part( 'inc/loop', $post_type );
	endwhile;


	$results['html'] 		= ob_get_clean();

	if ( $query->max_num_pages > 1 ) {
		$results['load_more_html'] 	= QS::load_more_btn( $args, $offset, '.row-posts' );
	}

    wp_send_json( $results );
}