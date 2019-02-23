<?php
/**
 * Register Social Params
 *
 * @link       https://codesupply.co
 * @since      1.0.0
 *
 * @package    Basic Social Accounts
 * @subpackage Includes
 */

/**
 * Set list social params
 *
 * @param array $list Array social params.
 * @return array Array social params.
 */
function bsa_social_params( $list = array() ) {

	// Facebook.
	$list['facebook'] = array(
		'id'		=> 'facebook',
		'name'		=> esc_html__( 'Facebook', 'basic-social-accounts' ),
		'fields'	=> array(
			'csco_facebook_app_id'		=> esc_html__( 'Facebook App ID', 'basic-social-accounts' ),
			'csco_facebook_app_secret'	=> esc_html__( 'Facebook App Secret', 'basic-social-accounts' ),
		),
	);

	ob_start();
	?>
		<ol>
			<li>
				<?php echo wp_kses_post( __( 'Go to <a href="https://developers.facebook.com" target="_blank">developers.facebook.com</a> and click on <strong>Log In</strong> in the top right.  Log in using your personal Facebook credentials.', 'basic-social-accounts' ) ); ?>
				<p><?php echo wp_kses_post( __( '<em><strong>Note:</strong> You cannot log in to the Developer site using a Facebook Page or Business account. You must use the username and password from your personal Facebook profile. Facebook doesn\'t allow businesses to register as developers, only individuals.</em>', 'basic-social-accounts' ) ); ?></p>
			</li>
			<li><?php echo wp_kses_post( __( 'If this is your first time signing in to the Facebook Developer portal then click on <strong>Register</strong>. Registering is a quick an easy process which will take less than a couple of minutes.  If you\'re already registered then you can skip ahead to step 7.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Accept the Facebook terms and click <strong>Next</strong>.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Enter your phone number to confirm your account.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Facebook will send you an automated text message containing a confirmation code. Enter it in the box and click <strong>Register</strong>.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'You\'re now registered as a Facebook Developer. Click <strong>Done</strong>.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Hover over <strong>My Apps</strong> and then click on <strong>Add a New App.</strong>', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Click on <strong>basic setup.</strong>', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Enter your <strong>App Name</strong>. This can be anything you like. Choose a <strong>Category</strong>. Click <strong>Continue</strong>.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Complete the Security Check and click <strong>Submit</strong>.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Your App should now be set up. Copy and paste your <strong>App ID</strong> and <strong>App Secret</strong> into the setting fields.', 'basic-social-accounts' ) ); ?></li>
		</ol>
	<?php
	$list['facebook']['instructions'] = ob_get_clean();

	// Instagram.
	$list['instagram'] = array(
		'id'		=> 'instagram',
		'name'		=> esc_html__( 'Instagram', 'basic-social-accounts' ),
		'fields'	=> array(
			'csco_instagram_token'		=> esc_html__( 'Instagram Token', 'basic-social-accounts' ),
		),
	);

	ob_start();
	?>
		<ol>
			<li><?php echo wp_kses_post( __( 'Go to <a href="http://instagram.pixelunion.net/" target="_blank">instagram.pixelunion.net</a> and click on <strong>Generate Access Token</strong>.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Copy and paste your <strong>Access token</strong> into the setting field.</strong>.', 'basic-social-accounts' ) ); ?></li>
		</ol>
	<?php
	$list['instagram']['instructions'] = ob_get_clean();

	// Twitter.
	$list['twitter'] = array(
		'id'		=> 'twitter',
		'name'		=> esc_html__( 'Twitter', 'basic-social-accounts' ),
		'fields'	=> array(
			'csco_twitter_consumer_key'			=> esc_html__( 'Twitter Consumer Key', 'basic-social-accounts' ),
			'csco_twitter_consumer_secret'		=> esc_html__( 'Twitter Consumer Secret', 'basic-social-accounts' ),
			'csco_twitter_access_token'			=> esc_html__( 'Twitter Access Token', 'basic-social-accounts' ),
			'csco_twitter_access_token_secret'	=> esc_html__( 'Twitter Access Token Secret', 'basic-social-accounts' ),
		),
	);

	ob_start();
	?>
		<ol>
			<li><?php echo wp_kses_post( __( 'Go to <a href="https://apps.twitter.com/app/new" target="_blank">apps.twitter.com/app/new</a> and log in, if necessary.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Enter your desired Application Name, Description and your website address making sure to enter the full address including the http://. You can leave the callback URL empty.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Accept the TOS and submit the form by clicking the <strong>Create your Twitter Application</strong>.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'After creating your Twitter Application click on the tab that says Keys and Access Tokens, then you have to give access to your Twitter Account to use this Application. To do this, click the <strong>Create my Access Token</strong> button.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Lastly copy the Consumer key (API key), Consumer Secret, Access Token and Access Token Secret from the screen into our setting fields.', 'basic-social-accounts' ) ); ?></li>
		</ol>
	<?php
	$list['twitter']['instructions'] = ob_get_clean();

	// Google Plus.
	$list['google'] = array(
		'id'		=> 'google',
		'name'		=> esc_html__( 'Google Plus', 'basic-social-accounts' ),
		'fields'	=> array(
			'csco_google_key'			=> esc_html__( 'Google Key', 'basic-social-accounts' ),
		),
	);

	ob_start();
	?>
		<ol>
			<li><?php echo wp_kses_post( __( 'Navigate to the <a href="https://console.developers.google.com/" target="_blank">Google Developers Console</a>.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'From the top Project menu select <strong>Create project</strong>.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Give your project a name, agree to the terms, then click <strong>Create</strong>.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Select Credentials under API Manager in the left-hand menu, click <strong>Create credentials</strong>, then select <strong>API key</strong>.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'On the <strong>API key created</strong> popup, select and copy (Cmd-C or Ctrl-C) your newly created API key.', 'basic-social-accounts' ) ); ?></li>
		</ol>
	<?php
	$list['google']['instructions'] = ob_get_clean();

	// YouTube.
	$list['youtube'] = array(
		'id'		=> 'youtube',
		'name'		=> esc_html__( 'YouTube', 'basic-social-accounts' ),
		'fields'	=> array(
			'csco_youtube_key'			=> esc_html__( 'YouTube Key', 'basic-social-accounts' ),
		),
	);

	ob_start();
	?>
		<ol>
			<li><?php echo wp_kses_post( __( 'Navigate to the <a href="https://console.developers.google.com/" target="_blank">Google Developers Console</a>.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'From the top Project menu select <strong>Create project</strong>.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Give your project a name, agree to the terms, then click <strong>Create</strong>.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Select Credentials under API Manager in the left-hand menu, click <strong>Create credentials</strong>, then select <strong>API key</strong>.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'On the <strong>API key created</strong> popup, select and copy (Cmd-C or Ctrl-C) your newly created API key.', 'basic-social-accounts' ) ); ?></li>
		</ol>
	<?php
	$list['youtube']['instructions'] = ob_get_clean();

	// SoundCloud.
	$list['soundcloud'] = array(
		'id'		=> 'soundcloud',
		'name'		=> esc_html__( 'SoundCloud', 'basic-social-accounts' ),
		'fields'	=> array(
			'csco_soundcloud_client_id'	=> esc_html__( 'SoundCloud Client ID', 'basic-social-accounts' ),
		),
	);

	ob_start();
	?>
		<ol>
			<li>
				<?php echo wp_kses_post( __( '<strong>Register Your App and Obtain API Credentials with SoundCloud.</strong>', 'basic-social-accounts' ) ); ?>
				<p><?php echo wp_kses_post( __( '<em>SoundCloud doesn\'t have an automated process to register your app. Only after SoundCloud approves your application you will be able to use the your app.</em>', 'basic-social-accounts' ) ); ?></p>
				<p><?php echo wp_kses_post( __( 'Navigate to the <a href="http://developers.soundcloud.com/" target="_blank">SoundCloud Developer Portal</a>. Using the navigation menu on the right side, click on <strong>Register a new app</strong>.', 'basic-social-accounts' ) ); ?></p>
				<p><?php echo wp_kses_post( __( 'You will be asked to fill out a Developer Application (which is a Google Forms document) that provides SoundCloud information about your Client.', 'basic-social-accounts' ) ); ?></p>
				<p><?php echo wp_kses_post( __( 'Once you have completed and submitted your application, you will be contacted by the SoundCloud team with further instructions on how to proceed. Only at this point will you be given the appropriate API credentials to complete the integration.', 'basic-social-accounts' ) ); ?></p>
			</li>
			<li><?php echo wp_kses_post( __( '<strong>Set Up a SoundCloud.</strong><br> Once your Client has been added to your SoundCloud account, you can get the Client ID.', 'basic-social-accounts' ) ); ?></li>
		</ol>
	<?php
	$list['soundcloud']['instructions'] = ob_get_clean();

	// Dribbble.
	$list['dribbble'] = array(
		'id'		=> 'dribbble',
		'name'		=> esc_html__( 'Dribbble', 'basic-social-accounts' ),
		'fields'	=> array(
			'csco_dribbble_token'		=> esc_html__( 'Dribbble Token', 'basic-social-accounts' ),
		),
	);

	ob_start();
	?>
		<ol>
			<li><?php echo wp_kses_post( __( 'Go to <a href="https://dribbble.com/account/applications/new" target="_blank">this</a> page.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Enter all of the information (For "callback URL" you can just enter your domain name).', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Click <strong>Register application</strong> button.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Find and copy the <strong>Client Access Token</strong>.', 'basic-social-accounts' ) ); ?></li>
		</ol>
	<?php
	$list['dribbble']['instructions'] = ob_get_clean();

	// Vimeo.
	$list['vimeo'] = array(
		'id'		=> 'vimeo',
		'name'		=> esc_html__( 'Vimeo', 'basic-social-accounts' ),
		'fields'	=> array(
			'csco_vimeo_token'			=> esc_html__( 'Vimeo Token', 'basic-social-accounts' ),
		),
	);

	ob_start();
	?>
		<ol>
			<li><?php echo wp_kses_post( __( 'Log into Vimeo Apps here: <a href="https://developer.vimeo.com/apps" target="_blank">developer.vimeo.com/apps</a>.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Click on the <strong>Create New App</strong> button.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Fill out the app Name, Description, URL fields. These fields are required.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Accept the TOS and click on the <strong>Create App</strong> button.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'You\'ll land on your App\'s administrative page. Click the <strong>Authentication</strong> tab.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Scroll down to the <strong>Generate a New Access Token</strong> section. Click the <strong>Generate Token</strong> button.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Your access token will be created below. Copy and paste the access token into the setting field.', 'basic-social-accounts' ) ); ?></li>
		</ol>
	<?php
	$list['vimeo']['instructions'] = ob_get_clean();

	// Behance.
	$list['behance'] = array(
		'id'		=> 'behance',
		'name'		=> esc_html__( 'Behance', 'basic-social-accounts' ),
		'fields'	=> array(
			'csco_behance_client_id'	=> esc_html__( 'Behance Client ID', 'basic-social-accounts' ),
		),
	);

	ob_start();
	?>
		<ol>
			<li><?php echo wp_kses_post( __( 'Go to <a href="https://www.behance.net/dev/apps" target="_blank">www.behance.net/dev/apps</a>.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Click on the <strong>Register a new app</strong>.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Fill out the app Name, Website, Description fields.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Copy and paste the <strong>client id</strong> into the setting field.', 'basic-social-accounts' ) ); ?></li>
		</ol>
	<?php
	$list['behance']['instructions'] = ob_get_clean();

	// Behance.
	$list['github'] = array(
		'id'		=> 'github',
		'name'		=> esc_html__( 'GitHub', 'basic-social-accounts' ),
		'fields'	=> array(
			'csco_github_client_id'		=> esc_html__( 'GitHub Client ID', 'basic-social-accounts' ),
			'csco_github_client_secret'	=> esc_html__( 'GitHub Client Secret', 'basic-social-accounts' ),
		),
	);

	ob_start();
	?>
		<ol>
			<li><?php echo wp_kses_post( __( 'Log into GitHub and go to <a href="https://github.com/settings/applications/new" target="_blank">Register new application</a>.', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Complete the information on this page then click <strong>Register application</strong>', 'basic-social-accounts' ) ); ?></li>
			<li><?php echo wp_kses_post( __( 'Once the application is registered, your app\'s <strong>Client Id</strong> and <strong>Client Secret</strong> will be displayed on the following page.', 'basic-social-accounts' ) ); ?></li>
		</ol>
	<?php
	$list['github']['instructions'] = ob_get_clean();

	return $list;
}
add_filter( 'csco_register_social_params', 'bsa_social_params' );
