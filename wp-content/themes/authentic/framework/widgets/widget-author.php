<?php
/**
 * Widget Author
 *
 * @package Authentic Wordpress Theme
 * @subpackage Widgets
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

/**
 * Authentic Widget Author Class
 */
class Authentic_Widget_Author extends WP_Widget {

	/**
	 * Sets up a new widget instance.
	 */
	public function __construct() {

		$this->default_settings = array(
			'title'           => esc_html__( 'Author', 'authentic' ),
			'author_id'       => '',
			'avatar'          => true,
			'posts_only'      => false,
			'author_name'     => true,
			'description'     => true,
			'social_accounts' => true,
			'archive_btn'     => true,
		);

		$widget_details = array(
			'classname'   => 'authentic_widget_author',
			'description' => '',
		);
		parent::__construct( 'authentic_widget_author', esc_html__( 'Authentic: Author', 'authentic' ), $widget_details );
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

		// Display on author’s posts only.
		if ( $params['posts_only'] ) {
			if ( is_single() ) {
				$post_id = get_queried_object_id();

				if ( get_post_field( 'post_author', $post_id ) !== $params['author_id'] ) {
					return false;
				}
			} else {
				return false;
			}
		}

		// Before Widget.
		echo $args['before_widget'];

		// Content.
		?>
			<div class="widget-body">
				<?php if ( $params['avatar'] ) { ?>
					<div class="widget-media">
						<?php if ( $params['archive_btn'] ) { ?>
							<a href="<?php echo esc_url( get_author_posts_url( $params['author_id'] ) ); ?>" class="arhive-link">
								<?php echo get_avatar( $params['author_id'], 160 ); ?>
							</a>
						<?php } else { ?>
							<?php echo get_avatar( $params['author_id'], 160 ); ?>
						<?php } ?>
					</div>
				<?php } ?>

				<?php
				if ( $params['author_name'] ) {
					echo wp_kses_post( $args['before_title'] . get_the_author_meta( 'display_name', $params['author_id'] ) . $args['after_title'] );
				} else {
					if ( $params['title'] ) {
						echo wp_kses_post( $args['before_title'] . apply_filters( 'widget_title', $params['title'], $instance, $this->id_base ) . $args['after_title'] );
					}
				} ?>

				<?php
				if ( $params['description'] ) {
					$author_description = get_the_author_meta( 'description', $params['author_id'] );

					if ( $author_description ) { ?>
						<div class="widget-content"><?php echo wp_kses_post( $author_description ); ?></div>
					<?php }
				}
				?>

				<?php if ( $params['social_accounts'] ) { ?>
					<div class="social-accounts">
						<?php csco_post_author_social_accounts( $params['social_accounts'], $params['author_id'] ); ?>
					</div>
				<?php } ?>

				<?php if ( $params['archive_btn'] ) { ?>
					<a href="<?php echo esc_url( get_author_posts_url( $params['author_id'] ) ); ?>" class="btn btn-primary btn-effect"><span><?php esc_html_e( 'View Posts', 'authentic' ); ?></span><span><i class="icon icon-arrow-right"></i></span></a>
				<?php } ?>
			</div>
		<?php

		// After Widget.
		echo $args['after_widget'];
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

		// Display on author’s posts only.
		if ( ! isset( $instance['posts_only'] ) ) {
			$instance['posts_only'] = false;
		}

		// Display author’s avatar.
		if ( ! isset( $instance['avatar'] ) ) {
			$instance['avatar'] = false;
		}

		// Display author’s display name.
		if ( ! isset( $instance['author_name'] ) ) {
			$instance['author_name'] = false;
		}

		// Display author’s description.
		if ( ! isset( $instance['description'] ) ) {
			$instance['description'] = false;
		}

		// Display author’s social accounts.
		if ( ! isset( $instance['social_accounts'] ) ) {
			$instance['social_accounts'] = false;
		}

		// Display post archive button.
		if ( ! isset( $instance['archive_btn'] ) ) {
			$instance['archive_btn'] = false;
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

			<!-- Author -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'author_id' ) ); ?>"><?php esc_html_e( 'Author', 'authentic' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'author_id' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'author_id' ) ); ?>" class="widefat">
					<?php
					if ( function_exists( 'csco_get_post_authors' ) ) {
						$authors = csco_get_post_authors();
						foreach ( $authors as $user_id => $display_name ) {
							?>
								<option value="<?php echo esc_attr( $user_id ); ?>" <?php selected( $params['author_id'], $user_id ); ?>><?php echo esc_html( $display_name ); ?></option>
							<?php
						}
					}
					?>
				</select>
			</p>

			<!-- Display author’s avatar -->
			<p><input id="<?php echo esc_attr( $this->get_field_id( 'avatar' ) ); ?>" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'avatar' ) ); ?>" type="checkbox" <?php checked( (bool) $params['avatar'] ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'avatar' ) ); ?>"><?php esc_html_e( 'Display author’s avatar', 'authentic' ); ?></label></p>

			<!-- Display author’s display name -->
			<p><input id="<?php echo esc_attr( $this->get_field_id( 'author_name' ) ); ?>" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'author_name' ) ); ?>" type="checkbox" <?php checked( (bool) $params['author_name'] ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'author_name' ) ); ?>"><?php esc_html_e( 'Display author’s name instead of widget title', 'authentic' ); ?></label></p>

			<!-- Display author’s description -->
			<p><input id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" type="checkbox" <?php checked( (bool) $params['description'] ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_html_e( 'Display author’s description', 'authentic' ); ?></label></p>

			<!-- Display author’s social accounts -->
			<p><input id="<?php echo esc_attr( $this->get_field_id( 'social_accounts' ) ); ?>" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'social_accounts' ) ); ?>" type="checkbox" <?php checked( (bool) $params['social_accounts'] ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_accounts' ) ); ?>"><?php esc_html_e( 'Display author’s social accounts', 'authentic' ); ?></label></p>

			<!-- Display post archive button -->
			<p><input id="<?php echo esc_attr( $this->get_field_id( 'archive_btn' ) ); ?>" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'archive_btn' ) ); ?>" type="checkbox" <?php checked( (bool) $params['archive_btn'] ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'archive_btn' ) ); ?>"><?php esc_html_e( 'Display post archive button', 'authentic' ); ?></label></p>

			<!-- Display on author’s posts only -->
			<p><input id="<?php echo esc_attr( $this->get_field_id( 'posts_only' ) ); ?>" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'posts_only' ) ); ?>" type="checkbox" <?php checked( (bool) $params['posts_only'] ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'posts_only' ) ); ?>"><?php esc_html_e( 'Display on author’s posts only', 'authentic' ); ?></label></p>

		<?php
	}
}
