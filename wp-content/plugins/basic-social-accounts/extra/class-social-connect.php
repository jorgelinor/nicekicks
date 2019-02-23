<?php
/**
 * Creating general settings for social networks
 *
 * @link       https://codesupply.co
 * @since      1.0.0
 *
 * @package    Basic Social Accounts
 * @subpackage Extra
 */

if ( ! class_exists( 'Social_Connect' ) ) {

	/**
	 * Social Connect Class
	 */
	class Social_Connect {

		/**
		 * Activated connect.
		 *
		 * @since    1.0.0
		 * @access   protected
		 * @var      bool    $_register_connect    Activated connect.
		 */
		protected static $_register_connect = false;

		/**
		 * Define the core functionality of the plugin.
		 *
		 * @since    1.0.0
		 */
		public function __construct() {
			if ( ! self::$_register_connect ) {
				add_action( 'admin_menu', array( $this, 'register_options_page' ) );

				self::$_register_connect = true;
			}
		}

		/**
		 * Register admin page
		 *
		 * @since 1.0.0
		 */
		public function register_options_page() {
			add_options_page( esc_html__( 'Connect', 'basic-social-accounts' ), esc_html__( 'Connect', 'basic-social-accounts' ), 'manage_options', 'csco_settings', array( $this, 'build_options_page' ) );
		}

		/**
		 * Build admin page
		 *
		 * @since 1.0.0
		 */
		public function build_options_page() {

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( esc_html__( 'You do not have sufficient rights to view this page.', 'basic-social-accounts' ) );
			}

			$this->save_options_page();
			$this->reset_cache();
			?>

				<div class="wrap csco-wrap">
					<h2><?php esc_html_e( 'Connect', 'basic-social-accounts' ); ?></h2>

					<div class="csco-settings">
						<?php $social_params = apply_filters( 'csco_register_social_params', array() ); ?>

						<?php if ( $social_params ) : ?>
							<form class="csco-basic" method="post">
								<div class="csco-tabs">
									<?php
									$social_params = array_values( $social_params );

									$tab = isset( $_GET['tab'] ) ? esc_attr( $_GET['tab'] ) : $social_params[0]['id']; // Input var ok; sanitization ok.

									$subtab = isset( $_GET['subtab'] ) ? esc_attr( $_GET['subtab'] ) : 'settings'; // Input var ok; sanitization ok.
									?>

									<nav class="nav-tab-wrapper woo-nav-tab-wrapper">
										<?php
										foreach ( $social_params as $item ) {
											$class = ( $item['id'] === $tab ) ? 'nav-tab-active' : ''; // Input var ok.

											printf( '<a class="nav-tab %4$s" href="%1$s&tab=%2$s&subtab=settings">%3$s</a>',
												esc_url( admin_url( 'options-general.php?page=csco_settings' ) ), esc_attr( $item['id'] ), esc_html( $item['name'] ), esc_attr( $class )
											);
										}
										?>
									</nav>

									<?php
									foreach ( $social_params as $item ) {
										if ( $item['id'] === $tab ) { // Input var ok.
										?>
										<div id="tab-<?php echo esc_attr( $item['id'] ); ?>" class="tab-wrap">
											<div class="csco-subtabs">
												<ul class="subsubsub">
													<?php
														$class = ( 'settings' === $subtab ) ? 'current' : ''; // Input var ok.

														printf( '<li><a class="subtab %4$s" href="%1$s&tab=%2$s&subtab=settings">%3$s</a> |</li>',
															esc_url( admin_url( 'options-general.php?page=csco_settings' ) ), esc_attr( $item['id'] ), esc_html__( 'Settings', 'basic-social-accounts' ), esc_attr( $class )
														);

														$class = ( 'instructions' === $subtab ) ? 'current' : ''; // Input var ok.

														printf( '<li><a class="subtab %4$s" href="%1$s&tab=%2$s&subtab=instructions">%3$s</a></li>',
															esc_url( admin_url( 'options-general.php?page=csco_settings' ) ), esc_attr( $item['id'] ), esc_html__( 'Instructions', 'basic-social-accounts' ), esc_attr( $class )
														);
													?>
												</ul>

												<br class="clear">

												<?php if ( 'settings' === $subtab ) { // Input var ok. ?>
													<div id="subtab-<?php echo esc_attr( $item['id'] ); ?>-settings" class="subtab subtab-wrap subtab-active">
														<h2><?php esc_html_e( 'Settings', 'basic-social-accounts' ); ?></h2>

														<!-- Render Fields -->
														<?php
														if ( isset( $item['fields'] ) && $item['fields'] ) {
															?>
															<table class="form-table">
																<tbody>
																	<?php
																	foreach ( $item['fields'] as $field_key => $field_caption ) {
																	?>
																		<tr>
																			<th scope="row"><label class="title" for="<?php echo esc_attr( $field_key ); ?>"><?php echo esc_html( $field_caption ); ?></label></th>
																			<td><input class="regular-text" id="<?php echo esc_attr( $field_key ); ?>" name="<?php echo esc_attr( $field_key ); ?>" type="text" value="<?php echo esc_attr( get_option( $field_key ) ); ?>" /></td>
																		</tr>
																	<?php
																	}
																	?>
																</tbody>
															</table>
															<?php
														}
														?>
													</div>
												<?php } // End if(). ?>
												<?php if ( 'instructions' === $subtab ) { // Input var ok. ?>
													<div id="subtab-<?php echo esc_attr( $item['id'] ); ?>-instructions" class="subtab subtab-wrap">
														<h2><?php esc_html_e( 'Instructions', 'basic-social-accounts' ); ?></h2>

														<div class="content">
															<?php
															if ( isset( $item['instructions'] ) ) {
																echo wp_kses_post( $item['instructions'] );
															}
															?>
														</div>
													</div>
												<?php } // End if(). ?>
											</div>
										</div>
									<?php
										} // End if().
									} // End foreach().
									?>
								</div>

								<?php wp_nonce_field( 'csco_save_action','csco_save_nonce' ); ?>

								<p class="submit">
									<input class="button button-primary" name="save_settings" type="submit" value="<?php esc_html_e( 'Save changes', 'basic-social-accounts' ); ?>" />
								</p>
							</form>

							<hr>

							<form method="post" class="form-reset">
								<?php wp_nonce_field( 'csco_reset_action','csco_reset_nonce' ); ?>

								<p class="submit"><input class="csco-button button" name="csco_reset_cache" type="submit" value="<?php esc_html_e( 'Reset cache', 'basic-social-accounts' ); ?>" /></p>
							</form>
						<?php else : ?>
							<p class="submit">
								<?php esc_html_e( 'The list of social network settings is empty!!!', 'basic-social-accounts' ); ?>
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
			if ( isset( $_POST['csco_save_action'] ) && ! wp_verify_nonce( wp_unslash( $_POST['csco_save_action'] ),'csco_save_nonce' ) ) { // Input var ok; sanitization ok.
				return;
			}

			if ( isset( $_POST['save_settings'] ) ) { // Input var ok.

				// Save social params.
				$social_params = apply_filters( 'csco_register_social_params', array() );

				foreach ( $social_params as $item ) {
					$id = $item['id'];

					if ( isset( $item['fields'] ) && $item['fields'] ) {
						foreach ( $item['fields'] as $field_key => $field_caption ) {
							if ( isset( $_POST[ $field_key ] ) ) { // Input var ok.
								update_option( $field_key, sanitize_text_field( wp_unslash( $_POST[ $field_key ] ) ) ); // Input var ok.
							}
						}
					}
				}

				printf( '<div id="message" class="updated fade"><p><strong>%s</strong></p></div>', esc_html__( 'The settings are saved.', 'basic-social-accounts' ) );
			} // End if().
		}

		/**
		 * Reset cache
		 *
		 * @since 1.0.0
		 */
		protected function reset_cache() {
			if ( isset( $_POST['csco_reset_action'] ) && ! wp_verify_nonce( wp_unslash( $_POST['csco_reset_action'] ),'csco_reset_nonce' ) ) { // Input var ok; sanitization ok.
				return;
			}

			$reset_list = apply_filters( 'csco_reset_cache', array() );

			if ( isset( $_POST['csco_reset_cache'] ) && $reset_list ) { // Input var ok.
				global $wpdb;

				foreach ( $reset_list as $option_name ) {
					$wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->options WHERE option_name LIKE '%%%s%%'", $option_name ) ); // db call ok; no-cache ok.
				}

				printf( '<div id="message" class="updated fade"><p><strong>%s</strong></p></div>', esc_html__( 'Cache successfully cleared.', 'basic-counters' ) );
			}
		}
	}
} // End if().
