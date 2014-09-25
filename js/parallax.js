jQuery( document ).ready( function( $ ){
	$( document ).scroll( function(){
		img=$( '.page-header.header-image' );
		if ( 'undefined' !== typeof img.offset() ) {
			scroll = $(document).scrollTop();
			bgHeight = $('.page-header.header-image').attr('data-background-height');
			headerHeight = $('.page-header.header-image').outerHeight();

			// Calculate the offset in pixels
			parallaxPx = ( scroll / 2 ) + ( bgHeight - headerHeight ) / 2;
			// Because of background-size:cover, the offset should be given in percentages instead of pixels
			if ( bgHeight > headerHeight )
				parallaxPct = 100-( 100*parallaxPx / (bgHeight-headerHeight) );
			else if ( bgHeight < headerHeight )
				parallaxPct = ( 100*parallaxPx / (bgHeight-headerHeight) );
			else
				parallaxPct = 50-( 100*parallaxPx / (headerHeight) );

			img.css( 'background-position' , '50% ' + parallaxPct + '%' );
		}
	});
}( jQuery ) );
