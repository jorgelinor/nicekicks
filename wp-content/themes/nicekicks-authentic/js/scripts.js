(function($){
	var counter = 0, adSlotsToLoad = [], adConfig = {
		dfpID: '1015938',
		enableSingleRequest: false,
		collapseEmptyDivs: true,
		setCentering: true,
		setTargeting: dfp_ad_targeting || {},
		url: window.location.toString().replace(/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/gi, ''),
		sizeMapping: {
	        'leaderboard-desktop': [
	            {browser: [990, 300],   ad_sizes: [[970, 250], [728, 90]]},
	            {browser: [740, 100],   ad_sizes: [728, 90]},
	            {browser: [0, 0],       ad_sizes: []}
	        ],
	        'leaderboard-mobile': [
	            {browser: [740, 100],   ad_sizes: []},
	            {browser: [0, 0],       ad_sizes: [[320, 50],  [320, 100]]}
	        ],
	        'mobile-unit': [
	            {browser: [740, 100],   ad_sizes: [300, 250]},
	            {browser: [0, 0],       ad_sizes: [[300, 250], [300, 600]]}
	        ]
	    }
	};

	var loadAds = function($container) {
		if (window.googletag && googletag.apiReady) {
        	window.googletag.pubads().updateCorrelator();
    	}

		let prevAds = $container.find('.adunit:visible:not(.display-block)');
		if(prevAds){
			prevAds.each(function(index, ad){
				ad.remove();
			})
		}

		let inContentads = $container.find('section.widget>.textwidget:not(.display-block)');
		
		inContentads.each(function(index, ad){
			let newId = 'nicekicks_300x250_320x50_InContent_' + counter;
			let element = document.createElement('div');
			element.setAttribute('id', newId);

			if(ad){
				if(counter<3){
					element.innerHTML = `<!-- Tag ID: nicekicks_300x250_320x50_InContent -->
					<div align="center" id="nicekicks_300x250_320x50_InContent">
					<script data-cfasync="false" type="text/javascript">
					    freestar.queue.push(function () { googletag.display('nicekicks_300x250_320x50_InContent'); });
					</script>
					</div>`;
				}else{
					adSlotsToLoad.push({
						placementName: "nicekicks_300x250_320x50_InContent",
						slotId: newId
					});
				}
				ad.append(element);
				ad.setAttribute('class', 'display-block');
			}
			++counter;
		});
	};

	loadAds($('body'));

	$(document).on('csco-ajax-loaded', function() {
		loadAds($('body'));	
		// Page done loading
		function callAds() {
			console.log(adSlotsToLoad)
			freestar.newAdSlots(adSlotsToLoad);
		}
		// Use callback on initial page load to ensure scripts are ready
		freestar.initCallback = function () {
			callAds();
			adSlotsToLoad = [];
		}

		freestar.initCallback();
	});
})(jQuery);
