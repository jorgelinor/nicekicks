jQuery(function(){
(function ($){
	var searchInPlace = function(){
        if(jQuery.fn.on){
            $(document).on('mouseover mouseout', '.search-in-place>.item', function(){$(this).toggleClass('active');})
                       .on('mousedown', '.search-in-place>.item', function(){document.location = $(this).find('a').attr('href');})
                       .on('click', '.search-in-place>.labels.more', function(){document.location = $(this).find('a').attr('href');});
        }else{
            $('.search-in-place>.item').live('mouseover mouseout', function(){$(this).toggleClass('active');})
                                       .live('mousedown', function(){document.location = $(this).find('a').attr('href');})
                                       .live('click', '.search-in-place>.labels.more', function(){document.location = $(this).find('a').attr('href');});
        }
    };

	searchInPlace.prototype = {
		active : null,
		search : '',
		config:{
			min 		 : codepeople_search_in_place.char_number,
			image_width  : 268,
			image_height : 130,
			colors		 : ['#F4EFEC', '#B5DCE1', '#F4E0E9', '#D7E0B1', '#F4D9D0', '#D6CDC8', '#F4E3C9', '#CFDAF0'],
			areas		 : ['div.hentry', '#content', '#main', 'div.content', '#middle', '#container', '#wrapper']
		},
		
		autocomplete : function(){
			var me = this;
			$(("#mgm-live-search input[name='s']")).attr('autocomplete', 'off').bind('keyup focus', 
				function(){
					var s = $(this),
						v = s.val();
					if(me.checkString(v)){
						me.getResults(s);
					}else{
						if(me.search.indexOf(v) != 0){
							$('.search-in-place').hide();
						}
					}	
				}
			).blur(function(){
				setTimeout(function(){$('.search-in-place').hide();}, 150);
			});
		},
		
		checkString : function(v){
			return this.config.min <= v.length;
		},
		
		getResults : function(e){
			if(e.val() == this.search){
				$('.search-in-place').show();
				return;
			}	
				
			this.search = e.val();
			var me 	= this,
				f	= e.parents('form'), // Forms that contain the search box
				o 	= (f.length) ? f.offset() : null,
				p 	= {'s': me.search},
				s 	= $('<div class="search-in-place"></div>');
			
			// For wp_ajax
			p.action = "search_in_place";
			
			// Stop all search actions
			if(me.active) me.active.abort();
			
			// Remove results container inserted previously
			$('.search-in-place').remove();
			
			// Set the results container
			if(o){
				s.width(f.width()).css({'left' : o.left, 'top' : (parseInt(o.top) + f.height()+5)+'px'}).appendTo('body');
				me.displayLoading(s);
				
				me.active = jQuery.get( codepeople_search_in_place.root + '/wp-admin/admin-ajax.php', p, function(r){
					me.displayResult(r, s);
					me.removeLoading(r, s);
				}, "json");
			}
		},
		
		displayResult : function(o, e){
			var me = this,
				s = '';
			
			for(var t in o){
				s += '<div class="labels hidden">'+t+'</div>';
				var l = o[t];
				for(var i=0, h = l.length; i < h; i++){
					s += '<div class="item col-md-3">'; 
					
					
					if(l[i].thumbnail){ 
						s += '<figure class="search-thumb"><a href="'+l[i].link+'"><img src="'+l[i].thumbnail+'"/></a></figure><div class="data boxed">';
					}else{
						s += '<div class="data">';
					}
					
					s += '<span class="title"><a href="'+l[i].link+'">'+l[i].title+'</a></span>'
					if(l[i].resume) s += '<span class="resume">'+l[i].resume+'</span>';
					
					s += '<div class="reply-wrap clearfix">' //djwd
					if(l[i].date) s += '<span class="date pull-left"><span class="glyphicon glyphicon-edit"></span>'+l[i].date+'</span>';
					if(l[i].author) s += '<span class="author pull-right"><span class="glyphicon glyphicon-user"></span>'+l[i].author+'</span>';
					s += '</div>' //djwd
					
					s += '</div></div>';
					
				}
			}
			
			e.prepend(s).find('.search-thumb img').load(function(){
				var size = me.imgSize(this);
				$(this).width(size.w).height(size.h).css('visibility', 'visible');
			});
		},
		
		imgSize : function(e){
			e = $(e);
			
			var w = e.width(),
				h = e.height(),
				nw, nh;
			
			if(w > this.config.image_width){
				nw = this.config.image_width;
				nh = nw/w*h;
				w = nw; h = nh;
			}
			
			if(h > this.config.image_height){
				nh = this.config.image_height;
				nw = nh/h*w;
				w = nw; h = nh;
			}
			
			return {'w':w, 'h':h};
		},
		
		displayLoading : function(e){
			e.append('<div class="labels"><div class="mgm-spinner-pos"><div class="mgm-spinner mgm-spinner-xs"></div></div></div>'); /* djwd - changing .loading class*/
		},
		
		removeLoading : function(c, e){
			var s = (typeof c.length != 'undefined') ? codepeople_search_in_place.empty : '<a href="'+codepeople_search_in_place.home+'?s='+this.search+'&submit=Search">'+codepeople_search_in_place.more+'</a>';
			e.find('.mgm-spinner-pos').parent().addClass('more').html(s); /* djwd - changing .loading parent*/
			
		},
		
		
		
		highlightTerms : function(terms){
			var me = this;
			$.each(terms, function(i, term){
				if(term.length >= codepeople_search_in_place.char_number){
					var color = me.config.colors[i%me.config.colors.length],
						regex = new RegExp('(<[^>]*>)|('+ term.replace(/([-.*+?^${}()|[\]\/\\])/g,"\\$1") +')', 'ig');
					$.each(me.config.areas, function(j, area){
						var area = $(area);
						if(area.length)
							area.html(area.html().replace(regex, function(a, b, c){
								return (a.charAt(0) == '<') ? a : '<mark style="background-color:'+ color +'">' + c + '</mark>';
							}));
					});
				}	
			});
			
		}
		
	};

	jQuery(function(){
		var	searchObj = new searchInPlace();
		
		if((codepeople_search_in_place.highlight*1) && codepeople_search_in_place.terms && codepeople_search_in_place.terms.length > 0){
			searchObj.highlightTerms(codepeople_search_in_place.terms);
		}
		
		if((codepeople_search_in_place.identify_post_type)*1){
			$('.type-post').prepend('<div class="search-in-place-type-post">'+codepeople_search_in_place.post_title+'</div>');
			$('.type-page').prepend('<div class="search-in-place-type-page">'+codepeople_search_in_place.page_title+'</div>');
		}
		
		searchObj.autocomplete();
	});	
})(jQuery);
});