<?php 
// Show only events before end date
$args = array(
    'post_type'      => 'event',
    'posts_per_page' => -1,
    'meta_key'       => 'start-date', 		// this will order by start date
    'orderby'        => 'meta_value_num', 	// this will order by start date
    'meta_query'     => array(
        'relation' => 'AND',
        array(
            'key'   => 'show-in-slider',
            'value' => true,
        ),
        array(
            'key'     => 'end-date',
            'value'   => date('Ymd'),
            'compare' => '>=',
            'type'    => 'DATE',
        ),
    ),
);

// Get closest event
$args = array(
   'post_type' => 'event',
   'posts_per_page' => 1,
   'meta_query' => array(
		'key'           => 'date',
		'compare'       => '>',
		'value'         => date('Ymd'),
		'type'          => 'DATETIME'
   )
);

// Get posts which has a start date in the next two months
$current_date = date( 'Y-m-d' );
$range_date   = date( 'Y-m-d', strtotime( '+2 months' ) );

$args = array( 
	'post_type' => 'session', 
	'orderby'	=> 'meta_value_num',
	'meta_key'	=> 'start_date',
	'meta_query' => array(
		array(
			'key' 	  => 'start_date', 
			'value'   => array( $current_date, $range_date ),
			'compare' => 'BETWEEN', 
			'type' 	  => 'DATE',
		),
	),
)
