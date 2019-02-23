<?php /* Blog Style D */

$cb_qry = cb_get_qry();

$current_post = 1;

if ( $cb_qry->have_posts() ) : while ( $cb_qry->have_posts() ) : $cb_qry->the_post();

  $cb_post_id = $post->ID;

  $cb_category_color = cb_get_cat_color( $cb_post_id );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cb-blog-style-d cb-module-d cb-separated cb-img-above-meta clearfix'); ?> role="article" data-post-num="<?php echo intval( $current_post ); ?>" data-post-style="d">
  
    <div class="cb-mask cb-img-fw" <?php cb_img_bg_color( $cb_post_id ); ?>>
        <?php cb_thumbnail( '759', '500' ); ?>
        <?php cb_review_ext_box( $cb_post_id ); ?>
    </div>

    <div class="cb-meta clearfix">

        <h2 class="cb-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

        <?php cb_byline( $cb_post_id ); ?>

        <?php if ( ot_get_option('cb_bs_d_length', 'cb-bs-d-excerpt') != 'cb-bs-d-excerpt' ) { ?>
          <div class="cb-excerpt"><?php the_content(); ?></div>
        <?php } else { ?>
          <div class="cb-excerpt"></div>
        <?php } ?>

    </div>

</article>

<?php 

		$current_post++;
    
	endwhile;

	cb_page_navi( $cb_qry );
	endif;
	wp_reset_postdata();

?>

<div class="visible-desktop visible-tablet">
    <div class="adslot" id="div-gpt-ad-1466196178639-5" style="width: 600px; min-height: 0; margin: 0 auto 20px;">
        <script type='text/javascript'>
            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1466196178639-5'); });
        </script>
    </div>
</div>