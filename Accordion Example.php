<?php if ( have_rows( 'accordion' ) ) : ?>

	<ul class="accordion">

		<?php while ( have_rows( 'accordion' ) ) : the_row();?>

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

<?php endif;?>

<script>
function accordion_init() {
    $('.accordion li .entry-title a').click(function(e) {
        e.preventDefault();
        $('.accordion li.active').not($(this).closest('.accordion li')).removeClass('active').find('.entry-content').slideUp();
        $(this).closest('.accordion li').toggleClass('active').find('.entry-content').slideToggle();
    });
}
</script>
