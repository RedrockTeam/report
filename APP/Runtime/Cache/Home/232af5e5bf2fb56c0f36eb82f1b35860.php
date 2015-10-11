<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>提交</title>
<link rel="stylesheet" href="/report/Public/styles/normalize.min.css">	
<link rel="stylesheet" href="/report/Public/styles/style.debug.css">	
</head>
<body>
	<div id="submit-report">
		<ul class="report-list">
			<li class="report-list-item">
				<i class="iconfont">&#xe616;</i>
				<div class="rli-item">
					申报人<span></span>
				</div>
				<div class="rli-itemDetail">
					陈定攀
				</div>
			</li>
			<li class="report-list-item">
				<i class="iconfont">&#xe611;</i>
				<div class="rli-item">
					电话<span></span>
				</div>
				<div class="rli-itemDetail" >
					<input type="text" class="submit-input" placeholder="请输入常用手机号">
				</div>
			</li>
			<li class="report-list-item">
				<div class="placetaker">
					
				</div>
				<div class="rli-item">
					服务项目<span></span>
				</div>
				<div class="rli-itemDetail">
					请选择分类
				</div>
				<i class="iconfont iconfont-star" style="float: right">&#xe62b;</i>
				<div class="rli-itemDetailMore">
					<div class="placetaker">
					
					</div>
					<div class="rli-item">
						<span></span>
					</div>
					<div class="rli-itemDetail">
						请选择分类
					</div>
					<i class="iconfont iconfont-star" style="float: right">&#xe62b;</i>
				</div>
			</li>
			<li class="report-list-item">
				<div class="placetaker">
					
				</div>
				<div class="rli-item">
					服务区域<span></span>
				</div>
				<div class="rli-itemDetail">
					请选择分类
				</div>
				<i class="iconfont iconfont-star" style="float: right">&#xe62b;</i>
				<div class="rli-itemDetailMore">
					<div class="placetaker">
					
					</div>
					<div class="rli-item">
						<span></span>
					</div>
					<div class="rli-itemDetail">
						请选择分类
					</div>
					<i class="iconfont iconfont-star" style="float: right">&#xe62b;</i>
				</div>
			</li>
		</ul>
	</div>
	<div id="submit-response">
		<ul class="report-list">
			<li class="report-list-item">
				<i class="iconfont">&#xe609;</i>
				<div class="rli-item">
					标题<span></span>
				</div>
				<div class="rli-itemDetail" >
					<input type="text" class="submit-input" placeholder="请输入十字以内">
				</div>
			</li>
			<li class="report-list-item">
				<i class="iconfont">&#xe655;</i>
				<div class="rli-item">
					申报内容<span></span>
				</div>
				<div class="rli-itemDetail" >

				</div>
			</li>
			<div class="rli-itemDetailMore" style="margin-top: 0">
				<textarea class="submit-text">请在这里输入内容
					
				</textarea>
			</div>
		</ul>
	</div>	
	<div class="detail-btn">
		<input type="button" class="btn-confirm" value="提      交">
	</div>
</body>
<script src="/report/Public/scripts/zepto.js"></script>
<script src="/report/Public/scripts/flexible.js"></script>
</html>