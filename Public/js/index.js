var game = function(){
	this.time = 0;
	this.result = [];
};

game.prototype.begin = function(){
	var that = this;
	$.ajax({
		type : 'post',
		url : beginURL,
		data : 'openId='+openid+'&key=86b4359bdfdefb5b21d6260476087062',
		success : function(data){
			rest = data.rest;
			that.draw('begin');
		},
		error : function(){
			alert('连接服务器失败！');
		}
	});

}

game.prototype.start = function(){
	var that = this;
	$.ajax({
		type : 'post',
		url : queURL,
		data : 'type=getContent&key=86b4359bdfdefb5b21d6260476087062',
		success : function(data){
			that.question = data.data;
			that.queNum = 1;
			that.result = [];
			that.time = 0;
			if(rest>0){
				rest--;
				that.que();
				that.count();
			}else{
				that.alert('nomore');
			}
		},
		error : function(){
			alert('连接服务器失败！');
		}
	});


  // this.question = [{qid:1,question:'sf',ansA:'sdf',ansB:'sf',ansC:'sdf',ansD:'dsf',true_ans:'sdf'}
  // ,{qid:1,que:'sf',ansA:'asdf',ansB:'sdf',ansC:'sfd',ansD:'sdf',tureAns:'sdf'}
  // ,{qid:1,que:'sf',ansA:'asdf',ansB:'sdf',ansC:'sfd',ansD:'sdf',tureAns:'sdf'}
  // ,{qid:1,que:'sf',ansA:'asdf',ansB:'sdf',ansC:'sfd',ansD:'sdf',tureAns:'sdf'}
  // ,{qid:1,que:'sf',ansA:'asdf',ansB:'sdf',ansC:'sfd',ansD:'sdf',tureAns:'sdf'}];

}

game.prototype.que = function(){
	var content = '';
	var that = this;
	content += '<div class="header">TIME：您已经花费<span class="green">'+that.time+'</span>秒</div>';
	content += '<p class="que"><i>'+that.queNum+'</i>'+that.question[that.queNum-1].question+'</p>';
	content += '<div class="ans ans_off" data="1">A：'+that.question[that.queNum-1].ans_A+'</div>';
	content += '<div class="ans ans_off" data="2">B：'+that.question[that.queNum-1].ans_B+'</div>';
	content += '<div class="ans ans_off" data="3">C：'+that.question[that.queNum-1].ans_C+'</div>';
	content += '<div class="ans ans_off" data="4">D：'+that.question[that.queNum-1].ans_D+'</div>';
	$('.bc').html(content);
	$('.ans_off').on('touchstart',function(){
		$(this).removeClass('ans_off');
		$(this).addClass('ans_on');
	});
	$('.ans').on('click',function(){
		that.result.push($(this).attr('data'));
		if(that.queNum == 5){
			that.end();
		}else{
			that.queNum++;
			that.que();
		}
	});
}

game.prototype.count = function(){
	var that = this;
	this.timer = setInterval(function(){that.time++;$('.header').find('.green').html(that.time)},1000);
}

game.prototype.end = function(){
	//var this.result = '';
	clearInterval(this.timer);
	var that = this;
	var count = 0;
	var rank = 0;
	var score = 0;
	$.each(that.result,function(index,element){
		if(element == that.question[index].true_ans){
			count++;
		}
	});
	score = 80*count/5+20-(this.time-20)*0.4;
	$.ajax({
		type : 'post',
		url : ansURL,
		data : 'type=getGrade&key=86b4359bdfdefb5b21d6260476087062&openId='+openid+'&grade='+score,
		success : function(data){
			rank = data.rank;
			var data = {time:that.time,score:score,rank:rank};
			s.set('我在网校十五周年之网校知多少中得了'+score+'分，排名第'+rank+'。现在参加更有好礼相送哦~');
			that.draw('end',data);
		},
		error : function(){
			alert('连接服务器失败！');
		}
	});

}

game.prototype.share = function(){
	this.alert('share');
}

game.prototype.draw = function(page,data){
	if(page == "begin"){
		//首页
		var that = this;
		var content = "";
		content += '<img class="imgHead" src="Public/img/logo.png"><div class="outer">';
		content += '<div class="button start"></div>';
		content += '<div class="button prize"></div>';
		content += '<div class="button help"></div>';
		content += '<div class="button rank"></div></div>';
		content += '<span class="hongyan" style="display:block;position: absolute;bottom: 0px;width: 100%;font-weight: lighter;text-align: center;color: #fff;font-size: 0.8em;">@红岩网校工作站</span>';
		$('.bc').html(content);
		$('.bc').css({'background-image':'url(Public/img/indexbc.png)'});
		$('.start').on('click',function(){
			that.start();
		});
		$('.prize').on('click',function(){
			that.prize();
		});
		$('.help').on('click',function(){
			that.draw("help");
		});
		$('.rank').on('click',function(){
			that.rank();
		});
	}else if(page == "help"){
		var content = "";
		var that = this;
		content += '<div class="header"><img src="Public/img/help_title.png"></div>';
		content += '<div class="content"><h2>游戏规则</h2><p>1.每轮用户可以有一次答题机会，共计五道题，每轮第一次进行分享则增加一次答题机会； <br/>2.排行榜将在每轮结束时停止更新，排名前5名的用户可获得现金红包，每位参与的用户均可参加5月9日晚上的线下晚会的实物抽奖，根据参与的轮数不同抽中奖品也不同；<br/>3.红包口令将在每轮答题结束后，在我的奖品中查看，实物奖品将于5月9日的线下晚会中抽出中奖者；<br/>4.本活动的最终解释权归红岩网校工作站所有。</p><h2>奖品详情</h2>';
		content += '<table><tbody><tr><td>参与4到5天：</td>	<td>耳机、小米手环</td><td>共7名</td></tr><tr><td>参与3天：</td><td>u盘、键鼠套装</td><td>共10名</td></tr><tr><td>参与1天：</td><td>精美笔记本</td><td>共10名</td></tr></tbody></table></div>';
		content += '<div class="outer"><div class="button start"></div><div class="button return"></div></div>';
		$('.bc').html(content);
		$('.bc').css({'background-image':'url(Public/img/back.png)'});
		$('.start').on('click',function(){
			that.start();
		});
		$('.return').on('click',function(){
			that.begin();
		});
	}else if(page == "prize"){
		var content = "";
		var that = this;
		content += '<div class="header"><img src="Public/img/prize_title.png"></div>';
		content += '<table class="prize_table"><tbody><tr><th>序号</th><th>奖品</th><th>红包口令</th><th>发放时间</th></tr>';
		$.each(data,function(index,element){
			content += '<tr><td>'+(index+1)+'</td><td>'+element.pri+'</td><td><span data="'+element.kl+'" class="kouling">口令</span></td><td>'+element.date+'</td></tr>';
		});
		content += '</tbody></table>';
		content += '<p class="warning">红包请在发放后24小时内领取，<br/>过期失效后视作无效</p><p class="prize_p">5月9日晚上八点我们在春华秋实广场（二教与老图之间）将举行线下晚会，届时参与游戏的用户可免费参与实物抽奖。</p>';
		content += '<div class="outer"><div class="button return"></div><div class="button more"></div></div>';
		$('.bc').html(content);
		$('.bc').css({'background-image':'url(Public/img/back.png)'});
		$('.return').on('click',function(){
			that.begin();
		});
		$('.kouling').on('click',function(){
			var data = $(this).attr('data');
			that.alert('kouling',data);
		});
	}else if(page == "rank"){
		var content = "";
		var that = this;
		content += '<div class="header"><img src="Public/img/rank_title.png"></div>';
		content += '<table class="rank_table"><tbody><tr><th>排名</th><th>昵称</th></tr>';
		$.each(data,function(index,element){
			content += '<tr><td>'+(index+1)+'</td><td>'+element.name;
		});
		content += '</tbody></table>';
		content += '<h2 class="rank_h2">说明</h2><p class="rank_p">1.排行榜是实时更新的，并在每天题目更新时重置排行榜；<br/>2.每日排行前五名将各得到现金红包一个。</p>';
		content += '<div class="outer"><div class="button return"></div><div class="button prize"></div></div>';
		$('.bc').html(content);
		$('.bc').css({'background-image':'url(Public/img/back.png)'});
		$('.return').on('click',function(){
			that.begin();
		});
		$('.prize').on('click',function(){
			that.prize();
		});
	}else if(page == "end"){
		var content = "";
		var that = this;
		content += '<div class="end"><h1>游戏结束</h1><h2>用 时：<span>'+data.time+'</span></h2><h2>得 分：<span>'+data.score+'</span></h2><h2>当前排行：<span>'+data.rank+'</span></h2></div>';
		content += '<div class="outer"><div class="button rank"></div><div class="button share"></div></div>';
		$('.bc').html(content);
		$('.rank').on('click',function(){
			that.rank();
		});
		$('.share').on('click',function(){
			that.alert('share');
		});
	}
}

game.prototype.alert = function(data,kouling){
	var content = '';
	content += '<div class="over"></div>';
	if(data == 'nomore'){
		content += '<div class="alert"><p>您本轮的答题机会已经用完， 请<span class="red">下一轮</span>再来吧。首次分享可再获得一次答题机会哟~</p><div class="button confirm"></div></div>';
	}else if(data == 'kouling'){
		content +='<div class="alert"><p style="text-align:center">口令为<span class="red">'+kouling+'</span><br/>线下会有更多奖品等着您</p><div class="button confirm"></div><div class="button more"></div></div>';
	}else if(data == 'share'){
		content += '<div class="alert"><p style="text-align:center;">晒晒成绩，分享活动吧~<br/>每轮第一次分享游戏活动能获得1次重新答题的机会哦</p><div class="button confirm"></div></div>';
	}

	$('body').append(content);
	$('.button').on('click',function(){
		$('.over').remove();
		$('.alert').remove();
	});
	$('.alert').css({'left':($(window).width()-$('.alert').width())/2,'top':($(window).height()-$('.alert').height())/2-50});
}

game.prototype.prize = function(){
	if(this.prizes){
		this.draw("prize",this.prizes);
	}else{
		var array = [];
		$.ajax({
			type : 'post',
			url : prizeURL,
			data : 'openId='+openid,
			success : function(data){
				array = data;
			},
			error : function(){
				alert('连接服务器失败！');
			}
		});
		//var data = [{pri:'现金红包10元',date:'2012-2-2',kl:'kouling'},{pri:'现金红包10元',time:'2012-2-3',kouling:'kouling'}];
		this.draw("prize",array);
	}
	
}

game.prototype.rank = function(){
	var array = [];
	var that = this;
	$.ajax({
			type : 'post',
			url : rankURL,
			data : '',
			success : function(data){
				array = data.data;
				that.draw("rank",array);
			},
			error : function(){
				alert('连接服务器失败！');
			}
		});
	//var data = [{name:'2012-2-2'},{name:'aaa'}];

}

var Game = new game();
Game.begin();