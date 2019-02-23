<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package Authentic
 * @subpackage Templates
 * @version 1.0.0
 * @since Authentic 2.0.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) { ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php } ?>
	<?php wp_head(); ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-111233-1', 'auto');
  ga('send', 'pageview');

</script>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'csco_body_start' ); ?>

<div id="page" class="site">

	<?php do_action( 'csco_site_start' ); ?>

	<div class="site-inner">

		<?php do_action( 'csco_header_before' ); ?>

		<header id="masthead" class="site-header" role="banner">

			<?php do_action( 'csco_header_start' ); ?>

			<?php do_action( 'csco_header' ); ?>

			<?php do_action( 'csco_header_end' ); ?>

		</header>

		<?php do_action( 'csco_header_after' ); ?>

		<?php do_action( 'csco_site_content_before' ); ?>

		<div class="site-content">

			<?php do_action( 'csco_site_content_start' ); ?>

			<div class="container">

				<?php do_action( 'csco_main_content_before' ); ?>

				<div id="content" class="main-content">

					<?php do_action( 'csco_main_content_start' ); ?>