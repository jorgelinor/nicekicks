<?php global $redux_builder_amp;  ?>
<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
    <link rel="dns-prefetch" href="https://cdn.ampproject.org">
	<?php do_action( 'amp_post_template_head', $this ); ?>
	<style amp-custom>
		<?php $this->load_parts( array( 'style' ) ); ?>
		<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
  <script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
</head>

<body <?php ampforwp_body_class('design_3_wrapper');?> >
<?php do_action('ampforwp_body_beginning', $this); ?>
<?php $this->load_parts( array( 'header-bar' ) ); ?>

<?php do_action( 'ampforwp_after_header', $this ); ?>
<main>
	<article class="amp-wp-article">
		<?php do_action('ampforwp_post_before_design_elements') ?>
		<div class="sneaker__breadcrumb">
			<?php
				$brand = get_field('brand');
				if ($brand === 'Jordan') {
					?>
						<a href="/jordan-release-dates">&larr; &nbsp; Jordan Release Dates</a>
					<?php
				}
				else {
					?>
						<a href="/sneaker-release-dates">&larr; &nbsp; Sneaker Release Dates</a>
					<?php
				}
			?>
		</div>
		<?php
      $this->load_parts( array('ampforwp-the-title' ));
    ?>
<div class="amp-wp-article-content">
  <div class="amp-wp-content the_content">
    <div>
      <?php
        $images = get_field('images');
        $has_images = $images && count($images) > 0;

        if( $has_images ) {
          ?>
            <amp-carousel
              id="carousel-with-preview"
              layout="fixed-height" height="300" type="carousel"
            >
          <?php
        }
        foreach( $images as $image ) {
          $size = 'medium';
          $icon = false;
					$alt = $image['alt'];
          $attachment = wp_get_attachment_image_src($image['ID'], $size, $icon);
          list($src, $width, $height) = $attachment;
          ?>
            <amp-img
              src="<?php echo $src; ?>"
              width="300"
              height="300"
              alt="<?php echo $alt; ?>"
            ></amp-img>
          <?php
        }
        if( $has_images ) {
          ?>
            </amp-carousel>
          <?php
        }
      ?>
    </div>

		<style type="text/css">
		  .sneaker__breadcrumb {
				max-width: 1000px;
				margin: 0 auto;
			}
			.sneaker__vitals {
				margin-bottom: 1rem;
			}
			@media (min-width: 800px) {
				.sneaker__vitals__row {
					display: flex;
				}
			}
			.sneaker__vital {
				flex: 1;
				display: flex;
				flex-direction: column;
				margin-bottom: 0.5rem;
			}
			.sneaker__label {
				font-size: 0.9rem;
				color: #777777;
			}
			.sneaker__value {
				color: #000;
			}
			.sneaker__section-title {
				font-size: 1.1rem;
				font-weight: 600;
				margin-bottom: 0.5rem;
			}
		</style>

		<div class="sneaker__vitals">
			<div class="sneaker__vitals__row">
				<div class="sneaker__vital">
					<div class="sneaker__label">Brand</div>
					<div class="sneaker__value"><?php the_field('brand'); ?></div>
				</div>
				<div class="sneaker__vital">
					<div class="sneaker__label">Model</div>
					<div class="sneaker__value"><?php the_field('model'); ?></div>
				</div>
				<div class="sneaker__vital">
					<div class="sneaker__label">Colorway</div>
					<div class="sneaker__value"><?php the_field('colorway'); ?></div>
				</div>
			</div>
			<div class="sneaker__vitals__row">
				<?php
					if (get_field('price')) {
						?>
							<div class="sneaker__vital">
								<div class="sneaker__label">Price</div>
								<div class="sneaker__value">$<?php the_field('price'); ?></div>
							</div>
						<?php
					}
				?>
				<div class="sneaker__vital">
					<div class="sneaker__label">Release Date</div>
					<div class="sneaker__value">
						<?php
							$release_date_type = get_field('release_date_type');
							if ($release_date_type === 'Calendar Date') {
								 the_field('calendar_release_date');
							}
							if ($release_date_type === 'Text Date') {
								the_field('text_release_date');
							}
						?>
					</div>
				</div>
					<?php
						if (get_field('style_code')) {
							?>
							<div class="sneaker__vital">
								<div class="sneaker__label">Style Code</div>
								<div class="sneaker__value"><?php the_field('style_code'); ?></div>
							</div>
							<?php
						}
					?>
			</div>
		</div>


		<div class="sneakers__description-purchase">
			<div class="sneakers__description"><?php the_field('product_description'); ?></div>
			<?php
				if (get_field('purchase_links')) {
					?>
						<div class="sneakers__purchase">
							<div class="sneaker__section-title">Where To Buy</div>
							<?php the_field('purchase_links'); ?>
						</div>
					<?php
				}
			?>
		</div>

		<?php
			$posts = get_field('related_posts');
			if ($posts) {
				?>
				<div class="sneaker__section-title">More Info</div>
				<ul class="sneaker__related-ul">
					<?php
						foreach($posts as $p) {
							?>
							<li class="sneaker__related-li">
								<a href="<?php echo get_permalink( $p->ID ); ?>"><?php echo get_the_title( $p->ID ); ?></a>
							</li>
							<?php
						}
					?>
				</ul>
				<?php
			}
		?>

		<?php
			$stylecode = get_field('style_code');
			if ($stylecode) {
				echo do_shortcode("[kickdb stylecode='$stylecode']");
			}
		?>

  </div>
</div>
    <?php
    	$this->load_parts( array('ampforwp-the-content' ));
    	$this->load_parts( array('ampforwp-meta-taxonomy' ));
    	$this->load_parts( array('ampforwp-bread-crumbs' ));
    ?>
		<?php do_action('ampforwp_post_after_design_elements') ?>
	</article>
</main>
<?php do_action( 'amp_post_template_above_footer', $this ); ?>
<?php $this->load_parts( array( 'footer' ) ); ?>
<?php do_action( 'amp_post_template_footer', $this ); ?>
</body>
</html>
