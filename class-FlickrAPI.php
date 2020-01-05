<?php
class FlickrAPI {
	public function __construct() {
		$this->api_key  = get_field( 'flickr_api_key', 'option' );
		$this->user_id  = get_field( 'flickr_user_id', 'option' );
	}

	public function delete_albums() {
		$args = array( 
			'post_type' => 'gallery', 
			'posts_per_page' => -1,
		);
		$query = new WP_Query( $args );

		while ( $query->have_posts() ) : $query->the_post();

			wp_delete_post( get_the_ID() );
			
		endwhile; wp_reset_postdata();
	}

	public function api_request( $add_params ) {
		$params = array(
			'api_key'	=> $this->api_key,
			'user_id'   => $this->user_id,
			'format'	=> 'php_serial',
		);

		foreach ( $add_params as $key => $value ) {
			$params[$key] = $value;
		}

		$encoded_params = array();

		foreach ( $params as $k => $v ) {

			$encoded_params[] = urlencode( $k ).'='.urlencode( $v );
		}

		$url = "https://api.flickr.com/services/rest/?".implode( '&', $encoded_params );

		$rsp = file_get_contents( $url );

		$rsp_obj = unserialize( $rsp );

		return $rsp_obj;
	}

	public function get_albums() {
		$params = array( 
			'method' => 'flickr.photosets.getList' 
		);

		$rsp_obj = $this->api_request( $params );

		$albums = $rsp_obj['photosets']['photoset'];

		return $albums;
	}

	public function get_album_photos( $album_id ) {
		$params = array(
			'method'	  => 'flickr.photosets.getPhotos',
			'photoset_id' => $album_id,
			'extras'      => 'url_n',
			'per_page'	  => 1
		);

		$photos = $this->api_request( $params );

		return $photos;
	}

	public function insert_albums() {
		$albums = $this->get_albums();

		foreach ( $albums as $album ) {
			$title = $album['title']['_content'];

			$args = array(
				'post_type'      => 'gallery',
				'meta_key' 	     => 'album_id',
				'meta_value'     => $album['id'],
				'posts_per_page' => 1
			);
			$post = get_posts( $args );
			
			if ( ! $post ) {
				$args = array(
					'post_type' 	=> 'gallery',
					'post_title'	=> $title,
					'post_status'   => 'publish'
				);

				// Insert album
				$post_id = wp_insert_post( $args );

				update_field( 'album_id', $album['id'], $post_id );
				update_field( 'photo_count', $album['count_photos'], $post_id );
				update_field( 'gallery_url', "https://www.flickr.com/photos/{$this->user_id}/albums/{$album['id']}", $post_id );
				update_field( 'views', $album['count_views'], $post_id );

				if ( $post_id ) {
					$this->insert_album_photos( $post_id, $album['id'] ); 
				}
			}
		}
	}

	public function insert_album_photos( $post_id, $album_id ) {
		// Insert photos into album
		$photos = $this->get_album_photos( $album_id );
		$photo  = $photos['photoset']['photo'][0]['url_n'];
		$value = array(
			'url' => $photo
		);
		add_row( 'photos', $value, $post_id );
	}
}

$FlickrAPI = new FlickrAPI();

//$FlickrAPI->delete_albums();
//$FlickrAPI->insert_albums();

