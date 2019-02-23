"use strict";

(function($) {

	$(function() {
		/*
		 * Tabs
		 */
		$('.bsa-wrap .bsa-tabs .nav-tab-wrapper .nav-tab').on('click', function(event) {

			$('.bsa-wrap .bsa-tabs .nav-tab-wrapper .nav-tab').removeClass('nav-tab-active');

			$(this).addClass('nav-tab-active');

			// Container
			$('.bsa-wrap .bsa-tabs .tab-wrap').removeClass('tab-active');

			$($(this).attr('href')).addClass('tab-active');

			$(window).resize();

			return false;
		});

		/*
		 * jQuery Sortable UI
		 */
		$('.bsa-wrap .form-table .social-sortable').sortable( { placeholder: 'ui-state-highlight' } );
		$('.bsa-wrap .form-table .social-sortable').disableSelection();


		/*
		 * Check display fields
		 */
		var bsaCheckDisplayFields = function(){
			$('.bsa-wrap .bsa_multiple_accounts').each(function(index, el) {

				var item = $(el).attr('data-item');

				if( !$(el).prop('checked') ){
					$('.bsa-wrap .nav-tab.' + item).hide();

					$('.bsa-wrap .social-sortable .ui-state-default.' + item).hide();
				} else {
					$('.bsa-wrap .nav-tab.' + item).show();

					$('.bsa-wrap .social-sortable .ui-state-default.' + item).show();
				}
			});
		}

		/*
		 * Cick display social
		 */
		$('.bsa-wrap .bsa_multiple_accounts').on('click', function(event) {
			bsaCheckDisplayFields();
		});

		/*
		 * INIT
		 */
		bsaCheckDisplayFields();
	});

})(jQuery);