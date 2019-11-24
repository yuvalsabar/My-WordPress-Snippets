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

	/**
	 * Build terms filter
	 * @param  array $args
	 */
	static function build_filter( $args = '' ) {
		$defaults = array(
			'post_type'       => 'post',
			'taxonomies'      => array(),
			'posts_per_page'  => 9,
			'offset' 		  => 9,
		);

		$args = wp_parse_args( $args, $defaults );

		ob_start(); ?>
			
		<div class="filter" data-post_type="<?php echo $args['post_type']; ?>" data-posts_per_page="<?php echo $args['posts_per_page']; ?>" data-offset="<?php echo $args['offset']; ?>">
			<span class="entry-text">
				<?php _e( 'Search By', 'qstheme' );?>
			</span>
			
			<ul class="filter-buttons">
				<li>
					<span class="btn-filter btn-filter-all" data-all="all">
						<?php _e( 'All', 'qstheme' );?>
					</span>
				</li>

				<?php foreach ( $args['taxonomies'] as $key => $value ) : ?>
					
					<li>
						<span class="filter-cat">
							<?php echo $value['label']; ?>
							<span class="sprite sprite-arrow-down-white" aria-hidden="true"></span>
						</span>
						
						<?php $terms = get_terms( $key ); ?>

						<ul class="dropdown">
							<?php foreach ( $terms as $term ) : ?>
								<li>
									<a href="#" class="btn-filter" data-<?php echo $key; ?>="<?php echo $term->term_id; ?>" rel="nofollow">
										<?php echo $term->name; ?>
									</a>
								</li>
							<?php endforeach ?>
						</ul>
					</li>

				<?php endforeach ?>
				
			</ul>
		</div>


		<?php echo ob_get_clean();
	}
}

$ys = new YS();