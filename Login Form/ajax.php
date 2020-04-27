<?php
/**
 * Ajax login
 */
function ajax_login() {
    check_ajax_referer( -1, 'nonce' );

    parse_str( $_POST['data'], $data );
    
    if ( is_email( $data['username'] ) ) {
       $info['user_login'] = get_user_by( 'email', $data['username'] ); 
       $info['user_login'] = $info['user_login']->user_login;
    } else {
        $info['user_login'] = sanitize_text_field($data['username']);
    }
    $info['user_password'] = sanitize_text_field($data['password']);
    $info['remember']      = $data['remember'] ? true : false;

    $user_signon = wp_signon( $info, false );

    if ( is_wp_error( $user_signon ) ) {
        $results = array( 'status' => 'error', 'message' => __( 'Incorrect username or password', 'ystheme' ) );
    } else {
        $results = array( 'status' => 'success', 'message' => __( 'Login Completed', 'ystheme' ) );
    }

    wp_send_json( $results );
}
add_action( 'wp_ajax_nopriv_ajax_login', 'ajax_login' );
add_action( 'wp_ajax_ajax_login', 'ajax_login' );