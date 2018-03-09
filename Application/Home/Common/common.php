<?php
 /**
	 * 获取时间键值
	 */
	function getInfokey($info){ 
		$info = "***".$info;  //添加占位符，避免搜索词在0位置出现
		$key = array();
		if(strripos($info,"shangyue"))    $key[0] = -1; //上月
		if(strripos($info,"dangyue"))     $key[0] = 0;  //本月
		if(strripos($info,"lastmonth"))   $key[0] = -1; //上月
		if(strripos($info,"month"))       $key[0] = 0;  //本月
		if(strripos($info,"week")) 		  $key[0] = 1;  //本周
		if(strripos($info,"yesterday"))   $key[0] = 2;  //昨天
		if(strripos($info,"today"))       $key[0] = 3;  //今天
		if(strripos($info,"tomorrow"))    $key[0] = 4;  //明天
		if(strripos($info,"houtian"))     $key[0] = 5;  //后天
		
		if(strripos($info,"add"))         $key[1] = 0; //添加
		if(strripos($info,"dengji"))      $key[1] = 1; //登记
		if(strripos($info,"yy"))          $key[1] = 2; //预约
		if(strripos($info,"yidao"))       $key[1] = 3; //已到
		if(strripos($info,"weidao"))      $key[1] = 4; //未到
		if(strripos($info,"yudao"))       $key[1] = 5; //预到
		return $key;
	}
	
	 /**
     * 处理序列化的数组
     */ 
    function SetData($datas){
     	foreach($datas as $val){
			  $data[$val['name']] = $val['value'];
		  }
		return $data;
    }
    
 /**
  * 获取时间sql
  * @param  [type]  $start 开始时间
  * @param  [type]  $end   结束时间
  * @param  [type]  $filed 时间字段
  * @param  integer $t     字段类型，0：为时间戳，1：为2017-09-17式时间 2：为2017-09-17 15:30:28式时间 
  * @return [type]         [description]
  */
	function timeSql($start,$end,$filed,$t=0){ 
		$sql ='';
		date_default_timezone_set( "PRC" );
		if($start != '' || $end != '') {
			if($start != '' && $end != '') {
				if($t==0){
					$st_time = strtotime($start );
					$en_time    = strtotime($end." 23:59:59" );
					$sql= "&& ".$filed.">='".$st_time."'&& ".$filed."<='".$en_time."'";
				}else{
					$sql= "&& ".$filed.">='".$start."' && ".$filed."<= '".$end."'";
				}
			} elseif($start != '') {
				if($t==0){
					$st_time = strtotime($start );
					$sql= "&& ".$filed.">='".$st_time."'&& ".$filed."<='".time()."'";
				}else{
					$sql= "&& ".$filed.">='".$start."' && ".$filed."<= '".date( "Y-m-d" )."'";
				}
			}
		}
		return $sql;
	}
	
	
	 /**
      * 获取咨询人员sql
      * @param  [type]  $user 咨询人员
      * @return [type]         [description]
      */
    function setUser($user){
    	$sql = '';
    	if($user !=0) {
			$Userinfo     = M('User')->where(array('id' => $user))->find();
			$sql .= " && type_in ='" . $Userinfo['name'] . "'";
		}else{
			if(session('m_id')==1){
			    $hfgroup=M('User')->where(array('m_id' => array('IN',array(1,2,3,5))))->select();	
			}else{
				$hfgroup=M('User')->where(array('m_id' => array('IN',array(2,3))))->select();		
			}
			foreach($hfgroup as $hfv){
				$hfname .="'".$hfv['name']."'".',';
			}
			$hfstr=substr($hfname, 0, -1);
			$other = ",'杨馨蕊','毛俊会','周玉慧'";
		    $sql .= "&& type_in in($hfstr $other)";
		}
		return $sql;
    }
    
    
     /**
     * 通过id字符串你查询相应的数据表，从而获取sql语句
     */
	 function StrTableSql($str,$table,$filed,$filed2){
	 	$sql = '';
    	if($str !=0) {
			$array= explode( ",", $str);  
			if(count($array)==1){
				$item = M($table)->where(array('id' => $str))->find();
			    $sql .= $filed."='" . $item[$filed2] . "'";
			}else{
				foreach($array as $key => $val ) { 
					$item = M($table)->where(array('id' => $val))->find();
					if($key==0){
						$sql .= $filed."= '" . $item[$filed2] . "'";
					}else{
						$sql .= "  or ".$filed."= '" . $item[$filed2] . "'";
					}
				}
			}
			return " && (".$sql.")";
		}
    }
    
    
    /**
     * 通过id查询相应的数据表，从而获取sql语句
     */
    function TableSql($id,$table,$filed,$filed2){
	 	$sql = '';
    	if($id !=0) {
    		$item = M($table)->where(array('id' => $id))->find();
			$sql .= "&& ".$filed."='" . $item[$filed2] . "'";
		}
		return $sql;
    }
    
    
    /**
     * 根据id字符串，获取sql语句
     */
	function StrSql($str,$filed){
	 	$sql = '';
    	if($str !=0) {
			$array= explode( ",", $str);  
			if(count($array)==1){
			    $sql .= $filed."='" . $str . "'";
			}else{
				foreach($array as $key => $val ) { 
					if($key==0){
						$sql .= $filed."= '" . $val . "'";
					}else{
						$sql .= "  or ".$filed."= '" . $val . "'";
					}
				}
			}
			return " && (".$sql.")";
		}
    }
     /**
     * 获取简报查询sql
     */
	function getJianSqls($info,$t=''){
		    if($info=='tomorrow_yudao'){
				$sql  = array('isorder'=>1,'time' => array('EQ',date('Y-m-d',C('TOMORROW_START'))));//明日预到
				$sql2 = "&& time = '" .date('Y-m-d',C('TOMORROW_START'))."' && isorder=1";//明日预到
				$text = '明日[ <bl>'.date('Y-m-d',C('TOMORROW_START')).'</bl> ] <b>预到</b>';
			}
			if($info=='tomorrow_daizhen'){
			    $sql=array('time' => array('EQ',date('Y-m-d',C('TOMORROW_START'))),'laiyuan'=>'否','isorder'=>0);//明日待诊[登记]
			    $sql2 = "&& time = '" .date('Y-m-d',C('TOMORROW_START'))."' && laiyuan='否' && 'isorder'=0";//
			    $text = '明日[ <bl>'.date('Y-m-d',C('TOMORROW_START')).'</bl> ] <b>待诊</b>';
			}
			
			
			if($info=='today_add'){
			    $sql  = array('in_time' => array(array('EGT',C('TODAY_START')),array('ELT',time())));//今日录入
			    $sql2 = "&& in_time >='".C('TODAY_START')."' && in_time <='".time()."'";//今日录入
			    $text = '今日[ <bl>'.date('Y-m-d').'</bl> ] <b>录入</b>';
			}
			if($info=='today_yuyue'){
			    $sql  = array('isorder'=>1,'in_time' => array(array('EGT',C('TODAY_START')),array('ELT',time())));//今日录入
			    $sql2 = "&& in_time >='".C('TODAY_START')."' && in_time <='".time()."' && isorder=1";//今日录入
			    $text = '今日[ <bl>'.date('Y-m-d').'</bl> ] <b>预约</b>';
			}
			if($info=='today_yudao'){
				$sql  = array('isorder'=>1,'time' => array('EQ',date('Y-m-d',C('TODAY_START'))));//今日预到
				$sql2 = "&& time ='".date('Y-m-d',C('TODAY_START'))."' && isorder=1";//今日预到
				$text = '今日[ <bl>'.date('Y-m-d').'</bl> ] <b>预到</b>';
			}
			if($info=='today_yidao'){
			    $sql  = array('time' => array('EQ',date('Y-m-d',C('TODAY_START'))),'laiyuan'=>'是');//今日已到院
			    $sql2 = "&& time ='".date('Y-m-d',C('TODAY_START'))."' && laiyuan='是'";//今日已到院
			    $text = '今日[ <bl>'.date('Y-m-d').'</bl> ] <b>到院</b>';
			}
			if($info=='today_weidao'){
			    $sql  = array('isorder'=>1,'time' => array('EQ',date('Y-m-d',C('TODAY_START'))),'laiyuan'=>'否');//今日未到
			    $sql2 = "&& time ='".date('Y-m-d',C('TODAY_START'))."' && laiyuan='否' && isorder=1";//今日未到院
			    $text = '今日[ <bl>'.date('Y-m-d').'</bl> ] <b>未到</b>';
			}
			if($info=='today_daizhen'){
				$sql  = array('time' => array('EQ',date('Y-m-d',C('TODAY_START'))),'laiyuan'=>'否','isorder'=>0);//今日改约
				$sql2 = "&& time ='".date('Y-m-d',C('TODAY_START'))."' && laiyuan='否' && isorder=0";//今日改约
				$text = '今日[ <bl>'.date('Y-m-d').'</bl> ] <b>改约</b>';
			}
			
			
			if($info=='yesterday_add'){
				$sql  = array('in_time' => array(array('EGT',C('YESTERDAY_START')),array('ELT',C('YESTERDAY_END'))));//昨日录入
				$sql2 = "&& in_time >='".C('YESTERDAY_START')."'&& in_time <='".C('YESTERDAY_END')."'";//昨日录入
				$text = '昨日[ <bl>'.date('Y-m-d',C('YESTERDAY_START')).'</bl> ] <b>录入</b>';
			}
			if($info=='yesterday_yuyue'){
				$sql  = array('isorder'=>1,'in_time' => array(array('EGT',C('YESTERDAY_START')),array('ELT',C('YESTERDAY_END'))));//昨日录入
				$sql2 = "&& in_time >='".C('YESTERDAY_START')."'&& in_time <='".C('YESTERDAY_END')."' && isorder=1";//昨日录入
				$text = '昨日[ <bl>'.date('Y-m-d',C('YESTERDAY_START')).'</bl> ] <b>预约</b>';
			}
			if($info=='yesterday_yudao'){
				$sql  = array('isorder'=>1,'time' => array('EQ',date('Y-m-d',C('YESTERDAY_START'))));//昨日预到
				$sql2 = "&& time ='".date('Y-m-d',C('YESTERDAY_START'))."' && isorder=1";//昨日预到
				$text = '昨日[ <bl>'.date('Y-m-d',C('YESTERDAY_START')).'</bl> ] <b>预到</b>';
			}
			if($info=='yesterday_yidao'){
			    $sql=array('time' => array('EQ',date('Y-m-d',C('YESTERDAY_START'))),'laiyuan'=>'是');//昨日到院
			    $sql2 = "&& time ='".date('Y-m-d',C('YESTERDAY_START'))."' && laiyuan='是'";//昨日已到院
			    $text = '昨日[ <bl>'.date('Y-m-d',C('YESTERDAY_START')).'</bl> ] <b>到院</b>';
			}
			if($info=='yesterday_weidao'){
				$sql  = array('isorder'=>1,'time' => array('EQ',date('Y-m-d',C('YESTERDAY_START'))),'laiyuan'=>'否');//昨日未到
				$sql2 = "&& time ='".date('Y-m-d',C('YESTERDAY_START'))."' && laiyuan='否' && isorder=1";//昨日未到院
				$text = '昨日[ <bl>'.date('Y-m-d',C('YESTERDAY_START')).'</bl> ] <b>未到</b>';
			}
			if($info=='yesterday_daizhen'){
			    $sql  = array('time' => array('EQ',date('Y-m-d',C('YESTERDAY_START'))),'laiyuan'=>'否','isorder'=>0);//昨日待诊
			    $sql2 = "&& time ='".date('Y-m-d',C('YESTERDAY_START'))."' && laiyuan='否' && isorder=0";//昨日改约
			    $text = '昨日[ <bl>'.date('Y-m-d',C('YESTERDAY_START')).'</bl> ] <b>待诊</b>';
			}
			
			if($info=='month_add'){
			   $sql  = array('in_time' => array(array('EGT',C('MONTH_START')),array('ELT',C('MONTH_END'))));//本月录入
			   $sql2 = "&& in_time >='".C('MONTH_START')."' && in_time <='".C('MONTH_END')."'";//本月录入
			   $text = '本月[ <bl>'.date('Y-m-d',C('MONTH_START')).'</bl> ~ <bl>'.date('Y-m-d',C('MONTH_END')).'</bl>] <b>录入</b></b>';
			}
			if($info=='month_yuyue'){
			   $sql  = array('isorder'=>1,'in_time' => array(array('EGT',C('MONTH_START')),array('ELT',C('MONTH_END'))));//本月录入
			   $sql2 = "&& in_time >='".C('MONTH_START')."' && in_time <='".C('MONTH_END')."' && isorder=1";//本月录入
			   $text = '本月[ <bl>'.date('Y-m-d',C('MONTH_START')).'</bl> ~ <bl>'.date('Y-m-d',C('MONTH_END')).'</bl>] <b>预约</b></b>';
			}
			if($info=='month_yudao'){
				$sql  = array('isorder'=>1,'time' => array(array('EGT',date('Y-m-d',C('MONTH_START'))),array('ELT',date('Y-m-d',C('MONTH_END')))));//本月预约
				$sql2 = "&& time >='".date('Y-m-d',C('MONTH_START'))."' && time <='".date('Y-m-d',C('MONTH_END'))."' && isorder=1";//本月预约
				$text = '本月[ <bl>'.date('Y-m-d',C('MONTH_START')).'</bl> ~ <bl>'.date('Y-m-d',C('MONTH_END')).'</bl>] <b>预约</b>';
			}
			if($info=='month_yidao'){
			    $sql  = array('time' => array(array('EGT',date('Y-m-d',C('MONTH_START'))),array('ELT',date('Y-m-d',C('MONTH_END')))),'laiyuan'=>'是');//本月到院
			    $sql2 = "&& time >='".date('Y-m-d',C('MONTH_START'))."' && time <='".date('Y-m-d',C('MONTH_END'))."' && laiyuan='是'";//本月到院
			    $text = '本月[ <bl>'.date('Y-m-d',C('MONTH_START')).'</bl> ~ <bl>'.date('Y-m-d',C('MONTH_END')).'</bl>] <b>到院</b>';
			}
			if($info=='month_weidao'){
			   $sql  = array('isorder'=>1,'time' => array(array('EGT',date('Y-m-d',C('MONTH_START'))),array('ELT',date('Y-m-d',C('MONTH_END')))),'laiyuan'=>'否');//本月未到
			   $sql2 = "&& time >='".date('Y-m-d',C('MONTH_START'))."' && time <='".date('Y-m-d',C('MONTH_END'))."' && laiyuan='否' && isorder=1";//本月未到
			   $text = '本月[ <bl>'.date('Y-m-d',C('MONTH_START')).'</bl> ~ <bl>'.date('Y-m-d',C('MONTH_END')).'</bl>] <b>未到</b>';
			}
			if($info=='month_daizhen'){
				$sql  = array('time' => array(array('EGT',date('Y-m-d',C('MONTH_START'))),array('ELT',date('Y-m-d',C('MONTH_END')))),'laiyuan'=>'否','isorder'=>0);//本月待诊
			    $sql2 = "&& time >='".date('Y-m-d',C('MONTH_START'))."' && time <='".date('Y-m-d',C('MONTH_END'))."' && laiyuan='否' && isorder=0";//本月待诊
			    $text = '本月[ <bl>'.date('Y-m-d',C('MONTH_START')).'</bl> ~ <bl>'.date('Y-m-d',C('MONTH_END')).'</bl>] <b>待诊</b>';
			}
			
			if($info=='lastmonth_add'){
			    $sql  = array('in_time' => array(array('EGT',C('LASTMONTH_START')),array('ELT',C('LASTMONTH_END'))));//上月录入
			    $sql2 = "&& in_time >='".C('LASTMONTH_START')."' && in_time <='".C('LASTMONTH_END')."'";//上月录入
			    $text = '上月[ <bl>'.date('Y-m-d',C('LASTMONTH_START')).'</bl> ~ <bl>'.date('Y-m-d',C('LASTMONTH_END')).'</bl>] <b>录入</b>';
			}
			if($info=='lastmonth_yuyue'){
			    $sql  = array('isorder'=>1,'in_time' => array(array('EGT',C('LASTMONTH_START')),array('ELT',C('LASTMONTH_END'))));//上月录入
			    $sql2 = "&& in_time >='".C('LASTMONTH_START')."' && in_time <='".C('LASTMONTH_END')."' && isorder=1";//上月录入
			    $text = '上月[ <bl>'.date('Y-m-d',C('LASTMONTH_START')).'</bl> ~ <bl>'.date('Y-m-d',C('LASTMONTH_END')).'</bl>] <b>预约</b>';
			}
			if($info=='lastmonth_yudao'){
				$sql  = array('isorder'=>1,'time' => array(array('EGT',date('Y-m-d',C('LASTMONTH_START'))),array('ELT',date('Y-m-d',C('LASTMONTH_END')))));//上月预约
				$sql2 = "&& time >='".date('Y-m-d',C('LASTMONTH_START'))."' && time <='".date('Y-m-d',C('LASTMONTH_END'))."' && isorder=1";//上月预约
				$text = '上月[ <bl>'.date('Y-m-d',C('LASTMONTH_START')).'</bl> ~ <bl>'.date('Y-m-d',C('LASTMONTH_END')).'</bl>] <b>预约</b>';
			}
			if($info=='lastmonth_yidao'){
				$sql  = array('laiyuan_time' =>array(array('EGT',C('LASTMONTH_START')),array('ELT',C('LASTMONTH_END'))),'laiyuan'=>'是');//上月到院
				$sql2 = "&& time >='".date('Y-m-d',C('LASTMONTH_START'))."' && time <='".date('Y-m-d',C('LASTMONTH_END'))."' && laiyuan='是'";//上月到院
				$text = '上月[ <bl>'.date('Y-m-d',C('LASTMONTH_START')).'</bl> ~ <bl>'.date('Y-m-d',C('LASTMONTH_END')).'</bl>] <b>到院</b>';
			}
			if($info=='lastmonth_weidao'){
			    $sql  = array('isorder'=>1,'time' => array(array('EGT',date('Y-m-d',C('LASTMONTH_START'))),array('ELT',date('Y-m-d',C('LASTMONTH_END')))),'laiyuan'=>'否');//上月未到
			    $sql2 = "&& time >='".date('Y-m-d',C('LASTMONTH_START'))."' && time <='".date('Y-m-d',C('LASTMONTH_END'))."' && laiyuan='否' && isorder=1";//上月未到
			    $text = '上月[ <bl>'.date('Y-m-d',C('LASTMONTH_START')).'</bl> ~ <bl>'.date('Y-m-d',C('LASTMONTH_END')).'</bl>] <b>未到</b>';
			}
			if($info=='lastmonth_daizhen'){
				$sql  = array('time' => array(array('EGT',date('Y-m-d',C('LASTMONTH_START'))),array('ELT',date('Y-m-d',C('LASTMONTH_END')))),'laiyuan'=>'否','isorder'=>0);//上月待诊
			    $sql2 = "&& time >='".date('Y-m-d',C('LASTMONTH_START'))."' && time <='".date('Y-m-d',C('LASTMONTH_END'))."' && laiyuan='否' && isorder=0";//上月待诊
			    $text = '上月[ <bl>'.date('Y-m-d',C('LASTMONTH_START')).'</bl> ~ <bl>'.date('Y-m-d',C('LASTMONTH_END')).'</bl>] <b>待诊</b>';
			}
			
			if($info=='week_add'){
			    $sql  = array('in_time' => array(array('EGT',C('WEEK_START')),array('ELT',C('WEEK_END'))));//本周录入
			    $sql2 = "&& in_time >='".C('WEEK_START')."' && in_time <='".C('WEEK_END')."'";//本周录入
			    $text = '本周[ <bl>'.date('Y-m-d',C('WEEK_START')).'</bl> ~ <bl>'.date('Y-m-d',C('WEEK_END')).'</bl>] <b>录入</b>';
			}
			if($info=='week_yuyue'){
			    $sql  = array('isorder'=>1,'in_time' => array(array('EGT',C('WEEK_START')),array('ELT',C('WEEK_END'))));//本周录入
			    $sql2 = "&& in_time >='".C('WEEK_START')."' && in_time <='".C('WEEK_END')."' && isorder=1";//本周录入
			    $text = '本周[ <bl>'.date('Y-m-d',C('WEEK_START')).'</bl> ~ <bl>'.date('Y-m-d',C('WEEK_END')).'</bl>] <b>预约</b>';
			}
			if($info=='week_yudao'){
				$sql  = array('isorder'=>1,'time' => array(array('EGT',date('Y-m-d',C('WEEK_START'))),array('ELT',date('Y-m-d',C('WEEK_START')))));//上月预约
				$sql2 = "&& time >='".date('Y-m-d',C('WEEK_START'))."' && time <='".date('Y-m-d',C('WEEK_START'))."' && isorder=1";//上月预约
				$text = '上月[ <bl>'.date('Y-m-d',C('WEEK_START')).'</bl> ~ <bl>'.date('Y-m-d',C('WEEK_START')).'</bl>] <b>预约</b>';
			}
			if($info=='week_yidao'){
			    $sql  = array('laiyuan_time' =>array(array('EGT',C('WEEK_START')),array('ELT',C('WEEK_END'))),'laiyuan'=>'是');//本周到院
			    $sql2 = "&& laiyuan_time >='".C('WEEK_START')."' && laiyuan_time<='".C('WEEK_END')."' && laiyuan ='是'";//本周到院
			    $text = '本周[ <bl>'.date('Y-m-d',C('WEEK_START')).'</bl> ~ <bl>'.date('Y-m-d',C('WEEK_END')).'</bl>] <b>到院</b>';
			}
			if($info=='week_weidao'){
			    $sql  = array('isorder'=>1,'time' => array(array('EGT',date('Y-m-d',C('WEEK_START'))),array('ELT',date('Y-m-d',C('WEEK_END')))),'laiyuan'=>'否');//本周未到
			    $sql2 = "&& time >='".date('Y-m-d',C('WEEK_START'))."' && time<='".date('Y-m-d',C('WEEK_END'))."' && laiyuan ='否' && isorder=1";//本周到院
			    $text = '本周[ <bl>'.date('Y-m-d',C('WEEK_START')).'</bl> ~ <bl>'.date('Y-m-d',C('WEEK_END')).'</bl>] <b>未到</b>';
			}
			$res = array('sql'=>$sql,'sql2'=>$sql2,'text'=>$text);
			if($t!=''){  
				return $res[$t];
			}else{
				return $res;
			}
	}
?>