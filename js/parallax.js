jQuery( document ).ready( function( $ ){
	$( document ).scroll( function(){
		img=$( '.page-header.header-image' );
		parallax=50-( $(document).scrollTop() / ( img.outerHeight() + img.offset().top ) * 40 );
		img.css( 'background-position' , '50% ' + parallax + '%' );
	});
}( jQuery ) );
