$(document).ready(function() { 
	$('ul.menu').superfish({ 
		delay:       800,                            // one second delay on mouseout 
		animation:   {height:'show'},  // fade-in and slide-down animation 
		speed:       'normal',                          // faster animation speed 
		autoArrows:  true,                           // disable generation of arrow mark-up 
		dropShadows: false                            // disable drop shadows 
	}); 
}); 

$(function () {	
	
});

$(window).load(function() { 
	$('.pagination li span').css({opacity: 0});
	
	$('.pagination li').not('.current')
	.hover(function(){
		$(this).find('span')
		.stop().animate({opacity:0.33})
	}, function(){
		$(this).find('span')
		.stop().animate({opacity:0})
	})
}); 