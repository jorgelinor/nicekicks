$( function() {
  var link,
    contents,
    eventEmitter;

  contents = gajus
    .Contents( {
      articles: $( 'h1, h2, h3, h4, h5, h6', '.content' )
    } );

  eventEmitter = contents.eventEmitter();

  $( '.toc' ).append( contents.list() );

  eventEmitter.on( 'ready', function() {
    $( 'nav a' ).smoothScroll();
  } );

  eventEmitter.on( 'change', function( data ) {
    if ( data.previous ) {
      $( data.previous.guide )
        .removeClass( 'active' )
        .parents( 'li' )
        .removeClass( 'active-child' );
    }

    $( data.current.guide )
      .addClass( 'active' )
      .parents( 'li' )
      .addClass( 'active-child' );
  } );
} );

jQuery( document ).ready( function() {

  jQuery( 'nav' ).theiaStickySidebar( {
    // Settings
    additionalMarginTop: 30,
    minWidth: 960
  } );

  $( '.content' ).magnificPopup( {
    delegate: 'img',
    type: 'image',
    callbacks: {
      elementParse: function( item ) { item.src = item.el.attr( 'src' ); }
    }
  } );

  $( '.content a' ).smoothScroll();

} );
