/**
 * navigation.js
 *
 * Handles toggling the navigation menu.
 */
( function() {
	var container, button, menu;

	container = document.getElementById( 'site-navigation' );
	if ( ! container )
		return;

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button )
		return;

	menu = container.getElementsByTagName( 'ul' )[0];

	masthead = document.getElementById( 'masthead' );
	siteTitle = masthead.getElementsByTagName( 'h1' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		siteTitle.style.margin = '0';
		return;
	}

	if ( -1 === menu.className.indexOf( 'nav-menu' ) )
		menu.className += ' nav-menu';

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) )
			container.className = container.className.replace( ' toggled', '' );
		else
			container.className += ' toggled';
	};
} )();

jQuery( document ).ready(function( $ ) {
	$(document).on('scroll', function(){
		if ( 80 < $(document).scrollTop() ) {
			$('#masthead').addClass('unfocused');
		} else {
			$('#masthead').removeClass('unfocused');
		}
	});
});
