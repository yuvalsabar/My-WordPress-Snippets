<div class="filter">
	<span class="entry-text">
		<?php _e( 'Search By', 'qstheme' ); ?>
	</span>
	
	<ul class="filter-buttons">
		<li>
			<span class="btn-filter btn-filter-all" data-all="all">
				<?php _e( 'All', 'qstheme' ); ?>
			</span>
		</li>
		<li>
			<span class="filter-cat">
				<?php _e( 'Category', 'qstheme' );?>
				<span class="sprite sprite-arrow-down-white" aria-hidden="true"></span>
			</span>
			
			<?php $terms = get_terms( 'partner_cat' ); ?>

			<ul class="dropdown">
				<?php foreach ( $terms as $term ): ?>
					<li>
						<a href="#" class="btn-filter" data-partner_cat="<?php echo $term->term_id; ?>" rel="nofollow">
							<?php echo $term->name; ?>
						</a>
					</li>
				<?php endforeach ?>
			</ul>
		</li>
		<li>
			<span class="filter-cat">
				<?php _e( 'Country', 'qstheme' );?>
				<span class="sprite sprite-arrow-down-white" aria-hidden="true"></span>
			</span>

			<?php $terms = get_terms( 'country_cat' ); ?>

			<ul class="dropdown">
				<?php foreach ( $terms as $term ): ?>
					<li>
						<a href="#" class="btn-filter" data-country_cat="<?php echo $term->term_id; ?>" rel="nofollow">
							<?php echo $term->name; ?>
						</a>
					</li>
				<?php endforeach ?>
			</ul>
		</li>
	</ul>
</div>
