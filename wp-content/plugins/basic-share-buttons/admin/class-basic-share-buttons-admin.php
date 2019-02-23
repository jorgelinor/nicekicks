<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://codesupply.co
 * @since      1.0.0
 *
 * @package    Basic Share Buttons
 * @subpackage Admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Basic Share Buttons
 * @subpackage Admin
 * @author     Code Supply Co. <hello@codesupply.co>
 */
class Basic_Share_Buttons_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $plugin_name  The name of this plugin.
	 * @param string $version      The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the scripts for the admin area.
	 *
	 * @since    1.0.0
	 * @param string $hook Page hook.
	 */
	public function enqueue_scripts( $hook ) {
		if ( 'settings_page_bsb_settings' === $hook ) {
			wp_enqueue_script( 'jquery-ui-sortable' );

			wp_register_script( 'bsb_admin_js', plugin_dir_url( __FILE__ ) . 'js/basic-social-buttons-admin.js', false, $this->version );
			wp_enqueue_script( 'bsb_admin_js' );
		}
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 * @param string $hook Page hook.
	 */
	public function enqueue_styles( $hook ) {
		if ( 'settings_page_bsb_settings' === $hook ) {
			wp_register_style( 'bsb_admin_css', plugin_dir_url( __FILE__ ) . 'css/basic-social-buttons-admin.css', false, $this->version, 'screen' );
			wp_enqueue_style( 'bsb_admin_css' );
		}
	}

	/**
	 * Register options default
	 *
	 * @since 1.0.0
	 */
	public function register_options_default() {

		// Save options default [locations].
		$locations = apply_filters( 'bsb_locations', array() );

		if ( $locations ) {
			foreach ( $locations as $key => $item ) {
				$location = $item['location'];

				if ( ! bsb_has_option( "bsb_{$location}_display_share_buttons" ) && isset( $item['display'] ) ) {
					update_option( "bsb_{$location}_display_share_buttons", $item['display'] );
				}

				if ( ! bsb_has_option( "bsb_{$location}_multiple_buttons" ) && isset( $item['shares'] ) ) {
					update_option( "bsb_{$location}_multiple_buttons", (array) $item['shares'] );
				}

				if ( ! bsb_has_option( "bsb_{$location}_order_multiple_buttons" ) && isset( $item['shares'] ) ) {
					update_option( "bsb_{$location}_order_multiple_buttons", (array) $item['shares'] );
				}

				if ( ! bsb_has_option( "bsb_{$location}_display_total_share_count" ) && isset( $item['fields']['total'] ) ) {
					update_option( "bsb_{$location}_display_total_share_count", $item['fields']['total'] );
				}

				if ( ! bsb_has_option( "bsb_{$location}_display_count" ) && isset( $item['fields']['counts'] ) ) {
					update_option( "bsb_{$location}_display_count", $item['fields']['counts'] );
				}

				if ( ! bsb_has_option( "bsb_{$location}_display_labels" ) && isset( $item['fields']['labels'] ) ) {
					update_option( "bsb_{$location}_display_labels", $item['fields']['labels'] );
				}

				if ( ! bsb_has_option( "bsb_{$location}_scheme" ) && isset( $item['scheme'] ) ) {
					update_option( "bsb_{$location}_scheme", $item['scheme'] );
				}
			} // End foreach().
		} // End if().
	}

	/**
	 * Register admin page
	 *
	 * @since 1.0.0
	 */
	public function register_options_page() {
		add_options_page( esc_html__( 'Share Buttons', 'basic-share-buttons' ), esc_html__( 'Share Buttons', 'basic-share-buttons' ), 'manage_options', 'bsb_settings', array( $this, 'build_options_page' ) );
	}


	/**
	 * Build admin page
	 *
	 * @since 1.0.0
	 */
	public function build_options_page() {

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You do not have sufficient rights to view this page.', 'basic-share-buttons' ) );
		}

		$this->save_options_page();
		$this->reset_cache();
		?>

			<div class="wrap bsb-wrap">
				<h2><?php esc_html_e( 'Share Buttons', 'basic-share-buttons' ); ?></h2>

				<div class="bsb-settings">
					<?php $locations = apply_filters( 'bsb_locations', array() ); ?>

					<?php if ( $locations ) : ?>
						<form class="bsb-basic" method="post">
							<div class="bsb-tabs">
								<?php
								$locations = array_values( $locations );

								$tab = isset( $_GET['tab'] ) ? esc_attr( $_GET['tab'] ) : 'general'; // Input var ok; sanitization ok.
								?>

								<nav class="nav-tab-wrapper woo-nav-tab-wrapper">
									<a class="nav-tab <?php echo esc_attr( 'general' === $tab ) ? 'nav-tab-active' : ''; ?>" href="<?php echo esc_url( admin_url( 'options-general.php?page=bsb_settings' ) ); ?>&tab=general"><?php esc_html_e( 'General', 'basic-share-buttons' ); ?></a>

									<?php
									foreach ( $locations as $item ) {
										$class = ( $item['location'] === $tab ) ? 'nav-tab-active' : ''; // Input var ok.

										printf( '<a class="nav-tab %4$s" href="%1$s&tab=%2$s">%3$s</a>',
											esc_url( admin_url( 'options-general.php?page=bsb_settings' ) ), esc_attr( $item['location'] ), esc_html( $item['name'] ), esc_attr( $class )
										);
									}
									?>
								</nav>

								<?php if ( 'general' === $tab ) { ?>
									<div id="tab-general" class="tab-wrap">
										<table class="form-table">
											<tbody>
												<!-- Labels of social networks -->
												<tr class="visible">
													<th scope="row"><?php esc_html_e( 'Labels of social networks', 'basic-share-buttons' ); ?></label></th>
													<td>
														<?php
														$accounts = bsb_get_accounts();
														if ( $accounts ) {
															foreach ( $accounts as $key => $account ) {
															?>
																<p><label for="bsb_label_<?php echo esc_attr( $key ); ?>"><input class="regular-text" id="bsb_label_<?php echo esc_attr( $key ); ?>" name="bsb_label_<?php echo esc_attr( $key ); ?>" type="text" value="<?php echo esc_attr( get_option( "bsb_label_{$key}", $account['label'] ) ); ?>"> <?php echo esc_attr( $account['name'] ); ?></label></p>
															<?php
															}
														}
														?>
													</td>
												</tr>
												<!-- Counter Mode -->
												<tr class="visible">
													<th scope="row"><?php esc_html_e( 'Counter Mode', 'basic-share-buttons' ); ?></th>
													<td>
														<p><label><input class="tog" id="bsb_counter_mode_php" name="bsb_counter_mode" type="radio" value="php" <?php checked( get_option( 'bsb_counter_mode', 'php' ), 'php' ); ?>> <?php esc_html_e( 'PHP', 'basic-share-buttons' ); ?></label></p>
														<p><label><input class="tog" id="bsb_counter_mode_rest" name="bsb_counter_mode" type="radio" value="rest" <?php checked( get_option( 'bsb_counter_mode', 'php' ), 'rest' ); ?>> <?php esc_html_e( 'REST API', 'basic-share-buttons' ); ?></label></p>
													</td>
												</tr>
												<!-- Total Title -->
												<tr class="visible">
													<th scope="row"><?php esc_html_e( 'Total Title', 'basic-share-buttons' ); ?></label></th>
													<td>
														<label for="bsb_total_title"><input class="regular-text" id="bsb_total_title" name="bsb_total_title" type="text" value="<?php echo esc_attr( get_option( 'bsb_total_title', 'Total' ) ); ?>"> <?php echo esc_attr( 'Total' ); ?></label>
													</td>
												</tr>
												<!-- Total Label -->
												<tr class="visible">
													<th scope="row"><?php esc_html_e( 'Total Label', 'basic-share-buttons' ); ?></label></th>
													<td>
														<label for="bsb_total_label"><input class="regular-text" id="bsb_total_label" name="bsb_total_label" type="text" value="<?php echo esc_attr( get_option( 'bsb_total_label', 'Shares' ) ); ?>"> <?php echo esc_attr( 'Shares' ); ?></label>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								<?php } // End if(). ?>

								<?php
								foreach ( $locations as $item ) {
									if ( $item['location'] === $tab ) { // Input var ok.
										$location = $item['location'];
									?>
									<div id="tab-<?php echo esc_attr( $location ); ?>" class="tab-wrap">
										<table class="form-table">
											<tbody>
												<!-- Display Share Buttons -->
												<tr class="visible">
													<th scope="row"><label for="bsb_<?php echo esc_attr( $location ); ?>_display_share_buttons"><?php esc_html_e( 'Display Share Buttons', 'basic-share-buttons' ); ?></label></th>
													<td><input class="bsb_display_share_buttons" id="bsb_<?php echo esc_attr( $location ); ?>_display_share_buttons" name="bsb_<?php echo esc_attr( $location ); ?>_display_share_buttons" type="checkbox" value="true" <?php checked( (bool) get_option( "bsb_{$location}_display_share_buttons", false ) ); ?>></td>
												</tr>
												<!-- Share Buttons -->
												<tr>
													<th scope="row"><?php esc_html_e( 'Share Buttons', 'basic-share-buttons' ); ?></label></th>
													<td>
														<?php
														$accounts = bsb_get_accounts();

														if ( $accounts ) {
															foreach ( $accounts as $key => $account ) {
																$bsb_multiple_buttons = get_option( "bsb_{$location}_multiple_buttons", array() );

																$checked = in_array( $key, $bsb_multiple_buttons, true ) ? 'checked' : '';
															?>
																<p><label for="bsb_<?php echo esc_attr( $location ); ?>_multiple_buttons_<?php echo esc_attr( $key ); ?>"><input class="bsb_multiple_buttons" data-item="<?php echo esc_attr( $key ); ?>" id="bsb_<?php echo esc_attr( $location ); ?>_multiple_buttons_<?php echo esc_attr( $key ); ?>" name="bsb_<?php echo esc_attr( $location ); ?>_multiple_buttons[]" type="checkbox" value="<?php echo esc_attr( $key ); ?>" <?php echo esc_attr( $checked ); ?>> <?php echo esc_attr( $account['name'] ); ?></label></p>
															<?php
															}
														}
														?>
													</td>
												</tr>
												<!-- Order -->
												<tr>
													<th scope="row"><label for="bsb_<?php echo esc_attr( $location ); ?>_order_multiple_buttons"><?php esc_html_e( 'Order', 'basic-share-buttons' ); ?></label></th>
													<td>
														<ul class="social-sortable">
															<?php
															$accounts_save = get_option( "bsb_{$location}_order_multiple_buttons", array() );

															$accounts = bsb_get_accounts();

															// Sort.
															if ( $accounts_save && $accounts ) {
																$accounts_save = array_flip( $accounts_save );
																$accounts      = array_merge( $accounts_save, $accounts );
															}

															// Output.
															if ( $accounts ) {
																foreach ( $accounts as $key => $account ) {
																	?>
																	<li class="ui-state-default <?php echo esc_attr( $key ); ?>">
																		<span class="dashicons dashicons-sort"></span>
																		<input type="text" name="bsb_<?php echo esc_attr( $location ); ?>_order_multiple_buttons[]" value="<?php echo esc_attr( $key ); ?>"><?php echo esc_attr( $account['name'] ); ?>
																	</li>
																	<?php
																}
															}
															?>
														</ul>
													</td>
												</tr>
												<!-- Display Total Share Count -->
												<?php if ( isset( $item['fields']['total'] ) ) { ?>
													<tr>
														<th scope="row"><label for="bsb_<?php echo esc_attr( $location ); ?>_display_total_share_count"><?php esc_html_e( 'Display Total Share Count', 'basic-share-buttons' ); ?></label></th>
														<td><input id="bsb_<?php echo esc_attr( $location ); ?>_display_total_share_count" name="bsb_<?php echo esc_attr( $location ); ?>_display_total_share_count" type="checkbox" value="true" <?php checked( (bool) get_option( "bsb_{$location}_display_total_share_count", false ) ); ?>></td>
													</tr>
												<?php } ?>
												<!-- Display Counts -->
												<?php if ( isset( $item['fields']['counts'] ) ) { ?>
													<tr>
														<th scope="row"><label for="bsb_<?php echo esc_attr( $location ); ?>_display_count"><?php esc_html_e( 'Display Counts', 'basic-share-buttons' ); ?></label></th>
														<td><input id="bsb_<?php echo esc_attr( $location ); ?>_display_count" name="bsb_<?php echo esc_attr( $location ); ?>_display_count" type="checkbox" value="true" <?php checked( (bool) get_option( "bsb_{$location}_display_count", false ) ); ?>></td>
													</tr>
												<?php } ?>
												<!-- Display Labels -->
												<?php if ( isset( $item['fields']['labels'] ) ) { ?>
													<tr>
														<th scope="row"><label for="bsb_<?php echo esc_attr( $location ); ?>_display_labels"><?php esc_html_e( 'Display Labels', 'basic-share-buttons' ); ?></label></th>
														<td><input id="bsb_<?php echo esc_attr( $location ); ?>_display_labels" name="bsb_<?php echo esc_attr( $location ); ?>_display_labels" type="checkbox" value="true" <?php checked( (bool) get_option( "bsb_{$location}_display_labels", false ) ); ?>></td>
													</tr>
												<?php } ?>
												<!-- Color Scheme -->
												<?php
												$schemes = bsb_format_color_schemes( $item );

												// Check schemes.
												if ( bsb_scheme_check( $schemes ) ) {
												?>
												<tr>
													<th scope="row"><label for="bsb_<?php echo esc_attr( $location ); ?>_scheme"><?php esc_html_e( 'Color Scheme', 'basic-facebook' ); ?></label></th>
													<td>
														<select class="regular-text" name="bsb_<?php echo esc_attr( $location ); ?>_scheme" id="bsb_<?php echo esc_attr( $location ); ?>_scheme">
															<?php
															if ( $schemes ) {
																foreach ( $schemes as $key => $item ) {
																	?>
																		<option value="<?php echo esc_attr( $key ); ?>" <?php selected( get_option( "bsb_{$location}_scheme" ), $key ); ?>><?php echo esc_attr( $item['name'] ); ?></option>
																	<?php
																}
															}
															?>
														</select>
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>

										<input type="hidden" name="<?php echo esc_attr( "bsb_action_{$location}" ); ?>" value="true">
									</div>
								<?php
									} // End if().
								} // End foreach().
								?>
							</div>

							<?php wp_nonce_field( 'bsb_save_action','bsb_save_nonce' ); ?>

							<p class="submit">
								<input class="button button-primary" name="save_settings" type="submit" value="<?php esc_html_e( 'Save changes', 'basic-share-buttons' ); ?>" />
							</p>
						</form>

						<hr>

						<form method="post" class="form-reset">
							<?php wp_nonce_field( 'bsb_reset_action','bsb_reset_nonce' ); ?>

							<p class="submit"><input class="bsb-button button" name="reset_cache" type="submit" value="<?php esc_html_e( 'Reset cache', 'basic-share-buttons' ); ?>" /></p>
						</form>
					<?php else : ?>
						<p class="submit">
							<?php esc_html_e( 'The list of locations is empty!!!', 'basic-share-buttons' ); ?>
						</p>
					<?php endif; ?>
				</div>
			</div>
		<?php
	}

	/**
	 * Settings save
	 *
	 * @since 1.0.0
	 */
	protected function save_options_page() {
		if ( isset( $_POST['bsb_save_action'] ) && ! wp_verify_nonce( wp_unslash( $_POST['bsb_save_action'] ),'bsb_save_nonce' ) ) { // Input var ok; sanitization ok.
			return;
		}

		if ( isset( $_POST['save_settings'] ) ) { // Input var ok.

			// Save social buttons [titles].
			$accounts = bsb_get_accounts();

			if ( $accounts ) {
				foreach ( $accounts as $key => $account ) {
					if ( isset( $_POST[ "bsb_label_{$key}" ] ) ) { // Input var ok.
						update_option( "bsb_label_{$key}", sanitize_text_field( wp_unslash( $_POST[ "bsb_label_{$key}" ] ) ) ); // Input var ok.
					}
				}
			}

			if ( isset( $_POST['bsb_counter_mode'] ) ) { // Input var ok.
				update_option( 'bsb_counter_mode', sanitize_text_field( wp_unslash( $_POST['bsb_counter_mode'] ) ) ); // Input var ok.
			}
			if ( isset( $_POST['bsb_total_title'] ) ) { // Input var ok.
				update_option( 'bsb_total_title', sanitize_text_field( wp_unslash( $_POST['bsb_total_title'] ) ) ); // Input var ok.
			}
			if ( isset( $_POST['bsb_total_label'] ) ) { // Input var ok.
				update_option( 'bsb_total_label', sanitize_text_field( wp_unslash( $_POST['bsb_total_label'] ) ) ); // Input var ok.
			}

			// Save social buttons [locations].
			$locations = apply_filters( 'bsb_locations', array() );

			if ( $locations ) {
				foreach ( $locations as $key => $item ) {
					$location = $item['location'];

					if ( ! isset( $_POST[ "bsb_action_{$location}" ] ) ) { // Input var ok.
						continue;
					}

					if ( isset( $_POST[ "bsb_{$location}_display_share_buttons" ] ) ) { // Input var ok.
						update_option( "bsb_{$location}_display_share_buttons", true );
					} else {
						update_option( "bsb_{$location}_display_share_buttons", false );
					}

					if ( isset( $_POST[ "bsb_{$location}_multiple_buttons" ] ) ) { // Input var ok.
						update_option( "bsb_{$location}_multiple_buttons", $_POST[ "bsb_{$location}_multiple_buttons" ] ); // Input var ok; sanitization ok.
					}

					if ( isset( $_POST[ "bsb_{$location}_order_multiple_buttons" ] ) ) { // Input var ok.
						update_option( "bsb_{$location}_order_multiple_buttons", (array) $_POST[ "bsb_{$location}_order_multiple_buttons" ] ); // Input var ok; sanitization ok.
					}

					if ( isset( $_POST[ "bsb_{$location}_display_total_share_count" ] ) ) { // Input var ok.
						update_option( "bsb_{$location}_display_total_share_count", true );
					} else {
						update_option( "bsb_{$location}_display_total_share_count", false );
					}

					if ( isset( $_POST[ "bsb_{$location}_display_count" ] ) ) { // Input var ok.
						update_option( "bsb_{$location}_display_count", true );
					} else {
						update_option( "bsb_{$location}_display_count", false );
					}

					if ( isset( $_POST[ "bsb_{$location}_display_labels" ] ) ) { // Input var ok.
						update_option( "bsb_{$location}_display_labels", true );
					} else {
						update_option( "bsb_{$location}_display_labels", false );
					}

					if ( isset( $_POST[ "bsb_{$location}_scheme" ] ) ) { // Input var ok.
						update_option( "bsb_{$location}_scheme", sanitize_text_field( wp_unslash( $_POST[ "bsb_{$location}_scheme" ] ) ) ); // Input var ok.
					}
				} // End foreach().
			} // End if().

			printf( '<div id="message" class="updated fade"><p><strong>%s</strong></p></div>', esc_html__( 'The settings are saved.', 'text-domain' ) );
		} // End if().
	}

	/**
	 * Reset cache
	 *
	 * @since 1.0.0
	 */
	protected function reset_cache() {
		if ( isset( $_POST['bsb_reset_action'] ) && ! wp_verify_nonce( wp_unslash( $_POST['bsb_reset_action'] ),'bsb_reset_nonce' ) ) { // Input var ok; sanitization ok.
			return;
		}

		if ( isset( $_POST['reset_cache'] ) ) { // Input var ok.
			global $wpdb;

			$wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE '%bsb_share_count_%'" ); // db call ok; no-cache ok.
			$wpdb->query( "DELETE FROM $wpdb->postmeta WHERE meta_key LIKE '%bsb_share_count%' OR meta_key LIKE '%bsb_share_transient%'" ); // db call ok; no-cache ok.

			printf( '<div id="message" class="updated fade"><p><strong>%s</strong></p></div>', esc_html__( 'Cache successfully cleared.', 'basic-tweets' ) );
		}
	}
}
