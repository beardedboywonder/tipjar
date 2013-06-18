$(function() {

    var Submitter = (function () {
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
            setCategory(this.dataset.tipApp);
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
}());

Submitter.init();

// I have no idea why the click event sometimes isn't fired... really weird
// Firefox it works every time...
// It seems that when you click on the padding around the button, it doesn't work. Maybe try wrapping the button in a different element which takes care of layout things and the <button> is just styles
// It could also be that since you're using top: 7px; when the button gets active that it doesn't think it should be a click because the mouse is no longer on the button. Solution could be to use transforms or to add a pseudo element which covers up the 7px that goes missing. Chris Coyier of css-tricks posted about that earlier this year (he has button very similar to yours)
// If none of that works, maybe scrap the css and start over!
$('#buttonholder').on('click', function (evt) {
    console.log('#buttonholder:', evt.target);
});
$('body').on('click', function (evt) {
    console.log('body:', evt.target);
});

});