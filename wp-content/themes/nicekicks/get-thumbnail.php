<?php $tout_query = new WP_Query('cat=&showposts=5'); ?>
<?php while ($tout_query->have_posts()) : $tout_query->the_post(); ?>
<span class="orbit-caption" id="postTitle<?php echo $post->ID; ?>"><?php the_title(); ?></span>
<?php endwhile; ?>