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
            'value'   => date('Y-m-d'),
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
		'value'         => date('Y-m-d'),
		'type'          => 'DATETIME'
   )
);