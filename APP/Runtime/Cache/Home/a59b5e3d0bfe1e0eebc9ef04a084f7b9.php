<?php if (!defined('THINK_PATH')) exit();?><!-- 
	css 命名规则
	页面-区域（以功能分）-功能
	一个 css 名称最多三级
	若有大于三级的情况，则后面两栏照常写，第一栏为缩写
	功能相同内容不同标签最后一个属性用驼峰
 -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>首页</title>	
<link rel="stylesheet" href="/report/Public/styles/normalize.min.css">	
<link rel="stylesheet" href="/report/Public/styles/style.debug.css">	
</head>
<body>
	<header id="home-header">
		<span class="home-header-name">
			姚蕤
		</span>
		<input type="button" class="home-header-submit" value="报修提交">
	</header>
	<div class="home-nav">
		<div id="home-nav-unfinish" class="home-nav-focus">
			未完成
		</div>
		<div id="home-nav-finish">
			已完成
		</div>
	</div>
	<div id="home-unfinishItems" class="home-itemList">
		<ul>
			<li class="home-itemList-single">
				<p>
					<span class="hi-single-type">修电费</span>
					<span class="hi-single-status">派出中</span>
				</p>
				<span class="hi-single-date">
					2015-10-3
				</span>
			</li>
		</ul>
	</div>
	<div id="home-finishItems" class="home-itemList" style="display: none">
		<ul>
			<li class="home-itemList-single">
				<p>
					<span class="hi-single-type">修电费</span>
					<span class="hi-single-status">已完成</span>
				</p>
				<span class="hi-single-date">
					2015-10-3
				</span>
			</li>
			<li class="home-itemList-single">
				<p>
					<span class="hi-single-type">修电费</span>
					<span class="hi-single-status">已完成</span>
				</p>
				<span class="hi-single-date">
					2015-10-3
				</span>
			</li>
		</ul>
	</div>
</body>
<script src="/report/Public/scripts/zepto.js"></script>
<script src="/report/Public/scripts/flexible.js"></script>
<script type="text/javascript">
(function(){
	var $btn_unfinish = $("#home-nav-unfinish"),
		$btn_finish = $("#home-nav-finish"),
		$unfinishItems = $("#home-unfinishItems"),
		$finishItems = $("#home-finishItems");

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
}());	
</script>
</html>