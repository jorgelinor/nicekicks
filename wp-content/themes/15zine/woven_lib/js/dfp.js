/**
 * Woven DFP
 **/

function woven_is_mobile() {
    if (sessionStorage.desktop)
        return false;
    else if (localStorage.mobile)
        return true;

    mobile = ['iphone','android','blackberry','nokia','opera mini','windows mobile','windows phone','iemobile']; 
    for (var i in mobile) if (navigator.userAgent.toLowerCase().indexOf(mobile[i].toLowerCase()) > 0) return true;

    return false;
}

jQuery( document ).ready(function(){
	var dfpslots = jQuery( 'body' ).find( '.adslot' ).filter( ':visible' ),
	i = 0,
	slot = new Array();
	
	if ( ! woven_is_mobile() ) {
		if ( 'homepage' == WVNconfig.PageData.type ) {
			page_placement = 'Homepage';
		} else if ( 'editorial' == WVNconfig.PageData.type ) {
			page_placement = 'EDIT';
		} else {
			page_placement = 'ROS';
		}
	} else {
		page_placement = 'Mobile';
	}
	
	if ( dfpslots.length ) {

		googletag.cmd.push(function() {
			jQuery( dfpslots ).each(function(){
				unit_placement = jQuery( this ).data( 'zone' );
				zone_placement = page_placement + '_' + unit_placement;

				if ( 'Native' == unit_placement ) {
					zone_placement = 'Homepage_' + unit_placement;
				}

				console.log( 'Rendering NK Zone: ' + zone_placement );

				slot[i] = googletag.defineSlot(
					'/6036473/' + zone_placement,
					jQuery( this ).data( 'size' ), 
					jQuery( this ).attr( 'id' )
				).addService( googletag.pubads() );

				if ( 'editorial' == WVNconfig.PageData.type ) {
					slot[i].setTargeting( 'campaign', WVNconfig.PageData.editorial );
				}

				if ( jQuery( this ).data( 'cids' ) ) slot[i].set( 'adsense_channel_ids', jQuery(this).attr( 'data-cids' ) );
				i++
			});

			// googletag.pubads().enableSingleRequest();
			// googletag.enableServices();

			jQuery( dfpslots ).each(function(){
				googletag.display( jQuery( this ).attr( 'id' ) );
			});
		});

	}
});
