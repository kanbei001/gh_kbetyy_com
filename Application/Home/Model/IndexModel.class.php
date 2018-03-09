<?php
namespace Home\Model;
use Think\Model;
class IndexModel extends Model {
	 // 设置完整的数据表（包含前缀）
    protected $trueTableName  = 'bk_kefuinfo';
    /**********************************************************公用函数*********************************************************************/
	 /**
     * 处理序列化的数组
     */ 
    function SetData($datas){
     	foreach($datas as $val){
			  $data[$val['name']] = $val['value'];
		  }
		return $data;
    }
	
	/**********************************************************【】    首页    【】*********************************************/
	/**
	 * 获取各天各种情况的数据
	 */
	function getIndexArr($DAYLIST,$DAYACT,$str=''){
		$arr = array();
		foreach($DAYLIST as $day){ 
			foreach($DAYACT as $act){ 
				$sql = getJianSqls($day.'_'.$act,'sql2');
				if($sql){
					$arr[$day.'_'.$act]=M('Kefuinfo')->where("1".$str.$sql)->count();
				}
			}
			if($arr[$day.'_yidao']){
				$ycf=$arr[$day.'_yidao']/$arr[$day.'_yudao']; 
		        $arr[$day.'_bfb']=(round($ycf,2)*100)."%";
			}
		}
		return $arr;
	}
	/*****************************************************************【】  预约管理 【】********************************************************************/
    /**
     * 模糊搜索
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
	function getmohuSql($data){  
		 $map= '';
         if($data['mohu'] != ''){
				$map .= " && ( yuyue like'%".$data['mohu']."%' ";
				$map .= " or username like'%".$data['mohu']."%'";
				$map .= " or phone like '%".$data['mohu']."%'";
				$map .= " or qq like '%".$data['mohu']."%')";
		}
		if($data['laiyuan'] !='-请选择-') $map .= " && laiyuan = '".$data['laiyuan']."' ";  // 判断来院是否为空
		$map .= timeSql($data['type_in_strat'],$data['type_in_end'],'in_time',0);  //录入时间
		//判断咨询员是否为空
		if($data['chakan'] !=0) {
			 $Userinfo     = M('User')->where(array('id' => $data['chakan']))->find();
			 $map .= " && type_in='" . $Userinfo['name'] . "'";
		}else{
			if(session('m_id')==1){
			    $hfgroup=M('User')->where(array('m_id' => array('IN',array(2,3,5))))->select();	
			}else{
			    $hfgroup=M('User')->where(array('m_id' => array('IN',array(2,3))))->select();		
			}
			foreach($hfgroup as $hfv){
				 $hfname.="'".$hfv['name']."'".',';
			}
			$hfstr=substr($hfname, 0, -1);
			$other = ",'杨馨蕊','毛俊会','周玉慧'";
		     $map .= "&& type_in in($hfstr $other)";
		}
        return $map;
	}

	/**
	 * 获取时间按钮的链接
	 */
	function getClickLink($date){ 
		switch ($date) {
			case "-1":   //上月  
			    $arr['yy_link']= '/index.php/Index/jianbao/info/lastmonth_add.html'; //预约记录链接
				$arr['yyshi_link']= '/index.php/Index/jianbao/info/lastmonth_yidao.html';  //来院记录链接
				$arr['yyfou_link']='/index.php/Index/jianbao/info/lastmonth_weidao.html';  //未到记录链接
				break;
			case 0:   //本月  
			    $arr['yy_link']= '/index.php/Index/jianbao/info/month_add.html'; //预约记录链接
				$arr['yyshi_link']= '/index.php/Index/jianbao/info/month_yidao.html';  //来院记录链接
				$arr['yyfou_link']='/index.php/Index/jianbao/info/month_weidao.html';  //未到记录链接
				break;
			case 1:   //本周
				$arr['yy_link']= '/index.php/Index/jianbao/info/week_add.html'; //预约记录链接
				$arr['yyshi_link']= '/index.php/Index/jianbao/info/week_yidao.html';  //来院记录链接
				$arr['yyfou_link']='/index.php/Index/jianbao/info/week_weidao.html';  //未到记录链接
				break;
			case 2:   //昨天
				$arr['yy_link']= '/index.php/Index/jianbao/info/yesterday_add.html'; //预约记录链接
				$arr['yyshi_link']= '/index.php/Index/jianbao/info/yesterday_yidao.html';  //来院记录链接
				$arr['yyfou_link']='/index.php/Index/jianbao/info/yesterday_weidao.html';  //未到记录链接
				break;
			case 3:   //今天
				$arr['yy_link']= '/index.php/Index/jianbao/info/today_add.html'; //预约记录链接
				$arr['yyshi_link']= '/index.php/Index/jianbao/info/today_yidao.html';  //来院记录链接
				$arr['yyfou_link']='/index.php/Index/jianbao/info/today_weidao.html';  //未到记录链接
				break;
			case 4:   //明天
				$arr['yy_link']= '/index.php/Index/jianbao/info/tomorrow_yudao.html'; //预到记录链接
				break;
		}	
		return $arr;
	}

	function getClickNum($str_1,$str2){ 
		$yy= intval(M('Kefuinfo')->where($str_1." && isorder=1")->count()); //预约记录总数
		$dengji= intval(M('Kefuinfo')->where($str_1." && isorder=0")->count()); //预约记录总数
		if($dengji>0){
		    $arr['yy']="<b>".$yy."</b>+".$dengji." <i style='font-size:12px;color:grey;'>[登记 ]</i>";
		}else{
		    $arr['yy']="<b>".$yy."</b>";
		}
		$luru1= intval(M('Kefuinfo')->where($str2." && isorder=1")->count()); //录入预约记录总数
		$luru2= intval(M('Kefuinfo')->where($str2." && isorder=0")->count()); //录入登记记录总数
		if($luru2>0){
		    $arr['luru']="<b>".$luru1."</b>+".$luru2." <i style='font-size:12px;color:grey;'>[登记 ]</i>";
		}else{
		    $arr['luru']="<b>".$luru1."</b>";
		}
		$arr['yyshi']= intval(M('Kefuinfo')->where($str_1." && isorder=1 && laiyuan='是'")->count()); //来院记录总数
		$arr['yyfou']= intval(M('Kefuinfo')->where($str_1." && isorder=1 && laiyuan='否'")->count()); //未到记录总数
		return $arr;
	}
	
    /*********************************************************************************简报*********************************************/
    
    /**
     * 根据参数条件，获取sql语句
     */
	function GetSql($data){ 
		$sql  = '';
		if($data['yuyue'] != '')    $sql .= "&&yuyue like'%".$data['yuyue']."%'";           
		if($data['username'] != '') $sql .= "&&username like'%".$data['username']."%'";
		if($data['phone'] != '')    $sql .= "&&phone like '%".$data['phone']."%'";
		if($data['qq'] != '')       $sql .= "&&qq like '%".$data['qq']."%'";
		if($data['isorder'] !=9999) $sql .= "&&isorder='".$data['isorder']."'"; //预约或登记
        if($data['laiyuan'] !='-请选择-' && $data['laiyuan'] !='0') $sql .= "&&laiyuan='".$data['laiyuan']."'";  //判断是否来院
        
		$sql .= timeSql($data['type_in_strat'],$data['type_in_end'],'in_time',0);  //录入时间
		$sql .= timeSql($data['yuyue_strat'],$data['yuyue_end'],'time',1);  //预约时间
		$sql .= timeSql($data['laiyuan_strat'],$data['laiyuan_end'],'laiyuan_time',0);  //来院时间
		$sql .= TableSql($data['keshi'],'Section','keshi','section_name');  //科室
		$sql .= setUser($data['chakan']);  //咨询员
		$sql .= TableSql($data['huifang'],'Callback','huifang','callback_name');  //回访
		$sql .= StrTableSql($data['diqu'],'Area','area','area_name');  //地区
		$sql .= StrSql($data['qudaos'],'info_channel');  //渠道
		$sql .= StrTableSql($data['yingxiao'],'Yingxiao','marketing','yingxiao_name');  //营销
		$sql .= StrTableSql($data['zixun'],'Consult','consult','consult_name');  //资讯
		$sql .= StrSql($data['web'],'source_web');  //来源网站
	    return $sql;
	}
		function GetSqls($data){  //新的
		$sql  = '';
		if($data['yuyue'] != '')    $sql .= "&&yuyue like'%".$data['yuyue']."%'";           
		if($data['username'] != '') $sql .= "&&username like'%".$data['username']."%'";
		if($data['phone'] != '')    $sql .= "&&phone like '%".$data['phone']."%'";
		if($data['qq'] != '')       $sql .= "&&qq like '%".$data['qq']."%'";
		if($data['isorder'] !=9999) $sql .= "&&isorder='".$data['isorder']."'"; //预约或登记
        if($data['laiyuan'] !='-请选择-' && $data['laiyuan'] !='0') $sql .= "&&laiyuan='".$data['laiyuan']."'";  //判断是否来院
        
		$sql .= timeSql($data['type_in_strat'],$data['type_in_end'],'in_time',0);  //录入时间
		$sql .= timeSql($data['yuyue_strat'],$data['yuyue_end'],'time',1);  //预约时间
		$sql .= timeSql($data['laiyuan_strat'],$data['laiyuan_end'],'laiyuan_time',0);  //来院时间
		$sql .= TableSql($data['keshi'],'Section','keshi','section_name');  //科室
		$sql .= setUser($data['chakan']);  //咨询员
		$sql .= TableSql($data['huifang'],'Callback','huifang','callback_name');  //回访
		$sql .= StrTableSql($data['area'],'Area','area','area_name');  //地区
		$sql .= StrSql($data['info_channel'],'info_channel');  //渠道
		$sql .= StrTableSql($data['marketing'],'Yingxiao','marketing','yingxiao_name');  //营销
		$sql .= StrTableSql($data['consult'],'Consult','consult','consult_name');  //资讯
		$sql .= StrSql($data['source_web'],'source_web');  //来源网站
	    return $sql;
	}
	/**
     * 根据日期参数条件，获取sql语句
     */
	function GetTimeSql($date){ 
		$sql  = '';
		$sql2  = '';
		switch ($date) {
			case 0:   //本月  
				$sql  .= "&& time >= '".date("Y")."-".date("m")."-01' &&time <='".date("Y")."-".date("m")."-".date("t")."'";
				$sql2 .= "&& in_time >='".C('MONTH_START')."' && in_time <='".C('MONTH_END')."'";
				break;
			case 1:   //本周
				$sql  .= "&& time >= '".date("Y-m-d",C('WEEK_START'))."' &&time <='".date("Y-m-d",C('WEEK_END'))."'"; 
				$sql2 .= "&& in_time >='".C('WEEK_START')."' && in_time <='".C('WEEK_END')."'";
				break;
			case 2:   //昨天
			   $sql  .= "&& time ='".date("Y-m-d",strtotime("-1 day"))."'";
			   $sql2 .= "&& in_time >='".C('YESTERDAY_START')."' && in_time <='".C('YESTERDAY_END')."'";
				break;
			case 3:   //今天
				$sql  .= "&& time ='".date("Y-m-d")."'";
				$sql2 .= "&& in_time >='".C('TODAY_START')."' && in_time <='".C('TODAY_END')."'";
				break;
			case 4:   //明天
				$sql .= "&& time ='".date("Y-m-d",strtotime("+1 day"))."'";
				break;
		}
	    return array('sql'=>$sql,'sql2'=>$sql2);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/**
	 * 处理数组
	 */
	function getData($datas){
		foreach ($datas as $v){
			if($v['sex'] == '1') {
			    $sex = '男';
			} else if($v['sex'] == '2') {
			   $sex = '女';
			} else {
			   $sex = '';
			}
			if($v['laiyuan'] =='是') {
			   $comed ="<span  style='color:green;'>√</span>";
			} else{
			   $comed ="<span  style='color:red;'>×</span>";
			}
			
			if($v['isorder'] ==1) {
			   $order = "<span rel='1' style='color:green;'>√</span>";
			} else{
			   $order = "<span rel='0' style='color:red;cursor:pointer;'>×</span>";
			}
			$Qdinfo=M('Qudaoinfo')->where(array('id'=>$v['info_channel']))->find();
			$info_channel=$Qdinfo['info_name'];
			
			$Webinfo=M('Web')->where(array('id'=>$v['source_web']))->find();
			$source_web=$Webinfo['web_name'];
			
			$in_time=date('Y-m-d',$v['in_time']); 
			
			$laiyuan_time= $v['laiyuan_time']? date('Y-m-d H:i:s',$v['laiyuan_time']):"---";
			$str[]= array( 
				'id' => $v['id'], 
				'yuyue' => $v['yuyue'],
				'username'=>$v['username'],
				'sex' => $sex, 
				'area' => $v['area'],
				'age' => $v['age'],
				'phone'=>$v['phone'],
				'qq'=>$v['qq'],
				'keshi'=>$v['keshi'],
				'bingzhong'=> $v['bingzhong'],
				'bingzheng'=> $v['bingzheng'],
				'remark'=> $v['remark'],
				'consult'=>$v['consult'],
				'info_channel'=>$info_channel,
				'marketing'=>$v['marketing'],
				'source_web'=>$source_web,
				'source_url'=>$v['source_url'],
				'keyword'=>$v['keyword'],
				'type_in'=>$v['type_in'],
				'isorder'=>$order,
				'comed'=>$comed,
				'isordernum'=>$v['isorder'],
				'time'=>$v['time'],
				'in_time'=>$in_time,
				'doctor'=>$v['doctor'],
				'laiyuan'=>$v['laiyuan'],
				'huifang'=>$v['huifang'],
				'laiyuan_time'=>$laiyuan_time,
				'qudao_group_id'=>$v['qudao_group_id'],
			);
		}
		return $str;
	}
	/**
	 * 处理数组
	 */
	function getDatas($datas){
		foreach ($datas as $v){
			$Qdinfo=M('Qudaoinfo')->where(array('id'=>$v['info_channel']))->find();
			$info_channel=$Qdinfo['info_name'];
			
			$Webinfo=M('Web')->where(array('id'=>$v['source_web']))->find();
			$source_web=$Webinfo['web_name'];

			$hfhistory=$v['remark']."\r\n";
	        $visitlist=M('Visit')->where(array('aid' =>$v['id']))->order('id desc')->select();
		    foreach($visitlist as $vi){
				$time=$vi['writer'].":".date('Y-m-d H:i:s',$vi['senddate']);
				$hfhistory.=$time."&nbsp;>>&nbsp;".$vi['description']."\r\n";
			}

			$str[]= array( 
				'id' => $v['id'], 
				'yuyue' => $v['yuyue'],
				'username'=>$v['username'],
				'sex' => $v['sex'], 
				'area' => $v['area'],
				'age' => $v['age'],
				'phone'=>$v['phone'],
				'qq'=>$v['qq']?$v['qq']:'- - -',
				'keshi'=>$v['keshi'],
				'bingzhong'=> $v['bingzhong'],
				'bingzheng'=> $v['bingzheng'],
				'remark'=> $v['remark'],
				'consult'=>$v['consult'],
				'info_channel'=>$info_channel,
				'marketing'=>$v['marketing'],
				'source_web'=>$source_web,
				'source_url'=>$v['source_url'],
				'keyword'=>$v['keyword'],
				'type_in'=>$v['type_in'],
				'isorder'=>$v['isorder'],
				'isordernum'=>$v['isorder'],
				'time'=>$v['time'],
				'remark'=>$hfhistory,
				'in_time'=>date('Y-m-d H:i',$v['in_time']),
				'doctor'=>$v['doctor']?$v['doctor']:'- - -',
				'laiyuan'=>$v['laiyuan'],
				'huifang'=>$v['huifang'],
				'laiyuan_time'=>$v['laiyuan_time']? date('Y-m-d H:i',$v['laiyuan_time']):"- - -",
				'qudao_group_id'=>$v['qudao_group_id']
			);
		}
		return $str;
	}
	
	
	/*********************************************************************  导医   *****************************************************************/
	
	/**
	 * 获取导医列表搜索sql
	 */
	function getDySearchSql($data){
		$str          = 1;
		$str_1        = $str;
	    if(ismobile()){   
			if($data['date'] == 4){  //明天
			     $str_1 = $str .= "&&time = '".date("Y-m-d",strtotime("+1 day"))."'";
			}else if($data['date'] == 5){   //后天
			  	 $str_1 = $str .= "&&time = '".date("Y-m-d",strtotime("+2 day"))."'";
			}else if($data['date'] == 3){   //今天
			   	$str_1 = $str .= "&&time = '".date("Y-m-d")."'";
			}else{   //本月
				$str_1 = $str .= "&&time >= '".date("Y")."-".date("m")."-01' &&time <='".date("Y")."-".date("m")."-".date("t")."'";
			}
			if($data['words'] != ''){
				$str_1 = $str .= "&&yuyue like'%".$data['words']."%' ";
				$str_1 = $str .= "or username like'%".$data['words']."%'";
				$str_1 = $str .= "or phone like '%".$data['words']."%'";
			}
			
		}else{
			//判断预约号是否为空
			if($data['yuyue'] != '')  $str_1 = $str .= "&&yuyue like'%".$data['yuyue']."%'";
			//判断用户名是否为空
			if($data['username'] != '')  $str_1 = $str .= "&&username like'%".$data['username']."%'";
			//判断电话是否为空
			if($data['phone'] != '')  $str_1 = $str .= "&&phone like '%".$data['phone']."%'";
		  //显示三天的数据
			$date=date("Y-m-d",time());
			$date1=strtotime($date);
			$time_in = date('Y-m-d',$date1 - 2*24*60*60);   
		  $str_1 = $str .= "&& time >= '".$time_in."' &&  time <= '".$date."'";
		}
        $str_1 = $str .= "&&isorder=1";
        return $str_1;
	}
 }
 


 function getmysql(){
 	  //判断预约号是否为空
		if($yuyue != '')
		$str_1 = $str .= "&&yuyue like'%$yuyue%'";
		//判断用户名是否为空
		if($username != '')
		$str_1 = $str .= "&&username like'%$username%'";
		//判断电话是否为空
		if($phone != '')
		$str_1 = $str .= "&&phone like '%$phone%'";
		//1.判断录入时间是否为空
		if($_POST['in_time'] != '' || $_POST['end_time'] != '') {
		if($_POST['in_time'] != '' && $_POST['end_time'] != '') {
		date_default_timezone_set( "PRC" );
		$date    = strtotime($end_time );
		$time_in = date( 'Y-m-d', $date + 1 * 24 * 60 * 60);
		$str_1   = $str .= "&&in_time>=UNIX_TIMESTAMP('$in_time')&&in_time<=UNIX_TIMESTAMP('$time_in')";
		} elseif($_POST['in_time'] != '') {
		date_default_timezone_set( "PRC" );
		$date_end = date( "Y-m-d H:i:s" );
		$date     = strtotime($in_time );
		$time_in  = date( 'Y-m-d', $date + 1 * 24 * 60 * 60);
		$str_1    = $str .= "&&in_time>=UNIX_TIMESTAMP('$in_time')&&in_time<=UNIX_TIMESTAMP('$date_end')";
		}
		}
		//1.判断预约时间是否为空
		if($yuyue_time != '' || $end_yuyue != '') {
		if($yuyue_time != '' && $end_yuyue != '') {
		date_default_timezone_set( "PRC" );
		$date    = strtotime($end_yuyue );
		$time_in = date( 'Y-m-d', $date + 1 * 24 * 60 * 60);
		$str_1   = $str .= "&&time>='$yuyue_time'&&time<='$end_yuyue'";
		} else if($yuyue_time != '') {
		date_default_timezone_set( "PRC" );
		$date_end = date( "Y-m-d " );
		$str_1    = $str .= "&&time>='$yuyue_time'";
		}
		}
		//判断来院时间
		if($_POST['laiyuan_star'] != '' || $_POST['laiyuan_end'] != '') {
		if($_POST['laiyuan_star'] != '' && $_POST['laiyuan_end'] != '') {
		date_default_timezone_set( "PRC" );
		$date    = strtotime($laiyuan_end );
		$time_in = date( 'Y-m-d', $date + 1 * 24 * 60 * 60);
		$str_1   = $str .= "&&laiyuan_time>=UNIX_TIMESTAMP('$laiyuan_star')&&laiyuan_time<=UNIX_TIMESTAMP('$time_in')";
		} elseif($_POST['laiyuan_star'] != '') {
		date_default_timezone_set( "PRC" );
		$date_end = date( "Y-m-d H:i:s" );
		$date     = strtotime($laiyuan_star );
		$time_in  = date( 'Y-m-d', $date + 1 * 24 * 60 * 60);
		$str_1    = $str .= "&&laiyuan_time>=UNIX_TIMESTAMP('$laiyuan_star')&&laiyuan_time<=UNIX_TIMESTAMP('$date_end')";
		}
		}
		//判断科室是否为空
		if($keshi !=0) {
		$Sectioninfo = M('Section')->where(array('id' => $keshi))->find();
		$keshi_name  = "keshi='" . $Sectioninfo['section_name'] . "'";
		$str_1       = $str .= "&&($keshi_name)";
		}
		//1.判断来院是否为空
		if($laiyuan !='-请选择-')
		$str_1 = $str .= "&&laiyuan='$laiyuan'";
		//判断咨询员是否为空
		if($chakan !=0) {
		$Userinfo     = M('User')->where(array('id' => $chakan))->find();
		$type_in_name = "type_in='" . $Userinfo['name'] . "'";
		$str_1        = $str .= "&&($type_in_name)";
		}else{
			
		
		if(session('m_id')==1){
		 $hfgroup=M('User')->where(array('m_id' => array('IN',array(2,3,5))))->select();	
			
			}else{
				
			 $hfgroup=M('User')->where(array('m_id' => array('IN',array(2,3))))->select();		
				}
		
		 
		 foreach($hfgroup as $hfv){
			 
			 $hfname.="'".$hfv['name']."'".',';
			 
			 }
		$hfstr=substr($hfname, 0, -1);
		
	    $str_1 = $str .= "&& type_in in($hfstr)";

			}
		
		
		
		
		
		//判断qq是否为空
		if($qq != '')
		$str_1 = $str .= "&&qq like '%$qq%'";
		
		//判断回访是否为空
		if($huifang !=0) {
		$Callbackinfo = M('Callback')->where(array('id' => $huifang))->find();
		$huifang_name = "huifang='" . $Callbackinfo['callback_name'] . "'";
		$str_1        = $str .= "&&($huifang_name)";
		}
		//判断预约情况是否为空
		if($isorder !=9999) {
        $str_1 = $str .= "&&isorder='$isorder'";
		}
		//判断地区是否为空
		if($diqu !=0) {
		$str_diqu    = "," . $diqu;
		$arr_diqu[ ] = explode( ",", $str_diqu );
		$diqu_id     = $arr_diqu[ 0 ][ 1 ];
		$Areainfo    = M('Area')->where(array('id' => $diqu_id))->find();
		$diqu_name   = "area='" . $Areainfo['area_name'] . "'";
		foreach($arr_diqu as $key => $val ) {
		for($i = 1; $i < count($val ) - 1; $i++ ) {
		$Areainfos = M('Area')->where(array('id' => $val[ $i + 1 ]))->find();
		$diqu_name .= "  or area= '" . $Areainfos['area_name'] . "'";
		}
		}
		$str_1 = $str .= "&&($diqu_name)";
		}
		//判断渠道是否为空
		if($qudaos !=0) {
		$str_qudao    = "," . $qudaos;
		$arr_qudao[ ] = explode( ",", $str_qudao );
		$qudao_id     = $arr_qudao[ 0 ][ 1 ];
		$qudao_name   = "info_channel=" . $qudao_id;
		foreach($arr_qudao as $key => $val ) {
		for($i = 1; $i < count($val ) - 1; $i++ ) {
		$qudao_name .= "  or info_channel= " . $val[ $i + 1 ];
		}
		}
		$str_1 = $str .= "&&($qudao_name)";
		}
		//判断营销是否为空
		if($yingxiao !=0) {
		$str_yingxiao    = "," . $yingxiao;
		$arr_yingxiao[ ] = explode( ",", $str_yingxiao );
		$yingxiao_id     = $arr_yingxiao[ 0 ][ 1 ];
		$Yingxiaoinfo    = M('Yingxiao')->where(array('id' => $yingxiao_id))->find();
		$yingxiao_name   = "marketing='" . $Yingxiaoinfo['yingxiao_name'] . "'";
		foreach($arr_yingxiao as $key => $val ) {
		for($i = 1; $i < count($val ) - 1; $i++ ) {
		$YingxiaoinfoS = M('Yingxiao')->where(array('id' => $val[ $i + 1 ]))->find();
		$yingxiao_name .= "  or marketing= '" . $Yingxiaoinfos['yingxiao_name'] . "'";
		}
		}
		$str_1 = $str .= "&&($yingxiao_name)";
		}
		//判断咨询是否为空
		if($zixun !=0) {
		$str_zixun      = "," . $zixun;
		$arr_consult[ ] = explode( ",", $str_zixun );
		$consult_id     = $arr_consult[ 0 ][ 1 ];
		$Consult        = M('Consult')->where(array('id' => $consult_id))->find();
		$consult_name   = "consult='" . $Consult['consult_name'] . "'";
		foreach($arr_consult as $key => $val ) {
		for($i = 1; $i < count($val ) - 1; $i++ ) {
		$Consults = M('Consult')->where(array('id' => $val[ $i + 1 ]))->find();
		$consult_name .= "  or consult= '" . $Consults['consult_name'] . "'";
		}
		}
		$str_1 = $str .= "&&($consult_name)";
		}
		//判断来源网站是否为空
		if($web !=0) {
		$str_web    = "," . $web;
		$arr_web[ ] = explode( ",", $str_web );
		$web_id     = $arr_web[ 0 ][ 1 ];
		$web_name   = "source_web=" . $web_id;
		foreach($arr_web as $key => $val ) {
		for($i = 1; $i < count($val ) - 1; $i++ ) {
		$web_name .= "  or source_web= " . $val[ $i + 1 ];
		}
		}
		$str_1 = $str .= "&&($web_name)";
		}
 }
 
 ?>