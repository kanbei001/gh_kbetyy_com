<?php
namespace Home\Controller;
use Think\Controller;
class RecycleController extends BaseauthController {

		public function recycle_list()
		{
			
		$zxylist = M( 'User' )->where( array('m_id' => array('IN',array(2,3,5)) ))->select();
		$huifanglist           = M( 'Callback' )->select();
		$keshilist             = M( 'Section' )->select();
		$arealist              = M( 'Area' )->select();
		$consultlist           = M( 'Consult' )->select();
		$qudaoinfolist         = M( 'Qudaoinfo' )->select();
		$yingxiaolist          = M( 'Yingxiao' )->select();
		$weblist               = M( 'Web' )->select();
		$doctorsectionlist     = M( 'Doctorsection' )->select();
		$this->assign( 'zxylist', $zxylist );
		$this->assign( 'huifanglist', $huifanglist );
		$this->assign( 'keshilist', $keshilist );
		$this->assign( 'arealist', $arealist );
		$this->assign( 'consultlist', $consultlist );
		$this->assign( 'qudaoinfolist', $qudaoinfolist );
		$this->assign( 'yingxiaolist', $yingxiaolist );
		$this->assign( 'weblist', $weblist );
		$this->assign( 'doctorsectionlist', $doctorsectionlist );
		$this->main_menu='回收站';
        $this->son_menu='查看回收信息';
		$this->display();
		}
		
		//预约科室病种加载
		public function kssection_ajax(){
		
		$keshi=I('post.keshi_val');		
		
		
		$bzinfo=M('Bingzhong')->where(array('keshi_id'=>$keshi))->select();	
		
		$bzlist =array('list'=>$bzinfo);
		
		echo json_encode($bzlist);	
		
		
		}		
		
		//登记信息列表ajax表格列表
		public function right_ajax()
		{
		$sessionname = session( 'username' );
		$page        = intval( I( 'post.pageNum' )); //当前页
		$total = intval( M('Deleteinfo')->count()); //记录总数
		if($total>0){
		$pageSize           = 20; //每页显示数 
		$totalPage          = ceil( $total / $pageSize );
		$startPage          = $page * $pageSize;
		$arr['total']     = $total;
		$arr['pageSize']  = $pageSize;
		$arr['totalPage'] = $totalPage;
		$arr['quanxian']  = session( 'm_id' );
		$sql = "select * from bk_deleteinfo  order by in_time desc limit  $startPage,$pageSize";
		$query = M()->query( $sql );
		foreach( $query as $v ) {
		if( $v['sex'] == '1' ) {
		$sex = '男';
		} else if( $v['sex'] == '2' ) {
		$sex = '女';
		} else {
		$sex = '';
		}
		
		if($v['isorder'] ==1) {
		$order = "<span rel='1' style='color:green;'>√</span>";
		} else{
		$order = "<span rel='0' style='color:red;cursor:pointer;'>×</span>";
		}
		
		$Qdinfo           = M( 'Qudaoinfo' )->where( array('id' => $v['info_channel']))->find();
		$info_channel     = $Qdinfo['info_name'];
		$Webinfo          = M( 'Web' )->where( array('id' => $v['source_web']))->find();
		$source_web       = $Webinfo['web_name'];
		$in_time          = date( 'Y-m-d H:i:s', $v['in_time'] );
		$laiyuan_time     = date( 'Y-m-d H:i:s', $v['laiyuan_time'] );
		$arr['list'][ ] = array('id' => $v['id'],
		'yuyue' => $v['yuyue'],
		'username' => $v['username'],
		'sex' => $sex,
		'area' => $v['area'],
		'age' => $v['age'],
		'phone' => $v['phone'],
		'qq' => $v['qq'],
		'keshi' => $v['keshi'],
		'bingzhong' => $v['bingzhong'],
		'bingzheng' => $v['bingzheng'],
		'remark' => $v['remark'],
		'consult' => $v['consult'],
		'info_channel' => $info_channel,
		'marketing' => $v['marketing'],
		'source_web' => $source_web,
		'source_url' => $v['source_url'],
		'keyword' => $v['keyword'],
		'type_in' => $v['type_in'],
		'time' => $v['time'],
		'in_time' => $in_time,
		'doctor' => $v['doctor'],
		'order' => $order,
		'laiyuan' => $v['laiyuan'],
		'huifang' => $v['huifang'],
		'laiyuan_time' => $v['laiyuan_time'],
		'qudao_group_id' => $v['qudao_group_id'],
		'isorder' => $v['isorder'],
		'identitys' => $v['identitys'],
		'huifang_time' => $v['huifang_time']

		);
		}
		echo json_encode( $arr );
		}
		}
		// 预约信息ajax搜索
		public function search_ajax()
		{
		$quanxian     = session( 'm_id' );
		$yuyue        = I( 'post.yuyue' ); //预约号
		$username     = I( 'post.username' ); //姓名
		$phone        = I( 'post.phone' ); //电话
		$in_time      = I( 'post.in_time' ); //录入时间
		$end_time     = I( 'post.end_time' ); //结束录入时间
		$laiyuan_star = I( 'post.laiyuan_star' ); //来院时间
		$laiyuan_end  = I( 'post.laiyuan_end' ); //结束来院时间
		$keshi        = I( 'post.keshi' ); //科室
		$bingzhong    = I( 'post.bingzhong' ); //病种
		$laiyuan      = I( 'post.laiyuan' ); //来院与否
		$chakan       = I( 'post.chakan' ); //查看
		$yuyue_time   = I( 'post.yuyue_time' ); //预约时间
		$end_yuyue    = I( 'post.end_yuyue' ); //结束预约时间
		$qq           = I( 'post.qq' ); //关键词
		$huifang      = I( 'post.huifang' ); //回访
		$diqu         = $_POST['diqu']; //地区
		$web          = $_POST['web']; //来源网站
		$zixun        = $_POST['zixun']; //咨询方式
		$yingxiao     = $_POST['yingxiao']; //营销方式   
		$qudaos       = $_POST['qudao']; //渠道信息
		$page         = intval( I( 'post.pageNum' )); //当前页       
		$pageSize     = 20; //每页显示数 
		$str          = 1;
		$str_1        = $str;
		//判断预约号是否为空
		if( $yuyue != '' )
		$str_1 = $str .= "&&yuyue like'%$yuyue%'";
		//判断用户名是否为空
		if( $username != '' )
		$str_1 = $str .= "&&username like'%$username%'";
		//判断电话是否为空
		if( $phone != '' )
		$str_1 = $str .= "&&phone like '%$phone%'";
		//1.判断录入时间是否为空
		if( $_POST['in_time'] != '' || $_POST['end_time'] != '' ) {
		if( $_POST['in_time'] != '' && $_POST['end_time'] != '' ) {
		date_default_timezone_set( "PRC" );
		$date    = strtotime( $end_time );
		$time_in = date( 'Y-m-d', $date + 1 * 24 * 60 * 60 );
		$str_1   = $str .= "&&in_time>=UNIX_TIMESTAMP('$in_time')&&in_time<=UNIX_TIMESTAMP('$time_in')";
		} elseif( $_POST['in_time'] != '' ) {
		date_default_timezone_set( "PRC" );
		$date_end = date( "Y-m-d H:i:s" );
		$date     = strtotime( $in_time );
		$time_in  = date( 'Y-m-d', $date + 1 * 24 * 60 * 60 );
		$str_1    = $str .= "&&in_time>=UNIX_TIMESTAMP('$in_time')&&in_time<=UNIX_TIMESTAMP('$date_end')";
		}
		}
		//1.判断预约时间是否为空
		if( $yuyue_time != '' || $end_yuyue != '' ) {
		if( $yuyue_time != '' && $end_yuyue != '' ) {
		date_default_timezone_set( "PRC" );
		$date    = strtotime( $end_yuyue );
		$time_in = date( 'Y-m-d', $date + 1 * 24 * 60 * 60 );
		$str_1   = $str .= "&&time>='$yuyue_time'&&time<='$end_yuyue'";
		} else if( $yuyue_time != '' ) {
		date_default_timezone_set( "PRC" );
		$date_end = date( "Y-m-d " );
		$str_1    = $str .= "&&time>='$yuyue_time'";
		}
		}
		//判断来院时间
		if( $_POST['laiyuan_star'] != '' || $_POST['laiyuan_end'] != '' ) {
		if( $_POST['laiyuan_star'] != '' && $_POST['laiyuan_end'] != '' ) {
		date_default_timezone_set( "PRC" );
		$date    = strtotime( $laiyuan_end );
		$time_in = date( 'Y-m-d', $date + 1 * 24 * 60 * 60 );
		$str_1   = $str .= "&&laiyuan_time>=UNIX_TIMESTAMP('$laiyuan_star')&&laiyuan_time<=UNIX_TIMESTAMP('$time_in')";
		} elseif( $_POST['laiyuan_star'] != '' ) {
		date_default_timezone_set( "PRC" );
		$date_end = date( "Y-m-d H:i:s" );
		$date     = strtotime( $laiyuan_star );
		$time_in  = date( 'Y-m-d', $date + 1 * 24 * 60 * 60 );
		$str_1    = $str .= "&&laiyuan_time>=UNIX_TIMESTAMP('$laiyuan_star')&&laiyuan_time<=UNIX_TIMESTAMP('$date_end')";
		}
		}
		//判断科室是否为空
		if( $keshi != 0 ) {
		$Sectioninfo = M( 'Section' )->where( array('id' => $keshi))->find();
		$keshi_name  = "keshi='" . $Sectioninfo['section_name'] . "'";
		$str_1       = $str .= "&&($keshi_name)";
		}
		//判断病种是否为空
		if( $bingzhong != 0 ) {
		$Bingzhonginfo  = M( 'Bingzhong' )->where( array('id' => $bingzhong))->find();
		$bingzhong_name = "bingzhong='" . $Bingzhonginfo['bingzhong_name'] . "'";
		$str_1          = $str .= "&&($bingzhong_name)";
		}
		//1.判断来院是否为空
		//1.判断来院是否为空
		if( $laiyuan != 0 )
		$str_1 = $str .= "&&laiyuan='$laiyuan'";
		//判断咨询员是否为空
		if( $chakan != 0 ) {
		$Userinfo     = M( 'User' )->where( array('id' => $chakan))->find();
		$type_in_name = "type_in='" . $Userinfo['name'] . "'";
		$str_1        = $str .= "&&($type_in_name)";
		} else if( session( 'm_id' ) == 3 || session( 'm_id' ) == 4 ) {
		$type_in_name = "type_in='" . session( 'username' ) . "'";
		$str_1        = $str .= "&&($type_in_name)";
		}
		//判断qq是否为空
		if( $qq != '' )
		$str_1 = $str .= "&&qq like '%$qq%'";
		//判断回访是否为空
		if( $huifang != 0 ) {
		$Callbackinfo = M( 'Callback' )->where( array('id' => $huifang))->find();
		$huifang_name = "huifang='" . $Callbackinfo['callback_name'] . "'";
		$str_1        = $str .= "&&($huifang_name)";
		}
		//判断地区是否为空
		if( $diqu != 0 ) {
		$str_diqu    = "," . $diqu;
		$arr_diqu[ ] = explode( ",", $str_diqu );
		$diqu_id     = $arr_diqu[ 0 ][ 1 ];
		$Areainfo    = M( 'Area' )->where( array('id' => $diqu_id))->find();
		$diqu_name   = "area='" . $Areainfo['area_name'] . "'";
		foreach( $arr_diqu as $key => $val ) {
		for( $i = 1; $i < count( $val ) - 1; $i++ ) {
		$Areainfos = M( 'Area' )->where( array('id' => $val[ $i + 1 ]))->find();
		$diqu_name .= "  or area= '" . $Areainfos['area_name'] . "'";
		}
		}
		$str_1 = $str .= "&&($diqu_name)";
		}
		//判断渠道是否为空
		if( $qudaos != 0 ) {
		$str_qudao    = "," . $qudaos;
		$arr_qudao[ ] = explode( ",", $str_qudao );
		$qudao_id     = $arr_qudao[ 0 ][ 1 ];
		$qudao_name   = "info_channel=" . $qudao_id;
		foreach( $arr_qudao as $key => $val ) {
		for( $i = 1; $i < count( $val ) - 1; $i++ ) {
		$qudao_name .= "  or info_channel= " . $val[ $i + 1 ];
		}
		}
		$str_1 = $str .= "&&($qudao_name)";
		}
		//判断营销是否为空
		if( $yingxiao != 0 ) {
		$str_yingxiao    = "," . $yingxiao;
		$arr_yingxiao[ ] = explode( ",", $str_yingxiao );
		$yingxiao_id     = $arr_yingxiao[ 0 ][ 1 ];
		$Yingxiaoinfo    = M( 'Yingxiao' )->where( array('id' => $yingxiao_id))->find();
		$yingxiao_name   = "marketing='" . $Yingxiaoinfo['yingxiao_name'] . "'";
		foreach( $arr_yingxiao as $key => $val ) {
		for( $i = 1; $i < count( $val ) - 1; $i++ ) {
		$YingxiaoinfoS = M( 'Yingxiao' )->where( array('id' => $val[ $i + 1 ]))->find();
		$yingxiao_name .= "  or marketing= '" . $Yingxiaoinfos['yingxiao_name'] . "'";
		}
		}
		$str_1 = $str .= "&&($yingxiao_name)";
		}
		//判断咨询是否为空
		if( $zixun != 0 ) {
		$str_zixun      = "," . $zixun;
		$arr_consult[ ] = explode( ",", $str_zixun );
		$consult_id     = $arr_consult[ 0 ][ 1 ];
		$Consult        = M( 'Consult' )->where( array('id' => $consult_id))->find();
		$consult_name   = "consult='" . $Consult['consult_name'] . "'";
		foreach( $arr_consult as $key => $val ) {
		for( $i = 1; $i < count( $val ) - 1; $i++ ) {
		$Consults = M( 'Consult' )->where( array('id' => $val[ $i + 1 ]))->find();
		$consult_name .= "  or consult= '" . $Consults['consult_name'] . "'";
		}
		}
		$str_1 = $str .= "&&($consult_name)";
		}
		//判断来源网站是否为空
		if( $web != 0 ) {
		$str_web    = "," . $web;
		$arr_web[ ] = explode( ",", $str_web );
		$web_id     = $arr_web[ 0 ][ 1 ];
		$web_name   = "source_web=" . $web_id;
		foreach( $arr_web as $key => $val ) {
		for( $i = 1; $i < count( $val ) - 1; $i++ ) {
		$web_name .= "  or source_web= " . $val[ $i + 1 ];
		}
		}
		$str_1 = $str .= "&&($web_name)";
		}
		$posts              = M()->query( "select * from bk_deleteinfo where $str_1" );
		$total              = count( $posts ); //记录总数
		if($total>0){
		$totalPage          = ceil( $total / $pageSize ); //总页数 
		$startPage          = $page * $pageSize; //开始记录 
		$sql                = "select * from bk_deleteinfo where $str_1 order by in_time desc limit  $startPage,$pageSize";
		$arr['total']     = $total;
		$arr['pageSize']  = $pageSize;
		$arr['totalPage'] = $totalPage;
		$arr['quanxian']  = $quanxian;
		$query              = M()->query( $sql );
		foreach( $query as $v ) {
		if( $v['sex'] == '1' ) {
		$sex = '男';
		} else if( $v['sex'] == '2' ) {
		$sex = '女';
		} else {
		$sex = '';
		}
		if($v['isorder'] ==1) {
		$order = "<span rel='1' style='color:green;'>√</span>";
		} else{
		$order = "<span rel='0' style='color:red;cursor:pointer;'>×</span>";
		}
		
		$Qdinfo           = M( 'Qudaoinfo' )->where( array('id' => $v['info_channel']))->find();
		$info_channel     = $Qdinfo['info_name'];
		$Webinfo          = M( 'Web' )->where( array('id' => $v['source_web']))->find();
		$source_web       = $Webinfo['web_name'];
		$Yxinfo           = M( 'Yingxiao' )->where( array('id' => $v['marketing']))->find();
		$marketing        = $Yxinfo['yingxiao_name'];
		$in_time          = date( 'Y-m-d H:i:s', $v['in_time'] );
		$laiyuan_time     = date( 'Y-m-d H:i:s', $v['laiyuan_time'] );
		$arr['list'][ ] = array('id' => $v['id'],
		'yuyue' => $v['yuyue'],
		'username' => $v['username'],
		'sex' => $sex,
		'area' => $v['area'],
		'age' => $v['age'],
		'phone' => $v['phone'],
		'qq' => $v['qq'],
		'keshi' => $v['keshi'],
		'bingzhong' => $v['bingzhong'],
		'bingzheng' => $v['bingzheng'],
		'remark' => $v['remark'],
		'consult' => $v['consult'],
		'info_channel' => $info_channel,
		'marketing' => $marketing,
		'source_web' => $source_web,
		'source_url' => $v['source_url'],
		'keyword' => $v['keyword'],
		'type_in' => $v['type_in'],
		'time' => $v['time'],
		'in_time' => $in_time,
		'doctor' => $v['doctor'],
		'order' => $order,
		'laiyuan' => $v['laiyuan'],
		'huifang' => $v['huifang'],
		'laiyuan_time' => $laiyuan_time,
		'isorder' =>$v['isorder'],
		'qudao_group_id' => $v['qudao_group_id'] 
		);
		}
		echo json_encode( $arr );
		   }
		}
	
	
	        public function restore(){
	        $id = I('get.id');
		    $ljinfo=M('Deleteinfo')->where(array('id'=>$id))->find();
		    $data['id']=$ljinfo['id'];
            $data['yuyue']= $ljinfo['yuyue'];//预约号
            $data['laiyuan']= $ljinfo['laiyuan'];//来院
            $data['huifang']= $ljinfo['huifang'];//回访
            $data['doctor']= $ljinfo['doctor'];//医生
            $data['area']= $ljinfo['area'];//地区
            $data['username']=$ljinfo['username'];//客户
            $data['sex']=$ljinfo['sex'];//性别
            $data['age']=$ljinfo['age'];//年龄
            $data['phone']=$ljinfo['phone'];//电话
            $data['qq']=$ljinfo['qq'];//QQ
            $data['keshi']=$ljinfo['keshi'];//科室      
            $data['bingzhong']=$ljinfo['bingzhong'];//病种
            $data['bingzheng']=$ljinfo['bingzheng'];//病症
            $data['remark']=$ljinfo['remark'];//备注
            $data['consult']=$ljinfo['consult'];//咨询方式   
            $data['qudao_group_id']=$ljinfo['qudao_group_id'];
            $data['info_channel']=$ljinfo['info_channel'];//渠道信息
            $data['marketing']=$ljinfo['marketing'];//营销方式
            $data['source_web']=$ljinfo['source_web'];//来源网站
            $data['source_url']=$ljinfo['source_url'];//来源网址
            $data['keyword']=$ljinfo['keyword'];//关键词
            $data['type_in']=$ljinfo['type_in'];//录入者
            $data['time']=$ljinfo['time'];//预约时间
            $data['in_time']= $ljinfo['in_time'];
			$data['laiyuan_time']= $ljinfo['laiyuan_time'];
			$data['qudao_group_id']= $ljinfo['qudao_group_id'];
			$data['isorder']= $ljinfo['isorder'];
			$data['identitys']= $ljinfo['identitys'];
			$data['huifang_time']= $ljinfo['huifang_time'];
		    $posts = M('Kefuinfo')->add($data);
			if($posts){
				$delinfo=M('Deleteinfo')->where(array('id'=>$id))->delete();
				
				if($delinfo){
		        $this->success('信息还原成功');
		                    }else{
		                      $this->error('信息还原成功，请重试功');	
		                         };
				
				
				}
		
	
	}
	
	
	
	//弹窗详情
		public function xiangqing_ajax()
		{
		
		
		
		$id = I('post.ids');
		
		
		$v=M('Deleteinfo')->where(array('id'=>$id))->find();
		
		if($v['sex']=='1'){
		$sex='男'; 
		}else if($v['sex']=='2'){
		$sex='女'; 
		}else{  
		$sex='';    
		}
		
		
		if($v['area']==0){
		$age='';
		
		
		}else{
		
		$age=$v['area'];
		
		}
		
		
		$Qdinfo=M('Qudaoinfo')->where(array('id'=>$v['info_channel']))->find();
		$info_channel=$Qdinfo['info_name'];
		
		
		$Webinfo=M('Web')->where(array('id'=>$v['source_web']))->find();
		$source_web=$Webinfo['web_name'];
		
		
		$in_time=date('Y-m-d H:i:s',$v['in_time']); 
		
		$laiyuan_time=date('Y-m-d H:i:s',$v['laiyuan_time']);
		
		$arr= array(
		'id' => $v['id'], 
		'yuyue' => $v['yuyue'],
		'username'=>$v['username'],
		'sex' => $sex, 
		'area' => $age,
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
		'time'=>$v['time'],
		'in_time'=>$in_time,
		'doctor'=>$v['doctor'],
		'laiyuan'=>$v['laiyuan'],
		'huifang'=>$v['huifang'],
		'laiyuan_time'=>$laiyuan_time,
		'qudao_group_id'=>$v['qudao_group_id'],  
		);
		  echo json_encode($arr); 

		}

	public function recycle_del(){

	$ids=I('get.id');
	$where= array('id' =>$ids);
	$areainfo=M('Deleteinfo')->where($where)->delete();
	
	if($areainfo){	
	$this->success('删除成功！');
	}else{
		
	$this->error('删除失败！');
		}
	}

			
}