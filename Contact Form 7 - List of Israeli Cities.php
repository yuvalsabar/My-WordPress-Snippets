<?php
// Usage: Simply use [cities] in the form

function cities_form_tag( $tag ) {
	$endpoint = 'https://data.gov.il/api/3/action/datastore_search?resource_id=ec172c08-27fe-4d97-960d-dabf741c077f&fields=%D7%A9%D7%9D_%D7%99%D7%A9%D7%95%D7%91,%D7%A9%D7%9D_%D7%99%D7%A9%D7%95%D7%91_%D7%9C%D7%95%D7%A2%D7%96%D7%99&limit=32000';
	$cities   = json_decode( file_get_contents( $endpoint ), JSON_FORCE_OBJECT )['result']['records'];
	$cities   = is_rtl() ? wp_list_pluck( $cities, 'שם_ישוב' ) : wp_list_pluck( $cities, 'שם_ישוב_לועזי' );

	ob_start();
	?>

	<span class="wpcf7-form-control-wrap city">
		<select name="city" class="wpcf7-form-control wpcf7-select" aria-invalid="false">
			<option value="<?php _e( 'City', 'ystheme' ); ?>">
				<?php _e( 'City', 'ystheme' ); ?>
			</option>
			<?php
			foreach ( $cities as $city ) :
				$city = str_replace( '(', ')', $city );
				$city = str_replace( ' )', ' (', $city );
				?>

				<option value="<?php echo $city; ?>">
					<?php echo $city; ?>
				</option>

			<?php endforeach; ?>
		</select>
	</span>

	<?php

	return ob_get_clean();
}

function add_form_tags() {
	wpcf7_add_form_tag( 'cities', 'cities_form_tag' );
}
add_action( 'wpcf7_init', 'add_form_tags' );
