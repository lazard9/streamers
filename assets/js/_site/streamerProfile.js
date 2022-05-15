// Togle Sidebar
$('.slide-in').on('click', function(){
	$('#streamer-aside').addClass('sidebar-overlay');
});
$('.slide-out').on('click', function(){
	$('#streamer-aside').removeClass('sidebar-overlay');
});

// Sticky Sidebar
if ($('.streamer-sidebar').length) {
	var $window = $(window);  
	var $sidebar = $(".streamer-sidebar");
	var $sidebarOffset = $sidebar.offset();

	$window.on("scroll load",function() {
		if($window.scrollTop() > $sidebarOffset.top) {
			$sidebar.addClass("fixed");   
		} else {
			$sidebar.removeClass("fixed");   
		}    
	});
}

//File tabs.js.
$('.tab-content:first-child').show();
$('.tab-nav-link').bind('click', function(e) {
	$this = $(this);
	$tabs = $this.parent().parent().next();
	$target = $($this.data("target")); // get the target from data attribute
	$this.siblings().removeClass('current-tab');
	$target.siblings().css("display", "none")
		$this.addClass('current-tab');
		$target.fadeIn("fast");
	});
$('.tab-nav-link:first-child').trigger('click');