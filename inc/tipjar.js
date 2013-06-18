var Tipjar = {};

// Key/value pairs
Tipjar.Settings = (function( $ ) {
    'use strict';

    var self = {},
        ua = navigator.userAgent;

    self.$window = $( window );
    self.$document = $( document );
    self.$html = $( document.documentElement );
    self.$body = $( document.body );

    self.system =  ua.indexOf('Mac') !== -1 ? 'mac' : 'windows';

    return self;
}( jQuery ));


// Functions, polyfills, and more that extend the global namespace
Tipjar.Environment = (function( Settings ) {
    'use strict';

    var self = {
        init : function() {
            self.addDeviceClasses();
        },

        addDeviceClasses : function() {
            Settings.$body.addClass( Settings.system );
        }
    };

    self.init();

    return self;
}( Tipjar.Settings ));


// Global utility functions
// Tipjar.Utilities = ();


Tipjar.Submitter = (function( $ ) {
    'use strict';

    var $selectedCategory = $('.js-selected-category'),
        $inputs = $('input.onoffswitch-checkbox'),
        $tray = $('.submit-form'),
        $trayToggleBtn = $('.press'),

        init = function () {
            listenForEvents();

            // Hide the tip submission initially
            $tray.hide();

            // Trigger the first change event so the category text is populated
            $inputs.first().trigger('change');
        },

        listenForEvents = function () {
            $inputs.on('change', onRadioChanged);
            $('.submit-form form').on('submit', onSubmit);
            $trayToggleBtn.on('click', onTrayBtnClicked);
        },

        setCategory = function (category) {
            $selectedCategory.text(category);
            console.log($selectedCategory);
        },
        onTrayBtnClicked = function () {
            $tray
            // Stop what its doing
            .stop(true, true)
            // Toggle slide
            .slideToggle(400)
            // Toggle Class
            .toggleClass('slideSign');
        },

        onRadioChanged = function () {
            // Note: instead of using the value for the display
            // ('cause maybe you need nice characters for a database or something),
            // You could a data-* attribute with the correct label
            setCategory( this.dataset.tipApp );
        },

        // Maybe sanitize your data or check for required fields or ajax submit
        // You could put a `required` attribute on fields that are required
        // and the browser will do the work for you
        onSubmit = function () {
            // Show page is doing something: http://codepen.io/hakimel/pen/gkeha
            console.log('submit button clicked');
            // Return false here if the form shouldn't be submitted
            return false;
        };

    // Return public methods
    return {
        init: init
    };
}( jQuery ));

Tipjar.SocialLinks = (function( $ ) {
    'use strict';

    var opts = {
        pinterest: {
            height: 525
        },
        google: {
            height: 400
        }
    },
    // delay = 400,

    init = function() {
        $('.social-links li').on('click', function() {
            var link = $(this).find('a'),
                type = link.attr('class').replace('share-', '');

            // Open popup window with social link
            window.open( link.attr('href'), '_blank', 'width=560,height=' + (opts[type] && opts[type].height || 450) );

            // Prevent default and stop propagation
            return false;
        });
    };

    return {
        init: init
    };
}( jQuery ));


$(document).ready(function() {
    Tipjar.Environment.init();
    Tipjar.Submitter.init();
    Tipjar.SocialLinks.init();
});

