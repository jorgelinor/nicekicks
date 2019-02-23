<?php /* Blog Style G */
$cb_count = 1;
$cb_qry = cb_get_qry();

if ( $cb_qry->have_posts() ) : while ( $cb_qry->have_posts() ) : $cb_qry->the_post();

  $cb_post_id = $post->ID;
  if ( $cb_count == 4 ) { $cb_count = 1; }
  if ( $cb_count % 3  == 0 ) {  
?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('cb-blog-style-d cb-module-d cb-separated cb-img-above-meta cb-big-thumb clearfix'); ?> role="article">

        <div class="cb-mask cb-img-fw" <?php cb_img_bg_color( $cb_post_id ); ?>>
            <?php cb_thumbnail( '759', '500' ); ?>
            <?php cb_review_ext_box( $cb_post_id ); ?>
        </div>

        <div class="cb-meta clearfix">

            <h2 class="cb-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

            <?php cb_byline( $cb_post_id ); ?>

            <?php cb_post_meta( $cb_post_id ); ?>

        </div>

    </article>

<?php } else { ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( "cb-blog-style-b cb-module-a cb-article cb-article-row-2 cb-article-row cb-img-above-meta clearfix cb-separated cb-no-$cb_count" ); ?> role="article">

        <div class="cb-mask cb-img-fw" <?php cb_img_bg_color( $cb_post_id ); ?>>
            <?php cb_thumbnail( '360', '240' ); ?>
            <?php cb_review_ext_box( $cb_post_id ); ?>
        </div>

        <div class="cb-meta clearfix">

            <h2 class="cb-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

            <?php cb_byline( $cb_post_id ); ?>
            
            <?php cb_post_meta( $cb_post_id ); ?>

        </div>

</article>

<?php
  }
  $cb_count++;
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