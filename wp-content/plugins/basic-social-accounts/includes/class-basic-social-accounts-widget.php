<?php
/**
 * Widget Social Accounts
 *
 * @link       https://codesupply.co
 * @since      1.0.0
 *
 * @package    Basic Social Accounts
 * @subpackage Widget
 */

/**
 * Basic Widget Social Accounts
 */
class Basic_Social_Accounts_Widget extends WP_Widget {

	/**
	 * Sets up a new widget instance.
	 */
	public function __construct() {

		$this->default_settings = array(
			'title'                 => esc_html__( 'Social Accounts', 'basic-social-accounts' ),
			'template'              => 'default',
			'cache'                 => true,
			'labels'                => true,
			'titles'                => true,
			'counts'                => true,
		);

		$widget_details = array(
			'classname' => 'basic_social_accounts_widget',
			'description' => esc_html__( 'A list of social media accounts with counters.', 'basic-social-accounts' ),
		);
		parent::__construct( 'basic_social_accounts_widget', esc_html__( 'Social Accounts', 'basic-social-accounts' ), $widget_details );
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
		?>

		<div class="widget-body">
			<?php

			// Title.
			if ( $params['title'] ) {
				echo wp_kses_post( $args['before_title'] . apply_filters( 'widget_title', $params['title'], $instance, $this->id_base ) . $args['after_title'] );
			}

			bsa_template_appearance( $params );
			?>
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

		// Labels.
		if ( ! isset( $instance['labels'] ) ) {
			$instance['labels'] = false;
		}

		// Titles.
		if ( ! isset( $instance['titles'] ) ) {
			$instance['titles'] = false;
		}

		// Counts.
		if ( ! isset( $instance['counts'] ) ) {
			$instance['counts'] = false;
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
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'basic-social-accounts' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $params['title'] ); ?>" /></p>

			<!-- Labels -->
			<p><input id="<?php echo esc_attr( $this->get_field_id( 'labels' ) ); ?>" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'labels' ) ); ?>" type="checkbox" <?php checked( (bool) $params['labels'] ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'labels' ) ); ?>"><?php esc_html_e( 'Display labels', 'basic-social-accounts' ); ?></label></p>

			<!-- Titles -->
			<p><input id="<?php echo esc_attr( $this->get_field_id( 'titles' ) ); ?>" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'titles' ) ); ?>" type="checkbox" <?php checked( (bool) $params['titles'] ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'titles' ) ); ?>"><?php esc_html_e( 'Display titles', 'basic-social-accounts' ); ?></label></p>

			<!-- Сounts -->
			<p><input id="<?php echo esc_attr( $this->get_field_id( 'counts' ) ); ?>" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'counts' ) ); ?>" type="checkbox" <?php checked( (bool) $params['counts'] ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'counts' ) ); ?>"><?php esc_html_e( 'Display counts', 'basic-social-accounts' ); ?></label></p>

			<!-- Template -->
			<?php if ( bsa_templates_check() ) : ?>
				<p><label for="<?php echo esc_attr( $this->get_field_id( 'Template' ) ); ?>"><?php esc_html_e( 'Template', 'basic-social-accounts' ); ?></label>
					<select name="<?php echo esc_attr( $this->get_field_name( 'template' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'template' ) ); ?>" class="widefat">
						<?php
						$templates = apply_filters( 'bsa_templates', array() );
						if ( $templates ) {
							foreach ( $templates as $key => $item ) {
								?>
									<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $params['template'], $key ); ?>><?php echo esc_attr( $item['name'] ); ?></option>
								<?php
							}
						}
						?>
					</select>
				</p>
			<?php endif; ?>

			<p class="alert alert-warning">
				<?php
					echo sprintf( '<a href="%2$s" target="_blank">%1$s</a>', esc_html__( 'Social Settings', 'basic-social-accounts' ), esc_url( admin_url( 'options-general.php?page=bsa_settings' ) ) );
				?>
			</p>
		<?php
	}
}
