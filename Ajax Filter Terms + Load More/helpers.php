<?php
class YS {
	/**
	 * Generate load more button
	 * @param  array 	$args   	WP_Query args
	 * @param  int 		$offset	 	Offset to start from
	 * @param  string 	$append 	Element to append the results to
	 */
	static function load_more_btn( $args, $offset, $append ) {
		?>

		<div class="load-more-wrap">
			<button class="btn btn-load-more btn-load-more-<?php echo $args['post_type'];?> btn-blue-text" data-offset="<?php echo $offset; ?>" data-append="<?php echo $append; ?>" data-query=<?php echo json_encode( $args ); ?>>
				<?php _e( 'Load More', 'qstheme' ); ?>
			</button>

			<div class="loader-wrap"></div>
		</div>
		
		<?php
		return ob_get_clean();
	}
}

$ys = new YS();