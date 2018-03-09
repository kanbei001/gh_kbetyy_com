<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller{
	
public function sms(){
@session_start();
header("Content-type:text/html; charset=UTF-8");
function Post($curlPost,$url){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_NOBODY, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
		$return_str = curl_exec($curl);
		curl_close($curl);
		return $return_str;
}

function xml_to_array($xml){
	$reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
	if(preg_match_all($reg, $xml, $matches)){
		$count = count($matches[0]);
		for($i = 0; $i < $count; $i++){
		$subxml= $matches[2][$i];
		$key = $matches[1][$i];
			if(preg_match( $reg, $subxml )){
				$arr[$key] = xml_to_array( $subxml );
			}else{
				$arr[$key] = $subxml;
			}
		}
	}
	return $arr;
}

function random($length = 6 , $numeric = 0) {
	PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
	if($numeric) {
		$hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
	} else {
		$hash = '';
		$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
		$max = strlen($chars) - 1;
		for($i = 0; $i < $length; $i++) {
			$hash .= $chars[mt_rand(0, $max)];
		}
	}
	return $hash;
}

$target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";

$mobile = $_POST['mobile'];

$send_code = $_POST['send_code'];

$mobile_code = random(4,1);
if(empty($mobile)){
	exit('手机号码不能为空');
}

if(empty($_SESSION['send_code']) or $send_code!=$_SESSION['send_code']){
	exit('请求超时，请刷新页面后重试');
}

$post_data = "account=cf_13372685510&password=y123456&mobile=".$mobile."&content=".rawurlencode("您的动态码是：".$mobile_code."。请不要把动态码泄露给其他人。如非本人操作，可不用理会！");
$gets =  xml_to_array(Post($post_data, $target));
if($gets['SubmitResult']['code']==2){
	$_SESSION['mobile'] = $mobile;
	$_SESSION['mobile_code'] = $mobile_code;
}
echo $gets['SubmitResult']['msg'];
	}
	
	 public function ckphone_ajax(){
		 
		 $name=I('post.name');
		 $phone=I('post.mobile');
		 $phoneinfo=M('user')->where(array('phone'=>$phone,'name'=>$name))->find();
		 if($phoneinfo){
			 
			 $success=1; 
			 
			 }else{
				 
			$success=0;

				 }
		 
		 
		$result = array('success' =>$success);
		
        echo json_encode($result);

		 }
	
	
	
	
public function login_ajax(){
		$name=I('post.username');
		$password=I('post.password');
		//$mobile=I('post.mobile');
		//$mobile_code=I('post.mobile_code');	  
        $db = M('user');
		$where = array('name' =>$name);
		$field = array('id', 'name', 'password,m_id');
		$user = $db->where($where)->field($field)->find();
		if (!$user || $user['password'] != md5($password)) {
			
			$varone=0;
			
		}else{
			
			$varone=1;
			
			}
//		if($mobile!=$_SESSION['mobile'] or $mobile_code!=$_SESSION['mobile_code'] or empty($mobile) or empty($mobile_code))
//		{
//			
//			$vartwo=0;
//	
//		
//		
//		}else{
			$vartwo=1;
//	
//			
//			}
 // $vartwo=1;
	//   $ipresult=check_ip(get_client_ip());
	//   $vartthrees=get_client_ip();
 //     if($ipresult||$user['m_id']==1){
	 	$vartthree=1;
	//  }else{
	// 	$vartthree=0;
	//  }

		 
		
	if($varone && $vartwo && $vartthree){
		
		$varfour=1;
		
		session('uid', $user['id']);
		session('username', $user['name']);
		session('m_id',$user['m_id']);
		session('juese', roles($user['m_id']));
		}else{
			
		$varfour=0;
			}

		$result = array('varone' =>$varone,'vartwo' =>$vartwo,'vartthree' =>$vartthree,'vartthrees' =>$vartthrees,'varfour' =>$varfour);
		
        echo json_encode($result);			
			
			
			
			
	}
	
	
	
	
/*	  public function login(){
	  if (!IS_POST) E('非法提交！');
        $db = M('user');
		$where = array('name' =>I('post.username'));
		
		$field = array('id', 'name', 'password,m_id');
		$user = $db->where($where)->field($field)->find();
	
		if (!$user || $user['password'] != md5(I('post.password'))) {
			$this->error('帐号或密码错误');
		}else{
		session('uid', $user['id']);
		session('username', $user['name']);
		session('m_id',$user['m_id']);
		session('juese', roles($user['m_id']));
		$this->redirect('Index/index');
			
			}
		   
				   
    }*/
		
	
    public function index(){
 
	if(!session('uid') && !session('username') ){
	function random($length = 6 , $numeric = 0) {
	PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
	if($numeric) {
		$hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
	} else {
		$hash = '';
		$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
		$max = strlen($chars) - 1;
		for($i = 0; $i < $length; $i++) {
			$hash .= $chars[mt_rand(0, $max)];
		}
	}
	return $hash;
}
session('send_code', random(6,1));

$telinfo=M('Tel')->select();
        foreach ($telinfo as $v){
			
			$phonearr[]=$v['phone'];
			
			}
	
			$usertellist=(json_encode($phonearr));
			
		
			
			$this->assign('usertellist',$usertellist);
			$this->display();
			
			}else{
			$this->redirect('Index/index');
				
				}

	}
}