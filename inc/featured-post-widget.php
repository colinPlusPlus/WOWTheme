<?php
/**
 * Description: This widget will add custom icons to each category listed.
 * Author: Colin Williams
 * Author URI: http://www.mainstreetcreativeco.com
 */

/**
 * Adds Featured_Post_Widget widget.
 */
class Featured_Post_Widget extends WP_Widget {


	/**
	 * Register widget with WordPress.
	 */

	function __construct() {

		$this->defaults = array(
			'title'                   => 'From The Blog:',
			'posts_cat'               => '',
			'posts_num'               => 3,
			'posts_offset'            => 0,
			'orderby'                 => '',
			'order'                   => '',
			'exclude_displayed'       => 0,
			'show_image'              => 1,
			);

		parent::__construct(
			'wow_featured_posts', // Base ID
			__('Featured Posts'), // Name
			array( 'description' => __( 'This is where you can customize your featured posts', 'text_domain' ), ) // Args
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
		
		global $wp_query;

		$instance = wp_parse_args( (array) $instance, $this->defaults );

		$title = $instance['title'];

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$query_args = array(
			'post_type' => 'post',
			'cat'       => $instance['posts_cat'],
			'showposts' => $instance['posts_num'],
			'offset'    => $instance['posts_offset'],
			'orderby'   => $instance['orderby'],
			'order'     => $instance['order'],
		);

		$wp_query = new WP_Query( $query_args );

		if ( have_posts() ) : while ( have_posts() ) : the_post();
		?>
			<article>
				<?php if($instance['show_image']):?>
				<div class="content">
					<h1><a href="<?php echo get_the_permalink(); ?>"> <?php echo get_the_title(); ?></a></h1>
					<p class="date"><?php echo get_the_date('M j/y') ?> &nbsp; By: <?php echo get_the_author(); ?>&nbsp; In: <?php the_category(', '); ?></p>
					<p><?php echo get_the_excerpt(); ?></p>
					<a href="<?php echo get_the_permalink(); ?>"><span class="read-btn">Read more</span></a>
				</div>
				<?php if(has_post_thumbnail()): ?>
					<?php the_post_thumbnail( 'full', array( 'class '=> 'img-responsive', 'alt' => 'the_title_attribute()' ) ); ?>
				<?php endif; ?>
				<?php else: ?>
				<div class="content-alt">
					<h1><a href="<?php echo get_the_permalink(); ?>"> <?php echo get_the_title(); ?></a></h1>
					<p class="date"><?php echo get_the_date('M j/y') ?> &nbsp; By: <?php echo get_the_author(); ?>&nbsp; In: <?php the_category(', '); ?></p>
					<p><?php echo get_the_excerpt(); ?></p>
					<a href="<?php echo get_the_permalink(); ?>"><span class="read-btn">Read more</span></a>
				</div>
				<?php endif; ?>
			</article>
		<?php
		endwhile; endif;
		wp_reset_query();
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'posts_cat' ); ?>"><?php _e( 'Category ' ); ?>:</label>
					<?php
					$categories_args = array(
						'name'            => $this->get_field_name( 'posts_cat' ),
						'selected'        => $instance['posts_cat'],
						'orderby'         => 'Name',
						'hierarchical'    => 1,
						'show_option_all' => __( 'All Categories'),
						'hide_empty'      => '0',
					);
					wp_dropdown_categories( $categories_args ); ?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_num' ); ?>"><?php _e( 'Number of Posts to Show'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'posts_num' ); ?>" name="<?php echo $this->get_field_name( 'posts_num' ); ?>" value="<?php echo esc_attr( $instance['posts_num'] ); ?>" size="2" />
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'show_image' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'show_image' ); ?>" value="1" <?php checked( $instance['show_image'] ); ?>/>
			<label for="<?php echo $this->get_field_id( 'show_image' ); ?>"><?php _e( 'Show Featured Image'); ?></label>
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
		$instance['posts_cat'] = ( ! empty( $new_instance['posts_cat'] ) ) ? strip_tags( $new_instance['posts_cat'] ) : '' ;
		$instance['posts_num'] = ( ! empty( $new_instance['posts_num'] ) ) ? strip_tags( $new_instance['posts_num'] ) : '' ;
		$instance['show_image'] = ( ! empty( $new_instance['show_image'] ) ) ? strip_tags( $new_instance['show_image'] ) : '' ;
		return $instance;
	}

} // class Featured_Post_Widget
