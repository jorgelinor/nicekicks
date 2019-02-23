<?php
/**
 * Widget Suscribe
 *
 * @package Authentic Wordpress Theme
 * @subpackage Widgets
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

/**
 * Authentic Widget Suscribe Class
 */
class Authentic_Widget_Posts extends WP_Widget {

	/**
	 * Sets up a new widget instance.
	 */
	public function __construct() {

		$this->default_settings = array(
			'title'              => '',
			'layout'             => 'list',
			'thumbnail'          => 'sm-sq',
			'posts_per_page'     => 5,
			'orderby'            => 'date',
			'order'              => 'desc',
			'time_frame'         => '',
			'category'           => false,
			'post_meta'          => array( 'date' ),
			'post_meta_category' => false,
			'post_meta_compact'  => false,
			'featured'           => false,
		);

		$widget_details = array(
			'classname'   => 'authentic_widget_posts',
			'description' => esc_html__( 'Display a list of your posts.', 'authentic' ),
		);
		parent::__construct( 'authentic_widget_posts', esc_html__( 'Authentic: Posts', 'authentic' ), $widget_details );
	}

	/**
	 * Outputs the content for the current widget instance.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current widget instance.
	 */
	public function widget( $args, $instance ) {
		$params = array_merge( $this->default_settings, $instance );

		$posts_args = array(
			'posts_per_page'      => $params['posts_per_page'],
			'order'               => $params['order'],
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
		);

		if ( $params['category'] ) {
			$category          = $params['category'];
			$posts_args['cat'] = $category;
		}

		// Post order.
		if ( 'meta_value_num' === $params['orderby'] ) {
			// Post Views.
			$posts_args['orderby'] = 'post_views';
		} else {
			$posts_args['orderby'] = $params['orderby'];
		}

		if ( $params['featured'] ) {
			// Check if custom taxonomy was registered.
			if ( taxonomy_exists( 'csco_post_featured' ) ) {
				// Featured posts.
				$posts_args['tax_query'] = array(
					array(
						'taxonomy' => 'csco_post_featured',
						'field'    => 'slug',
						'terms'    => 'widget',
						),
					);
			}
		}

		if ( $params['time_frame'] ) {
			$posts_args['date_query'] = array(
				array(
					'column' => 'post_date_gmt',
					'after'  => $params['time_frame'] . ' ago',
				),
			);
		}

		$posts = new WP_Query( apply_filters( 'csco_widget_posts_query_args', $posts_args ) );

		if ( $posts->have_posts() ) {

			// Before Widget.
			echo $args['before_widget'];

			// Title.
			if ( $params['title'] ) {
				echo wp_kses_post( $args['before_title'] . apply_filters( 'widget_title', $params['title'], $instance, $this->id_base ) . $args['after_title'] );
			}
			?>

			<div class="widget-body layout-<?php echo esc_html( $params['layout'] ); ?> posts-per-page-<?php echo intval( $params['posts_per_page'] ); ?>">

			<?php if ( 'slider' === $params['layout'] ) { ?>

				<div class="owl-container owl-flip">
					<div class="owl-carousel">

						<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>

							<?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_ID(), $params['thumbnail'] ); ?>

							<div class="owl-slide">

								<article <?php post_class( 'overlay overlay-static' ); ?>>
									<?php the_post_thumbnail( $params['thumbnail'] ); ?>
									<div>
										<?php if ( $params['post_meta_category'] ) { csco_post_meta( 'category' ); } ?>
										<h3 class="entry-title"><?php the_title(); ?></h3>
										<?php csco_post_meta( $params['post_meta'], array(), (bool) $params['post_meta_compact'] ); ?>
										<?php csco_the_read_more(); ?>
									</div>
									<a href="<?php the_permalink(); ?>" class="overlay-link"></a>
								</article>

							</div>

						<?php endwhile; ?>

					</div>
					<div class="owl-dots"></div>
				</div>

			<?php } elseif ( 'list' === $params['layout'] ) { ?>

				<ul>
					<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>

						<li>
							<article>
								<div class="post-outer">
									<div class="post-inner">
										<a href="<?php the_permalink(); ?>" class="post-thumbnail">
											<?php the_post_thumbnail( $params['thumbnail'] ); ?>
										</a>
									</div>
									<div class="post-inner">
										<?php if ( $params['post_meta_category'] ) { csco_post_meta( 'category' ); } ?>
										<h5 class="media-heading entry-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h5>
										<?php csco_post_meta( $params['post_meta'], array(), (bool) $params['post_meta_compact'] ); ?>
									</div>
								</div>
							</article>
						</li>

					<?php endwhile; ?>
				</ul>

			<?php } elseif ( 'numbered' === $params['layout'] ) { ?>

				<ul>
					<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>

						<li>
							<article>
								<div class="post-outer">
									<div class="post-inner">
										<a href="<?php the_permalink(); ?>" class="post-thumbnail">
											<?php the_post_thumbnail( $params['thumbnail'] ); ?>
											<span class="post-number-wrap">
												<span class="post-number">
													<span><?php echo esc_html( $posts->current_post + 1 ); ?></span>
													<span><i class="icon icon-arrow-right"></i></span>
												</span>
											</span>
										</a>
									</div>
									<div class="post-inner">
										<?php if ( $params['post_meta_category'] ) { csco_post_meta( 'category' ); } ?>
										<h5 class="media-heading entry-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h5>
										<?php csco_post_meta( $params['post_meta'], array(), (bool) $params['post_meta_compact'] ); ?>
									</div>
								</div>
							</article>
						</li>

					<?php endwhile; ?>
				</ul>

			<?php } ?>

			</div>

			<?php

			// After Widget.
			echo $args['after_widget'];
		}

		wp_reset_postdata();
	}

	/**
	 * Handles updating settings for the current widget instance.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Settings to save or bool false to cancel saving.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $new_instance;

		// Post Meta.
		if ( ! isset( $instance['post_meta'] ) ) {
			$instance['post_meta'] = array();
		}

		// Category Post Meta.
		if ( ! isset( $instance['post_meta_category'] ) ) {
			$instance['post_meta_category'] = array();
		}

		// Compact Post Meta.
		if ( ! isset( $instance['post_meta_compact'] ) ) {
			$instance['post_meta_compact'] = array();
		}

		// Featured Posts.
		if ( ! isset( $instance['featured'] ) ) {
			$instance['featured'] = array();
		}

		return $instance;
	}

	/**
	 * Outputs the widget settings form.
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$params = array_merge( $this->default_settings, $instance );
		?>

			<!-- Title -->
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'authentic' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $params['title'] ); ?>" /></p>

			<!-- Layout -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"><?php esc_html_e( 'Layout', 'authentic' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>" class="widefat">
					<option value="list" <?php selected( $params['layout'], 'list' ); ?>><?php esc_html_e( 'List', 'authentic' ); ?></option>
					<option value="numbered" <?php selected( $params['layout'], 'numbered' ); ?>><?php esc_html_e( 'Numbered', 'authentic' ); ?></option>
					<option value="slider" <?php selected( $params['layout'], 'slider' ); ?>><?php esc_html_e( 'Slider', 'authentic' ); ?></option>
				</select>
			</p>

			<!-- Thumbnail -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'thumbnail' ) ); ?>"><?php esc_html_e( 'Thumbnail', 'authentic' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'thumbnail' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'thumbnail' ) ); ?>" class="widefat">
					<?php $image_sizes = csco_get_registered_image_sizes( true );
					var_dump( $image_sizes );
					foreach ( $image_sizes as $slug => $name ) { ?>
						<option value="<?php echo esc_html( $slug ); ?>" <?php selected( $params['thumbnail'], esc_html( $slug ) ); ?>><?php echo esc_html( $name ); ?></option>
					<?php } ?>
				</select>
			</p>

			<!-- Number of Posts -->
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'posts_per_page' ) ); ?>"><?php esc_html_e( 'Number of Posts', 'authentic' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'posts_per_page' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'posts_per_page' ) ); ?>" type="number" value="<?php echo esc_attr( $params['posts_per_page'] ); ?>" /></p>

			<!-- Order by -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php esc_html_e( 'Order by', 'authentic' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" class="widefat">
					<option value="date" <?php selected( $params['orderby'], 'date' ); ?>><?php esc_html_e( 'Date', 'authentic' ); ?></option>
					<option value="meta_value_num" <?php selected( $params['orderby'], 'meta_value_num' ); ?>><?php esc_html_e( 'Views', 'authentic' ); ?></option>
					<option value="comment_count" <?php selected( $params['orderby'], 'comment_count' ); ?>><?php esc_html_e( 'Comments', 'authentic' ); ?></option>
					<option value="rand" <?php selected( $params['orderby'], 'rand' ); ?>><?php esc_html_e( 'Random', 'authentic' ); ?></option>
				</select>
			</p>

			<!-- Order -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Order', 'authentic' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" class="widefat">
					<option value="desc" <?php selected( $params['order'], 'desc' ); ?>><?php esc_html_e( 'Descending', 'authentic' ); ?></option>
					<option value="asc" <?php selected( $params['order'], 'asc' ); ?>><?php esc_html_e( 'Ascending', 'authentic' ); ?></option>
				</select>
			</p>

			<!-- Time Frame -->
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'time_frame' ) ); ?>"><?php esc_html_e( 'Time Frame', 'authentic' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'time_frame' ) ); ?>" placeholder="<?php esc_html_e( '3 months', 'authentic' ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'time_frame' ) ); ?>" type="text" value="<?php echo esc_attr( $params['time_frame'] ); ?>" /></p>

			<!-- Category -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Category', 'authentic' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>[]" id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" class="widefat" style="height: auto !important;" multiple="multiple" size="8">
					<?php
						$cat_args = array(
							'hide_empty'   => 0,
							'hierarchical' => 1,
							'selected'     => (array) $params['category'],
							'walker'       => new CSCO_Add_Posts_Categories_Tree_Walker,
						);

						$allowed_html = array(
							'option' => array(
								'class'    => true,
								'value'    => true,
								'selected' => true,
							),
						);

						echo wp_kses( walk_category_dropdown_tree( get_categories( $cat_args ), 0, $cat_args ), $allowed_html );
					?>
				</select>
			</p>

			<!-- Post meta -->
			<h4><?php esc_html_e( 'Post Meta', 'authentic' ); ?></h4>

			<p><input id="<?php echo esc_attr( $this->get_field_id( 'post_meta_category' ) ); ?>" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'post_meta_category' ) ); ?>" type="checkbox" <?php checked( (bool) $params['post_meta_category'] ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'post_meta_category' ) ); ?>"><?php esc_html_e( 'Category', 'authentic' ); ?></label></p>

			<p><input id="<?php echo esc_attr( $this->get_field_id( 'post_meta' ) ); ?>-date" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'post_meta' ) ); ?>[]" type="checkbox" value="date" <?php checked( in_array( 'date', (array) $params['post_meta'], true ) ? true : false ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'post_meta' ) ); ?>-date"><?php esc_html_e( 'Date', 'authentic' ); ?></label></p>

			<p><input id="<?php echo esc_attr( $this->get_field_id( 'post_meta' ) ); ?>-author" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'post_meta' ) ); ?>[]" type="checkbox" value="author" <?php checked( in_array( 'author', (array) $params['post_meta'], true ) ? true : false ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'post_meta' ) ); ?>-author"><?php esc_html_e( 'Author', 'authentic' ); ?></label></p>

			<p><input id="<?php echo esc_attr( $this->get_field_id( 'post_meta' ) ); ?>-reading_time" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'post_meta' ) ); ?>[]" type="checkbox" value="reading_time" <?php checked( in_array( 'reading_time', (array) $params['post_meta'], true ) ? true : false ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'post_meta' ) ); ?>-reading_time"><?php esc_html_e( 'Reading Time', 'authentic' ); ?></label></p>

			<p><input id="<?php echo esc_attr( $this->get_field_id( 'post_meta' ) ); ?>-views" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'post_meta' ) ); ?>[]" type="checkbox" value="views" <?php checked( in_array( 'views', (array) $params['post_meta'], true ) ? true : false ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'params' ) ); ?>-views"><?php esc_html_e( 'Views', 'authentic' ); ?></label></p>

			<p><input id="<?php echo esc_attr( $this->get_field_id( 'post_meta' ) ); ?>-comments_count" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'post_meta' ) ); ?>[]" type="checkbox" value="comments_count" <?php checked( in_array( 'comments_count', (array) $params['post_meta'], true ) ? true : false ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'params' ) ); ?>-comments_count"><?php esc_html_e( 'Comments Count', 'authentic' ); ?></label></p>

			<!-- Compact Post Meta -->
			<h4><?php esc_html_e( 'Compact Post Meta', 'authentic' ); ?></h4>
			<p><input id="<?php echo esc_attr( $this->get_field_id( 'post_meta_compact' ) ); ?>" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'post_meta_compact' ) ); ?>" type="checkbox" <?php checked( (bool) $params['post_meta_compact'] ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'post_meta_compact' ) ); ?>"><?php esc_html_e( 'Display compact post meta', 'authentic' ); ?></label></p>

			<!-- Featured Posts -->
			<h4><?php esc_html_e( 'Featured Posts', 'authentic' ); ?></h4>
			<p><input id="<?php echo esc_attr( $this->get_field_id( 'featured' ) ); ?>" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'featured' ) ); ?>" type="checkbox" <?php checked( (bool) $params['featured'] ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'featured' ) ); ?>"><?php esc_html_e( 'Include only featured posts', 'authentic' ); ?></label></p>
		<?php
	}
}


/**
 * Create HTML dropdown list of Categories.
 */
class CSCO_Add_Posts_Categories_Tree_Walker extends Walker_CategoryDropdown {

	/**
	 * Starts the element output.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @see Walker::start_el()
	 *
	 * @param string $output   Passed by reference. Used to append additional content.
	 * @param object $category Category data object.
	 * @param int    $depth    Depth of category. Used for padding.
	 * @param array  $args     Uses 'selected', 'show_count', and 'value_field' keys, if they exist.
	 *                         See wp_dropdown_categories().
	 * @param int    $id       Optional. ID of the current category. Default 0 (unused).
	 */
	public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
		$pad  = str_repeat( '&nbsp;', $depth * 3 );
		$pad .= $depth > 0 ? '- ' : '';

		$term_id  = isset( $category->term_id ) ? intval( $category->term_id ) : false;
		if ( $term_id ) {
			$cat_name = apply_filters( 'list_cats', $category->name, $category );
			$output  .= "\t<option class='level-$depth' value='" . $term_id . "'";
			$selected = (array) $args['selected'];
			$selected = array_map( 'intval', $selected );
			if ( in_array( $term_id, $selected, true ) ) {
				$output .= ' selected="selected"';
			}
			$output .= '>';
			$output .= $pad . $cat_name;
			$output .= "</option>\n";
		}
	}
}
