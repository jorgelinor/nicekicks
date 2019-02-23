<?php
/**
 * Filters and Functions for Basic Plugins
 *
 * 1. Basic Share Buttons
 * 2. Basic Social Accounts
 * 3. Basic Twitter
 * 4. Basic Facebook
 * 5. Basic MailChimp
 * 6. Basic Shortcodes
 *
 * @package Authentic
 * @subpackage Framework
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

/**
 * -------------------------------------------------------------------------
 * [ Basic Share Buttons ]
 * -------------------------------------------------------------------------
 */

/**
 * Custom Locations
 *
 * @param array $locations Available locations.
 */
function csco_custom_share_locations( $locations = array() ) {
	$locations = array(
		array(
			'name'     => esc_html__( 'Post Sidebar', 'authentic' ),
			'location' => 'post-sidebar',
			'display'  => true,
			'fields'   => array(
				'total'			=> true,
				'counts'		=> true,
			),
			'shares'   => array( 'facebook', 'twitter', 'pinterest' ),
		),
		array(
			'name'     => esc_html__( 'Before Content', 'authentic' ),
			'location' => 'before-post',
			'display'  => false,
			'fields'   => array(
				'total'			=> true,
				'labels'		=> true,
				'counts'		=> true,
			),
			'shares'   => array( 'facebook', 'twitter', 'pinterest' ),
		),
		array(
			'name'     => esc_html__( 'After Content', 'authentic' ),
			'location' => 'after-post',
			'display'  => true,
			'fields'   => array(
				'total'			=> true,
				'labels'		=> true,
				'counts'		=> true,
			),
			'shares'   => array( 'facebook', 'twitter', 'pinterest' ),
		),
		array(
			'name'     => esc_html__( 'Post Archives', 'authentic' ),
			'location' => 'post-loop',
			'display'  => true,
			'fields'   => array(
				'counts'		=> false,
			),
			'shares'   => array( 'facebook', 'twitter', 'pinterest' ),
		),
	);

	return $locations;
}
add_filter( 'bsb_locations', 'csco_custom_share_locations' );

/**
 * Custom Color Schemes
 *
 * @param array $schemes Available color schemes.
 */
function csco_custom_share_color_schemes( $schemes = array() ) {

	$schemes = array(
		'default' => array(
			'name'     => esc_html__( 'Default', 'authentic' ),
		),
		'bold' => array(
			'name'     => esc_html__( 'Bold', 'authentic' ),
		),
		'monochrome' => array(
			'name'     => esc_html__( 'Monochrome', 'authentic' ),
		),
	);

	return $schemes;
}
add_filter( 'bsb_color_schemes', 'csco_custom_share_color_schemes' );

/**
 * Remove Default Styles
 */
add_filter( 'bsb_enqueue_styles', '__return_false' );

/**
 * -------------------------------------------------------------------------
 * [ Basic Social Accounts ]
 * -------------------------------------------------------------------------
 */

/**
 * Custom Templates
 *
 * @param array $templates Available templates.
 */
function csco_custom_social_accounts_templates( $templates = array() ) {

	$templates = array(
		'default' => array(
			'name' => esc_html__( 'Default', 'authentic' ),
			),
		'default bsa-columns bsa-col-2' => array(
			'name' => esc_html__( '2 columns', 'authentic' ),
			),
		'default bsa-columns bsa-col-3' => array(
			'name' => esc_html__( '3 columns', 'authentic' ),
			),
		'default bsa-columns bsa-col-4' => array(
			'name' => esc_html__( '4 columns', 'authentic' ),
			),
		'default bsa-columns bsa-col-5' => array(
			'name' => esc_html__( '5 columns', 'authentic' ),
			),
		'default bsa-columns bsa-col-6' => array(
			'name' => esc_html__( '6 columns', 'authentic' ),
			),
		'horizontal' => array(
			'name' => esc_html__( 'Horizontal List', 'authentic' ),
			),
		);

	return $templates;
}
add_filter( 'bsa_templates', 'csco_custom_social_accounts_templates' );

/**
 * Remove Default Styles
 */
add_filter( 'bsa_enqueue_styles', '__return_false' );

/**
 * -------------------------------------------------------------------------
 * [ Basic Twitter ]
 * -------------------------------------------------------------------------
 */

/**
 * Custom Templates
 *
 * @param array $templates Available templates.
 */
function csco_btw_register_templates( $templates = array() ) {
	$templates['slider'] = array(
		'name' => esc_html__( 'Slider', 'authentic' ),
		'func' => 'csco_btw_slider_template',
	);

	return $templates;
}
add_filter( 'btw_templates', 'csco_btw_register_templates' );

/**
 * Slider Template
 *
 * @param array $tweets Tweets.
 * @param array $params Parameters.
 */
function csco_btw_slider_template( $tweets, $params ) {
	?>

	<div class="btw-wrap btw-slider">

		<?php
		if ( is_array( $tweets ) && $tweets ) {

			$screen_name = $tweets[0]->user->screen_name;
			$avatar      = $tweets[0]->user->profile_image_url_https;

			if ( isset( $params['header'] ) && ( 'true' === $params['header'] || 'on' === $params['header'] ) ) {	?>

				<div class="btw-header">
					<a href="<?php echo esc_url( sprintf( 'https://twitter.com/%s/', $screen_name ) ); ?>" class="btw-link" target="_blank">
						<?php if ( $avatar ) { ?>
							<img src="<?php echo esc_url( $avatar ); ?>" alt="avatar" class="btw-avatar">
						<?php } ?>
						<span class="btw-username">@<?php echo wp_kses_post( $screen_name ); ?></span>
					</a>
				</div>

			<?php
			} ?>

			<div class="btw-tweets">
				<div class="owl-container owl-flip">
					<div class="owl-carousel">

						<?php
						foreach ( $tweets as $tweet ) {
							$retweets    = $tweet->retweet_count > 0 ? $tweet->retweet_count : '';
							$tweet_id    = $tweet->id_str;
							$text        = btw_convert_links( $tweet->text );
							$time        = btw_relative_time( $tweet->created_at );
							?>
								<div class="owl-slide">
									<div class="btw-tweet">

										<div class="btw-content"><?php echo wp_kses_post( $text ); ?></div>
										<a href="https://twitter.com/<?php echo esc_attr( $screen_name ); ?>/status/<?php echo esc_attr( $tweet_id ); ?>" class="btw-time timestamp" target="_blank"><?php echo esc_html( $time ); ?></a>

										<div class="btw-actions">
											<ul>
												<li>
													<a onClick="window.open('https://twitter.com/intent/tweet?in_reply_to=<?php echo esc_attr( $tweet_id ); ?>','Twitter','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" class="tweet-reply" href="https://twitter.com/intent/tweet?in_reply_to=<?php echo esc_attr( $tweet_id ); ?>">
														<i class="btw-icon icon icon-reply"></i>
														<span class="btw-label btw-reply"><?php esc_html_e( 'Reply', 'basic-twitter' );?></span>
													</a>
												</li>
												<li>
													<a onClick="window.open('https://twitter.com/intent/retweet?tweet_id=<?php echo esc_attr( $tweet_id ); ?>','Twitter','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" class="tweet-retweet" href="https://twitter.com/intent/retweet?tweet_id=<?php echo esc_attr( $tweet_id ); ?>">
														<i class="btw-icon icon icon-repeat"></i>
														<span class="btw-count"><?php echo wp_kses_post( $retweets ); ?></span>
														<span class="btw-label btw-retweet"><?php esc_html_e( 'Retweet', 'basic-twitter' ); ?></span>
													</a>
												</li>
												<li>
													<a onClick="window.open('https://twitter.com/intent/favorite?tweet_id=<?php echo esc_attr( $tweet_id ); ?>','Twitter','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" class="tweet-favorite" href="https://twitter.com/intent/favorite?tweet_id=<?php echo esc_attr( $tweet_id ); ?>">
														<i class="btw-icon icon icon-heart"></i>
														<span class="btw-label btw-favorite"><?php esc_html_e( 'Favorite', 'basic-twitter' ); ?></span>
													</a>
												</li>
											</ul>
										</div>

									</div>
								</div>
							<?php
						} ?>

					</div>
					<div class="owl-dots"></div>
				</div>
			</div>

			<?php
			if ( isset( $params['button'] ) && ( 'true' === $params['button'] || 'on' === $params['button'] ) ) { ?>

				<div class="btw-footer">
					<a class="btw-btn btn btn-primary btn-effect" href="<?php echo esc_url( sprintf( 'https://twitter.com/%s/', $screen_name ) ); ?>" target="_blank">
						<span class="btw-follow"><?php esc_html_e( 'Follow', 'basic-twitter' ); ?></span>
						<span><i class="btw-icon icon icon-twitter"></i></span>
					</a>
				</div>

				<?php
			}
		} else { ?>
			<p><?php esc_html_e( 'No Twitter Found!', 'basic-twitter' ); ?></p>
			<?php
		} ?>
	</div>
	<?php
}

/**
 * Remove Default Styles
 */
add_filter( 'btw_enqueue_styles', '__return_false' );

/**
 * -------------------------------------------------------------------------
 * [ Basic Facebook ]
 * -------------------------------------------------------------------------
 */

/**
 * Load SDK
 */
function csco_include_facebook_sdk() {
	if ( ! function_exists( 'bfb_load_sdk' ) ) {
		return;
	}
	bfb_load_sdk();
}
add_action( 'csco_body_start', 'csco_include_facebook_sdk' );

/**
 * Custom Facebook Comments Locations
 *
 * @param array $locations Facebook Comments locations.
 */
function csco_custom_fb_comments_locations( $locations = array() ) {

	$locations['before_comments'] = array(
		'name'     => esc_html__( 'Before WordPress comments', 'authentic' ),
		'action'   => 'csco_post_after',
		'priority' => 35,
	);

	$locations['after_comments'] = array(
		'name'     => esc_html__( 'After WordPress comments', 'authentic' ),
		'action'   => 'csco_post_after',
		'priority' => 45,
	);

	return $locations;
}
add_filter( 'bfb_comments_location', 'csco_custom_fb_comments_locations' );

/**
 * Remove Default Styles
 */
add_filter( 'bfb_enqueue_styles', '__return_false' );

/**
 * -------------------------------------------------------------------------
 * [ Basic MailChimp ]
 * -------------------------------------------------------------------------
 */

/**
 * Remove Default Styles
 */
add_filter( 'bmc_enqueue_styles', '__return_false' );

/**
 * -------------------------------------------------------------------------
 * [ Basic Shortcodes ]
 * -------------------------------------------------------------------------
 */

/**
 * Remove Default Styles & Scripts
 */
add_filter( 'bsc_enqueue_styles', '__return_false' );
add_filter( 'bsc_enqueue_scripts', '__return_false' );
add_filter( 'bsc_enqueue_bootstrap_styles', '__return_false' );
add_filter( 'bsc_enqueue_bootstrap_scripts', '__return_false' );
