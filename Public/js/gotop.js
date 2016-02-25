$(function(){
	    // scroll to top on request
    if ($("a#totop").length) {
	$("a#totop").hide().removeAttr("href");
	if ($(window).scrollTop() != "0") {
	$("a#totop").fadeIn("slow")
	}
	var scrollDiv = $("a#totop");
	$(window).scroll(function () {
	if ($(window).scrollTop() == "0") {
	    $(scrollDiv).fadeOut("slow")
	} else {
	    $(scrollDiv).fadeIn("slow")
	}
	});
	$("a#totop").click(function () {
	$("html, body").animate({
	    scrollTop: 0
	}, "slow")
	})
    }
})