<?php 
$args = array( 
	'post_type' => 'post', 
	'posts_per_page' => 25
);
$query = new WP_Query( $args );

if ( $query->have_posts() ) : ?>

	<section class="posts">
		<div class="container">	
			<?php get_template_part( 'inc/tpl-posts/filter' ); ?>

			<ul class="row-posts">
				
				<?php 
				while ( $query->have_posts() ) : $query->the_post();
			
					get_template_part( 'inc/loop', 'post' );
			
				endwhile; wp_reset_postdata();
				?>

			</ul>
			
			<div class="load-more-container">
				<?php
				// Posts per page is the number of posts to load in each call
				$args['posts_per_page'] = 10; 
				echo YS::load_more_btn( $args, $args['posts_per_page'], '.row-posts' );
				?>
			</div>
		</div>
	</section>

<?php endif;
?>