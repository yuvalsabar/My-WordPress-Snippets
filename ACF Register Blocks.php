<?php
/**
 * Register blocks
 */
function register_acf_block_types() {
    acf_register_block_type(array(
        'name'              => 'block_name_1',
        'title'             => __( 'Block 1', 'ystheme' ),
        'render_template'   => 'inc/blocks/block-name-1.php',
        'category'          => 'ys-blocks',
        'icon'              => 'star-filled',
        'keywords'          => array( 'slider' ),
    ));
    acf_register_block_type(array(
        'name'              => 'block_name_2',
        'title'             => __( 'Block 2', 'ystheme' ),
        'render_template'   => 'inc/blocks/block-name-2.php',
        'category'          => 'ys-blocks',
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
function ys_block_categories( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'ys-blocks',
				'title' => __( 'Custom Blocks', 'ystheme' ),
			),
		)
	);
}
add_filter( 'block_categories', 'ys_block_categories', 10, 2);