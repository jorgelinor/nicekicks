<?php
/**
 * Customizer theme demos.
 *
 * @link       https://codesupply.co
 * @since      1.0.0
 *
 * @package    Authentic
 * @subpackage Demos
 */

/**
 * Register customizer control for rendering
 */
function register_csco_demos_control() {
	/**
	 * A customizer control for rendering the export/import form.
	 *
	 * @since 0.1
	 */
	final class CSCO_Demos_Control extends WP_Customize_Control {

		/**
		 * Renders the control content.
		 *
		 * @since 0.1
		 * @access protected
		 * @return void
		 */
		protected function render_content() {
			?>
				<h3><?php esc_html_e( 'Reset', 'authentic' ); ?></h3>

				<p><?php esc_html_e( 'Click the button to reset the customization settings for this theme.', 'authentic' ); ?></p>

				<p><input type="submit" name="csco-demos-reset" class="button-secondary button" value="<?php esc_html_e( 'Reset', 'authentic' ); ?>"></p>

				<hr>

				<?php $demos = apply_filters( 'csco_theme_demos', array() ); ?>

				<?php if ( isset( $demos['demos'] ) && $demos['demos'] ) { ?>
					<h3><?php esc_html_e( 'Select Demo', 'authentic' ); ?></h3>

					<div class="theme-browser rendered">
						<div class="themes wp-clearfix">
							<?php
							foreach ( $demos['demos'] as $slug => $settings ) {
								?>
									<div class="theme demo" data-demo="<?php echo esc_html( $slug ); ?>" style="margin-bottom: 15px; cursor: default;">
										<?php if ( isset( $settings['preview_image_url'] ) ) { ?>
											<div class="screenshot">
												<img style="display: block;" src="<?php echo esc_url( get_template_directory_uri() . $settings['preview_image_url'] ); ?>">
											</div>
										<?php } ?>

										<?php if ( isset( $settings['name'] ) ) { ?>
											<h2 class="theme-name"><?php echo esc_html( $settings['name'] ); ?></h2>
										<?php } ?>

										<div class="theme-actions">
											<a class="button button-primary csco-demo-import" href="#"><?php esc_html_e( 'Import', 'authentic' ); ?></a>
										</div>
									</div><br>
								<?php
							}
							?>
						</div>
					</div>
				<?php } ?>
			<?php
		}
	}
}
add_action( 'customize_register', 'register_csco_demos_control' );



/**
 * The main theme demos class.
 *
 * @since 0.1
 */
class CSCO_Demos_Core {

	/**
	 * WP_Customize_Manager
	 *
	 * @var array $wp_customize  WP_Customize_Manager.
	 */
	private $wp_customize;

	/**
	 * __construct
	 *
	 * This function will setup the field type data
	 */
	function __construct() {
		add_action( 'customize_register', array( $this, 'register' ) );

		// Import Action.
		add_action( 'wp_ajax_customizer_import', array( $this, 'import_customizer_ajax' ) );
		add_action( 'customize_controls_print_scripts', array( $this, 'import_customizer_script' ) );

		// Reset Action.
		add_action( 'wp_ajax_customizer_reset', array( $this, 'reset_customizer_ajax' ) );
		add_action( 'customize_controls_print_scripts', array( $this, 'reset_customizer_script' ) );
	}

	/**
	 * Registers the control with the customizer.
	 *
	 * @since 0.1
	 * @param object $wp_customize An instance of WP_Customize_Manager.
	 * @return void
	 */
	public function register( $wp_customize ) {
		$this->wp_customize = $wp_customize;

		// Add the demos section.
		$wp_customize->add_section( 'csco-section', array(
			'title'	   => __( 'Theme Demos', 'authentic' ),
			'priority' => 0,
		));

		// Add the demos setting.
		$wp_customize->add_setting( 'csco-setting', array(
			'default' => '',
			'type'	  => 'none',
		));

		// Add the demos control.
		$wp_customize->add_control( new CSCO_Demos_Control(
			$wp_customize,
			'csco-setting',
			array(
				'section'	=> 'csco-section',
				'priority'	=> 1,
			)
		));
	}


	/**
	 * ---------------------------------------------------------------------------------
	 * ---------------------------------------------------------------------------------
	 */

	/**
	 * Handler Import Customizer Ajax
	 */
	public function import_customizer_ajax() {
		if ( ! $this->wp_customize->is_preview() ) {
			wp_send_json_error( 'not_preview' );
		}

		if ( ! check_ajax_referer( 'customizer-import', 'nonce', false ) ) {
			wp_send_json_error( 'invalid_nonce' );
		}

		if ( ! isset( $_POST['demo'] ) ) { // Input var ok.
			wp_send_json_error( 'invalid_demo' );
		} else {
			$demo = sanitize_text_field( wp_unslash( $_POST['demo'] ) ); // Input var ok.
		}

		$this->reset_customizer();

		$this->import_customizer( $demo );

		wp_send_json_success();
	}

	/**
	 * Function Import Customizer Ajax
	 *
	 * @param string $slug Demo slug.
	 */
	public function import_customizer( $slug ) {
		global $wp_customize;

		$demos = apply_filters( 'csco_theme_demos', array() );

		// IMPORT.
		if ( $demos ) {
			// Call the customize_save action.
			do_action( 'customize_save', $wp_customize );

			// Import Mods.
			if ( isset( $demos['common_mods'] ) && $demos['common_mods'] ) {
				foreach ( $demos['common_mods'] as $key => $value ) {

					// Call the customize_save_ dynamic action.
					do_action( 'customize_save_' . $key, $wp_customize );

					// Save the mod.
					set_theme_mod( $key, $value );
				}
			}

			// Import Options.
			if ( isset( $demos['common_options'] ) && $demos['common_options'] ) {
				foreach ( $demos['common_options'] as $key => $value ) {
					update_option( $key, $value );
				}
			}

			// Specific demos.
			if ( isset( $demos['demos'] ) && $demos['demos'] ) {
				// Import Mods.
				if ( isset( $demos['demos'][ $slug ]['mods'] ) && $demos['demos'][ $slug ]['mods'] ) {
					foreach ( $demos['demos'][ $slug ]['mods'] as $key => $value ) {
						// Call the customize_save_ dynamic action.
						do_action( 'customize_save_' . $key, $wp_customize );

						// Save the mod.
						set_theme_mod( $key, $value );
					}
				}
				// Import Options.
				if ( isset( $demos['demos'][ $slug ]['options'] ) && $demos['demos'][ $slug ]['options'] ) {
					foreach ( $demos['demos'][ $slug ]['options'] as $key => $value ) {
						update_option( $key, $value );
					}
				}
			}

			// Call the customize_save_after action.
			do_action( 'customize_save_after', $wp_customize );
		}
	}

	/**
	 * Enqueue Customizer Script for Import
	 */
	public function import_customizer_script() {
	?>
		<script>
			jQuery(function ($) {
				$('body').on('click', '.csco-demo-import', function (event) {
					event.preventDefault();

					var data = {
						wp_customize: 'on',
						action: 'customizer_import',
						demo:   $(this).closest('.demo').attr('data-demo'),
						nonce:  '<?php echo esc_attr( wp_create_nonce( 'customizer-import' ) ); ?>'
					};

					var r = confirm( "<?php esc_html_e( 'Attention! This will remove all customizations ever made via customizer to this theme! This action is irreversible!', 'authentic' ); ?>" );

					if (!r) return;

					$(this).attr('disabled', 'disabled');

					$.post(ajaxurl, data, function ( response ) {
						wp.customize.state('saved').set(true);

						try {
							var info = $.parseJSON( JSON.stringify(response) );

							if( typeof info.success != 'undefined' && info.success == true ){
								location.reload();
							} else {
								if( typeof info.data != 'undefined' ){
									alert( info.data );
								} else {
									alert( '<?php esc_html_e( 'Error server!', 'authentic' ); ?>' );
								}
							}
						} catch (e) {
							alert( response );
						}
					});

					return false;
				});
			});
		</script>
	<?php
	}


	/**
	 * ---------------------------------------------------------------------------------
	 * ---------------------------------------------------------------------------------
	 */

	/**
	 * Handler Reset Customizer Ajax
	 */
	public function reset_customizer_ajax() {
		if ( ! $this->wp_customize->is_preview() ) {
			wp_send_json_error( 'not_preview' );
		}

		if ( ! check_ajax_referer( 'customizer-reset', 'nonce', false ) ) {
			wp_send_json_error( 'invalid_nonce' );
		}

		$this->reset_customizer();

		wp_send_json_success();
	}

	/**
	 * Function Reset Customizer Ajax
	 */
	public function reset_customizer() {
		$settings = $this->wp_customize->settings();

		$demos = apply_filters( 'csco_theme_demos', array() );

		// Remove theme_mod settings registered in customizer.
		foreach ( $settings as $setting ) {
			if ( 'theme_mod' === $setting->type ) {

				$exclude = array();
				if ( isset( $demos['reset_exclude_mods'] ) && $demos['reset_exclude_mods'] ) {
					$exclude = $demos['reset_exclude_mods'];
				}

				if ( ! in_array( $setting->id, $exclude, true ) ) {
					remove_theme_mod( $setting->id );
				}
			}
		}

		// Remove option settings.
		if ( $demos ) {
			// Options imported with every demo.
			if ( isset( $demos['common_options'] ) && $demos['common_options'] ) {
				foreach ( $demos['common_options'] as $key => $value ) {

					$exclude = array();
					if ( isset( $demos['reset_exclude_options'] ) && $demos['reset_exclude_options'] ) {
						$exclude = $demos['reset_exclude_options'];
					}

					if ( ! in_array( $key, $exclude, true ) ) {
						delete_option( $key );
					}
				}
			}
			// Specific demos.
			if ( isset( $demos['demos'] ) && $demos['demos'] ) {
				foreach ( $demos['demos'] as $demo ) {
					if ( isset( $demo['options'] ) && $demo['options'] ) {
						foreach ( $demo['options'] as $key => $value ) {

							$exclude = array();
							if ( isset( $demos['reset_exclude_options'] ) && $demos['reset_exclude_options'] ) {
								$exclude = $demos['reset_exclude_options'];
							}

							if ( ! in_array( $key, $exclude, true ) ) {
								delete_option( $key );
							}
						}
					}
				}
			}
		}
	}

	/**
	 * Enqueue Customizer Script for Reset
	 */
	public function reset_customizer_script() {
	?>
		<script>
			jQuery(function ($) {
				$('body').on('click', 'input[name="csco-demos-reset"]', function (event) {
					event.preventDefault();

					var data = {
						wp_customize: 'on',
						action: 'customizer_reset',
						nonce: '<?php echo esc_attr( wp_create_nonce( 'customizer-reset' ) ); ?>'
					};

					var r = confirm( "<?php esc_html_e( 'Attention! This will remove all customizations ever made via customizer to this theme! This action is irreversible!', 'authentic' ); ?>" );

					if (!r) return;

					$(this).attr('disabled', 'disabled');

					$.post(ajaxurl, data, function ( response ) {
						wp.customize.state('saved').set(true);

						try {
							var info = $.parseJSON( JSON.stringify(response) );

							if( typeof info.success != 'undefined' && info.success == true ){
								location.reload();
							} else {
								if( typeof info.data != 'undefined' ){
									alert( info.data );
								} else {
									alert( '<?php esc_html_e( 'Error server!', 'authentic' ); ?>' );
								}
							}
						} catch (e) {
							alert( response );
						}
					});
				});
			});
		</script>
	<?php
	}
}
new CSCO_Demos_Core();