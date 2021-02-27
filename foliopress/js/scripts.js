jQuery( function() {

	// toggle to display search form
	jQuery('.search-toggle').on( "click", function(event) {
		var that = jQuery('.search-toggle'),
		wrapper = jQuery('.search-block'),
		fpBody = jQuery('.site').parent("body");

		that.toggleClass('active');
		wrapper.toggleClass('off').toggleClass('on');
		fpBody.toggleClass('overflow-hide');
		jQuery('.search-block.on').fadeIn();
		jQuery('.search-block.off').fadeOut();
		if ( that.is('.active') || jQuery('.search-toggle')[0] === event.target ) {
			wrapper.find('.s').focus();
		}

		// search form escape while pressing ESC key
		jQuery(document).on('keydown', function (e) {
			if ( e.keyCode === 27 && that.hasClass('active') ) {
				that.removeClass('active');
				wrapper.addClass('off').removeClass('on');
				fpBody.removeClass( 'overflow-hide' );
				jQuery('.search-block.off').fadeOut();
			}
		});
	});

	// content placement according to fixed navigation
	var navBarHeight = jQuery('nav.fixed-top').outerHeight(),
	adminBarHeight = jQuery('#wpadminbar').outerHeight(),
	screenheight = jQuery(window).outerHeight(),
	screenwidth = jQuery(window).outerWidth();
	
	if(navBarHeight){
		jQuery('.site').css('padding-top',navBarHeight);
		if (adminBarHeight){
			jQuery('.navbar.fixed-top').css('top',adminBarHeight);
		}
	}

	//Dropdown menu scroll for small devices
	if(screenwidth <= 991) {
		if(navBarHeight){
			jQuery('#navbarCollapse').css('max-height', screenheight - navBarHeight);
			if (adminBarHeight){
				jQuery('#navbarCollapse').css('max-height', screenheight - navBarHeight - adminBarHeight );
			}
		}
	}

	// hide #back-top first
	jQuery(".back-to-top").hide();

	// fade in #back-top
	jQuery(function () {
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 1000) {
				jQuery('.back-to-top').fadeIn();
			} else {
				jQuery('.back-to-top').fadeOut();
			}
		});

		// scroll body to 0px on click
		jQuery('.back-to-top a').on( "click", function() {
			jQuery('body,html,header').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

});
