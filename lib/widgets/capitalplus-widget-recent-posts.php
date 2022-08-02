<?php
// Register and load the widget
function load_custom_widget() {
    register_widget('CapitalPlus_Recent_Posts_Widget');
}
add_action('widgets_init', 'load_custom_widget');

/**
 * Widget API: WP_Widget_Recent_Posts class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement a Recent Posts widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class CapitalPlus_Recent_Posts_Widget extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'custom-recent-posts',
			'description' => __( 'Capital Plus: recent posts widget' ),
			'customize_selective_refresh' => true,
		);

		parent::__construct( 'custom-recent-posts', __( 'Capital Plus: Recent Posts' ), $widget_ops );
		$this->alt_option_name = 'widget_recent_blog_posts';
	}

	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$default_title = __( 'Recent Posts' );
		$title         = ( ! empty( $instance['title'] ) ) ? $instance['title'] : $default_title;

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 3;
		if ( ! $number ) {
			$number = 3;
		}
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		$r = new WP_Query(
			/**
			 * Filters the arguments for the Recent Posts widget.
			 *
			 * @since 3.4.0
			 * @since 4.9.0 Added the `$instance` parameter.
			 *
			 * @see WP_Query::get_posts()
			 *
			 * @param array $args     An array of arguments used to retrieve the recent posts.
			 * @param array $instance Array of settings for the current widget.
			 */
			apply_filters(
				'widget_posts_args',
				array(
					'posts_per_page'      => $number,
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
				),
				$instance
			)
		);

		if ( ! $r->have_posts() ) {
			return;
		}
		?>

		<?php echo $args['before_widget']; ?>

		<?php
		if ( $title ) {
			echo '<div class="aside-head">';
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$format = current_theme_supports( 'html5', 'navigation-widgets' ) ? 'html5' : 'xhtml';

		/** This filter is documented in wp-includes/widgets/class-wp-nav-menu-widget.php */
		$format = apply_filters( 'navigation_widgets_format', $format );

		if ( 'html5' === $format ) {
			// The title may be filtered: Strip out HTML and make sure the aria-label is never empty.
			$title      = trim( strip_tags( $title ) );
			$aria_label = $title ? $title : $default_title;
			echo '<nav aria-label="' . esc_attr( $aria_label ) . '">';
		}
		?>

			<?php foreach ( $r->posts as $recent_post ) : ?>
				<?php
				$post_title   = get_the_title( $recent_post->ID, THEME_TEXTDOMAIN );
				$title        = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );
				$aria_current = '';

				if ( get_queried_object_id() === $recent_post->ID ) {
					$aria_current = ' aria-current="page"';
				}
				?>
				<a href="<?php the_permalink( $recent_post->ID, THEME_TEXTDOMAIN ); ?>" <?php echo $aria_current; ?>>
                <div class="card d-flex">
					<div class="img-wrap">
					<?php
				if(!empty(get_the_post_thumbnail_url( $recent_post->ID ))){
					?>
						<img src="<?php echo get_the_post_thumbnail_url( $recent_post->ID, THEME_TEXTDOMAIN ); ?>" class="img-fluid rounded-start" alt="...">
					<?php
				}
				else{
					$default_post_thumb_image = carbon_get_theme_option( 'default_post_thumb_image');
					$attached_default_post_thumb_image = get_media_url($default_post_thumb_image,'full');
					if(!empty($default_post_thumb_image)){
					?>
						<picture>
							<!-- Desktop -->
							<source class="img-fluid rounded-start" media="(min-width: 1200px)" srcset="<?php echo $attached_default_post_thumb_image; ?>">
							<!-- Tab -->
							<source class="img-fluid rounded-start" media="(min-width: 575px)" srcset="<?php echo $attached_default_post_thumb_image; ?>">
							<!-- Mobile -->
							<img class="img-fluid rounded-start" src="<?php echo $attached_default_post_thumb_image; ?>" alt="Default Post Image">
						</picture>
					<?php
					}
				}
				?>
                </div>
					<div class="content-warp f-center">
						<div class="card-body">
							<h5 class="cmn-heading">
								<?php echo $title; ?>
							</h5>
						</div>
					</div>
                </div>
				</a>
			<?php endforeach; ?>
		

		<?php
		if ( 'html5' === $format ) {
			echo '</nav>';
		}
		$page_for_posts = get_option( 'page_for_posts' );
		?>
		<a href="<?php echo esc_attr( esc_url( get_page_link( $page_for_posts ) ) ) ?><?php esc_html_e( '#blog', THEME_TEXTDOMAIN) ?>" class="btn bg-green cmn-btn"><?php esc_html_e( 'View More Posts', THEME_TEXTDOMAIN) ?></a>
		</div>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance              = $old_instance;
		$instance['title']     = sanitize_text_field( $new_instance['title'] );
		$instance['number']    = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since 2.8.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 3;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title', THEME_TEXTDOMAIN ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title', THEME_TEXTDOMAIN ); ?>" name="<?php echo $this->get_field_name( 'title', THEME_TEXTDOMAIN ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number', THEME_TEXTDOMAIN ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' , THEME_TEXTDOMAIN); ?>" name="<?php echo $this->get_field_name( 'number', THEME_TEXTDOMAIN ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
		</p>

		<p>
			<input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date', THEME_TEXTDOMAIN ); ?>" name="<?php echo $this->get_field_name( 'show_date', THEME_TEXTDOMAIN ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_date', THEME_TEXTDOMAIN ); ?>"><?php _e( 'Display post date?' ); ?></label>
		</p>
		<?php
	}
}
