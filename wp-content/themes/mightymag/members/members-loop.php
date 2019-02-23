<?php

/**
 * BuddyPress - Members Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_dtheme_object_filter()
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

<?php do_action( 'bp_before_members_loop' ); ?>

<?php if ( bp_has_members( bp_ajax_querystring( 'members' ) ) ) : ?>

	<div id="pag-top" class="pagination reply-wrap btn-full">

		<div class="pag-count" id="member-dir-count-top">

			<?php bp_members_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="member-dir-pag-top">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>

	<?php do_action( 'bp_before_directory_members_list' ); ?>

	<ul id="members-list" class="item-list" role="main">

	<?php while ( bp_members() ) : bp_the_member(); ?>

		<li class="boxed">
			<div class="item-avatar">
				<a href="<?php bp_member_permalink(); ?>"><?php bp_member_avatar('type=full&width=80&height=80'); ?></a>
			</div>

			<div class="item">
				<div class="item-title">
					<cite class="fn"><a class="user-name" href="<?php bp_member_permalink(); ?>"><?php bp_member_name(); ?></a></cite>
				</div>
				
				<?php if ( bp_get_member_latest_update() ) : ?>

					<span class="update"> <?php bp_member_latest_update(); ?></span>

				<?php endif; ?>

				<div class="item-meta"><span class="activity"><?php bp_member_last_active(); ?></span></div>

				<?php do_action( 'bp_directory_members_item' ); ?>

				<?php
				 /***
				  * If you want to show specific profile fields here you can,
				  * but it'll add an extra query for each member in the loop
				  * (only one regardless of the number of fields you show):
				  *
				  * bp_member_profile_data( 'field=the field name' );
				  */
				?>
			</div>
			
			<div class="clear"></div>

			<?php if ( is_user_logged_in() ) : ?>
			<div class="action reply-wrap clearfix">

				<?php do_action( 'bp_directory_members_actions' ); ?>

			</div>
			<?php endif; ?>

			<div class="clear"></div>
		</li>

	<?php endwhile; ?>

	</ul>

	<?php do_action( 'bp_after_directory_members_list' ); ?>

	<?php bp_member_hidden_fields(); ?>

	<div id="pag-bottom" class="pagination reply-wrap btn-full">

		<div class="pag-count" id="member-dir-count-bottom">

			<?php bp_members_pagination_count(); ?>

		</div>

	</div>
	
	<div class="pagination-links" id="member-dir-pag-bottom">

		<?php bp_members_pagination_links(); ?>

	</div>

<?php else: ?>

	<div id="message" class="alert alert-info">
		<p><?php _e( "Sorry, no members were found.", 'buddypress' ); ?></p>
	</div>

<?php endif; ?>

<?php do_action( 'bp_after_members_loop' ); ?>