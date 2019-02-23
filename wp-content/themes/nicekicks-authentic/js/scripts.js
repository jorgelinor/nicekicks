(function($){
	var adConfig = {
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

		$container.find('.adunit:visible:not(.display-block)').dfp(adConfig);
	};

	loadAds($('body'));

	$(document).on('csco-ajax-loaded', function() {
		loadAds($('body'));	
	});
})(jQuery);
