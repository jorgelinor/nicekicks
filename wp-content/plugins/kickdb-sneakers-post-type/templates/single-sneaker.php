<?php
/**
 * The template for displaying single sneakers.
 *
 * @package KickDB Sneaker Post Type
 * @subpackage Templates
 * @version 1.0.0
 * @since Authentic 2.0.0
 */

get_header(); ?>


	<div id="primary" class="content-area">

		<?php do_action( 'csco_main_before' ); ?>

		<main id="main" class="site-main" role="main">

			<?php do_action( 'csco_main_start' ); ?>

			<?php while ( have_posts() ) {

				the_post();

				do_action( 'csco_post_before' ); ?>


				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

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

				  <h1><?php the_title() ?></h1>
				  <?php /* do_action( 'csco_post_start' ); */ ?>

				  <div class="post-wrap">

				    <?php /*
							Show social buttons
							do_action( 'csco_post_main_before' );
						*/ ?>

				    <div class="post-main">

				      <?php do_action( 'csco_post_content_before' ); ?>

				      <div class="content entry-content">


				        <?/*
				          Using the same gallery code as Authentic Theme
				          /wp-content/themes/authentic/template-parts/media/format-gallery.php
				        */?>
				        <div class="post-media">
				          <div class="gallery gallery-slider owl-container owl-simple">
				            <div class="owl-carousel">
				              <?php
				              $images = get_field('images');
				              foreach ( $images as $image ) { ?>
				                <div class="owl-slide">
				                <figure>
				                  <?php echo wp_get_attachment_link( $image['id'], 'large', false, false, false ); ?>
				                </figure>
				                </div>
				              <?php } ?>
				            </div>
				            <div class="owl-dots"></div>
				          </div>
				        </div>
				        <style type="text/css">
									.sneaker__breadcrumb {
										margin-bottom: 0.5rem;
									}
				          .owl-carousel .owl-item {
				            height: 500px;
										display: flex;
										justify-content: center;
										align-items: center;
				          }
				          .owl-carousel .owl-item img {
				            max-height: 500px;
				            width: auto;
				          }
				          .owl-carousel .pin-it {
				            display: none;
				          }
				          .owl-carousel .image-popup:after {
				            display: none;
				          }
									@media (min-width: 1000px) {
										/* .sneaker__vitals {
											display: flex;
										}
										.sneaker__vitals__row {
											flex: 1;
										} */
									}
									@media (min-width: 600px) {
										.sneaker__vitals__row {
											display: flex;
										}
									}
				          .sneaker__vital {
										width: 33%;
				            flex-grow: 1;
										flex-shrink: 1;
				            display: flex;
				            flex-direction: column;
										margin-bottom: 0.5rem;
										margin-right: 0.5rem;
				          }
				          .sneaker__label {
				            font-size: 0.8rem;
				          }
				          .sneaker__value {
				            color: #000;
				          }
				          .sneaker__section-title {
				            font-size: 1.1rem;
				            margin-bottom: 0.5rem;
				          }
									.sneakers__description {
										margin: 1rem 0;
									}
				          .sneaker__related-ul {
				            margin: 0;
				            padding: 0;
				          }
				          .sneaker__related-li {
				            margin: 0;
				            padding: 0;
				            list-style: none;
				          }
				        </style>

				        <div class="sneaker__vitals">

									<div class="sneaker__vitals__row">
					          <div class="sneaker__vital sneaker__vital--brand">
					            <div class="sneaker__label">Brand</div>
					            <div class="sneaker__value"><?php the_field('brand'); ?></div>
					          </div>
					          <div class="sneaker__vital sneaker__vital--model">
					            <div class="sneaker__label">Model</div>
					            <div class="sneaker__value"><?php the_field('model'); ?></div>
					          </div>
					          <div class="sneaker__vital sneaker__vital--colorway">
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
					          <div class="sneaker__vital">
					            <?php
					              if (get_field('style_code')) {
					                ?>
					                  <div class="sneaker__label">Style Code</div>
					                  <div class="sneaker__value"><?php the_field('style_code'); ?></div>
					                <?php
					              }
					            ?>
					          </div>
					        </div>
								</div>

			          <div class="sneakers__description"><?php the_field('product_description'); ?></div>

			          <?php
			            if (get_field('purchase_links')) {
			              ?>
			                <div class="sneakers__purchase">
			                  <h3 class="sneaker__section-title">Where To Buy</h3>
			                  <?php the_field('purchase_links'); ?>
			                </div>
			              <?php
			            }
			          ?>

				        <?php
				          $posts = get_field('related_posts');
				          if ($posts) {
				            ?>
				            <h3 class="sneaker__section-title">More Info</h3>
				            <ul class="sneaker__related-ul">
				              <?php
				                foreach ($posts as $p) {
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

				        <?php the_content(); ?>

				      </div>

				      <?php do_action( 'csco_post_content_after' ); ?>

				    </div><!-- .post-main -->

				    <?php do_action( 'csco_post_main_after' ); ?>

				  </div><!-- .entry-wrap -->

				  <?php do_action( 'csco_post_end' ); ?>

				</article>


				<?php do_action( 'csco_post_after' ); ?>

			<?php } ?>

			<?php do_action( 'csco_main_end' ); ?>

		</main>

		<?php do_action( 'csco_main_after' ); ?>

	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
