(function(){
	var $detailBtn = $("#detail-title-btn");
	var $ditailDetail = $("#detail-title-detail");
	var $detailStars = $(".rli-itemDetail .iconfont-mark");
	var $detailConfirm = $("#detail-confirm");
	var $failContainer = $("#fail-container");
	var $failConfirm = $("#fail-btn");

	$detailBtn.click(function(){
		if($detailBtn.css("transform")==="rotate(0deg)") {
			$detailBtn.css({transform: "rotate(180deg)"});
			$ditailDetail.css({height: "auto",paddingTop: "0.5625rem",paddingBottom: "0.5625rem"});
		}else {
			$detailBtn.css({transform: "rotate(0deg)"});
			$ditailDetail.css({height: 0,paddingTop: 0,paddingBottom: 0});
		}
	});

	for(var i=0; i<$detailStars.length; i++) {
		$detailStars[i].index=i;
		(function() {
			$detailStars[i].addEventListener('click', function(){
				starMark(this.index);
			}, false);
		}());
	}

	var starMark = function(index) {
		for(i=0; i<=$detailStars.length-1; i++) {
			$detailStars[i].innerHTML = i <= index ? "&#xe685;" : "&#xe686;"; 
		}
	}

	starMark(1); //默认给两颗星

	$detailConfirm.click(function(){
		$failContainer.css({display: "block", marginTop: window.scrollY + "px", height: document.documentElement.clientHeight  + "px"});
	});

	$failConfirm.click(function(){
		$failContainer.css({display: "none"});
	});									/* 待做防止滑动 */

}());