<?php
/**
 * Widget About
 *
 * @package Authentic Wordpress Theme
 * @subpackage Widgets
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

/**
 * Authentic Widget About Class
 */
class Authentic_Widget_About extends WP_Widget {

	/**
	 * Sets up a new widget instance.
	 */
	public function __construct() {

		$this->default_settings = array(
			'title'       => esc_html__( 'About us', 'authentic' ),
			'subtitle'    => '',
			'image'       => false,
			'text'        => '',
			'button_url'  => '',
			'button_text' => '',
			'social_accounts' => true,
		);

		$widget_details = array(
			'classname'   => 'authentic_widget_about',
			'description' => esc_html__( 'Display Image, Text and Social Accounts.', 'authentic' ),
		);
		parent::__construct( 'authentic_widget_about', esc_html__( 'Authentic: About', 'authentic' ), $widget_details );
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

		// Before Widget.
		echo $args['before_widget'];

		// Image.
		if ( $params['image'] ) {
			echo sprintf( '<div class="widget-media"><img src="%1$s" alt="%2$s"></div>', esc_url( $params['image'] ), esc_html( get_bloginfo() ) );
		}

		// Title.
		if ( $params['title'] ) {
			echo wp_kses_post( $args['before_title'] . apply_filters( 'widget_title', $params['title'], $instance, $this->id_base ) . $args['after_title'] );
		}

		// Subtitle.
		if ( $params['subtitle'] ) {
			echo sprintf( '<p class="text-small">%1$s</p>', wp_kses_post( $params['subtitle'] ) );
		}

		// Subtitle.
		if ( $params['text'] ) {
			echo sprintf( '<div class="widget-content">%1$s</div>', wp_kses_post( $params['text'] ) );
		}

		?>

		<?php if ( ! empty( $params['button_url'] ) && ! empty( $params['button_text'] ) ) { ?>
			<a href="<?php echo esc_url( $params['button_url'], null, '' ); ?>" class="btn btn-secondary btn-effect">
				<span><?php echo wp_kses_post( $params['button_text'] ); ?></span>
				<span><i class="icon icon-arrow-right"></i></span>
			</a>
		<?php } ?>

		<?php

		if ( $params['social_accounts'] ) {

			if ( function_exists( 'bsa_get_accounts' ) ) {

				bsa_get_accounts( false, false, false, 'default' );

			} else { ?>

				<div class="alert alert-warning"><?php esc_html_e( 'This feature requires the Basic Social Accounts plugin.', 'authentic' ); ?></div>

			<?php }
		}

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

		// Socials.
		if ( ! isset( $instance['social_accounts'] ) ) {
			$instance['social_accounts'] = false;
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

			<!-- Subtitle -->
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>"><?php esc_html_e( 'Subtitle', 'authentic' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'subtitle' ) ); ?>" type="text" value="<?php echo esc_attr( $params['subtitle'] ); ?>" /></p>

			<!-- Image URL -->
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php esc_html_e( 'Image URL', 'authentic' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" type="text" value="<?php echo esc_attr( $params['image'] ); ?>" /></p>

			<!-- Text -->
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php esc_html_e( 'Text', 'authentic' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" rows="10"><?php echo esc_textarea( $params['text'] ); ?></textarea></p>

			<!-- Button URL -->
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'button_url' ) ); ?>"><?php esc_html_e( 'Button URL', 'authentic' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_url' ) ); ?>" type="text" value="<?php echo esc_attr( $params['button_url'] ); ?>" /></p>

			<!-- Button Text -->
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>"><?php esc_html_e( 'Button Text', 'authentic' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_text' ) ); ?>" type="text" value="<?php echo esc_attr( $params['button_text'] ); ?>" /></p>

			<!-- Socials -->
			<p><input id="<?php echo esc_attr( $this->get_field_id( 'social_accounts' ) ); ?>" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'social_accounts' ) ); ?>" type="checkbox" <?php checked( (bool) $params['social_accounts'] ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_accounts' ) ); ?>"><?php esc_html_e( 'Display list of social accounts', 'authentic' ); ?></label></p>
		<?php
	}
}
