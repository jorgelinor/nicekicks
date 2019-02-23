<?php /*
Example template for use with post thumbnails
Requires WordPress 2.9 and a theme which supports post thumbnails
Author: mitcho (Michael Yoshitaka Erlewine)
*/ ?>
<h3>You Might Also Like</h3>
<?php if ($related_query->have_posts()):?>
<ol>
	<?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
		<?php if ( has_post_thumbnail() ):?>
		<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'be_related' ); ?></a><br /><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
		<?php endif; ?>
	<?php endwhile; ?>
</ol>

<?php else: ?>
<p>No related photos.</p>
<?php endif; ?>
