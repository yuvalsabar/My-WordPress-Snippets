<?php 
$args = array( 
	'post_type' => 'tender', 
	'posts_per_page' => -1
);

$query = new WP_Query( $args );

if ( $query->have_posts() ) : ?>

	<table class="data-table table-ajax fade-in" data-paging="false" data-info="false" data-filter="false" data-order='[[0, "desc"]]'>
		<thead>
			<tr>
				<th class="publish-date">
					<?php _e( 'Date Published', 'qstheme' );?>
					<span class="fa fa-angle-down" aria-hidden="true"></span>
				</th>
				<th class="submit-date">
					<?php _e( 'Submit Date', 'qstheme' );?>
					<span class="fa fa-angle-down" aria-hidden="true"></span>
				</th>
				<th class="title" data-orderable="false">
					<?php _e( 'Tender Title', 'qstheme' );?>
				</th>
				<th class="view"></th>
			</tr>
		</thead>
		<tbody>
			<?php while ( $query->have_posts() ) : $query->the_post();
				$post_id 	  = get_the_ID();
				$publish_date = get_field( 'publish_date', $post_id );
				$submit_date  = get_field( 'submit_date', $post_id );
				$file 		  = get_field( 'file', $post_id );?> 
						
				<tr class="tr-toggle details-control" data-post-id="<?php echo $post_id;?>" data-template="tenders">
					<td class="publish-date" data-order="<?php echo strtotime( $publish_date );?>">
						<?php echo date( 'd/m/Y', strtotime( $publish_date ) );?>
					</td>
					<td class="submit-date details-control" data-order="<?php echo strtotime( $submit_date );?>">
						<?php echo date( 'd/m/Y', strtotime( $submit_date ) );?>
					</td>
					<td class="title details-control">
						<?php the_title();?>
					</td>
					<td class="view details-control">
						<span class="fa fa-angle-down" aria-hidden="true"></span>
					</td>
				</tr>
		   
			<?php endwhile; ?>
		</tbody>
	</table>

<?php endif;