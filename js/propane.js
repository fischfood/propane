/**
 *
 * Base theme javascript file
 * Put all your scripts related to your theme in here.
 * Keep in mind that this file will get concatenated into
 * a singular file.
 *
 */

// If we don't have an object for our theme create it.

if( typeof(propane) == 'undefined' ) {
    propane = {};
}

propane.site = function ( $ ) {
    // Private Variables
    var $window = $(window),
        $doc    = $(document),
        $body   = $('body');

    return {

        /*
         * function init
         * Kick off all of the business
         */

        init: function() {
	        // initialize foundation
	        $doc.foundation();

            $doc.foundation({
	            accordion: {
		            callback: function ( accordion ) {

			            if ( accordion.parents('[data-accordion]').data('accordion') === 'has-equalize' ) {
				            $(document).foundation('equalizer', 'reflow');
			            }

		            }
	            }
            });

            // Fix off-canvas menu icon for IOS
            $('.menu-icon').click(function () {} );
        }
    };
} ( jQuery );

jQuery(function( $ ) {
    propane.site.init();
});