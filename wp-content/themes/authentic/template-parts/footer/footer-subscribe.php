<?php
/**
 * Subscribe Footer Component.
 *
 * @package Authentic
 * @subpackage Footer Components
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

$title    = get_theme_mod( 'footer_subscribe_title', esc_html__( 'Subscribe','authentic' ) );
$message  = get_theme_mod( 'footer_subscribe_message', esc_html__( 'Subscribe now to our newsletter','authentic' ) );

?>

<div class="footer-section">
	<div class="container">
		<div class="footer-subscribe">
		  <div class="subscribe-container">

				<?php
				if ( shortcode_exists( 'basic_mailchimp' ) ) {

					echo do_shortcode( '[basic_mailchimp title="' . esc_html( $title ) . '" text="' . esc_html( $message ) . '"]' );

				} else { ?>

					<div class="alert alert-warning">
						<?php esc_html_e( 'Please install and activate Basic MailChimp plugin from Appearance → Install Plugins.' ); ?>
					</div>

				<?php } ?>

		  </div>
		</div>
	</div>
</div>
