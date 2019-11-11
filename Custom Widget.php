<?php
/**
 * Register custom sidebars and widgets
 */
function register_siderbars_and_widgets() {
	register_sidebar( 
		array(
			'name' 			=> __( 'Library Page', 'qstheme' ),
			'id'   			=> 'library',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
	        'after_widget'  => '</div>',
		)
	);

	register_widget( 'social_networks' );
}
add_action('widgets_init', 'register_siderbars_and_widgets');

/**
 * Custom widget: Socials networks
 */
class social_networks extends WP_Widget {
	function __construct() {
		parent::__construct(
			'social_networks',
			__( 'Social Networks', 'qstheme' ),
			array( 'description' => __( 'Social networks widget', 'qstheme' ) )
		);
	}

	// Creating widget front-end
	public function widget( $args, $instance ) {
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];

		// This is where you run the code and display the output
		ob_start();
		?>
	
		<div class="widget-in">
			<?php the_field( 'facebook', 'widget_' . $args['widget_id'] ); ?>
			<?php the_field( 'whatsapp', 'widget_' . $args['widget_id'] ); ?>
			<?php the_field( 'instagram', 'widget_' . $args['widget_id'] ); ?>
		</div>

		<?php 
		echo ob_get_clean(); 
		echo $args['after_widget'];
	}

	// Widget Backend
	public function form( $instance ) {
		// Fields are created by ACF
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		
		return $instance;
	}
}