<?php $btn_class = QS::is_favorite( $post->ID, 'product' ) ? 'btn-favorites is-favorite' : 'btn-favorites'; ?>
<button class="<?php echo $btn_class; ?>" data-post-id="<?php echo $post->ID; ?>" data-post-type="product" aria-label="<?php _e( 'Add to Favorties', 'qstheme' ); ?>" title="<?php _e( 'Add to Favorties', 'qstheme' ); ?>">
	<span class="fa fa-heart-o" aria-hidden="true"></span>
</button>

<?php
/**
 * Get favorites
 * @param  string $post_type
 * @return array  Array of favorites    
 */
static function get_favorites( $post_type = 'post' ) {
	if ( isset( $_COOKIE["favs_{$post_type}"] ) ) {
		return explode('|', $_COOKIE["favs_{$post_type}"]);
	} else {
		return array();
	}
}

/**
 * Is favorite
 * @param  int     $post_id
 * @param  string  $post_type
 * @return boolean            
 */
static function is_favorite( $post_id = '', $post_type = 'post' ) {
	if ( ! $post_id ) {
		global $post;
		$post_id = $post->ID;
	}

	$favs = QS::get_favorites( $post_type );

	if ( ! empty( $favs ) ) {
		if ( in_array( $post_id, $favs ) ) {
			return true;
		} else {
			return false;
		}
	}
}