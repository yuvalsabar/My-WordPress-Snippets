<?php if ( ! isset( $_COOKIE['gdpr'] ) ) : ?>

	<div class="gdpr-cookies">
		<div class="container">
			<div class="entry-text">
				<?php the_field( 'gdpr_content', 'option' ); ?>
			</div>
			<a href="#" rel="nofollow" class="btn-gdpr">
				<?php _e( 'I agree', 'qstheme' );?>
			</a>
		</div>
	</div>

<?php endif ;?>