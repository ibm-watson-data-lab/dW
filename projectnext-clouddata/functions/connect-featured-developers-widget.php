<?php

// --------------------------------------
// Outputs site users in an array one time for select2 script
// ---------------------------------------

function output_connect_users_js_array() {
	global $pagenow;

	if ( 'widgets.php' === $pagenow ) {

	  // Output a global JS object for Select2 to use
	  ?>
	  <script>  
	  window.site_users = <?php the_site_users_for_select2(); ?>;
	  </script>
	  <?php
	}
}
add_action( 'admin_head', 'output_connect_users_js_array' );

class Connect_Developers_Widget extends WP_Widget {
	
	/**
	 * Register widget with WordPress.
	 */	
	public function __construct() {

		// widget actual processes
		parent::__construct(
			'pnext_connect_featured_developers', // Base ID
			__('Connect Featured Developers', 'pnext'), // Name (if you change this, check the JS file because you refer to it there)
			array( 'description' => __( 'Create a nice lookin&rsquo; strip of your users', 'text_domain' ), ) // Args
		);
				
	}


	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		if ( 'strip' === $instance['layout'] ) {
		  connect_developers( $instance['devs'], 'strip', $instance['title'] );
		}
		
		if ( 'sidebar' === $instance['layout'] ) {
		  echo $args['before_widget'];
		  if ( ! empty( $title ) )
			  echo $args['before_title'] . $title . $args['after_title'];
		  
		  echo connect_developers( $instance['devs'], 'sidebar' );
		  
		  echo $args['after_widget'];  
		}
		
	}


	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		
		$title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : __( 'New title', 'pnext' );
		$devs = isset( $instance[ 'devs' ] ) ? $instance['devs'] : '';
		$layout = isset( $instance['layout'] ) ? $instance['layout'] : 'sidebar';
		?>

		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><b><?php _e( 'Title:' ); ?></b></label> 
		<input class="widefat" 
		  id="<?php echo $this->get_field_id( 'title' ); ?>" 
		  name="<?php echo $this->get_field_name( 'title' ); ?>" 
		  type="text" 
		  value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'devs' ); ?>"><b><?php _e( 'Developers:' ); ?></b></label>
		<div>
		  <input type="hidden" 
			style="width:90%;" 
			id="<?php echo $this->get_field_id( 'devs' ); ?>"
			name="<?php echo $this->get_field_name( 'devs' ); ?>"  
			value="<?php echo esc_attr( $devs ); ?>" />
		</div>
		</p>
		
		<p>
		<b><?php _e('Layout:') ?></b> <br/>
		  <div>
			<label for="<?php echo $this->get_field_id( 'layout' ) . '_sidebar'; ?>">
			<input 
			  type="radio" 
			  id="<?php echo $this->get_field_id( 'layout' ) . '_sidebar'; ?>"
			  name="<?php echo $this->get_field_name( 'layout' ); ?>" 
			  value="sidebar"
			  <?php if ( 'sidebar' === $layout ) echo 'checked="checked"';?>
			  />
			  Sidebar (<i>smallish avatars only</i>)
			</label>
		  </div>

		  <div>
			<label for="<?php echo $this->get_field_id( 'layout' ) . '_strip'; ?>">
			<input 
			  type="radio" 
			  id="<?php echo $this->get_field_id( 'layout' ) . '_strip'; ?>"
			  name="<?php echo $this->get_field_name( 'layout' ); ?>" 
			  value="strip"
			  <?php if ( 'strip' === $layout ) echo 'checked="checked"';?>
			  />
			  Full-width strip (<i>This setting is for stand-alone widget areas that you add to your template. It ignores widget area settings like 'before_widget' or 'before_title'</i>)
			</label>
		  </div>
		  
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['devs'] = ( ! empty( $new_instance['devs'] ) ) ? strip_tags( $new_instance['devs'] ) : ''; 
		$instance['layout'] = ( ! empty( $new_instance['layout'] ) ) ? strip_tags( $new_instance['layout'] ) : 'strip';

		return $instance;
	}

}

add_action( 'widgets_init', function(){
	register_widget( 'Connect_Developers_Widget' );
});