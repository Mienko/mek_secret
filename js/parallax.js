jQuery( document ).ready( function( $ ){
	$( document ).scroll( function(){
		img=$( '.page-header.header-image' );
		console.log( img.offset() );
		if ( 'undefined' !== typeof img.offset() ) {
			parallax=50-( $(document).scrollTop() / ( img.outerHeight() + img.offset().top ) * 40 );
			img.css( 'background-position' , '50% ' + parallax + '%' );
		}
	});
}( jQuery ) );
