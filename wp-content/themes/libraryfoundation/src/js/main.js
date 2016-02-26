function mobileMenu(){
	// Clone that thing
	var a = $('#header-navigation').html();
	var b = $('#mobile-menu_container').html(a);
	$('#mobile-menu_container a').removeClass('btn-nav').addClass('btn-mobile');
	$(".mobile-toggle").swap();
}

function openSub(){
	$("#home_sub").on('click', function(){
		$.magnificPopup.open({
			items: {
        src: '#mailchimp__signup' 
    	},
    	type: 'inline'
		});
	});
}

function fs_defaults(){
	$('.fs__carousel').carousel();
	$('.wallpaper').background();
}

$(document).ready(function(){
	//mobileMenu();
	fs_defaults();
	openSub();
});