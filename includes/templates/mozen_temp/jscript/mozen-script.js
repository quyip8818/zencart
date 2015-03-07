// JavaScript Document
/**
* @package Mozen - Responsive Zencart Template
* @copyright (C) 2012 by Dasinfomedia - All rights reserved!
* JS Document
*/
//Scroll to top Script
var jq = jQuery.noConflict();
jq(function() {
    jq.fn.scrollToTop = function() {
	jq(this).hide().removeAttr("href");
	if (jq(window).scrollTop() != "0") {
	    jq(this).fadeIn("slow")
	}
	var scrollDiv = jq(this);
	jq(window).scroll(function() {
	    if (jq(window).scrollTop() == "0") {
		jq(scrollDiv).fadeOut("slow")
	    } else {
		jq(scrollDiv).fadeIn("slow")
	    }
	});
	jq(this).click(function() {
	    jq("html, body").animate({
		scrollTop: 0
	    }, "slow")
	})
    }
});


jq(function() {
    jq("#w2b-StoTop").scrollToTop();
});


//Slider Script
var sli = jQuery.noConflict();
 sli(window).load(function() {
    sli('.flexslider').flexslider();
  });
 
 
 
//Accordian
var acc = jQuery.noConflict();
acc(document).ready(function(){

//Set default open/close settings
acc('.acc_container').hide(); //Hide/close all containers
acc('.acc_trigger:first').addClass('active').next().show(); //Add "active" class to first trigger, then show/open the immediate next container

//On Click
acc('.acc_trigger').click(function(){
if( $(this).next().is(':hidden') ) { //If immediate next container is closed...
acc('.acc_trigger').removeClass('active').next().slideUp(); //Remove all .acc_trigger classes and slide up the immediate next container
acc(this).toggleClass('active').next().slideDown(); //Add .acc_trigger class to clicked trigger and slide down the immediate next container
}
return false; //Prevent the browser jump to the link anchor
});

});

//Cloud Zoom
var cld = jQuery.noConflict();
cld('#zoom01, .cloud-zoom-gallery').CloudZoom();

 