function vw_mobile_app_menu_open_nav() {
	window.vw_mobile_app_responsiveMenu=true;
	jQuery(".sidenav").addClass('show');
}
function vw_mobile_app_menu_close_nav() {
	window.vw_mobile_app_responsiveMenu=false;
 	jQuery(".sidenav").removeClass('show');
}

jQuery(function($){
 	"use strict";
   	jQuery('.main-menu > ul').superfish({
		delay:       500,
		animation:   {opacity:'show',height:'show'},  
		speed:       'fast'
   	});
});

jQuery(document).ready(function () {
	window.vw_mobile_app_currentfocus=null;
  	vw_mobile_app_checkfocusdElement();
	var vw_mobile_app_body = document.querySelector('body');
	vw_mobile_app_body.addEventListener('keyup', vw_mobile_app_check_tab_press);
	var vw_mobile_app_gotoHome = false;
	var vw_mobile_app_gotoClose = false;
	window.vw_mobile_app_responsiveMenu=false;
 	function vw_mobile_app_checkfocusdElement(){
	 	if(window.vw_mobile_app_currentfocus=document.activeElement.className){
		 	window.vw_mobile_app_currentfocus=document.activeElement.className;
	 	}
 	}
 	function vw_mobile_app_check_tab_press(e) {
		"use strict";
		// pick passed event or global event object if passed one is empty
		e = e || event;
		var activeElement;

		if(window.innerWidth < 999){
		if (e.keyCode == 9) {
			if(window.vw_mobile_app_responsiveMenu){
			if (!e.shiftKey) {
				if(vw_mobile_app_gotoHome) {
					jQuery( ".main-menu ul:first li:first a:first-child" ).focus();
				}
			}
			if (jQuery("a.closebtn.mobile-menu").is(":focus")) {
				vw_mobile_app_gotoHome = true;
			} else {
				vw_mobile_app_gotoHome = false;
			}

		}else{

			if(window.vw_mobile_app_currentfocus=="responsivetoggle"){
				jQuery( "" ).focus();
			}}}
		}
		if (e.shiftKey && e.keyCode == 9) {
		if(window.innerWidth < 999){
			if(window.vw_mobile_app_currentfocus=="header-search"){
				jQuery(".responsivetoggle").focus();
			}else{
				if(window.vw_mobile_app_responsiveMenu){
				if(vw_mobile_app_gotoClose){
					jQuery("a.closebtn.mobile-menu").focus();
				}
				if (jQuery( ".main-menu ul:first li:first a:first-child" ).is(":focus")) {
					vw_mobile_app_gotoClose = true;
				} else {
					vw_mobile_app_gotoClose = false;
				}
			
			}else{

			if(window.responsiveMenu){
			}}}}
		}
	 	vw_mobile_app_checkfocusdElement();
	}
});

(function( $ ) {
	jQuery('document').ready(function($){
		jQuery(window).load(function() {
		    setTimeout(function () {
	    		jQuery("#preloader").fadeOut("slow");
		    },1000);
		})
	});

	$(window).scroll(function(){
		var sticky = $('.header-sticky'),
			scroll = $(window).scrollTop();

		if (scroll >= 100) sticky.addClass('header-fixed');
		else sticky.removeClass('header-fixed');
	});

	$(document).ready(function () {

		$(window).scroll(function () {
		    if ($(this).scrollTop() > 100) {
		        $('.scrollup i').fadeIn();
		    } else {
		        $('.scrollup i').fadeOut();
		    }
		});

		$('.scrollup i').click(function () {
		    $("html, body").animate({
		        scrollTop: 0
		    }, 600);
		    return false;
		});
	});	
})( jQuery );