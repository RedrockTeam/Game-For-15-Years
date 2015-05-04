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
		location.href = '<?php echo ($GAMEURL); ?>';
	});
	$('.vedio').on('touchend',function(){
		location.href = 'http://v.youku.com/v_show/id_XOTQ3MjE0ODM2.html';
	});
	$('.honor').on('touchend',function(){
		location.href = '';
	});
</script>
</body>
</html>