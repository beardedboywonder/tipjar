$(function() {

    $('.submit-form').css('display', 'none');
$('.submit-button').click(function () {
    $('.submit-form').slideToggle('normal');
    $(this).toggleClass('slideSign');
    return false;
});

});