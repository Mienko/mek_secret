/**
 * navigation.js
 *
 * Handles toggling the navigation menu.
 */

jQuery( document ).ready(function( $ ) {
	$('#site-navigation > div > ul').addClass('nav-menu');

	// Hide menu toggle button if menu is empty.
	if ( 0 == $('#site-navigation ul').length )
		$('.menu-toggle').hide();

	// Toggle the navigation menu
	$('.menu-toggle').click(function(){
		if ( $('#site-navigation').hasClass('toggled') ) {
			$('#site-navigation').removeClass('toggled');
			$('.menu-toggle').removeClass('toggled');
		} else {
			$('#site-navigation').addClass('toggled');
			$('.menu-toggle').addClass('toggled');
		}
	});

	// When we are scrolling, change the header
	$(document).on('scroll', function(){

		// If we're not at the top of the page ...
		if ( $('.site-main article:first-child .entry-title').offset().top + $('.site-main article:first-child .entry-title').height() < $(document).scrollTop() ) {
			// ... let's do fun stuff.

			// If this is a page or a single post, and the entry-title is not empty
			if ( ( $('body.single').length || $('body.page').length ) && ! $('#masthead .site-title .entry-title').length ) {

				// Copy the entry-title to the site-title in the #masthead
				$('#masthead .site-title').append('<span class="entry-title">: ' + $('.site-main article:first-child .entry-title').html() + '</span>');

				// If the longer title squeezes out the description ...
				if ($('#masthead .site-title').width() + $('#masthead .site-description').width() + 102 >= $('#masthead .site-branding').width() ) {

					// ... make sure the description disappears for real instead of hovering over other stuff.
					$('#masthead .site-description').css('display','none');
				}
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
