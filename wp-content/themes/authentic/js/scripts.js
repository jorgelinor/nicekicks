( function( $ ) {
	"use strict";

	/**
	 * Global Vars
	 */

	var windowWidth = window.innerWidth,
		windowHeight = window.innerHeight,
		adminBarHeight = $( '#wpadminbar' ).innerHeight(),
		headerHeight = $( '.site-header' ).innerHeight(),
		navBarHeight = $( '.navbar-primary' ).outerHeight();

	$( document ).ready( function() {
		adminBarHeight = $( '#wpadminbar' ).innerHeight();
		headerHeight = $( '.site-header' ).innerHeight();
		navBarHeight = $( '.navbar-primary' ).outerHeight();
	} );

	$( window ).resize( function() {
		windowWidth = window.innerWidth;
		windowHeight = window.innerHeight;
		adminBarHeight = $( '#wpadminbar' ).innerHeight();
		headerHeight = $( '.site-header' ).innerHeight();
		navBarHeight = $( '.navbar-primary' ).outerHeight();
	} );

	var isIE = /MSIE|Trident/i.test( navigator.userAgent );

	var rtl = false;

	if ( $( 'body' ).hasClass( 'rtl' ) ) {
		rtl = true;
	}

	/**
	 * Responsive Navigation Menu
	 */

	$.fn.responsiveNav = function() {
		this.removeClass( 'menu-item-expanded' );
		if ( this.prev().hasClass( 'submenu-visible' ) ) {
			this.prev().removeClass( 'submenu-visible' );
			this.parent().removeClass( 'menu-item-expanded' );
			this.prev().slideUp( 350 );
		} else {
			this.parent().parent().find( 'menu-item .sub-menu' ).removeClass( 'submenu-visible' );
			this.parent().parent().find( '.menu-item-expanded' ).removeClass( 'menu-item-expanded' );
			this.parent().parent().find( 'menu-item .sub-menu' ).slideUp( 350 );
			this.prev().toggleClass( 'submenu-visible' );
			this.prev().hide();
			this.prev().slideToggle( 350 );
			this.parent().toggleClass( 'menu-item-expanded' );
		}
	};

	// Make widget nav responsive.

	$( document ).ready( function( e ) {

		$( '.widget_nav_menu .menu-item-has-children' ).each( function( e ) {

			// Add a caret.
			$( this ).append( '<span></span>' );

			// Fire responsiveNav() when clicking a caret.
			$( '> span', this ).click( function( e ) {
				e.preventDefault();
				$( this ).responsiveNav();
			} );

			// Fire responsiveNav() when clicking a parent item with # href attribute.
			if ( '#' === $( '> a', this ).attr( 'href' ) ) {
				$( '> a', this ).click( function( e ) {
					e.preventDefault();
					$( this ).next().next().responsiveNav();
				} );
			}

		} );

	} );

	/**
	 * Offcanvas Navigation
	 */

	( function( $ ) {
		var offcanvas = $( '.offcanvas' ),
			body = $( 'body' ),
			container = $( '.site-inner' ),
			push = $( '.offcanvas-push' ),
			offcanvasOpen = 'offcanvas-open',
			siteOverlay = $( '.site-overlay' ),
			menuBtn = $( '.offcanvas-toggle' ),
			menuSpeed = 400,
			menuWidth = offcanvas.width() + 'px';

		function toggleOffcanvas() {
			body.toggleClass( offcanvasOpen );
			// recalc sticky sidebar by simulating window resize
			//  with a delay equal to the animation speed
			setTimeout( function() { $( window ).trigger( 'resize' ); }, 399 );
		}

		function openOffcanvasFallback() {
			body.addClass( offcanvasOpen );
			offcanvas.animate( { right: '0px' }, menuSpeed );
			container.animate( { right: menuWidth }, menuSpeed );
			push.animate( { right: menuWidth }, menuSpeed );
		}

		function closeOffcanvasFallback() {
			body.removeClass( offcanvasOpen );
			offcanvas.animate( { right: "-" + menuWidth }, menuSpeed );
			container.animate( { right: "0px" }, menuSpeed );
			push.animate( { right: "0px" }, menuSpeed );
		}

		//checks if 3d transforms are supported removing the modernizr dependency
		var cssTransforms3d = ( function csstransforms3d() {
			var el = document.createElement( 'p' ),
				supported = false,
				transforms = {
					'webkitTransform': '-webkit-transform',
					'OTransform': '-o-transform',
					'msTransform': '-ms-transform',
					'MozTransform': '-moz-transform',
					'transform': 'transform'
				};

			// Add it to the body to get the computed style
			document.body.insertBefore( el, null );

			for ( var t in transforms ) {
				if ( el.style[ t ] !== undefined ) {
					el.style[ t ] = 'translate3d(1px,1px,1px)';
					supported = window.getComputedStyle( el ).getPropertyValue( transforms[ t ] );
				}
			}

			document.body.removeChild( el );

			return ( supported !== undefined && supported.length > 0 && supported !== "none" );
		} )();

		if ( cssTransforms3d ) {

			//make menu visible
			offcanvas.css( { 'visibility': 'visible' } );

			//toggle menu
			menuBtn.on( 'click', function() {
				toggleOffcanvas();
			} );

			//close menu when clicking site overlay
			siteOverlay.on( 'click', function() {
				toggleOffcanvas();
			} );

		} else {
			//add css class to body
			body.addClass( 'no-csstransforms3d' );

			//hide menu by default
			if ( offcanvas.hasClass( offcanvasLeft ) ) {
				offcanvas.css( { left: "-" + menuWidth } );
			} else {
				offcanvas.css( { right: "-" + menuWidth } );
			}

			//make menu visible
			offcanvas.css( { 'visibility': 'visible' } );
			//fixes IE scrollbar issue
			container.css( { "overflow-x": "hidden" } );

			//keep track of menu state (open/close)
			var opened = false;

			//toggle menu
			menuBtn.on( 'click', function() {
				if ( opened ) {
					closeOffcanvasFallback();
					opened = false;
				} else {
					openOffcanvasFallback();
					opened = true;
				}
			} );

			//close menu when clicking site overlay
			siteOverlay.on( 'click', function() {
				if ( opened ) {
					closeOffcanvasFallback();
					opened = false;
				} else {
					openOffcanvasFallback();
					opened = true;
				}
			} );
		}
	}( jQuery ) );

	/**
	 * Parallax
	 */

	function initParallax() {
		if ( !isIE ) {
			$( '.parallax-enabled .parallax:not(.parallax-video)' ).jarallax( {
				speed: 0.8
			} );
			$( '.parallax-video' ).each( function() {
				$( this ).jarallax( {
					loop: true,
					speed: 0.8,
					videoSrc: $( this ).attr( 'data-video' ),
					videoStartTime: $( this ).data( 'start' ),
					videoEndTime: $( this ).data( 'end' ),
				} );
			} );
		}
	}

	$( document ).ready( function() {
		initParallax();
	} );

	$( document ).on( 'csco-ajax-loaded', function() {
		initParallax();
	} );

	/**
	 * Large Page Header
	 */

	var pageHeader = $( '.page-header-large .page-header' );

	// Function for calculating Page Header height.

	function setPageHeaderHeight() {

		// Define heights.
		var contentHeight = $( '> div', pageHeader ).innerHeight(),
			offsetHeight = adminBarHeight + headerHeight,
			availableHeight = windowHeight - offsetHeight;

		// Offset page header.
		pageHeader.css( 'margin-top', -offsetHeight + 'px' );
		pageHeader.css( 'padding-top', offsetHeight + 'px' );

		// Set the page header height.
		if ( availableHeight >= contentHeight ) {
			pageHeader.css( 'height', windowHeight + 'px' );
		} else {
			pageHeader.css( 'height', 'auto' );
		}

		// Add extra padding, if possible.
		if ( availableHeight - offsetHeight >= contentHeight ) {
			pageHeader.css( 'padding-bottom', offsetHeight + 'px' );
		} else {
			pageHeader.css( 'padding-bottom', 0 );
		}
	}

	// Set initial height.

	$( document ).ready( function() {
		setPageHeaderHeight();
	} );

	// Recalculate height on resize.

	$( window ).resize( function() {
		setPageHeaderHeight();
	} );

	/**
	 * Masonry
	 */

	var masonryContainer = $( '.archive-masonry' ),
		masonryOptions = {
			columns: '.archive-col',
			items: '.post-masonry, .post-featured, .widget'
		};

	$( masonryContainer ).colcade( masonryOptions );

	$( masonryContainer ).imagesLoaded( function() {
		$( masonryContainer ).colcade( masonryOptions );
	} );

	/**
	 * Fullscreen Search
	 */

	$( 'a[href="#search"]' ).on( 'click', function( event ) {
		event.preventDefault();
		$( '#search' ).addClass( 'open' );
		$( '#search input[type="search"]' ).focus();
		$( 'body' ).addClass( 'search-open' );
	} );

	$( '#search, #search button.close' ).on( 'click keyup', function( event ) {
		if ( event.target === this || event.target.className === 'close' || event.keyCode === 27 ) {
			event.preventDefault();
			$( this ).removeClass( 'open' );
			$( 'body' ).removeClass( 'search-open' );
		}
	} );

	/**
	 * Scroll To Top
	 */

	// Click event.

	$( 'a[href="#top"]' ).click( function() {
		$( 'html, body' ).animate( { scrollTop: 0 }, 'slow' );
		return false;
	} );

	// Show the button after scrolling past 800 pixels.

	$( document ).scroll( function() {
		var y = $( this ).scrollTop();
		if ( y > 800 ) {
			$( '.scroll-to-top' ).css( { 'opacity': 1 } );
		} else {
			$( '.scroll-to-top' ).css( { 'opacity': 0 } );
		}
	} );

	/**
	 * Pin It
	 */

	$.fn.pinIt = function() {
		this.each( function() {
			if ( $( this ).width() > 120 && $( this ).height() > 120 ) {
				$( this ).hover( function() {
					var postURL = $( location ).attr( 'href' );
					postURL = encodeURIComponent( postURL );
					var pinURL = $( this ).find( 'img' ).attr( 'src' );
					if ( $( '> a', this ).length > 0 ) {
						var imagehref = $( '> a', this ).attr( 'href' );
						if ( imagehref.match( /\.(gif|jpeg|jpg|png)/ ) ) {
							pinURL = imagehref;
						}
					}
					pinURL = encodeURIComponent( pinURL );
					$( '<a class="pin-it btn btn-primary btn-lg btn-effect" href="http://www.pinterest.com/pin/create/bookmarklet/?url=' + postURL + '&amp;media=' + pinURL + '&is_video=false" target="_blank"><span>Pin</span><span><i class="icon icon-pinterest"></i></span></a>' ).appendTo( this ).addClass( 'pin-it-visible' );
				}, function() {
					$( this ).children( '.pin-it' ).remove();
				} );
			}
		} );
	};

	$( document ).ready( function() {

		$( '.content, .post-media' ).imagesLoaded( function() {

			// All figures in the post content, except for the justified and slider galleries
			$( '.pin-it-enabled .content figure' ).not( '.gallery-justified figure, .gallery-slider figure' ).pinIt();

			// All figures in slider galleries: both in post content and post media sections
			$( '.pin-it-enabled .gallery-slider figure' ).pinIt();

			// Figure in image post format in post media section in single posts
			$( '.pin-it-enabled.single-format-image .post-media figure' ).pinIt();

		} );

	} );

	/**
	 * Image Lightboxes
	 */

	// All figures in post content, except for any galleries.

	$( '.lightbox-enabled .content figure' ).not( '.gallery figure' ).each( function() {
		var href = $( '> a', this ).attr( 'href' );
		if ( href && href.match( /\.(gif|jpeg|jpg|png)/ ) ) {
			$( '> a', this ).addClass( 'image-popup' );
			$( this ).magnificPopup( {
				delegate: '.image-popup',
				type: 'image',
				image: {
					titleSrc: function( item ) {
						return item.el.children().attr( 'alt' );
					}
				}
			} );
		}
	} );

	// All figures in grid and slider galleries.

	$( '.lightbox-enabled .gallery-grid, .lightbox-enabled .gallery-slider' ).each( function() {
		var href = $( 'figure > a', this ).attr( 'href' );
		if ( href && href.match( /\.(gif|jpeg|jpg|png)/ ) ) {
			$( 'figure > a', this ).addClass( 'image-popup' );
			$( this ).magnificPopup( {
				delegate: '.image-popup',
				type: 'image',
				image: {
					titleSrc: function( item ) {
						return item.el.children().attr( 'alt' );
					}
				},
				gallery: {
					enabled: true
				}
			} );
		}
	} );

	// Figure in image post format in post media section in single posts.

	$( '.lightbox-enabled.single-format-image .post-media figure > a' ).addClass( 'image-popup' ).magnificPopup( {
		type: 'image',
		image: {
			titleSrc: function( item ) {
				return item.el.children().attr( 'alt' );
			}
		},
		gallery: {
			enabled: false
		}
	} );

	/**
	 * Sticky Sidebar
	 */

	var lastWidget = $( '.sticky-sidebar-enabled .sidebar-area > .sidebar > .widget:last-child' );

	// Wrap the last widget in div.
	lastWidget.wrap( '<div class="widget-sticky"><div class="sticky"></div></div>' );

	// Add additional margin if there's admin bar.
	$( document ).ready( function() {
		lastWidget.css( 'top', 32 + adminBarHeight + 'px' );
	} );

	/**
	 * Sliders
	 */

	// Slider Parallax

	var owlSlide = $( '.parallax-enabled .owl-featured .slide-parallax:not(.slide-video)' );
	var owlVideo = $( '.slide-video' );

	// Init Hook

	function owlInit( event ) {

		// Init Parallax.
		if ( !isIE ) {

			var $container = $( event.target );

			owlSlide = $( '.parallax-enabled .owl-featured .slide-parallax:not(.slide-video)' );
			owlSlide.each( function() {
				$( this ).jarallax( {
					speed: 0.8,
					elementInViewport: $container,
				} );
			} );

			owlVideo = $( '.slide-video' );
			owlVideo.each( function() {
				$( this ).jarallax( {
					speed: 0.8,
					elementInViewport: $container,
					videoSrc: $( this ).data( 'video' ),
					videoStartTime: $( this ).data( 'start' ),
					videoEndTime: $( this ).data( 'end' ),
				} );
			} );

		}

		// Recalc Waypoints.
		Waypoint.refreshAll();

	}

	// Resize Hook

	function owlRezise() {
		// Reinit Parallax.
		owlSlide = $( '.parallax-enabled .owl-featured .slide-parallax' );
		if ( owlSlide.attr( 'data-jarallax-original-styles' ) ) {
			owlSlide.jarallax( 'clipContainer' ).jarallax( 'coverImage' ).jarallax( 'onScroll' );
		}
	}

	// Center

	var owlCenter = $( '.owl-center' );

	owlCenter.each( function() {

		function setArrowWidth( event ) {
			var carousel = $( event.target );
			$( '.owl-arrows > div', carousel.parent() ).css( 'width', ( carousel.innerWidth() - $( '.owl-item.center', carousel ).innerWidth() - 80 ) / 2 + 'px' );
		}

		function owlCenterInitialized( event ) {
			setArrowWidth( event );
			owlInit( event );
		}

		function owlCenterResized( event ) {
			setArrowWidth( event );
			owlRezise();
		}

		var container = $( this );
		var owl = $( '.owl-carousel', container );

		owl.owlCarousel( {
			autoplay: $( this ).data( 'autoplay' ),
			autoplayTimeout: $( this ).data( 'timeout' ),
			autoplayHoverPause: true,
			dragEndSpeed: 500,
			smartSpeed: 500,
			dotsContainer: $( '> .owl-dots', container ),
			navContainer: $( '> .owl-arrows', container ),
			navText: [ '', '' ],
			autoHeight: true,
			rtl: rtl,
			responsive: {
				0: {
					items: 1,
					loop: false,
					margin: 0,
					dots: true,
					nav: false,
				},
				1200: {
					center: true,
					items: 3,
					loop: true,
					margin: $( this ).data( 'padding' ),
					autoWidth: true,
					dots: false,
					nav: true,
				}
			},
			onInitialized: owlCenterInitialized,
			onResized: owlCenterResized,
		} );

	} );

	// Boxed

	var owlBoxed = $( '.owl-boxed' );

	owlBoxed.each( function() {

		var container = this;
		var owl = $( '.owl-carousel', this );

		owl.owlCarousel( {
			autoplay: $( this ).data( 'autoplay' ),
			autoplayTimeout: $( this ).data( 'timeout' ),
			autoplayHoverPause: true,
			dragEndSpeed: 500,
			smartSpeed: 500,
			items: 1,
			margin: 0,
			autoHeight: true,
			navText: [
				'<div class="btn btn-primary btn-effect"><span><i class="icon icon-chevron-up"></i></span><span>' + translation.previous + '</span></div>',
				'<div class="btn btn-primary btn-effect"><span><i class="icon icon-chevron-up"></i></span><span>' + translation.next + '</span></div>'
			],
			dots: true,
			dotsContainer: $( '> .owl-dots', container ),
			rtl: rtl,
			responsive: {
				0: {
					nav: false,
				},
				768: {
					nav: true,
					loop: true
				}
			},
			onInitialized: owlInit,
			onResized: owlRezise,
		} );

	} );

	// Large

	var owlLarge = $( '.owl-large' );

	function owlLargePosition() {

		// Define heights.
		var owlSlide = $( '.post-outer', owlLarge ),
			contentHeight = $( '.post-inner', owlSlide ).innerHeight(),
			offsetHeight = adminBarHeight + headerHeight,
			availableHeight = windowHeight - offsetHeight;

		// Offset page header.
		owlLarge.css( 'margin-top', -offsetHeight + 'px' );
		owlSlide.css( 'padding-top', offsetHeight + 'px' );

		// Set the page header height.
		if ( availableHeight >= contentHeight ) {
			owlSlide.css( 'height', windowHeight + 'px' );
		} else {
			owlSlide.css( 'height', 'auto' );
		}

		// Add extra padding, if possible.
		if ( availableHeight - offsetHeight >= contentHeight ) {
			owlSlide.css( 'padding-bottom', offsetHeight + 'px' );
		} else {
			owlSlide.css( 'padding-bottom', 0 );
		}

	}

	function owlLargeInitialized( event ) {
		owlLargePosition();
		owlInit( event );
	}

	function owlLargeResized() {
		owlLargePosition();
		owlRezise();
	}

	owlLarge.each( function() {

		var container = this;
		var owl = $( '.owl-carousel', this );

		owl.owlCarousel( {
			autoplay: $( this ).data( 'autoplay' ),
			autoplayTimeout: $( this ).data( 'timeout' ),
			autoplayHoverPause: true,
			dragEndSpeed: 500,
			smartSpeed: 500,
			items: 1,
			margin: 0,
			navText: [
				'<div class="btn btn-primary btn-effect"><span><i class="icon icon-chevron-up"></i></span><span>' + translation.previous + '</span></div>',
				'<div class="btn btn-primary btn-effect"><span><i class="icon icon-chevron-up"></i></span><span>' + translation.next + '</span></div>'
			],
			dots: true,
			dotsContainer: $( '> .owl-dots', container ),
			rtl: rtl,
			responsive: {
				0: {
					nav: false,
				},
				768: {
					nav: true,
					loop: true,
				}
			},
			onInitialized: owlLargeInitialized,
			onResized: owlLargeResized,
		} );

	} );

	// Recalc slider on vertical window resize.
	$( window ).resize( function() {
		if ( $( window ).width() === windowWidth ) {
			return;
		}
		windowWidth = $( window ).width();
		owlLargeResized();
	} );

	// Multiple

	var owlMultiple = $( '.owl-multiple' );

	owlMultiple.each( function() {

		var container = this;
		var owl = $( '.owl-carousel', this );

		owl.owlCarousel( {
			autoplay: $( this ).data( 'autoplay' ),
			autoplayTimeout: $( this ).data( 'timeout' ),
			autoplayHoverPause: true,
			dragEndSpeed: 500,
			smartSpeed: 500,
			navContainer: $( '> .owl-arrows', container ),
			navText: [ '', '' ],
			dots: true,
			dotsContainer: $( '> .owl-dots', container ),
			autoHeight: true,
			rtl: rtl,
			responsive: {
				0: {
					nav: false,
					loop: false,
					margin: 0,
					stagePadding: 0,
					items: 1,
				},
				992: {
					nav: false,
					loop: true,
					margin: 3,
					stagePadding: 0,
					items: 2,
				},
				1200: {
					nav: true,
					loop: true,
					margin: $( this ).data( 'padding' ),
					stagePadding: 100,
					items: $( this ).data( 'slides-visible' ),
				}
			},
			onInitialized: owlInit,
			onResized: owlRezise,
		} );

	} );

	// Simple

	var owlSimple = $( '.owl-simple' );

	owlSimple.each( function() {

		var container = this,
			owl = $( '.owl-carousel', this );

		$( container ).prepend( '<div class="images-loading"></div>' );

		$( owl ).imagesLoaded( function() {

			owl.parent().find( '.images-loading' ).remove();

			owl.owlCarousel( {
				dragEndSpeed: 250,
				smartSpeed: 250,
				autoHeight: true,
				items: 1,
				margin: 0,
				navText: [
					'<div class="btn btn-primary btn-effect"><span><i class="icon icon-chevron-up"></i></span><span>' + translation.previous + '</span></div>',
					'<div class="btn btn-primary btn-effect"><span><i class="icon icon-chevron-up"></i></span><span>' + translation.next + '</span></div>'
				],
				dots: true,
				dotsContainer: $( '> .owl-dots', container ),
				rtl: rtl,
				responsive: {
					0: {
						nav: false,
					},
					768: {
						nav: true,
					}
				},
				onInitialized: Waypoint.refreshAll(),
			} );

		} );

	} );

	// Flip

	function initOwlFlip() {

		var owlFlip = $( '.owl-flip' );

		owlFlip.each( function() {

			var container = this,
				owl = $( '.owl-carousel', this ),
				archive = $( this ).closest( '.archive-main' ),
				effectOut = 'flipOut',
				effectIn = 'flipIn';

			// Do not animate widgets inside archives.
			if ( archive.hasClass( 'archive-standard' ) || archive.hasClass( 'archive-list' ) ) {
				effectOut = 'fadeOut';
				effectIn = 'fadeIn';
			}

			if ( isIE ) {
				effectOut = 'fadeOut';
				effectIn = 'fadeIn';
			}

			$( owl ).imagesLoaded( function() {

				owl.owlCarousel( {
					dragEndSpeed: 250,
					smartSpeed: 250,
					autoHeight: true,
					animateOut: effectOut,
					animateIn: effectIn,
					items: 1,
					margin: 0,
					dots: true,
					dotsContainer: $( '> .owl-dots', container ),
					rtl: rtl,
					onInitialized: Waypoint.refreshAll(),
				} );

			} );

		} );

	}

	$( document ).ready( function() {
		initOwlFlip();
	} );

	$( document ).on( 'csco-ajax-loaded', function() {
		initOwlFlip();
	} );

	// Loop

	var owlLoop = $( '.owl-loop' );

	owlLoop.each( function() {

		var container = this;
		var owl = $( '.owl-carousel', this );

		$( container ).prepend( '<div class="images-loading"></div>' );

		$( owl ).imagesLoaded( function() {

			owl.parent().find( '.images-loading' ).remove();

			owl.owlCarousel( {
				dragEndSpeed: 250,
				smartSpeed: 250,
				autoHeight: true,
				dots: true,
				dotsContainer: $( '> .owl-dots', container ),
				rtl: rtl,
				responsive: {
					0: {
						items: 1,
						margin: 0,
					},
					544: {
						items: 2,
						margin: 20,
					},
					992: {
						items: 3,
						margin: $( container ).data( 'padding' ),
					},
					1200: {
						items: $( container ).data( 'columns' ),
						margin: $( container ).data( 'padding' ),
					}
				},
			} );

		} );

	} );

	/**
	 * Justified Gallery
	 */

	$( '.gallery-justified' ).justifiedGallery( {
		border: 0,
		margins: 10,
		lastRow: 'justify',
		rowHeight: 300,
		selector: 'figure, div:not(.spinner)',
		captions: true,
		maxRowHeight: '200%',
		cssAnimation: true,
		captionSettings: {
			animationDuration: 100,
			visibleOpacity: 1.0,
			nonVisibleOpacity: 0.0
		}
	} ).on( 'jg.complete', function( e ) {
		$( '.pin-it-enabled' ).find( $( 'figure', this ) ).pinIt();
		var href = $( 'figure > a', this ).attr( 'href' );
		if ( href && href.match( /\.(gif|jpeg|jpg|png)/ ) ) {
			$( 'figure > a', this ).addClass( 'image-popup' );
			$( this ).magnificPopup( {
				delegate: '.image-popup',
				type: 'image',
				image: {
					titleSrc: function( item ) {
						return item.el.children().attr( 'alt' );
					}
				},
				gallery: {
					enabled: true
				}
			} );
		}
	} );

	/**
	 * Waypoints
	 */

	/**
	 * Post Archive Lazy Load
	 */

	function initWaypointsPosts() {
		var waypointsPosts = $( '.lazy-load-enabled .post-archive article, .lazy-load-enabled .post-archive .widget' ).waypoint( function( direction ) {
			$( this.element ).addClass( 'lazy-loaded' );
		}, {
			offset: '95%'
		} );
	}

	$( document ).ready( function() {
		initWaypointsPosts();
	} );

	$( document ).on( 'csco-ajax-loaded', function() {
		initWaypointsPosts();
	} );

	/**
	 * Prev / Next Post Pagination
	 */

	// Display pagination on scrolling past article content.
	var waypointsPageContent = $( '.single-post .site-main > article' ).waypoint( function( direction ) {
		if ( direction === 'down' ) {
			$( '.post-pagination' ).addClass( 'pagination-visible' );
		} else {
			$( '.post-pagination' ).removeClass( 'pagination-visible' );
		}
	} );

	// Hide pagination on scrolling near footer.
	var waypointsSiteFooter = $( '.single-post .site-footer' ).waypoint( function( direction ) {
		if ( direction === 'down' ) {
			$( '.post-pagination' ).removeClass( 'pagination-visible' );
		} else {
			$( '.post-pagination' ).addClass( 'pagination-visible' );
		}
	}, {
		offset: 300
	} );

	/**
	 * Sticky Navigation
	 */

	var previousScroll = 0,
		headerNavbar = $( '.navbar-scroll-enabled .navbar-primary' ),
		navbarOffset = $( '.site-header' ).offset().top + $( '.site-header' ).height() - headerNavbar.height();

	// Init sticky navigation.
	$( document ).ready( function() {
		if ( headerNavbar.length ) {

			// Event on scrolling down past the header.
			var waypointsHeaderDown = $( '.site-header' ).waypoint( function( direction ) {
				if ( direction === 'down' ) {
					headerNavbar.wrap( '<div class="sticky-wrapper"></div>' );
					$( '.sticky-wrapper' ).height( headerNavbar.height() );
					headerNavbar.addClass( 'navbar-stuck' );
				}
			}, {
				offset: -headerHeight
			} );

			// Event on scrolling up past the header.
			var waypointsHeaderUp = $( '.site-header' ).waypoint( function( direction ) {
				if ( direction === 'up' ) {
					$( '.navbar-scroll-enabled .sticky-wrapper > .navbar-primary' ).unwrap();
					headerNavbar.removeClass( 'navbar-stuck' );
					headerNavbar.css( 'transition', 'none' );
					headerNavbar.removeClass( 'navbar-visible' );
				}
			}, {
				offset: -$( '.site-header' ).height() + headerNavbar.height() - 0.0001
			} );

		}
	} );

	// Recalc header offset on window resize.
	$( window ).resize( function() {
		navbarOffset = $( '.site-header' ).offset().top + $( '.site-header' ).height() - headerNavbar.height();
	} );

	// Hide / show navigation on scroll up and down.
	$( window ).scroll( function() {
		// Check if we scrolled past header area.
		if ( $( this ).scrollTop() > navbarOffset ) {
			if ( $( this ).scrollTop() > previousScroll ) {
				// Hide navbar on scroll down
				headerNavbar.removeClass( 'navbar-visible' );
				// Move the sticky sidebar content back up.
				$( '.sticky-sidebar-enabled .sticky' ).css( 'top', 32 + adminBarHeight + 'px' );
			} else {
				// Show navbar on scroll up
				headerNavbar.addClass( 'navbar-visible' );
				headerNavbar.css( 'transition', '.2s ease all' );
				// Move the sticky sidebar content down by the height of the navbar.
				$( '.sticky-sidebar-enabled .sticky' ).css( 'top', 32 + navBarHeight + adminBarHeight + 'px' );
			}
		}
		previousScroll = $( this ).scrollTop();
	} );

	/**
	 * AJAX Load More.
	 *
	 * Contains functions for AJAX Load More.
	 */


	/**
	 * Check if Load More is defined by the wp_localize_script
	 */
	if ( typeof csco_ajax_pagination !== 'undefined' ) {

		$( '.post-archive .archive-pagination' ).append( '<span class="load-more btn btn-lg btn-primary">' + csco_ajax_pagination.translation.load_more + '</span>' );

		var query_args = $.parseJSON( csco_ajax_pagination.query_args ),
			infinite = $.parseJSON( query_args.infinite_load ),
			button = $( '.post-archive .load-more' ),
			page = 2,
			loading = false,
			scrollHandling = {
				allow: infinite,
				reallow: function() {
					scrollHandling.allow = true;
				},
				delay: 400 //(milliseconds) adjust to the highest acceptable value
			};

	}

	/**
	 * Get next posts
	 */
	function csco_ajax_get_posts() {
		loading = true;
		// Set button text to Load More.
		button.text( csco_ajax_pagination.translation.loading );
		var data = {
			action: 'csco_ajax_load_more',
			nonce: csco_ajax_pagination.nonce,
			page: page,
			query_vars: csco_ajax_pagination.query_vars,
			query_args: csco_ajax_pagination.query_args,
		};
		$.post( csco_ajax_pagination.url, data, function( res ) {
			if ( res.success ) {

				// Get the posts.
				var data = $( res.data );

				// Check if there're any posts.
				if ( data.length ) {

					data.imagesLoaded( function() {

						// Append new posts to list, standard and grid archives.
						$( '.archive-main.archive-list, .archive-main.archive-standard, .archive-main.archive-grid' ).append( data );

						// Append new posts to masonry layout.
						$( '.archive-main.archive-masonry' ).colcade( 'append', data );

						// Trigger hooked actions.
						$( document ).trigger( 'csco-ajax-loaded' );

						// Reinit Facebook widgets.
						if ( $( '#fb-root' ).length ) {
							FB.XFBML.parse();
						}

						// Trigger window resize to refresh the sticky sidebar.
						$( window ).trigger( 'resize' );

					} );

					// Set button text to Load More.
					button.text( csco_ajax_pagination.translation.load_more );

					// Increment a page.
					page = page + 1;

					// Set the loading state.
					loading = false;

				} else {

					// Remove Load More button.
					button.remove();

				}
			} else {
				// console.log(res);
			}
		} ).fail( function( xhr, textStatus, e ) {
			// console.log(xhr.responseText);
		} );
	}

	/**
	 * Check if Load More is defined by the wp_localize_script
	 */
	if ( typeof csco_ajax_pagination !== 'undefined' ) {

		// On Scroll Event.
		$( window ).scroll( function() {
			if ( button.length && !loading && scrollHandling.allow ) {
				scrollHandling.allow = false;
				setTimeout( scrollHandling.reallow, scrollHandling.delay );
				var offset = $( button ).offset().top - $( window ).scrollTop();
				if ( 4000 > offset ) {
					csco_ajax_get_posts();
				}
			}
		} );

		// On Click Event.
		$( 'body' ).on( 'click', '.load-more', function() {
			if ( !loading ) {
				csco_ajax_get_posts();
			}
		} );

	}

	/**
	 * Google AdSense
	 */

	$( '.adsbygoogle' ).each( function() {
		(
			adsbygoogle = window.adsbygoogle || [] ).push( {} );
	} );

	/**
	 * Quanity Incrementor
	 */

	function quantity_increment() {
		var controls = $( '.quantity-controls' );
		controls.each( function() {
			$( this ).on( 'click', '.plus', function( e ) {
				var input = $( this ).parent().parent().find( 'input.qty' );
				var val = parseInt( input.val() );
				var step = input.attr( 'step' );
				step = 'undefined' !== typeof( step ) ? parseInt( step ) : 1;
				input.val( val + step ).change();
			} );
			$( this ).on( 'click', '.minus',
				function( e ) {
					var input = $( this ).parent().parent().find( 'input.qty' );
					var val = parseInt( input.val() );
					var step = input.attr( 'step' );
					step = 'undefined' !== typeof( step ) ? parseInt( step ) : 1;
					if ( val > 0 ) {
						input.val( val - step ).change();
					}
				} );
		} );
	}

	jQuery( document ).ready( function( $ ) {
		quantity_increment();
	} );

	$( document.body ).on( 'updated_wc_div', function() {
		quantity_increment();
	} );

	/**
	 * Product Thumbnail Slider
	 */

	var owlProductGallery = $( '.product-gallery-wrapper' );

	owlProductGallery.each( function() {

		var container = this;
		var owl = $( '.owl-carousel', this );

		$( container ).prepend( '<div class="images-loading"></div>' );

		$( owl ).imagesLoaded( function() {

			owl.parent().find( '.images-loading' ).remove();

			owl.owlCarousel( {
				dragEndSpeed: 250,
				smartSpeed: 250,
				autoHeight: true,
				dots: true,
				dotsContainer: $( '> .owl-dots', container ),
				rtl: rtl,
				responsive: {
					0: {
						items: 1,
						margin: 0,
					},
					544: {
						items: 2,
						margin: 15,
					},
					992: {
						items: 3,
						margin: 15,
					},
					1200: {
						items: 4,
						margin: 15,
					}
				},
			} );

		} );

	} );

	/**
	 * Lightbox
	 */

	$( '.lightbox-enabled .woocommerce-product-gallery__wrapper' ).each( function() {
		var href = $( '.woocommerce-product-gallery__image > a', this ).attr( 'href' );
		if ( href && href.match( /\.(gif|jpeg|jpg|png)/ ) ) {
			$( '.woocommerce-product-gallery__image > a', this ).addClass( 'image-popup' );
			$( this ).magnificPopup( {
				delegate: '.image-popup',
				type: 'image',
				image: {
					titleSrc: function( item ) {
						return item.el.children().attr( 'title' );
					}
				},
				gallery: {
					enabled: true
				}
			} );
		}
	} );

} )( jQuery );