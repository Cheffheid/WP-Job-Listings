<?php
/**
 *
 * Job Locations widget.
 *
 * @link       http://jeffreydewit.com
 * @since      1.0.0
 *
 * @package    job-listings
 * @subpackage job-listings/widgets
 */

/**
 * Job Locations widget.
 *
 * Defines a widget that lists the available location taxonomy terms.
 *
 * @since      1.0.0
 * @package    job-listings
 * @subpackage job-listings/widgets
 * @author     Jeffrey de Wit <jeff@jeffreydewit.com>
 */
class JJ_Job_Locations_Widget extends WP_Widget {

	/**
	 * Sets the widget slug value.
	 *
	 * @var string
	 */
	protected $widget_slug = 'jj-job-locations-widget';

	/**
	 * Define the widget properties.
	 */
	public function __construct() {
		parent::__construct(
			$this->get_widget_slug(),
			__( 'Job Locations', 'jj-job-listings' ),
			array(
				'classname'  => $this->get_widget_slug() . '-class',
				'description' => __( 'Lists job locations with available jobs.', 'jj-job-listings' ),
			)
		);
	}

	/**
	 * Return the widget slug.
	 *
	 * @since    1.0.0
	 *
	 * @return    Plugin slug variable.
	 */
	public function get_widget_slug() {
		return $this->widget_slug;
	}

	/**
	 * Outputs the content of the widget.
	 *
	 * @param array $args  The array of form elements.
	 * @param array $instance The current instance of the widget.
	 */
	public function widget( $args, $instance ) {
		global $wp_query;

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$before_widget = $args['before_widget'];
		$after_widget = $args['after_widget'];
		$before_title = $args['before_title'];
		$after_title = $args['after_title'];

		$taxonomy = 'job-location';
		$locations = get_terms( $taxonomy );
		$current_term = get_query_var( 'term' );

		$widget_html = $before_widget;
		$widget_html .= $before_title;
		$widget_html .= $title;
		$widget_html .= $after_title;
		$widget_html .= '<ul class="locations">';

		foreach ( $locations as $location ) {
			$class = '';

			if ( $current_term === $location->slug ) {
				$class = 'active';
			}

			$widget_html .= sprintf( '<li><a href="%s" class="%s">%s</a></li>',
				esc_attr( get_term_link( $location, $taxonomy ) ),
				$class,
				$location->name
			);
		}

		$widget_html .= '</ul>';
		$widget_html .= $after_widget;

		echo wp_kses_post( $widget_html );
	}

	/**
	 * Processes the widget's options to be saved.
	 *
	 * @param array $new_instance The new instance of values to be generated via the update.
	 * @param array $old_instance The previous instance of values before the update.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	/**
	 * Generates the administration form for the widget.
	 *
	 * @param array $instance The array of keys and values for the widget.
	 */
	public function form( $instance ) {

		$instance = wp_parse_args(
			(array) $instance,
			array( 'title' => '' )
		);

		$title = ! empty( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

		include( plugin_dir_path( __FILE__ ) . 'views/admin.php' );

	}
}
