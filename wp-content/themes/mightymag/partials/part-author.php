<div id="author-wrap">

	<h4 class="mgm-title">
		<span class="inner"><?php _e('About The Author', 'mightymag'); ?></span>
	</h4>
	
	<div class="boxed clearfix wow fadeInUp">
			
		<div class="img-frame pull-left">
			<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>">
			<?php echo get_avatar(get_the_author_meta('email'), '70'); ?>
			</a>
		</div>
	
		<span class="author-name"><?php the_author_posts_link(); ?></span>
		<p><?php the_author_meta("description"); ?></p>	
		
		<?php if(get_the_author_meta('twitter') || get_the_author_meta('facebook')|| get_the_author_meta('googleplus') || get_the_author_meta('flickr') || get_the_author_meta('linkedin') ||  get_the_author_meta('pinterest') ): ?>		
	
		<div id="author-socials-wrap" class="clearfix">
			<span class="author-socials clearfix">
				<?php if(get_the_author_meta('flickr')): ?>
				<a href="http://www.flickr.com/photos/<?php echo get_the_author_meta('flickr'); ?>" class="flickr"></a>
				<?php endif; ?>
			
				<?php if(get_the_author_meta('googleplus')): ?>
				<a href="http://plus.google.com/<?php echo get_the_author_meta('googleplus'); ?>?rel=author" class="googleplus"></a>
				<?php endif; ?>
				
				<?php if(get_the_author_meta('facebook')): ?>
				<a href="http://facebook.com/<?php echo get_the_author_meta('facebook'); ?>" class="facebook"></a>
				<?php endif; ?>
				
				<?php if(get_the_author_meta('linkedin')): ?>
				<a href="http://www.linkedin.com/in/<?php echo get_the_author_meta('linkedin'); ?>" class="linkedin"></a>
				<?php endif; ?>
			
				<?php if(get_the_author_meta('pinterest')): ?>
				<a href="http://pinterest.com/<?php echo get_the_author_meta('pinterest'); ?>" class="pinterest"></a>
				<?php endif; ?>
		
				<?php if(get_the_author_meta('twitter')): ?>
				<a href="http://twitter.com/<?php echo get_the_author_meta('twitter'); ?>" class="twitter"></a>
				<?php endif; ?>	
			</span><!--.author socials-->
		</div><!-- #author-socials-wrap-->
		
		<?php endif; ?>	
	</div><!-- .boxed -->
	
</div><!-- #author-wrap -->
