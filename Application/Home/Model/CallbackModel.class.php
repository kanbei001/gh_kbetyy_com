<?php
namespace Home\Model;
use Think\Model;
class CallbackModel extends Model {
	 function getWhere($data){
	 	$str = 1;
		$str_1= $str;
		$str2 = 1;
		$str_2= $str2;
	 	 //预约时间
	 	if($data['btn']==1){
	 		switch ($data['date']) {
	 			case -1:   //上月  
	 			    $last_month = date('Y-m', strtotime('last month'));
					$last_in = $last_month . '-01';
					$last_end = date('Y-m-d', strtotime("$last_month +1 month -1 day"));
					$last_in2 = strtotime($last_month . '-01 00:00:00');
                    $last_end2 = strtotime("$last_month +1 month -1 day +23 hours +59 minutes +59 seconds");
					$str_1 = $str .= "&&time >= '".$last_in."' &&time <='".$last_end."'";
					$str_2 = $str2 .= " && senddate>='".$last_in2."' && senddate<='".$last_end2."'";
					break;
				case 0:   //本月  
					$first = date("Y-m")."-01";
	                $end = date("Y-m")."-".date("t");
					$str_1 = $str .= "&&time >= '".$first."' &&time <='".$end."'";
					$str_2 = $str2 .= " && senddate>='".strtotime($first . ' 00:00:00')."' && senddate<='".strtotime($end . ' 23:59:59')."'";
					break;
				case 1:   //本周
				    $sdefaultDate = date("Y-m-d"); 
					$first=1; 
					$w=date('w',strtotime($sdefaultDate)); 
					$week_start=date('Y-m-d',strtotime("$sdefaultDate -".($w ? $w - $first : 6).' days')); 
					$week_end=date('Y-m-d',strtotime("$week_start +6 days"));
					$str_1 = $str .= "&&time >= '".$week_start."' &&time <='".$week_end."'";
					$str_2 = $str2 .= " && senddate>='".strtotime($week_start . ' 00:00:00')."' && senddate<='".strtotime($week_end . ' 23:59:59')."'";
					break;
				case 2:   //昨天
				    $zt = date("Y-m-d",strtotime("-1 day"));
				    $str_1 = $str .= "&&time ='".$zt."'";
				    $str_2 = $str2 .= " && senddate>='".strtotime($zt.' 00:00:00')."' && senddate<='".strtotime($zt.' 23:59:59')."'";
					break;
				case 3:   //今天
					$str_1 = $str .= "&&time ='".date("Y-m-d")."'";
					$str_2 = $str2 .= " && senddate>='".strtotime(date("Y-m-d").' 00:00:00')."' && senddate<='".strtotime(date("Y-m-d").' 23:59:59')."'";
					break;
				case 4:   //明天
				    $min = date("Y-m-d",strtotime("+1 day"));
					$str_1 = $str .= "&&time ='".$min."'";
					$str_2 = $str2 .= " && senddate>='".strtotime($min.' 00:00:00')."' && senddate<='".strtotime($min.' 23:59:59')."'";
					break;
			}
	 	}else{
	 		//预约时间
	 		if($data['yy_in_strat'] != '' && $data['yy_end_strat']!= '') {
				$str_1 = $str .= " && time>='".$data['yy_in_strat']."' && time<='".$data['yy_end_strat']."'";
			} elseif($data['yy_in_strat'] != '') {
				$str_1 = $str .= " && time>='".$data['yy_in_strat']."' && time<='".date('Y-m-d',time())."'";
			}
			//回访时间
			if($data['hf_in_strat'] != '' && $data['hf_end_strat']!= '') {
	        	$start_time=strtotime($data['hf_in_strat']." 00:00:00");
				$end_time= strtotime($data['hf_end_strat']." 23:59:59");
				$str_2 = $str2 .= " && senddate>='".$start_time."' && senddate<='".$end_time."'";
			} elseif($data['hf_in_strat'] != '') {
				$start_time=strtotime($data['hf_in_strat']." 00:00:00");
				$str_2 = $str2 .= " && senddate>='".$start_time."' && senddate<='".time()."'";
			}
	 	}
		
		//回访时间
//		if($in_time != '' || $end_time!= '') {
//			if($in_time != '' && $end_time!= '') {
//				$date    = strtotime($end_time );
//				$time_in = date( 'Y-m-d', $date + 1 * 24 * 60 * 60);
//				$start_time=strtotime($in_time);
//				$end_time= strtotime($end_time )+86399;
//				$str_1   = $str .= " && senddate>=$start_time && senddate<=$end_time";
//			    $str_2   = $str2 .= " && huifang_time>=$start_time && huifang_time<=$end_time";
//			} elseif($in_time!= '') {
//				$date_end =time();
//				$str_1    = $str .= " && senddate>=$start_time && senddate<=$date_end";
//				$str_2    = $str2 .= " && huifang_time>=$start_time && huifang_time<=$date_end";
//			}
//		}
        
        //回访状态
		if($data['huifang'] !=0) {
			$str_2 = $str2 .= " && cid='".$data['huifang']."'";
			$Callbackinfo = M('Callback')->where(array('id' => $data['huifang']))->find();
			$str_1 = $str .= " && huifang='".$Callbackinfo['callback_name'] . "'";
		}
		//来院状态		
		if($data['huifang']!=0){
			$str_1 = $str .= " && laiyuan='".$data['huifang']. "'";
		}
		//咨询员
		if($data['chakan']!=0) {
			$Userinfo     = M('User')->where(array('id' => $data['chakan']))->find();
			$str_1 = $str .= " && type_in='".$Userinfo['name']. "'";
			$str_2 = $str2 .= " && writer='".$Userinfo['name']. "'";
		}
		return $where = array($str_1,$str_2);
	 }
	function getHflink($date){
		switch ($date) {
			case -1:   //上月  
			    $link= '/index.php/Callback/jianbao/info/sywhf_weidao.html'; //未回访记录链接
				break;
			case 0:   //本月  
			    $link= '/index.php/Callback/jianbao/info/bywhf_weidao.html'; //未回访记录链接
				break;
			case 1:   //本周
			    $link= '/index.php/Callback/jianbao/info/yzwhf_weidao.html'; //未回访记录链接
				break;
			case 2:   //昨天
				$link= '/index.php/Callback/jianbao/info/ztwhf_weidao.html'; //未回访记录链接
				break;
			case 3:   //今天
				$link= '/index.php/Callback/jianbao/info/jtwhf_weidao.html'; //未回访记录链接
				break;
			case 4:   //明天
				$link= '/index.php/Callback/jianbao/info/mtwhf_weidao.html'; //未回访记录链接
				break;
		}
		return $link;
	}
 }
 
 
 ?>