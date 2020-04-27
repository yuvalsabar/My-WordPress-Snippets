<?php
/**
 * Ajax register
 */
function ajax_register() {
    check_ajax_referer( -1, 'nonce' );

    parse_str( $_POST['data'], $data );

    if ( $data['password'] != $data['password_auth'] ) {
        wp_send_json( array( 'status' => 'error', 'message' => __( 'Passwords do not match', 'ystheme' ) ) );
    } elseif ( ! is_email( $data['user_email'] ) ) {
        wp_send_json( array( 'status' => 'error', 'message' => __( 'Incorrect email', 'ystheme' ) ) );
    }

    $userdata = array(
        'user_login' => $data['user_email'],
        'user_email' => is_email( $data['user_email'] ) ? $data['user_email'] : '',
        'first_name' => $data['first_name'],
        'last_name'  => $data['last_name'],
        'user_pass'  => $data['password']
    );

    $user_id = wp_insert_user( $userdata );

    if ( is_wp_error( $user_id ) ) {
        wp_send_json( array( 'status' => 'error', 'message' => $user_id->get_error_message() ) );
    } 

    else {
        $creds = array();
        $creds['user_login']        = $data['user_email'];
        $creds['user_password']     = $data['password'];
        $creds['remember'] = true;
        $user = wp_signon( $creds, false );

        wp_send_json( array( 'status' => 'success', 'message' => __( 'Registration successfully completed', 'ystheme' ) ) );
    }
}
add_action( 'wp_ajax_nopriv_ajax_register', 'ajax_register' );
add_action( 'wp_ajax_ajax_register', 'ajax_register' );