<?php 
$post_type 	 	= 'customer';
$posts_per_page = $offset = 12;

$filter_args 	= array(
	'post_type'		 		=> $post_type,
	'posts_per_page' 		=> $posts_per_page,
	'offset'				=> $offset,
	'taxonomies' 	 		=> array( 
		'customer_cat' => array(
			'label'	 		=> __( 'Category', 'qstheme' )
		),
		'country_cat'  => array(
			'label' 		=> __( 'Country', 'qstheme' )
		)
	),
);

$args = array( 
	'post_type' 	 => $post_type, 
	'posts_per_page' => $posts_per_page
);

$query = new WP_Query( $args );

if ( $query->have_posts() ) : ?>

	<section class="section-posts">
		<div class="container">	
			<?php echo QS::build_filter( $filter_args ); ?>

			<div class="row row-posts">
				
				<?php 
				while ( $query->have_posts() ) : $query->the_post();
			
					get_template_part( 'inc/loop', $post_type );
			
				endwhile; wp_reset_postdata();
				?>

			</div>
			
			<?php if ( $query->max_num_pages > 1 ) : ?>

				<div class="load-more-container">
					<?php 
					$args['posts_per_page'] = 8;
					echo QS::load_more_btn( $args, $offset, '.row-posts' );
					?>
				</div>

			<?php endif; ?>
		</div>
	</section>

<?php endif;
?>