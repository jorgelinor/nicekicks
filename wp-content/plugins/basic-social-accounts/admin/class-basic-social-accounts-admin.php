<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://codesupply.co
 * @since      1.1.1
 *
 * @package    Basic Social Accounts
 * @subpackage Admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Basic Social Accounts
 * @subpackage Admin
 * @author     Code Supply Co. <hello@codesupply.co>
 */
class Basic_Social_Accounts_Admin {

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
		if ( 'settings_page_bsa_settings' === $hook ) {
			wp_enqueue_script( 'jquery-ui-sortable' );

			wp_register_script( 'bsa_admin_js', plugin_dir_url( __FILE__ ) . 'js/basic-social-accounts-admin.js', false, $this->version );
			wp_enqueue_script( 'bsa_admin_js' );
		}
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 * @param string $hook Page hook.
	 */
	public function enqueue_styles( $hook ) {
		if ( 'settings_page_bsa_settings' === $hook ) {
			wp_register_style( 'bsa_admin_css', plugin_dir_url( __FILE__ ) . 'css/basic-social-accounts-admin.css', false, $this->version, 'screen' );
			wp_enqueue_style( 'bsa_admin_css' );
		}
	}

	/**
	 * Register admin page
	 *
	 * @since 1.0.0
	 */
	public function register_options_page() {
		add_options_page( esc_html__( 'Social Accounts', 'basic-social-accounts' ), esc_html__( 'Social Accounts', 'basic-social-accounts' ), 'manage_options', 'bsa_settings', array( $this, 'build_options_page' ) );
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
		?>
			<div class="wrap bsa-wrap">
				<h2><?php esc_html_e( 'Social Accounts', 'basic-social-accounts' ); ?></h2>

				<div class="bsa-settings">
					<?php $social_accounts = apply_filters( 'bsa_social_accounts', array() ); ?>
					<form class="bsa-basic" method="post">
						<div class="bsa-tabs">
							<nav class="nav-tab-wrapper woo-nav-tab-wrapper">
								<a class="nav-tab nav-tab-active general" href="#tab-general"><?php esc_html_e( 'General', 'basic-social-accounts' ); ?></a>

								<?php foreach ( $social_accounts as $item ) { ?>
									<a class="nav-tab <?php echo esc_attr( $item['id'] ); ?>" href="#tab-<?php echo esc_attr( $item['id'] ); ?>"><?php echo esc_html( $item['name'] ); ?></a>
								<?php } ?>
							</nav>

							<div id="tab-general" class="tab-wrap tab-active">
								<h2><?php esc_html_e( 'General Settings', 'basic-social-accounts' ); ?></h2>
								<table class="form-table">
									<tbody>
										<!-- Social Accounts -->
										<tr>
											<th scope="row"><?php esc_html_e( 'Social Accounts', 'basic-share-buttons' ); ?></label></th>
											<td>
												<?php
												$accounts = $social_accounts;

												if ( $accounts ) {
													foreach ( $accounts as $key => $account ) {
														$bsa_multiple_accounts = get_option( 'bsa_multiple_accounts', array() );

														$checked = in_array( $key, $bsa_multiple_accounts, true ) ? 'checked' : '';
													?>
														<p><label for="bsa_multiple_accounts_<?php echo esc_attr( $key ); ?>"><input class="bsa_multiple_accounts" data-item="<?php echo esc_attr( $key ); ?>" id="bsa_multiple_accounts_<?php echo esc_attr( $key ); ?>" name="bsa_multiple_accounts[]" type="checkbox" value="<?php echo esc_attr( $key ); ?>" <?php echo esc_attr( $checked ); ?>> <?php echo esc_attr( $account['name'] ); ?></label></p>
													<?php
													}
												}
												?>
											</td>
										</tr>
										<!-- Order -->
										<tr>
											<th scope="row"><label for="bsa_order_multiple_accounts"><?php esc_html_e( 'Order', 'basic-share-buttons' ); ?></label></th>
											<td>
												<ul class="social-sortable">
													<?php
													$accounts_save = get_option( 'bsa_order_multiple_accounts', array() );

													$accounts = $social_accounts;

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
																<input type="text" name="bsa_order_multiple_accounts[]" value="<?php echo esc_attr( $key ); ?>"><?php echo esc_attr( $account['name'] ); ?>
															</li>
															<?php
														}
													}
													?>
												</ul>
											</td>
										</tr>
										<!-- Cache timeout -->
										<tr>
											<th scope="row"><label for="bsa_cache_timeout"><?php esc_html_e( 'Share Count Cache Interval', 'basic-social-accounts' ); ?></label></th>
											<td><input class="small-text" id="bsa_cache_timeout" name="bsa_cache_timeout" type="number" value="<?php echo esc_attr( get_option( 'bsa_cache_timeout', 60 ) ); ?>" /> <?php esc_html_e( 'minutes', 'basic-social-accounts' ); ?></td>
										</tr>
										<!-- Counter Mode -->
										<tr>
											<th scope="row"><?php esc_html_e( 'Counter Mode', 'basic-social-accounts' ); ?></th>
											<td>
												<p><label><input class="tog" id="bsa_counter_mode_php" name="bsa_counter_mode" type="radio" value="php" <?php checked( get_option( 'bsa_counter_mode', 'php' ), 'php' ); ?>> <?php esc_html_e( 'PHP', 'basic-social-accounts' ); ?></label></p>
												<p><label><input class="tog" id="bsa_counter_mode_rest" name="bsa_counter_mode" type="radio" value="rest" <?php checked( get_option( 'bsa_counter_mode', 'php' ), 'rest' ); ?>> <?php esc_html_e( 'REST API', 'basic-social-accounts' ); ?></label></p>
											</td>
										</tr>
										<!-- Link Target -->
										<tr>
											<th scope="row"><?php esc_html_e( 'Link Target', 'basic-social-accounts' ); ?></th>
											<td>
												<p><label><input class="tog" id="bsa_link_target_same" name="bsa_link_target" type="radio" value="same" <?php checked( get_option( 'bsa_link_target', 'new' ), 'same' ); ?>> <?php esc_html_e( 'Open in same window', 'basic-social-accounts' ); ?></label></p>
												<p><label><input class="tog" id="bsa_link_target_new" name="bsa_link_target" type="radio" value="new" <?php checked( get_option( 'bsa_link_target', 'new' ), 'new' ); ?>> <?php esc_html_e( 'Open in new window/tab', 'basic-social-accounts' ); ?></label></p>
											</td>
										</tr>
										<p></p>
										<!-- Apply "nofollow" attribute -->
										<tr>
											<th scope="row"><label class="title" for="bsa_nofollow"><?php esc_html_e( 'Apply "nofollow" attribute', 'basic-social-accounts' ); ?></label></th>
											<td><input id="bsa_nofollow" name="bsa_nofollow" type="checkbox" value="true" <?php checked( (bool) get_option( 'bsa_nofollow', true ) ); ?>></td>
										</tr>
									</tbody>
								</table>
							</div>

							<?php foreach ( $social_accounts as $item ) { ?>
								<div id="tab-<?php echo esc_attr( $item['id'] ); ?>" class="tab-wrap">
									<h2><?php echo esc_attr( bsa_specific_param( $item['id'], 'name' ) ); ?> <?php esc_html_e( 'Settings', 'basic-social-accounts' ); ?></h2>

									<table class="form-table">
										<tbody>
											<!-- Title -->
											<tr>
												<th scope="row"><label for="bsa_title_<?php echo esc_attr( $item['id'] ); ?>"><?php esc_html_e( 'Title', 'basic-social-accounts' ); ?></label></th>
												<td><input class="regular-text" id="bsa_title_<?php echo esc_attr( $item['id'] ); ?>" name="bsa_title_<?php echo esc_attr( $item['id'] ); ?>" type="text" value="<?php echo esc_attr( get_option( 'bsa_title_' . $item['id'], bsa_specific_param( $item['id'], 'name' ) ) ); ?>" /></td>
											</tr>
											<!-- Label -->
											<tr>
												<th scope="row"><label for="bsa_label_<?php echo esc_attr( $item['id'] ); ?>"><?php esc_html_e( 'Label', 'basic-social-accounts' ); ?></label></th>
												<td><input class="regular-text" id="bsa_label_<?php echo esc_attr( $item['id'] ); ?>" name="bsa_label_<?php echo esc_attr( $item['id'] ); ?>" type="text" value="<?php echo esc_attr( get_option( 'bsa_label_' . $item['id'], bsa_specific_param( $item['id'], 'label' ) ) ); ?>" /></td>
											</tr>
											<!-- Render Fields -->
											<?php
											if ( isset( $item['fields'] ) && $item['fields'] ) {
												foreach ( $item['fields'] as $field_key => $field_caption ) {
													if ( is_array( $field_caption ) ) {
													?>
														<tr>
															<th scope="row"><label class="title" for="<?php echo esc_attr( $field_key ); ?>"><?php echo esc_html( $field_caption['title'] ); ?></label></th>
															<td>
																<select class="regular-text" name="<?php echo esc_attr( $field_key ); ?>" id="<?php echo esc_attr( $field_key ); ?>">
																	<?php foreach ( $field_caption['options'] as $key => $val ) { ?>
																		<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, get_option( $field_key ) ); ?>><?php echo esc_attr( $val ); ?></option>
																	<?php } ?>
																</select>
															</td>
														</tr>
													<?php
													} else {
													?>
														<tr>
															<th scope="row"><label class="title" for="<?php echo esc_attr( $field_key ); ?>"><?php echo esc_html( $field_caption ); ?></label></th>
															<td><input class="regular-text" id="<?php echo esc_attr( $field_key ); ?>" name="<?php echo esc_attr( $field_key ); ?>" type="text" value="<?php echo esc_attr( get_option( $field_key ) ); ?>" /></td>
														</tr>
													<?php
													}
												}
											}
											?>
										</tbody>
									</table>
								</div>
							<?php } // End foreach(). ?>
						</div>

						<?php wp_nonce_field( 'bsa_save_action','bsa_save_nonce' ); ?>

						<p class="submit">
							<input class="button button-primary" name="save_settings" type="submit" value="<?php esc_html_e( 'Save changes', 'basic-social-accounts' ); ?>" />
						</p>
					</form>
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
		if ( isset( $_POST['bsa_save_action'] ) && ! wp_verify_nonce( wp_unslash( $_POST['bsa_save_action'] ),'bsa_save_nonce' ) ) { // Input var ok; sanitization ok.
			return;
		}

		if ( isset( $_POST['save_settings'] ) ) { // Input var ok.

			if ( isset( $_POST['bsa_multiple_accounts'] ) ) { // Input var ok.
				update_option( 'bsa_multiple_accounts', $_POST['bsa_multiple_accounts'] ); // Input var ok; sanitization ok.
			}
			if ( isset( $_POST['bsa_order_multiple_accounts'] ) ) { // Input var ok.
				update_option( 'bsa_order_multiple_accounts', (array) $_POST['bsa_order_multiple_accounts'] ); // Input var ok; sanitization ok.
			}
			if ( isset( $_POST['bsa_cache_timeout'] ) ) { // Input var ok.
				update_option( 'bsa_cache_timeout', sanitize_text_field( wp_unslash( $_POST['bsa_cache_timeout'] ) ) ); // Input var ok.
			}
			if ( isset( $_POST['bsa_counter_mode'] ) ) { // Input var ok.
				update_option( 'bsa_counter_mode', sanitize_text_field( wp_unslash( $_POST['bsa_counter_mode'] ) ) ); // Input var ok.
			}
			if ( isset( $_POST['bsa_link_target'] ) ) { // Input var ok.
				update_option( 'bsa_link_target', sanitize_text_field( wp_unslash( $_POST['bsa_link_target'] ) ) ); // Input var ok.
			}
			if ( isset( $_POST['bsa_nofollow'] ) ) { // Input var ok.
				update_option( 'bsa_nofollow', true );
			} else {
				update_option( 'bsa_nofollow', false );
			}

			// Save social params.
			$social_accounts = apply_filters( 'bsa_social_accounts', array() );

			foreach ( $social_accounts as $item ) {
				$id = $item['id'];

				if ( isset( $_POST[ "bsa_title_{$id}" ] ) ) { // Input var ok.
					update_option( "bsa_title_{$id}", sanitize_text_field( wp_unslash( $_POST[ "bsa_title_{$id}" ] ) ) ); // Input var ok.
				}

				if ( isset( $_POST[ "bsa_label_{$id}" ] ) ) { // Input var ok.
					update_option( "bsa_label_{$id}", sanitize_text_field( wp_unslash( $_POST[ "bsa_label_{$id}" ] ) ) ); // Input var ok.
				}

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
}
