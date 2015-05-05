<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	
	private $starDay = 4;
	private $acess_token = 'gh_68f0a1ffc303';
	private $wx_url = 'http://hongyan.cqupt.edu.cn/MagicLoop/index.php?s=/addon/Api/Api/';
	
	public function index(){
		//$this->checkTime();
		//$openId = I('get.id');
		$CODE = I('get.code');

		$time=time();
		$str = 'abcdefghijklnmopqrstwvuxyz1234567890ABCDEFGHIJKLNMOPQRSTWVUXYZ';
		$string='';
		for($i=0;$i<16;$i++){
			$num = mt_rand(0,61);
			$string .= $str[$num];
		}
		$secret =sha1(sha1($time).md5($string)."redrock");
		$web=$this->wx_url.'userInfo';
		$t2=array(
			'timestamp'=>$time,
			'string'=>$string,
			'secret'=>$secret,
			'token'=>$this->acess_token,
			'code' => $CODE,
		);
		$url2=$this->wx_url."webOauth";


		$oa = json_decode($this->curl_api($url2,$t2),true);//new
		//$this->newUser($oa['data']['openid'],$oa);
		$openId = $oa['data']['openid'];


		$this->assign('answerApi_url',U('Hmoe/Index/answerApi'));
		$this->assign('on_url',U('Public/img/on.png'));
		$this->assign('questionApi_url',U('Home/Index/questionApi'));
		$this->assign('rank_url',U('Home/Index/rankTop'));
//		$this->assign('openId',$openId);
//		$this->assign('Js',$data);
		$this->assign('GAMEURL',U('Home/Index/game/openId/'.$openId.'/code/'.$CODE));
		$this->display('index');
	}
	
	public function game(){
		//$this->checkTime();
		$openId = I('get.openId');
		$time=time();
		$str = 'abcdefghijklnmopqrstwvuxyz1234567890ABCDEFGHIJKLNMOPQRSTWVUXYZ';
		$string='';
		for($i=0;$i<16;$i++){
			$num = mt_rand(0,61);
			$string .= $str[$num];
		}
		$secret =sha1(sha1($time).md5($string)."redrock");
		/**/

		$find =array(
			'timestamp'=>$time,
			'string'=>$string,
			'secret'=>$secret,
			'token'=>$this->acess_token,
		);
		$back = json_decode($this->curl_api($this->wx_url."apiJsTicket",$find),true);

		$ticket=$back['data'];
		$timestamp=time();

		$str = 'abcdefghijklnmopqrstwvuxyz1234567890ABCDEFGHIJKLNMOPQRSTWVUXYZ';
		$nonceStr='';
		for($i=0;$i<16;$i++){
			$num = mt_rand(0,61);
			$nonceStr .= $str[$num];
		}

		$url ="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$key ="jsapi_ticket=$ticket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
		$data['ticket'] =$back['data'];
		$data['signature'] =sha1($key);
		$data['timestamp']=$timestamp;
		$data['nonceStr'] =$nonceStr;
		$data['url'] =$url;

		//
		//$data = I('get.js');

		$this->assign('openId',$openId);
		$this->assign('Js',$data);
		$this->assign('answerApi_url',U('Home/Index/answerApi'));
		$this->assign('on_url',U('public/img/on.png'));
		$this->assign('questionApi_url',U('Home/Index/questionApi'));
		$this->assign('rank_url',U('Home/Index/rankTop'));
		$this->display();

	}
	
	public function rankTop(){
		$now = (int)date('d');
		$select = D('reply')->join('`wx_user` on wx_user.wx_id = reply.wx_id')->where("reply.whichDay = $now")->field('wx_user.name')->order('reply.grade desc')->limit(5)->select();
		$this->ajaxReturn(array('data'=>$select));
	}
	
    private function setIn($src=''){
		
		$n=1;

       $handle = fopen("http://localhost:63342/Game-For-15-Years/public/data/$n.txt", 'r');
	   $i=0; 
	   $db = D("question$n");
	   $chose=array(
			2=>'ans_A',
			3=>'ans_B',
			4=>'ans_C',
			5=>'ans_D',
	   );
		while(!feof($handle)){
			if($content = trim(fgets($handle, 1024))){
				
				$i++;
				if($i==1){
					$arr = preg_split( "/[\s]+/", $content );
					$data['question'] = $arr[0];
					if(trim($arr[1])=='A'){
						$tmp = 1;
					}else if(trim($arr[1])=='B'){
						$tmp = 2;			
					}else if(trim($arr[1])=='C'){
						$tmp = 3;
					}else if(trim($arr[1])=='D'){
						$tmp = 4;
					}else{
						$tmp = 5;
					}
					$data['true_ans'] = $tmp;
				}else{
					$feld = $chose[$i];
					$data["$feld"] = $content;
				}
			}
			
			if($i==5){
				$feld = $chose[$i];
				$data["$feld"] = $content;
				print_r($data);
				echo '<br/>';
				$db->add($data);
				$i=0;
			}
		}
		fclose($handle);
		
		echo 'OK';

    }
	
	public function checkTime(){
		$now = date("H");
		/*if($now>=22||$now<=7) {
			$result = array( 'nowTime' => $now . "时", 'status' => 707, 'info' => '本游戏只在8点-22点开放' );
			$this->ajaxReturn($result);
		}*/
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if (strpos($user_agent, 'MicroMessenger') === false) {
			// 非微信浏览器禁止浏览
			$this->ajaxReturn(array('请使用微信打开'));
		}
	}

	
	public function	questionApi(){
		//$this->checkTime();
		$data = array(
					'data'=>"您访问的页面不存在",
					'status' => 404
		);
				
		if( 
			(I('post.type')== 'getContent')
			&&
			(I('post.key') == md5('cqupt_question'))  //密文:86b4359bdfdefb5b21d6260476087062
		){
			$data = array(
					'data' => '数据异常',
					'status' => 444,
			);
			$return_table = "question1";
			$star = ((int)date("d")-$this->starDay)*5;//*********************************************

			if($db_data = (D($return_table)->field('qid,question,ans_A,ans_B,ans_C,ans_D,true_ans')->limit($star,5)->select())){
				$data = array(
					'data' => $db_data,
					'status' => 200,
				);
			}
		}
		$this->ajaxReturn($data);
	}
	
	public function	answerApi(){
		//$this->checkTime();
		$data = array(
					'data'=>"您访问的页面不存在",
					'status' => 404
		);
				
		if(
			(I('post.type')== 'getGrade')
			&&
			(I('post.key') == md5('cqupt_question'))  //密文:86b4359bdfdefb5b21d6260476087062
			&&
			($grade = I('post.grade','',0))
			&&
			($openId = I('post.openId'))/*微信openid*/		
		){
		    $u['wx_id']= $openId;

			if(D('wx_user')->where("wx_id='$openId'")->find()){

			}else{
				$this->addUser($openId);//?
			}

			
			/*跟新reply成绩,比原来高就覆盖*/
			$add= array(
				'wx_id' => $openId,
				'whichDay' => (int)date("d"),
				'grade' => $grade,

			);
			$whichDay = (int)date("d");

			if($check = D('reply')->where("wx_id='$openId' and whichDay=$whichDay")->find()){
				if($this->checkShare($openId,$check['times'])<=0){
					$this->ajaxReturn(array('status'=>0,'info'=>'wrong'));
				}

				$add['times'] =$check['times']+1;
				if($check['grade']>$add['grade']){
					$add['grade']= $check['grade'];
					$add['askTime']= time();
				}
				
				D('reply')->where("wx_id='$openId' and whichDay=$whichDay")->save($add);
			}else{
				$add= array(
					'wx_id' => $openId,
					'whichDay' => (int)date("d"),
					'grade' => $grade,
					'askTime'=> time(),
					'times' => 1,
				);
				D('reply')->where("wx_id='$openId' and whichDay=$whichDay")->add($add);
			}
			
			/*跟新用户总成绩*/

			$save['joinDays'] = D('reply')->where("wx_id='$openId'")->count();
			
			D('wx_user')->where("wx_id='$openId'")->save($save);
			
			/*回复称号*/

			if(1){
				$rankNum = D('reply')->where("grade>$grade and whichDay=$whichDay")->count();
				$data = array(
						'rank' => $rankNum+1,
						'grade' => $grade,
						'status' => 200
				);
			}else{
				$data = array(
						'info' => '操作非法',
						'status' => 0
				);
			}
		}

		$this->ajaxReturn($data);
	}

	private function checkShare($openId,$time)
	{
		$shareDay = (int)date("d");
		if (
		($tmp = D('share')->where("wx_id='$openId' and shareDay = $shareDay ")->find())
		) {
			$top = 2;
		} else {
			$top = 1;
		}

		$data = array(
			'status' => 101,
			'info'   => '已到答题上限。',
		);

		if ($time > $top) {
			$this->ajaxReturn($data);
		} else {
			return ($top - $time);
		}

	}


	public function prizeApi(){
		if($openId = I('post.openId'))	{
			$data['data']=D('gift')->where("wx_id='$openId'")->select();
			$this->ajaxReturn($data);
		}
	}

	public function checkJoin(){
		$whichDay=(int)date('d');
		if(
			(I('post.key') == md5('cqupt_question'))  //密文:86b4359bdfdefb5b21d6260476087062
			&&
			($openId = I('post.openId'))/*微信openid*/
		) {
			if ($check = D('reply')->where("wx_id='$openId' and whichDay=$whichDay")->find()) {
				$t = $this->checkShare($openId, $check['times']);
			}else{
				$t = $this->checkShare($openId, 0);
			}

			$this->ajaxReturn(array('status'=>200,'rest'=>$t));
		}
	}

	public function shareApi(){
		$whichDay=(int)date('d');
		if(
			(I('post.key') == md5('cqupt_question'))  //密文:86b4359bdfdefb5b21d6260476087062
			&&
			($openId = I('post.openId'))/*微信openid*/
		) {
			$data['wx_id']=$openId;
			$data['shareDay']=date('d');
			if(D('share')->add($data)){
				$return['status']=200;
			}else{
				$return['status']=0;
			}

			$this->ajaxReturn($return);
		}
	}
	
	private function backUserInfo($openId){
		$time=time();
		$str = 'abcdefghijklnmopqrstwvuxyz1234567890ABCDEFGHIJKLNMOPQRSTWVUXYZ';
		$string='';
		for($i=0;$i<16;$i++){
			$num = mt_rand(0,61);
			$string .= $str[$num];
		}
		$secret =sha1(sha1($time).md5($string)."redrock");
		$web=$this->wx_url.'userInfo';
		$data=array(
			'timestamp'=>$time,
			'string'=>$string,
			'secret'=>$secret,
			'token'=>$this->acess_token,
			'openid'=>$openId,
		);
		$information=$this->curl_api($web,$data);
		
		$tmp = json_decode($information,true);
		return $tmp;
	}
	
	public function addUser($openId){
		$tmp=$this->backUserInfo($openId);
		$add = array(
			'wx_id'=>$tmp['data']['openid'],
			'name'=>$tmp['data']['nickname'],
			'img_src'=>$tmp['data']['headimgurl'],
			'sex'=>$tmp['data']['sex'],
		);
		
		D('wx_user')->add($add);
	}
	
	/*curl通用函数*/
	private function curl_api($web,$post=''){
		header('Content-Type:application/json; charset=utf-8');
		$send="";
		foreach($post as $p=>$value){
			
			$send .= '&'.$p."=".$value;
		}
		$curlPost = $send;
		// 初始化一个curl对象	
		$curl = curl_init();

		// 设置url
		curl_setopt($curl,CURLOPT_URL,$web);

		// 设置参数，输出或否
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

		//数据
		curl_setopt($curl,CURLOPT_POSTFIELDS,$curlPost);

		// 运行curl，获取网页。
		$contents = curl_exec($curl);
		// 关闭请求
		curl_close($curl);
		return $contents;
	}
	
	public function userInfo(){
		$data = array(
					'data'=>"您访问的页面不存在",
					'status' => 404
		);
				
		if(
			(I('post.key') == md5('cqupt_question'))  //密文:86b4359bdfdefb5b21d6260476087062
			&&
			($openId = I('post.openId','1'))/*微信openid*/	
			&&
			($type = I('post.type'))			
		){
			switch($type){
				case 'rankAll':
					$tmp = D('wx_user')->field('name,allGrade,avgGrade')->order('avgGrade desc')->limit(10)->select();
					$data = array(
						'data'=>$tmp,
						'status' => 200
					);
					break;
					
				case 'userInfo':
				    $tmp =D('reply')->field('que_type,rightNum,grade')->where("wx_id='$openId'")->select();
					unset($data['data']);
					$data['status']=200;
					foreach($tmp as $key => $value){
						$data['data'][] = $value;
					}
					$tmp = D('wx_user')->where("wx_id='$openId'")->find();
					$data['userInfo'] = $tmp;
					break;
					
				default:
					break;
			}
			
			
		}
		$this->ajaxReturn($data);
	}

	public function  add(){
		header("Content-type:text/html;charset=utf-8");
		$now = date('d')-1;
		$select = D('reply')->join('`wx_user` on wx_user.wx_id = reply.wx_id')->where("reply.whichDay = $now")->order('reply.grade desc')->limit(5)->select();

		$this->assign('now',$now);
		$this->assign('rank',$select);
		$this->assign('giftUrl',U('Home/Index/addGift'));
		$this->display('add');
	}

	public function addGift()
	{

		header("Content-type:text/html;charset=utf-8");
		if(I('post.change') != date('Ymd').'prize') exit(	'非法');
		$post  = I('post.');
		$table = D('gift');
		for ($i = 1; $i <= 5; $i++) {
			$array['wx_id'] = $post['id' . $i];
			$array['kl']    = $post['key' . $i];
			$array['date']  = date('Y-m-d');
			$array['pri']   = $post['pri' . $i];

			$table->add($array);
			$table->save($array);
		}

		print_r($post);
		echo '添加成功';
	}
}




