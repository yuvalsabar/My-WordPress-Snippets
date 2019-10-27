<?php
/**
 * Populate select field with titles and pipes in WPCF7
 */
function dynamic_select_field_values ( $scanned_tag, $replace ) {  
    if ( $scanned_tag['name'] != 'department' )  
        return $scanned_tag;

    $posts = get_posts(
        array ( 
            'post_type'      => 'department',
            'orderby'        => 'title',
            'order'          => 'ASC',
            'posts_per_page' => -1
        )
    );  
  
    if ( ! $posts )  
        return $scanned_tag;

    foreach ( $posts as $row ) {  
        $scanned_tag['raw_values'][] = $row->post_title . '|' . get_field( 'email', $row->ID );
    }

    $pipes = new WPCF7_Pipes($scanned_tag['raw_values']);

    $scanned_tag['values'] = $pipes->collect_befores();
    $scanned_tag['pipes'] = $pipes;
  
    return $scanned_tag;  
}  
add_filter( 'wpcf7_form_tag', 'dynamic_select_field_values', 10, 2); 

/**
 * Dynamic recipient with pipes
 */
function wpcf7_dynamic_recipient ($wpcf7) {
    // The ID of the form
    if ( $wpcf7->id() == 787 || $wpcf7->id() == 2520 ) {
        $submission = WPCF7_Submission::get_instance();
        $posted_data = $submission->get_posted_data();

        $email_to = $posted_data['department'];
        $mail = $wpcf7->prop( 'mail' );
        $mail['recipient'] = $email_to;

        $wpcf7->set_properties( array( 'mail' => $mail ) );
    }
}
add_action( 'wpcf7_before_send_mail', 'wpcf7_dynamic_recipient' );