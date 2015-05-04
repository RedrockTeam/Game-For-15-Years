<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>网校知多少</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0,maximum-scale=1.0" />
	<link rel="stylesheet" type="text/css" href="/Game-For-15-Years/Public/css/index.css">
	<script type="text/javascript" src="/Game-For-15-Years/Public/js/zepto.min.js"></script>
	<script src="/Game-For-15-Years/Public/js/weixin.js"></script>
</head>
<body>
<div class="bc">

</div>
<script type="text/javascript">
	var openid = "<?php echo ($openId); ?>";
	var rest = 0;
	var beginURL = '<?php echo U("Home:index/checkJoin"); ?>';
	var queURL = '<?php echo U("Home:index/questionApi"); ?>';
	var ansURL = '<?php echo U("Home:index/answerApi"); ?>';
	var shareURL = '<?php echo U("Home:index/shareApi"); ?>';
	var rankURL = '<?php echo U("Home:index/rankTop"); ?>';
	var prizeURL = '<?php echo U("Home:index/prizeApi"); ?>';
	wx.config({
	    debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
	    appId: 'wx81a4a4b77ec98ff4', // 必填，公众号的唯一标识
	    timestamp: '<?php echo ($Js["timestamp"]); ?>', // 必填，生成签名的时间戳
	    nonceStr: '<?php echo ($Js["nonceStr"]); ?>', // 必填，生成签名的随机串
	    signature: '<?php echo ($Js["signature"]); ?>',// 必填，签名，见附录1
	    jsApiList: [
	    	'onMenuShareTimeline',
	    	'onMenuShareAppMessage',
	    	'hideMenuItems'
	    ] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
	});

	wx.ready(function(){
		wx.hideMenuItems({
		    menuList: [
		    	 "menuItem:copyUrl",
		    	 "menuItem:originPage"
		    ]
		});

		
		wx.onMenuShareTimeline({
		    title: s.get(), // 分享标题
		    link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx81a4a4b77ec98ff4&redirect_uri=http%3A%2F%2Fhongyan.cqupt.edu.cn%2F%2FGame-For-15-Years%2FIndex%2Findex&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect', // 分享链接
		    imgUrl: 'http://hongyan.cqupt.edu.cn/Game-For-15-Years/Public/img/logo.png', // 分享图标
		    success: function () { 
		    	$.ajax({
						type : post,
						url : shareURL,
						data : 'type=getGrade&key=86b4359bdfdefb5b21d6260476087062&openId='+openid+'',
						success : function(data){
							if(data.status == 200){
								rest = 1;
							}
						},
						error : function(){
							alert('连接服务器失败！');
						}
					});
		        // 用户确认分享后执行的回调函数
		    },
		    cancel: function () { 
		        // 用户取消分享后执行的回调函数
		    }
		});


		// wx.onMenuShareAppMessage({
		//     title: s.get(), // 分享标题
		//     desc: '我已经成功闯关重邮问问答，快来挑战我吧！', // 分享描述
		//     link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx81a4a4b77ec98ff4&redirect_uri=http%3A%2F%2Fhongyan.cqupt.edu.cn%2Fcquptque%2FHome%2FIndex%2Findex&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect', // 分享链接
		//     imgUrl: 'http://hongyan.cqupt.edu.cn/cquptque/Public/img/share.jpg', // 分享图标
		//     type: 'link', // 分享类型,music、video或link，不填默认为link
		//     dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
		//     success: function () { 
		//         // 用户确认分享后执行的回调函数
		//     },
		//     cancel: function () { 
		//         // 用户取消分享后执行的回调函数
		//     }
		// });
	});
</script>
<script type="text/javascript" src="/Game-For-15-Years/Public/js/index.js"></script>
</body>
</html>