<?php /* Blog Style E */
global $current_post;

$cb_count = 1;
$cb_qry = cb_get_qry();

if ( $cb_qry->have_posts() ) : while ( $cb_qry->have_posts() ) : $cb_qry->the_post();

    $cb_post_id = $post->ID;
    if ( $cb_count == 3 ) { $cb_count = 1; }
?>  

<article id="post-<?php the_ID(); ?>" <?php post_class( "cb-blog-style-e cb-article-small cb-article cb-article-row-2 cb-article-row cb-separated clearfix cb-no-$cb_count" ); ?> role="article" data-post-num="<?php echo intval( $current_post ); ?>" data-post-style="e">

    <div class="cb-mask cb-img-fw" <?php cb_img_bg_color( $cb_post_id ); ?>>
        <?php cb_thumbnail( '100', '65' ); ?>
        <?php cb_review_ext_box( $cb_post_id, true ); ?>
    </div>

    <div class="cb-meta">

        <h2 class="cb-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php echo cb_get_byline_date( $cb_post_id ); ?>

    </div>

</article>

<?php
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