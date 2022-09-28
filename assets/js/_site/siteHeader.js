/* Resize menu */
$(window).on("scroll load", function resizemeny() {
	if ($(this).scrollTop() < 100) {
		$('.site-header').removeClass('resize-header');
	} else {
		$('.site-header').addClass('resize-header');
	}
});

// Search Bar & Toggle
$(function () {
	$('#toggle-search').on('click', function() {
		$('.header-search').toggleClass('state');
	});
});