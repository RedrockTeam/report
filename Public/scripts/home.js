(function(){
	var $btn_unfinish = $("#home-nav-unfinish"),
		$btn_finish = $("#home-nav-finish"),
		$unfinishItems = $("#home-unfinishItems"),
		$finishItems = $("#home-finishItems"),
		$toSubmit = $("#home-header-submit");

	$btn_unfinish.click(function() {
		$btn_unfinish.addClass("home-nav-focus");
		$btn_finish.removeClass("home-nav-focus");
		$unfinishItems.css({display: "block"});
		$finishItems.css({display: "none"});
	});

	$btn_finish.click(function() {
		$btn_finish.addClass("home-nav-focus");
		$btn_unfinish.removeClass("home-nav-focus");
		$unfinishItems.css({display: "none"});
		$finishItems.css({display: "block"});
	});	

	$unfinishItems.click(function() {
		window.location.href = "detail-undo.html";
	});
	$finishItems.click(function() {
		window.location.href = "detail.html";
	});
	$toSubmit.click(function() {
		window.location.href = "submit.html";
	});
}());