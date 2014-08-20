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

	// When we are scrolling, the header changes.
	$(document).on('scroll', function(){

		// If we're not at the top of the page ...
		if ( $('.site-main article:first-child .entry-title').offset().top + $('.site-main article:first-child .entry-title').height() < $(document).scrollTop() ) {
			// ... let's do fun stuff.

			// If this is a page or a single post, and the entry-title is not empty
			if ( ( $('body.single').length || $('body.page').length ) && ! $('#masthead .site-title .entry-title').length ) {

				// Copy the entry-title to the site-title in the #masthead
				$('#masthead .site-title').append('<span class="entry-title">: ' + $('.site-main article:first-child .entry-title').html() + '</span>');

				// If the longer title squeezes out the description ...
				if ($('#masthead .site-title').width() + $('#masthead .site-description').width() >= $('#masthead .site-branding').width() ) {

					// ... make sure the description disappears for real instead of hovering over other stuff.
					$('#masthead .site-description').css('display','none');
				}
				console.log($('#masthead .site-title').width() + ', ' + $('#masthead .site-description').width() + ', ' + $('#masthead .site-branding').width() )
			}

			// Also, make the masthead smaller
			$('#masthead').addClass('unfocused');
		} else {
			// We're at the top of the page, undo everything
			$('#masthead').removeClass('unfocused');
			$('#masthead .site-title .entry-title').remove();
			$('#masthead .site-description').css('display','block');
		}
	});
});
