<?php
/**
 * Register blocks
 */
function register_acf_block_types() {
    acf_register_block_type(array(
        'name'              => 'block_promotion',
        'title'             => __( 'קידום', 'qstheme' ),
        'render_template'   => 'inc/blocks/block-promotion.php',
        'category'          => 'qs-blocks',
        'icon'              => 'star-filled',
        'keywords'          => array( 'slider' ),
    ));
    acf_register_block_type(array(
        'name'              => 'block_programs',
        'title'             => __( 'תכניות לימוד', 'qstheme' ),
        'render_template'   => 'inc/blocks/block-programs.php',
        'category'          => 'qs-blocks',
        'icon'              => 'star-filled',
        'keywords'          => array( 'slider' ),
    ));
}

if ( function_exists( 'acf_register_block_type' ) ) {
    add_action( 'acf/init', 'register_acf_block_types');
}

/**
 * Register block categoires
 */
function qs_block_categories( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'qs-blocks',
				'title' => __( 'Custom Blocks', 'qstheme' ),
			),
		)
	);
}
add_filter( 'block_categories', 'qs_block_categories', 10, 2);