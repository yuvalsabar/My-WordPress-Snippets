<button class="btn btn-favorites" data-postid="<?php echo $post->ID;?>">
	<?php echo is_favorite() ? 'Favorite post' : 'Not a favorite post';?>
</button>
  
<?php

/**
* Get array of favorites posts
* @return array of favorites posts
*/
function get_favorites() {
    if ( isset( $_COOKIE['favorite_posts'] ) ) {
        return array_values( json_decode( stripslashes( $_COOKIE['favorite_posts'] ), true) );
    } else {
        return array();
    }
}

/**
* Check if the post is in favorites
* @param  int  $post_id
* @return boolean
*/
function is_favorite( $post_id = '' ) {
    if ( ! $post_id ) {
        global $post;
        $post_id = $post->ID;
    }
    $favs = get_favorites();

    if ( ! empty( $favs ) ) {
        if ( in_array( $post_id, $favs ) ) {
            return true;
        } else {
            return false;
        }
    }
}

/**
* Return count of favorites
*/
function get_favorites_counts() {
    $post_favs       = get_favorites( 'post' );
    $post_favs_count = count($post_favs);
    return $post_favs_count;
}
