<?php
function get_recaptcha_response() {
    $secret_key 	= 'SECRET_KEY_GOES_HERE';
    $response_key 	= $_POST['g-recaptcha-response'];
    $user_ip 		= $_SERVER['REMOTE_ADDR'];

    $url = "https://www.google.com/recaptcha/api/siteverify?secret={$secret_key}&response={$response_key}&remoteip={$user_ip}";

    $response = file_get_contents($url);

    $response = json_decode($response);

    return $response;
}

$response = get_recaptcha_response();

if ( $response->success ) {
	...
}