<?php
/**
 * CSCO Typekit
 *
 * @link       https://codesupply.co
 * @since      1.0.0
 *
 * @package    Authentic
 * @subpackage Includes
 */

if ( ! class_exists( 'CSCO_Typekit' ) ) {

	/**
	 * CSCO Typekit Class
	 */
	class CSCO_Typekit {

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
				add_filter( 'kirki/fonts/standard_fonts', array( $this, 'customize_standard_fonts' ) );

				add_action( 'admin_menu', array( $this, 'register_options_page' ) );
				add_action( 'customize_controls_enqueue_scripts', array( $this, 'frontend_enqueue' ) );
				add_action( 'wp_enqueue_scripts', array( $this, 'frontend_enqueue' ) );

				self::$_register_connect = true;
			}
		}

		/**
		 * Registers font variations format.
		 *
		 * @param array $variations If you want to return a specific option.
		 * @return array
		 */
		public function _font_variations_format( $variations = array() ) {

			$format = array(
				'n1' => '100',
				'i1' => '100italic',
				'n2' => '200',
				'i2' => '200italic',
				'n3' => '300',
				'i3' => '300italic',
				'n4' => 'regular',
				'i4' => 'italic',
				'n5' => '500',
				'i5' => '500italic',
				'n6' => '600',
				'i6' => '600italic',
				'n7' => '700',
				'i7' => '700italic',
				'n8' => '800',
				'i8' => '800italic',
				'n9' => '900',
				'i9' => '900italic',
			);

			if ( $variations && isset( $variations ) ) {
				foreach ( $variations as $key => $item ) {
					$variations[ $key ] = $format[ $item ];
				}
				return $variations;
			}

			return $format;
		}

		/**
		 * Customize standard fonts kirki
		 *
		 * @since 1.0.0
		 * @param array $fonts List fonts.
		 * @return array
		 */
		function customize_standard_fonts( $fonts ) {
			$token = get_option( 'csco_typekit_token' );
			$kit   = get_option( 'csco_typekit_kit' );

			if ( $token && $kit ) {

				$typekit = new Typekit();

				$data    = $typekit->get( $kit, $token );

				if ( $data && isset( $data['kit']['families'] ) && $data['kit']['families'] ) {

					foreach ( $data['kit']['families'] as $item ) {
						$id = $item['slug'];
						$fonts[ $id ] = array(
							'label'		=> $item['name'],
							'stack'		=> $item['css_stack'],
							'variants'	=> $this->_font_variations_format( $item['variations'] ),
						);
					}
				}
			}

			return $fonts;
		}

		/**
		 * Register admin page
		 *
		 * @since 1.0.0
		 */
		public function register_options_page() {
			add_options_page( esc_html__( 'Typekit', 'authentic' ), esc_html__( 'Typekit', 'authentic' ), 'manage_options', 'csco_typekit_settings', array( $this, 'build_options_page' ) );
		}

		/**
		 * Build admin page
		 *
		 * @since 1.0.0
		 */
		public function build_options_page() {

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( esc_html__( 'You do not have sufficient rights to view this page.', 'authentic' ) );
			}

			$this->save_options_page();
			?>

				<div class="wrap csco-wrap">
					<h2><?php esc_html_e( 'Typekit', 'authentic' ); ?></h2>

					<div class="csco-settings">
						<form method="post">
							<table class="form-table">
								<tbody>
									<!-- Typekit Token -->
									<tr>
										<th scope="row"><label for="csco_typekit_token"><?php esc_html_e( 'Typekit Token', 'authentic' ); ?></label></th>
										<td><input class="regular-text" id="csco_typekit_token" name="csco_typekit_token" type="text" value="<?php echo esc_attr( get_option( 'csco_typekit_token' ) ); ?>"></td>
									</tr>
									<tr>
										<td colspan="2">
											<p><?php esc_html_e( '1. Log in to your account', 'authentic' ); ?> <?php echo sprintf( '<a href="%1$s" target="_blank">%1$s</a>', esc_url( 'https://typekit.com' ) ); ?></p>
											<p><?php esc_html_e( '2. Go to', 'authentic' ); ?> <?php echo sprintf( '<a href="%1$s" target="_blank">%1$s</a>', esc_url( 'https://typekit.com/account/tokens' ) ); ?></p>
											<p><?php esc_html_e( '3. Copy your "Typekit Token" under the inscription "Your API tokens"', 'authentic' ); ?></p>
										</td>
									</tr>
									<!-- Kits -->
									<tr>
										<?php
										$token = get_option( 'csco_typekit_token' );

										if ( $token ) {

											$typekit = new Typekit();

											$typekit_data = $typekit->get( null, $token );

											if ( $typekit_data && isset( $typekit_data['kits'] ) && $typekit_data['kits'] ) {
											?>
												<th scope="row"><label for="csco_typekit_kit"><?php esc_html_e( 'Kits', 'authentic' ); ?></label></th>
												<td>
													<select class="regular-text" name="csco_typekit_kit" id="csco_typekit_kit">
														<option><?php esc_html_e( '- not selected -', 'authentic' ); ?></option>
														<?php foreach ( $typekit_data['kits'] as $item ) :
															$data_kit = $typekit->get( $item['id'], $token );
														?>
															<option <?php selected( $item['id'], get_option( 'csco_typekit_kit' ) ); ?> value="<?php echo esc_attr( $item['id'] ); ?>"><?php echo esc_html( $data_kit['kit']['name'] ); ?></option>
														<?php endforeach; ?>
													</select>
												</td>
											<?php } else { ?>
												<td colspan="2"><code><?php esc_html_e( 'Invalid Token or font sets not created!', 'authentic' ); ?></code></td>
											<?php } ?>
										<?php } ?>
									</tr>
								</tbody>
							</table>

							<?php wp_nonce_field( 'csco_save_action','csco_save_nonce' ); ?>

							<p class="submit"><input class="btw-button button button-primary" name="save_settings" type="submit" value="<?php esc_html_e( 'Save changes', 'authentic' ); ?>" /></p>
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
			if ( isset( $_POST['csco_save_action'] ) && ! wp_verify_nonce( wp_unslash( $_POST['csco_save_action'] ),'csco_save_nonce' ) ) { // Input var ok; sanitization ok.
				return;
			}

			if ( isset( $_POST['save_settings'] ) ) { // Input var ok.

				if ( isset( $_POST['csco_typekit_token'] ) ) { // Input var ok.
					update_option( 'csco_typekit_token', sanitize_text_field( wp_unslash( $_POST['csco_typekit_token'] ) ) ); // Input var ok.
				}
				if ( isset( $_POST['csco_typekit_kit'] ) ) { // Input var ok.
					update_option( 'csco_typekit_kit', sanitize_text_field( wp_unslash( $_POST['csco_typekit_kit'] ) ) ); // Input var ok.
				}
				printf( '<div id="message" class="updated fade"><p><strong>%s</strong></p></div>', esc_html__( 'The settings are saved.', 'authentic' ) );
			}
		}


		/**
		 * Settings save
		 *
		 * @since 1.0.0
		 */
		public function frontend_enqueue() {
			$kit = get_option( 'csco_typekit_kit' );

			if ( $kit ) {
				wp_enqueue_script( 'use-typekit', sprintf( '//use.typekit.net/%s.js', $kit ), array(), false, false );

				wp_add_inline_script( 'use-typekit', 'try{ Typekit.load({ async: true }); }catch(e){}' );
			}
		}
	}


	/**
	 * CSCO Typekit Client Class
	 */
	class Typekit {

		/**
		 * Timeout.
		 *
		 * @var int $timeout Timeout.
		 */
		private $timeout = 30;

		/**
		 * Api link.
		 *
		 * @var string $api link.
		 */
		private $api = 'https://typekit.com/api/v1/json/kits/';

		/**
		 * Create a new instance of the client
		 *
		 * @param number $timeout Connection timeout in seconds (default is 30 seconds).
		 */
		function __construct( $timeout = 30 ) {
			$this->timeout = $timeout;
		}

		/**
		 * Make a request and read the response. If succesful,
		 * a tuple of HTTP status code and response data is
		 * returned. If an error occurs NULL is returned.
		 *
		 * @param number $path Path.
		 * @param string $token Token.
		 * @return (number, string)|null
		 */
		private function make_request( $path, $token ) {

			$remote_get = wp_remote_get( $path, array(
				'timeout'     => $this->timeout,
				'httpversion' => '1.1',
				'headers'     => array(
					'Accept'          => 'application/json',
					'Host'            => 'typekit.com',
					'X-Typekit-Token' => $token,
				),
			) );

			if ( ! is_wp_error( $remote_get ) || wp_remote_retrieve_response_code( $remote_get ) === 200 ) {
				return array( '200', $remote_get['body'] );
			} else {
				return null;
			}
		}

		/**
		 * Get one or more kits. If kit identifier is not given
		 * all kits are returned.
		 *
		 * @param string $id The kit identifier (optional).
		 * @param string $token Your Typekit API token (optional).
		 * @return string|null NULL if retrieving the kit(s) failed, otherwise it return the data.
		 */
		function get( $id = null, $token = null ) {
			if ( ! is_null( $id ) ) {
				if ( ! is_null( $token ) ) {
					$result = $this->make_request( $this->api . $id . '/', $token );
				} else {
					$result = $this->make_request( $this->api . $id . '/published', $token );
				}
			} else {
				$result = $this->make_request( $this->api, $token );
			}

			if ( ! is_null( $result ) ) {
				list($status, $data) = $result;

				if ( '200' === $status ) {
					return json_decode( $data, true );
				}
			}
			return null;
		}
	}

	new CSCO_Typekit();
}
