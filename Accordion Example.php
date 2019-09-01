<ul class="qs-accordion">

	<?php while ( have_rows( 'faq' ) ) : the_row();?>

		 <li class="item">
			<h3 class="entry-title">
				<a href="#" rel="nofollow">
					<span class="entry-text"><?php the_sub_field( 'title' );?></span>
					<span class="fa fa-angle-down" aria-hidden="true"></span>
				</a>
			</h3>
			<div class="entry-content">
				<?php the_sub_field( 'content' );?>
			</div>
		</li>

	<?php endwhile; ?>
	
</ul>

<script>
	function qs_accordion() {
		jQuery('.qs-accordion li .entry-title a').click(function(e) {
			e.preventDefault();
			jQuery('.qs-accordion li.active').not(jQuery(this).closest('.qs-accordion li')).removeClass('active').find('.content').slideUp();
			jQuery(this).closest('.qs-accordion li').toggleClass('active').find('.content').slideToggle();
		});
	}
</script>