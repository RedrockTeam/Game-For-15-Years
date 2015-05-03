<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>红岩网校工作站15周年庆</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0,maximum-scale=1.0" />
	<link rel="stylesheet" type="text/css" href="/Game-For-15-Years/Public/css/index.css">
	<script type="text/javascript" src="/Game-For-15-Years/Public/js/zepto.min.js"></script>
</head>
<body>
<div class="home_bc">
	<div class="block"></div>
	<div class="game"></div>
	<div class="vedio"></div>
	<div class="honor"></div>
</div>
<script type="text/javascript">
	$('.game').on('touchend',function(){
		location.href = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx81a4a4b77ec98ff4&redirect_uri=http%3A%2F%2Fhongyan.cqupt.edu.cn%2F%2FGame-For-15-Years%2FIndex%2Findex&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
	});
	$('.vedio').on('touchend',function(){
		location.href = 'http://202.202.43.125';
	});
	$('.honor').on('touchend',function(){
		location.href = 'http://202.202.43.125';
	});
</script>
</body>
</html>