"use strict";

(function($) {

	$(function() {

		/*
		 * jQuery Sortable UI
		 */
		$('.bsb-wrap .social-sortable').sortable( { placeholder: 'ui-state-highlight' } );
		$('.bsb-wrap .social-sortable').disableSelection();

		/*
		 * Check display fields
		 */
		var bsbCheckDisplayFields = function(){
			$('.bsb-wrap .bsb_display_share_buttons').each(function(index, el) {

				if( $(el).prop('checked') ){
					$(el).parents('.form-table').find('tr').show();
				} else {
					$(el).parents('.form-table').find('tr').not($(el).parents('tr')).hide();
				}
			});

			$('.bsb-wrap .bsb_multiple_buttons').each(function(index, el) {

				var item = $(el).attr('data-item');

				if( !$(el).prop('checked') ){
					$('.bsb-wrap .social-sortable .ui-state-default.' + item).hide();
				} else {
					$('.bsb-wrap .social-sortable .ui-state-default.' + item).show();
				}
			});
		}

		/*
		 * Cick display buttons
		 */
		$('.bsb-wrap .bsb_display_share_buttons').on('click', function(event) {
			bsbCheckDisplayFields();
		});

		/*
		 * Cick display social
		 */
		$('.bsb-wrap .bsb_multiple_buttons').on('click', function(event) {
			bsbCheckDisplayFields();
		});

		/*
		 * INIT
		 */
		bsbCheckDisplayFields();
	});

})(jQuery);