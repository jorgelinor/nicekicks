<?php
	get_header();
	$cb_blog_style = cb_get_blog_style();

?>

<div class="adslot visible-mobile hidden-desktop hidden-tablet"><!-- /1015938/nicekicks_320x50_ROS -->
<div id='div-gpt-ad-1466196178639-3' style='min-height:50px; width:320px; margin: 0 auto;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1466196178639-3'); });
</script>
</div></div>

<div id="cb-content" class="wrap clearfix">
    
    <div id="main" class="cb-main clearfix cb-module-block" role="main">
        
        <?php cb_breadcrumbs(); ?> 
        <div class="cb-module-header cb-category-header">
            <h1 class="cb-module-title">
                <?php 
                    if ( is_day() == true) { 

                        the_date();

                    } elseif ( is_month() == true ) {

                        the_date( 'F Y' );

                    } elseif ( is_year() == true ) {

                        the_date( 'Y' );
                    }
                ?>
            </h1>                
        </div>
        
        <?php

            include( locate_template( 'blog-style-' . $cb_blog_style . '.php') );

        ?>

    </div> <!-- /main -->

   <?php if ( cb_get_sidebar_check( $cb_blog_style ) == true ) { get_sidebar(); } ?>

</div> <!-- end /#cb-content -->

<?php get_footer(); ?>