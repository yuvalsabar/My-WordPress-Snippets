<table class="data-table fade-in" data-paging="false" data-info="false" data-filter="false" data-order='[[0, "desc"]]'>
	<thead>
		<tr>
			<th class="date">
				<?php _e( 'Date Published', 'qstheme' );?>
				<span class="fa fa-angle-down" aria-hidden="true"></span>
			</th>
			<th class="title" data-orderable="false">
				<?php _e( 'Article Title', 'qstheme' );?>
			</th>
			<th class="view"></th>
		</tr>
	</thead>
	<tbody>
		<?php while ( have_rows( 'articles' ) ) : the_row();
			$link = get_sub_field('link');?>
					
			<tr>
				<td class="date" data-order="<?php echo strtotime( get_sub_field( 'date' ) );?>">
					<?php echo date( 'd/m/Y', strtotime( get_sub_field( 'date' ) ) );?>
				</td>
				<td class="title">
					<p class="link"><?php QS::acf_link('link');?></p>
				</td>
				<td class="view">
					<a href="<?php echo $link['url']; ?>"<?php if ( $link['target'] ) : ?> target="<?php echo $link['target']; ?>"<?php endif;?>>
						<span class="fa fa-angle-left" aria-hidden="true"></span>
					</a>
				</td>
			</tr>
	   
		<?php endwhile; ?>
	</tbody>
</table>

<script>
function datatable_init() {
    var table = $('.data-table').DataTable();
}
</script>